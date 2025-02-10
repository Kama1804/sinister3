@include('user.header')
<link rel="stylesheet" href="{{ asset('css/appointment.css') }}">
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
{{-- Main appointment booking form layout --}}
<div class="container mt-5">
    <h2 class="text-center mb-4">BOOK AN APPOINTMENT</h2>
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
                    <!-- Day headers will be added here by JavaScript -->
                    <!-- Date cells will be added here by JavaScript -->
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="form-section">
        <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST">

                @csrf
                <input type="hidden" id="appointment_date" name="appointment_date" required>

                {{-- Update the outlet selection options --}}
<div class="form-group mb-3">
    <label for="outlet">Select Outlet:</label>
    <select class="form-control" name="outlet" id="outlet" required>
        <option value="">Choose an outlet</option>
        <option value="eco_grandeur">Eco Grandeur</option>
        <option value="taman_ilmu">Taman Ilmu</option>
    </select>
</div>

{{-- Update the barber selection input name --}}
<div class="form-group mb-3">
    <label for="barber">Select Barber:</label>
    <select class="form-control" name="barber_id" id="barber" required>
        <option value="">Choose a barber</option>
        @foreach($barbers as $barber)
            <option value="{{ $barber->id }}" data-outlet="{{ $barber->outlet }}">
                {{ $barber->name }}
            </option>
        @endforeach
    </select>
</div>




                {{-- Services Selection (Multiple) --}}
                <div class="form-group mb-3">
                    <label>Select Services:</label>
                    <div class="services-container">
                        <div class="service-row mb-2">
                            <select class="form-control service-select" name="services[]" required>
                                <option value="">Choose a service</option>
                                <option value="haircut">Haircut</option>
                                <option value="beard_trim">Beard Trim</option>
                                <option value="mans_shave">Mans Shave</option>
                                <option value="hair_dyeing">Hair Dyeing</option>
                                <option value="mustache">Mustache</option>
                                <option value="db">Dreadlock or Braid</option>
                            </select>
                            <button type="button" class="btn btn-danger remove-service">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="add-service">Add Another Service</button>
                </div>

                {{-- Time Slots --}}
                <div class="form-group mb-3">
                    <label>Select Time:</label>
                    <div class="time-slots">
                        @foreach(['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
                                 '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30','18:00', '18:30','19:00', '19:30'] as $time)
                            <button type="button" class="btn btn-outline-primary time-slot" data-time="{{ $time }}">
                                {{ $time }}
                            </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="appointment_time" id="appointment_time" required>
                </div>

                {{-- Customer Details --}}
                <div class="form-group mb-3">
                    <label for="customer_name">Your Name:</label>
                    <input type="text" class="form-control" name="customer_name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Contact Number:</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
<button type="submit" class="btn btn-primary">Book Appointment</button>
        <script>
        document.getElementById("appointmentForm").addEventListener("submit", function (e) {
            const dateField = document.getElementById("appointment_date");
            const date = new Date(dateField.value);
            const formattedDate = date.toISOString().split("T")[0]; // Format to YYYY-MM-DD
            dateField.value = formattedDate; // Update the input value
        });

        document.getElementById('appointmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Check if a time slot is selected
    const selectedTime = document.querySelector('.time-slot.selected');
    if (!selectedTime) {
        Swal.fire({
            icon: 'warning',
            title: 'No Time Slot Selected',
            text: 'Please select a time slot.',
            showConfirmButton: true,
        });
        return;
    }

    // Check if the selected time slot is disabled
    if (selectedTime.classList.contains('disabled')) {
        Swal.fire({
            icon: 'error',
            title: 'Time Slot Unavailable',
            text: 'This time slot is not available. Please select another time.',
            showConfirmButton: true,
        });
        return;
    }

    // If all validations pass, submit the form
    this.submit();
});

    </script>
            </form>
        </div>
    </div>
</div>



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
            
            // Check if it's a weekend
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

// DOM Content Loaded Event Handler
document.addEventListener('DOMContentLoaded', function () {
    new Calendar();

    // Add service button handler
    document.getElementById('add-service').addEventListener('click', function () {
        const container = document.querySelector('.services-container');
        const serviceRow = document.querySelector('.service-row').cloneNode(true);
        serviceRow.querySelector('select').value = '';
        container.appendChild(serviceRow);
    });

    // Remove service button handler
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-service')) {
            const servicesCount = document.querySelectorAll('.service-row').length;
            if (servicesCount > 1) {
                e.target.closest('.service-row').remove();
            }
        }
    });

    // Time slot selection handler
    document.querySelectorAll('.time-slot').forEach(button => {
        button.addEventListener('click', function () {
            if (!this.classList.contains('disabled')) {
                document.querySelectorAll('.time-slot').forEach(btn => {
                    btn.classList.remove('selected');
                });
                this.classList.add('selected');
                document.getElementById('appointment_time').value = this.dataset.time;
            }
        });
    });

    // Form submission handler
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate required fields
        const requiredFields = {
            'appointment_date': 'Please select a date',
            'outlet': 'Please select an outlet',
            'barber_id': 'Please select a barber',
            'customer_name': 'Please enter your name',
            'phone': 'Please enter your contact number'
        };

        for (const [fieldId, message] of Object.entries(requiredFields)) {
            const field = document.getElementById(fieldId) || this.querySelector(`[name="${fieldId}"]`);
            if (!field || !field.value.trim()) {
                Swal.fire({
                    title: 'Warning!',
                    text: message,
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                if (field) field.focus();
                return;
            }
        }

        // Validate service selection
        const services = document.querySelectorAll('.service-select');
        let hasService = false;
        services.forEach(service => {
            if (service.value) hasService = true;
        });

        if (!hasService) {
            Swal.fire({
                title: 'Warning!',
                text: 'Please select at least one service',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Check if a time slot is selected
        const selectedTime = document.querySelector('.time-slot.selected');
        if (!selectedTime) {
            Swal.fire({
                title: 'Warning!',
                text: 'Please select a time slot',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Check if the selected time slot is disabled
        if (selectedTime.classList.contains('disabled')) {
            Swal.fire({
                title: 'Warning!',
                text: 'This time slot is not available. Please select another time.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return;
        }

// Directly submit the form without confirmation
Swal.fire({
    title: 'Processing...',
    text: 'Please wait while we book your appointment',
    allowOutsideClick: false,
    showConfirmButton: false,
    willOpen: () => {
        Swal.showLoading();
    }
});

// Submit the form directly
this.submit();


    });
});

// Outlet change handler
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

// Available time slots checker
function checkAvailableTimeSlots() {
    const date = document.getElementById('appointment_date').value;
    const outlet = document.getElementById('outlet').value;
    const barber = document.getElementById('barber').value;

    if (date && outlet && barber) {
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('disabled');
        });

        fetch(`/check-availability?date=${date}&outlet=${outlet}&barber=${barber}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const currentTime = new Date().getHours() * 60 + new Date().getMinutes();
                const currentDate = new Date().toISOString().split('T')[0];

                document.querySelectorAll('.time-slot').forEach(slot => {
                    const timeStr = slot.dataset.time;
                    const [hours, minutes] = timeStr.split(':').map(Number);
                    const slotTime = hours * 60 + minutes;

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
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to check time slot availability. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
    }
}

// Add event listeners for outlet and barber selection
['outlet', 'barber'].forEach(id => {
    document.getElementById(id).addEventListener('change', checkAvailableTimeSlots);
});
</script>

@include('user.footer')