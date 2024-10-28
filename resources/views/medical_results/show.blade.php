<div class="container">
    <h1>Medical Result Details</h1>
    <div>
        <strong>Doctor:</strong> {{ $medicalResult->doctor->name }}
    </div>
    <div>
        <strong>Medical Record:</strong> {{ $medicalResult->medicalRecord->id }}
    </div>
    <div> 
        <strong>Result:</strong> {{ $medicalResult->result }}
    </div>
    <div>
        <strong>Prescription:</strong> {{ $medicalResult->prescription }}
    </div>
    <div>
        <strong>Advice:</strong> {{ $medicalResult->advice }}
    </div>
    <a href="{{ route('medical_results.index') }}" class="btn btn-primary">Back</a>
</div>