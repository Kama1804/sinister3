<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        return view('user.appointment', compact('barbers'));
    }

    public function checkAvailability(Request $request)
    {
        $bookedSlots = Appointment::where('appointment_date', $request->date)
            ->where('outlet', $request->outlet)
            ->where('barber_id', $request->barber)
            ->pluck('appointment_time')
            ->map(function ($time) {
                return date('H:i', strtotime($time));
            })
            ->toArray();

        return response()->json(['bookedSlots' => $bookedSlots]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to book an appointment.');
        }
    
        $validated = $request->validate([
            'appointment_date' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isPast()) {
                        $fail('The appointment date cannot be in the past.');
                    }
                    if ($date->isWeekend()) {
                        $fail('Appointments cannot be made on weekends.');
                    }
                },
            ],
            'appointment_time' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $value);
                    if ($appointmentDateTime->isPast()) {
                        $fail('The appointment time cannot be in the past.');
                    }
                },
            ],
            'outlet' => 'required|string',
            'barber_id' => 'required|exists:barbers,id',
            'services' => 'required|array',
            'services.*' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
        ]);
    
        $existingAppointment = Appointment::where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->where('outlet', $validated['outlet'])
            ->where('barber_id', $validated['barber_id'])
            ->first();
    
        if ($existingAppointment) {
            return redirect()->back()
                ->with('error', 'Sorry, this time slot has already been booked. Please select another time.')
                ->withInput();
        }
    
        try {
            Log::info('Attempting to create appointment with data:', $validated);
            $validated['user_id'] = Auth::id();
            $appointment = Appointment::create($validated);
            Log::info('Appointment created successfully:', ['appointment_id' => $appointment->id]);
            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            Log::error('Appointment creation failed: ' . $e->getMessage(), [
                'data' => $validated,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withInput()->with('error', 'An error occurred while booking the appointment.');
        }
    }
    

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $barbers = Barber::all();
        return view('admin.appointment.edit', compact('appointment', 'barbers'));  // Updated view path
    }

    public function update(Request $request, $id)
    {
        try {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'outlet' => 'required|string',
            'barber_id' => 'required|exists:barbers,id',
            'services' => 'required|array',
            'services.*' => 'string',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($validated);

        return redirect()->route('admin.appointments.table')
            ->with('success', 'Appointment updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Failed to update appointment: ' . $e->getMessage());
    }
}

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments.table')->with('success', 'Appointment deleted successfully!');
    }

    public function table(Request $request)
{
    $search = $request->input('search');

    $appointments = Appointment::with('barber')
        ->when($search, function ($query, $search) {
            $query->where('customer_name', 'like', '%' . $search . '%')
                  ->orWhereHas('barber', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhere('appointment_date', 'like', '%' . $search . '%');
        })
        ->get();

        $serviceNames = [
            'haircut' => 'Haircut',
            'beard_trim' => 'Beard Trim',
            'mans_shave' => 'Mans Shave',
            'hair_dyeing' => 'Hair Dyeing',
            'mustache' => 'Mustache',
            'db' => 'Dreadlock or Braid',
        ];

        return view('admin.appointment.table', compact('appointments', 'serviceNames'));
}

}