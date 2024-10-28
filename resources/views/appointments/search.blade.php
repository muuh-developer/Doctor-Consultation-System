@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Search Available Appointments</h3>

                    <form action="{{ route('appointments.search') }}" method="GET">
                        <div class="mb-3">
                            <label for="specialization_id" class="form-label">Specialization</label>
                            <select class="form-control" id="specialization_id" name="specialization_id">
                                <option value="">Select Specialization</option>
                                @foreach($specializations as $specialization)
                                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    @if(isset($appointments) && count($appointments) > 0)
                        <div class="mt-4">
                            <h4>Available Appointments</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Specialization</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->doctor->name }}</td>
                                            <td>{{ $appointment->specialization->name }}</td>
                                            <td>{{ $appointment->appointment_datetime }}</td>
                                            <td>{{ $appointment->appointment_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-4">No available appointments found for the selected specialization.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
