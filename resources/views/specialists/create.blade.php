@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Hi, {{ auth()->user()->name }}, please fill in the details</h4>
                    <form action="{{ route('specialists.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <i class="fas fa-user"></i></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ auth()->user()->name }}" readonly required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_info" class="form-label">Contact Info <i class="fas fa-phone"></i></label>
                                <input type="tel" class="form-control" id="contact_info" name="contact_info" placeholder="valid phone number" required>
                                <small class="form-text text-muted primary">Must  be 10 digits long.</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="specialization" class="form-label">Specialization</label>
                                <select class="form-control" id="specialization" name="specialization_id">
                                    <option value=""disabled selected>select speciality...</option>
                                    @foreach($specializations as $specialization)
                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
