
    @include('layouts/templates/header')
    @include('layouts/templates/sidebar')
    @include('layouts/templates/navbar')

    <div class="container">
    <div class="card-body ">
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
        <a href="{{ route('medical_records.create') }}" class="btn btn-secondary w-100 mb-3">Create Medical Record</a>
        <table class="table table-striped" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Desc</th>
                    <th>Symptoms</th>
                    <th>Results</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicalRecords as $record)
                <tr>
                    <td>{{ $record->patient->name }}</td>
                    <td>{{ $record->doctor->name }}</td>
                    <td>{{ $record->record_datetime->format('Y-m-d H:i') }}</td>
                    <td>{{ $record->description }}</td>
                    <td>{{ $record->symptoms }}</td>
                    <td>
                        
                        <a href="{{ route('medical_records.addResult', $record->id) }}" class="btn btn-secondary">Add Result</a>
                            
                    </td>
                    
                    <td>
                        <a href="{{ route('medical_records.edit', $record->id) }}" class="btn btn-secondary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('medical_records.destroy', $record->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
    </div>

    @include('layouts/templates/footer')
    @include('layouts/templates/scripts')

</body>
</html>
