<div class="container">
    <h1>Edit Medical Result</h1>
    <form action="{{ route('medical_results.update', $medicalResult->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Doctor</label>
            <input type="text" class="form-control" id="doctor_id" name="doctor_id" value="{{ $medicalResult->doctor_id }}" required>
        </div>
        <div class="mb-3">
            <label for="medicalrecord_id" class="form-label">Medical Record</label>
            <input type="text" class="form-control" id="medicalrecord_id" name="medicalrecord_id" value="{{ $medicalResult->medicalrecord_id }}" required>
        </div>
        <div class="mb-3">
            <label for="result" class="form-label">Result</label>
            <textarea class="form-control" id="result" name="result" required>{{ $medicalResult->result }}</textarea>
        </div>
        <div class="mb-3">
            <label for="prescription" class="form-label">Prescription</label>
            <textarea class="form-control" id="prescription" name="prescription" required>{{ $medicalResult->prescription }}</textarea>
        </div>
        <div class="mb-3">
            <label for="advice" class="form-label">Advice</label>
            <textarea class="form-control" id="advice" name="advice" required>{{ $medicalResult->advice }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>