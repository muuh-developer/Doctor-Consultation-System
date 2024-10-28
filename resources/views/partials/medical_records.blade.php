@if($medicalRecords->isEmpty())
    <p>No medical records found for this patient.</p>
@else
@foreach($medicalRecords as $record)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $record->record_datetime }}</h5>
            <p class="card-text">{{ $record->description }}</p>
            <p class="card-text"><strong>Symptoms:</strong> {{ $record->symptoms }}</p>
            <p class="card-text"><strong>Prescription:</strong> {{ $record->prescription }}</p>
        </div>
    </div>
@endforeach
