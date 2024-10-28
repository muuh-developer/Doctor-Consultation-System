@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container">
    <div class="card-body">
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

        <div class="card card-body">
            <h3>Medical results</h3>
        </div>

        <table class="table table-striped" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Result</th>
                    <th>Prescription</th>
                    <th>Advice</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicalRecord->medicalResults as $result)
                    <tr>
                        <td>{{ $result->doctor->name }}</td>
                        <td>{{ $result->result }}</td>
                        <td>{{ $result->prescription }}</td>
                        <td>{{ $result->advice }}</td>
                        <td>{{ $result->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No medical results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
