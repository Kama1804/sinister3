<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller

    {
        // Add service names as a property
        private $serviceNames = [
            'haircut' => 'Haircut',
            'beard_trim' => 'Beard Trim',
            'mans_shave' => 'Mans Shave',
            'hair_dyeing' => 'Hair Dyeing',
            'mustache' => 'Mustache',
            'db' => 'Dreadlock or Braid'
        ];
    // Show user profile
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not authenticated.');
        }

        return view('user.profile', compact('user'));
    }

    // Show user's appointments
    public function appointments()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not authenticated.');
        }

        // Get user's appointments with the barber relationship
        $appointments = Appointment::with('barber')
            ->where('user_id', $user->id)
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->get();

            return view('user.my_appointment', [
                'appointments' => $appointments,
                'serviceNames' => $this->serviceNames
            ]);
        }

    // Cancel an appointment
    public function cancelAppointment($id)
    {
        $appointment = Appointment::find($id);
    
        if (!$appointment || $appointment->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action.'
            ]);
        }
    
        // Ensure appointment is in the future
        if (Carbon::parse($appointment->appointment_date)->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot cancel past appointments.'
            ]);
        }
    
        $appointment->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment cancelled successfully!'
        ]);
    }
    // Update user profile
    public function updateProfile(Request $request)
    {
        try {
            // Start database transaction
            DB::beginTransaction();
    
            $user = Auth::user(); // Get the authenticated user
    
            // Check if the user is authenticated
            if (!$user) {
                return back()->with('error', 'User not authenticated.');
            }
    
            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id, // Exclude current user from uniqueness check
                'password' => 'nullable|min:8', // Only validate password if provided
            ]);
    
            // Log the data we're trying to update for debugging
            Log::debug('Updating user data', $validated);
    
            // Prepare the data to be updated
            $updatedData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];
    
            // If password is provided, hash it and add it to the data
            if (!empty($validated['password'])) {
                $updatedData['password'] = Hash::make($validated['password']);
            }
    
            // Log the final update data for debugging
            Log::debug('Final data for update', $updatedData);
    
            // Perform the update operation
            $user = User::find(Auth::id());
            $updateResult = $user->update($updatedData);
    
            // Check if the update was successful
            if ($updateResult) {
                // Commit the transaction
                DB::commit();
                Log::info('User profile updated successfully', ['user_id' => $user->id]);
                return back()->with('success', 'Profile updated successfully.');
            } else {
                // If the update failed, throw an exception
                throw new \Exception('Failed to update user profile.');
            }
        } catch (\Exception $e) {
            // Rollback transaction on failure
            DB::rollBack();
            
            // Log the error with details
            Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->all(), // Log the request data to see what was sent
            ]);
    
            // Return the error message to the user
            return back()->withInput()->with('error', 'Failed to update profile. Error: ' . $e->getMessage());
        }
    }
}
