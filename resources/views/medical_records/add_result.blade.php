@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container">
    <div class="card-body">
        <h1>Add Medical Result</h1>
        
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

        <form method="POST" action="{{ route('medical_records.storeMedicalResult', $medicalRecord->id) }}">
            @csrf
            <div class="form-group">
                <label for="doctor_id">Select Doctor:</label>
                <select name="doctor_id" id="doctor_id" class="form-control">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="result" class="form-label">Medical Result</label>
                <textarea class="form-control" id="result" name="result" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label for="prescription" class="form-label">Prescription</label>
                <textarea class="form-control" id="prescription" name="prescription" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="advice" class="form-label">Advice</label>
                <textarea class="form-control" id="advice" name="advice" rows="2"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('medical_records.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
