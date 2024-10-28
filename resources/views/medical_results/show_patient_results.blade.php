@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
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

        @forelse($medicalRecords as $medicalRecord)
            <h3>Medical Result for: {{ $medicalRecord->patient->name }}</h3>
            <table class="table table-striped" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Med ID</th>
                        <th>Created by</th>
                        <th>Patient</th>
                        <th>Result</th>
                        <th>Prescription</th>
                        <th>Advice</th>
                        <th>Created At</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicalRecord->medicalResults as $result)
                        <tr>
                            <td>{{ $result->medicalRecord->id }}</td>
                            <td>{{ $result->doctor->name }}</td>
                            <td>{{ $result->medicalRecord->patient->name }}</td>
                            <td>{{ $result->result }}</td>
                            <td>{{ $result->prescription }}</td>
                            <td>{{ $result->advice }}</td>
                            <td>{{ $result->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('medical_results.downloadPdf', $result->medicalRecord->id) }}" class="btn btn-primary">Download PDF</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No medical results found for this record.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @empty
            <p>No medical records found for this patient.</p>
        @endforelse
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
