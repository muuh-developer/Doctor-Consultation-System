@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($usertype != 2)
        <b><a href="{{ route('appointments.create') }}" class="btn btn-secondary w-100 mb-3">Create Appointment</a></b>
    @endif

    <div class="card mb-4 ">
        <div class="card-header ">
            <i class="fas fa-table me-1"></i>
            Appointments Table
        </div>
        <div class="card-body "> 
            <table id="datatablesSimple" class="table table-striped"> 
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Specialization</th>
                        <th>Status</th>
                            <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_datetime }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>{{ $appointment->specialization->name }}</td>
                        <td style="background-color:
                            @if($appointment->status == 'cancelled') red
                            @elseif($appointment->status == 'completed') green
                            @elseif($appointment->status == 'submitted..') yellow
                            @else none
                            @endif;">
                            @if($usertype == 2)
                                <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="submitted.." {{ $appointment->status == 'submitted..' ? 'selected' : '' }}>submitted..</option>
                                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            @else
                                {{ $appointment->status }}
                            @endif
                        </td>
                        <td>
                            @if($usertype == 2)
                                <a href="{{ route('appointments.showMedicalRecords', $appointment->id) }}" class="btn btn-info">Medical Record</a>
                            @endif
                            @if($usertype != 2)
                                <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
