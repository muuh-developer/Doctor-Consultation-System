@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
<div class="container mt-4">
    <div class="card card-body text-center">
    <h3>Medical Results History</h3>
    <table class="table table-striped" id="datatablesSimple">
        <thead>
            <tr>
                <th>created by</th>
                <th>Time</th>
                <th>Patient</th>
                <th>Med ID</th>
                <th>Result</th>
                <th>Prescription</th>
                <th>Advice</th>
                @if($usertype != 1)
                <th>Download</th>
                @endif
                @if($usertype != 0)
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        </div>
        <tbody>
            @foreach($medicalResults as $result)
            <tr>
                <td>{{ $result->doctor->name }}</td>
                <td>{{ $result->created_at }}</td>
                <td>{{ $result->medicalRecord->patient->name }}</td>
                <td>{{ $result->medicalRecord->id }}</td>
                <td>{{ $result->result }}</td>
                <td>{{ $result->prescription }}</td>
                <td>{{ $result->advice }}</td>
                @if($usertype != 1)
                <td>
                <a href="{{ route('medical_results.downloadPdf', $result->medicalRecord->id) }}" class="btn btn-primary">Download PDF</a>

                </td>
                @endif
                @if($usertype != 0)

                <td>
                    <form action="{{ route('medical-results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this medical result?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="('Do you want to delete this result history?')">
                            <i class = "fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 
</div>
@include('layouts/templates/footer')
@include('layouts/templates/scripts')