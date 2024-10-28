<!-- resources/views/specialists/edit.blade.php -->

@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container">
    <h1>Edit Specialist</h1>
    <form action="{{ route('specialists.update', $specialist->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
                        <label for="name" class="form-label">Name <i class="fas fa-user"></i></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly required>
                    </div>
        <div class="mb-3">
                      <label for="specialization">Specialization</label>
                        <select class="form-control" id="specialization" name="specialization_id">
                        <option value=""disabled selected>register specialization...</option>

                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>
        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Info</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ $specialist->contact_info }}" required>
        </div>
        <div class="mb-3">
        <label for="availability">Availability:</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="availability[]" value="Monday" id="monday">
            <label class="form-check-label" for="monday">
                Monday
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="availability[]" value="Tuesday" id="tuesday">
            <label class="form-check-label" for="tuesday">
                Tuesday
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="availability[]" value="Wednesday" id="wednesday">
            <label class="form-check-label" for="wednesday">
                Wednesday
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="availability[]" value="Thursday" id="thursday">
            <label class="form-check-label" for="thursday">
                Thursday
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="availability[]" value="Friday" id="friday">
            <label class="form-check-label" for="friday">
                Friday
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="availability[]" value="Saturday" id="saturday">
            <label class="form-check-label" for="saturday">
                Saturday
            </label>
        </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
