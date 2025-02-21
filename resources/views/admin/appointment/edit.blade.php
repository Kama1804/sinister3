@include('admin.header')
<link rel="stylesheet" href="{{ asset('css/appointment.css') }}">
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Appointment</h2>
    <div class="appointment-layout">
        
        {{-- Calendar Section --}}
        <div class="calendar-section mb-3">
            <h4 class="text-center">Select a Date</h4>
            <div id="custom-calendar" class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-title">Pick date & time:</div>
                    <div class="month-navigation">
                        <button class="nav-btn prev-month">&lt;</button>
                        <span class="month-year"></span>
                        <button class="nav-btn next-month">&gt;</button>
                    </div>
                </div>
                <div class="calendar-grid">
                    <!-- Day headers and date cells will be generated by JavaScript -->
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="form-section">
            <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Customer Details --}}
                <div class="form-group mb-3">
                    <label for="customer_name">Customer Name:</label>
                    <input type="text" class="form-control" name="customer_name" value="{{ $appointment->customer_name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" name="phone" value="{{ $appointment->phone }}" required>
                </div>

                {{-- Date Selection --}}
                <input type="hidden" id="appointment_date" name="appointment_date" value="{{ $appointment->appointment_date }}" required>

                {{-- Outlet Selection --}}
                <div class="form-group mb-3">
                    <label for="outlet">Select Outlet:</label>
                    <select class="form-control" name="outlet" id="outlet" required>
                        <option value="eco_grandeur" {{ $appointment->outlet == 'eco_grandeur' ? 'selected' : '' }}>Eco Grandeur</option>
                        <option value="taman_ilmu" {{ $appointment->outlet == 'taman_ilmu' ? 'selected' : '' }}>Taman Ilmu</option>
                    </select>
                </div>

                {{-- Barber Selection --}}
                <div class="form-group mb-3">
                    <label for="barber">Select Barber:</label>
                    <select class="form-control" name="barber_id" id="barber" required>
                        @foreach($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ $appointment->barber_id == $barber->id ? 'selected' : '' }} data-outlet="{{ $barber->outlet }}">
                                {{ $barber->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Services Selection --}}
                <div class="form-group mb-3">
    <label for="services">Select Services:</label>
    <div class="services-container">
        @foreach($appointment->services as $service)
            <div class="service-row mb-2">
                <select class="form-control service-select" name="services[]" required>
                    <option value="haircut" {{ $service == 'haircut' ? 'selected' : '' }}>Haircut</option>
                    <option value="beard_trim" {{ $service == 'beard_trim' ? 'selected' : '' }}>Beard Trim</option>
                    <option value="mans_shave" {{ $service == 'mans_shave' ? 'selected' : '' }}>Mans Shave</option>
                    <option value="hair_dyeing" {{ $service == 'hair_dyeing' ? 'selected' : '' }}>Hair Dyeing</option>
                    <option value="mustache" {{ $service == 'mustache' ? 'selected' : '' }}>Mustache</option>
                    <option value="db" {{ $service == 'db' ? 'selected' : '' }}>Dreadlock or Braid</option>
                </select>
                <button type="button" class="btn btn-danger remove-service">Remove</button>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-secondary" id="add-service">Add Another Service</button>
</div>

                {{-- Time Slot --}}
                <div class="form-group mb-3">
                    <label for="appointment_time">Select Time:</label>
                    <div class="time-slots">
                    @foreach(['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
                    '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30','18:00', '18:30','19:00', '19:30'] as $time)
                            <button type="button" class="btn btn-outline-primary time-slot" data-time="{{ $time }}">
                                {{ $time }}
                            </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="appointment_time" id="appointment_time" value="{{ $appointment->appointment_time }}" required>
                </div>

                {{-- Submit Button --}}
                 <button type="submit" id="updateButton" class="btn btn-success">Update</button>
                <a href="{{ route('admin.appointments.table') }}" class="btn btn-danger mb-0">Back to Appointment List</a>
                {{-- Success or Error Message --}}
                {{-- Remove any existing success/error message scripts --}}

@if(session('success'))
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.appointments.table') }}";
                }
            });
        }
    </script>
@endif

@if(session('error'))
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        }
    </script>
@endif
            </form>
        </div>
    </div>
</div>

<script>
    // Calendar and form-related JS code to handle selection events
    document.getElementById('appointmentForm').addEventListener('submit', function (e) {
        const dateField = document.getElementById("appointment_date");
        const date = new Date(dateField.value);
        const formattedDate = date.toISOString().split("T")[0];
        dateField.value = formattedDate; // Update input value

        document.getElementById('outlet').addEventListener('change', function() {
    const selectedOutlet = this.value;
    const barberOptions = document.querySelectorAll('#barber option');
    
    barberOptions.forEach(option => {
        const barberOutlet = option.getAttribute('data-outlet');
        if (barberOutlet !== selectedOutlet && selectedOutlet !== '') {
            option.style.display = 'none';
        } else {
            option.style.display = 'block';
        }
    });
});

    });
</script>

{{-- Required JavaScript --}}
<script>


document.getElementById('outlet').addEventListener('change', function() {
    const selectedOutlet = this.value;
    const barberSelect = document.getElementById('barber');
    const barberOptions = barberSelect.querySelectorAll('option');
    
    barberSelect.value = ''; // Reset barber selection
    
    barberOptions.forEach(option => {
        if (option.value === '') return; // Skip the placeholder option
        
        if (option.dataset.outlet === selectedOutlet) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
});

class Calendar {
    constructor() {
        this.currentDate = new Date();
        this.selectedDate = null;
        this.monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
        this.dayNames = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
        
        this.initializeCalendar();
        this.setupEventListeners();
    }

    initializeCalendar() {
        const grid = document.querySelector('.calendar-grid');
        
        // Add day headers
        this.dayNames.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'day-header';
            dayHeader.textContent = day;
            grid.appendChild(dayHeader);
        });

        this.renderCalendar();
    }

    setupEventListeners() {
        // Add navigation button listeners
        document.querySelector('.prev-month').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.renderCalendar();
        });

        document.querySelector('.next-month').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.renderCalendar();
        });
    }

    formatDate(date) {
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    isDateInPast(date) {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        return date < today;
    }

renderCalendar() {
    const grid = document.querySelector('.calendar-grid');
    const monthYear = document.querySelector('.month-year');

    // Update month and year display
    monthYear.textContent = `${this.monthNames[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;

    // Clear existing dates
    const existingDates = grid.querySelectorAll('.date-cell, .empty-cell');
    existingDates.forEach(cell => cell.remove());

    // Calculate first day and number of days
    const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1).getDay();
    const daysInMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0).getDate();

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement('div');
        emptyCell.className = 'empty-cell';
        grid.appendChild(emptyCell);
    }

    // Add date cells
    for (let day = 1; day <= daysInMonth; day++) {
        const dateCell = document.createElement('div');
        dateCell.className = 'date-cell';
        dateCell.textContent = day;

        const cellDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), day);
        const formattedCellDate = this.formatDate(cellDate);

        // Check if it's the selected date
        if (formattedCellDate === selectedAppointmentDate) {
            dateCell.classList.add('selected');
            this.selectedDate = cellDate;
            document.getElementById('appointment_date').value = formattedCellDate;
        }

        const isWeekend = cellDate.getDay() === 0 || cellDate.getDay() === 6;

        if (isWeekend) {
            dateCell.classList.add('weekend-day');
        } else if (this.isDateInPast(cellDate)) {
            dateCell.classList.add('past-date');
        } else {
            dateCell.addEventListener('click', () => {
                if (!dateCell.classList.contains('fully-booked') && !dateCell.classList.contains('weekend-day')) {
                    const previousSelected = grid.querySelector('.selected');
                    if (previousSelected) {
                        previousSelected.classList.remove('selected');
                    }
                    dateCell.classList.add('selected');
                    this.selectedDate = cellDate;
                    document.getElementById('appointment_date').value = this.formatDate(this.selectedDate);
                    checkAvailableTimeSlots();
                }
            });
        }

        // Check if date is today
        const today = new Date();
        if (day === today.getDate() &&
            this.currentDate.getMonth() === today.getMonth() &&
            this.currentDate.getFullYear() === today.getFullYear()) {
            dateCell.classList.add('today');
        }

        grid.appendChild(dateCell);
    }
}

}

const selectedAppointmentTime = "{{ substr($appointment->appointment_time, 0, 5) }}";
document.addEventListener('DOMContentLoaded', function () {
    new Calendar();
    
    // Add service button functionality
    document.getElementById('add-service').addEventListener('click', function () {
        const container = document.querySelector('.services-container');
        const serviceRow = document.querySelector('.service-row').cloneNode(true);
        serviceRow.querySelector('select').value = ''; // Reset to empty
        container.appendChild(serviceRow);
    });

    // Remove service button functionality
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-service')) {
            const servicesCount = document.querySelectorAll('.service-row').length;
            if (servicesCount > 1) {
                e.target.closest('.service-row').remove();
            }
        }
    });

    // Time slot selection functionality
    document.querySelectorAll('.time-slot').forEach(button => {
        // First, normalize the time format for comparison
        const buttonTime = button.dataset.time;
        const normalizedSelectedTime = selectedAppointmentTime.substring(0, 5); // Get just HH:mm

        button.addEventListener('click', function () {
            if (!this.classList.contains('disabled')) {
                document.querySelectorAll('.time-slot').forEach(btn => {
                    btn.classList.remove('selected');
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-outline-primary');
                });
                this.classList.add('selected');
                this.classList.remove('btn-outline-primary');
                this.classList.add('btn-primary');
                document.getElementById('appointment_time').value = this.dataset.time;
            }
        });

        // Check if this is the selected time and highlight it
        if (buttonTime === normalizedSelectedTime) {
            button.classList.remove('btn-outline-primary');
            button.classList.add('btn-primary');
            button.classList.add('selected');
            document.getElementById('appointment_time').value = buttonTime;
        }
    });
});

    // Initialize the selected time slot
    const timeSlot = document.querySelector(`.time-slot[data-time="${selectedAppointmentTime}"]`);
    if (timeSlot) {
        timeSlot.classList.remove('btn-outline-primary');
        timeSlot.classList.add('btn-primary');
        timeSlot.classList.add('selected');
    }


['outlet', 'barber'].forEach(id => {
    document.getElementById(id).addEventListener('change', checkAvailableTimeSlots);
});

function checkAvailableTimeSlots() {
    const date = document.getElementById('appointment_date').value;
    const outlet = document.getElementById('outlet').value;
    const barber = document.getElementById('barber').value;

    if (date && outlet && barber) {
        // First, enable all time slots
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('disabled');
        });

        // Make an AJAX call to check booked slots
        fetch(`/check-availability?date=${date}&outlet=${outlet}&barber=${barber}`)
            .then(response => response.json())
            .then(data => {
                const currentTime = new Date().getHours() * 60 + new Date().getMinutes();
                const currentDate = new Date().toISOString().split('T')[0];

                document.querySelectorAll('.time-slot').forEach(slot => {
                    const timeStr = slot.dataset.time;
                    const [hours, minutes] = timeStr.split(':').map(Number);
                    const slotTime = hours * 60 + minutes;

                    // Disable the slot if:
                    // 1. It's in the booked slots array
                    // 2. It's today and the time has passed
                    if (data.bookedSlots.includes(timeStr)) {
                        slot.classList.add('disabled');
                        slot.title = 'This time slot is already booked';
                    } else if (date === currentDate && slotTime <= currentTime) {
                        slot.classList.add('disabled');
                        slot.title = 'This time slot has passed';
                    }
                });
            })
            .catch(error => {
                console.error('Error checking availability:', error);
            });
    }
}


    // Replace the existing form submission handler with this updated version
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.fire({
                title: 'Saving...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit the form
            this.submit();
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info');
        }
    });
});


['outlet', 'barber'].forEach(id => {
    document.getElementById(id).addEventListener('change', checkAvailableTimeSlots);
});
</script>
<script>
    const selectedAppointmentDate = "{{ $appointment->appointment_date }}";
    
</script>

