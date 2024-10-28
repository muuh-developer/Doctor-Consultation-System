@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container">
    

    <div class="card-body">
    <h3>Medical Records for {{ $appointment->patient->name }}</h3>
        <table id="datatablesSimple">
        <thead> 
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Symptoms</th>
                <!-- <th>Result</th> -->

            </tr>
        </thead>
        <tbody>
            @foreach($medicalRecords as $record)
            <tr>
                <td>{{ $record->record_datetime->format('Y-m-d H:i') }}</td>
                <td>{{ $record->description }}</td>
                <td>{{ $record->symptoms }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <a href="{{ route('appointments.index') }}" class="btn btn-primary">Back to Appointments</a>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
