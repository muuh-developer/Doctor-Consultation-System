@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
    <div class="container">
        <h1>Specialization Details</h1>
        <p><strong>Name:</strong> {{ $specialization->name }}</p>
    </div>
    @include('layouts/templates/footer')
@include('layouts/templates/scripts')           
