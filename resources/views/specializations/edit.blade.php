@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
    <div class="container">
        <h1>Edit Specialization</h1>
        <form action="{{ route('specializations.update', $specialization->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $specialization->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    @include('layouts/templates/footer')
@include('layouts/templates/scripts')