
@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container mt-4">
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
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($usertype != 3 && $usertype != 1)
    <button type="button" class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#createSpecialistModal">
        Fill your details here
    </button>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <!-- <i class="fas fa-table me-1"></i> -->
            @if($usertype == 3)
            Available specialist Records
            @elseif($usertype == 1)
            <b><h6 class= "text-center ">SPECIALIZATION DETAILS</h6></b>
            @else
            Your Records
            @endif
        </div>
        <div class="card-body ">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        
                        <th>Contact Info</th>
                        <th>Availability</th>
                        <th>specialty</th>
                        @if($usertype !=1)
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($specialists as $specialist)
                    <tr>
                        <td>{{ $specialist->name }}</td>
                        <td>{{ $specialist->contact_info }}</td>
                        <td>{{ $specialist->availability }}</td>
                        <td>{{ $specialist->specialization_name }}</td>

                        @if($usertype !=1)
                        <td>
                        
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSpecialistModal"
                                    data-id="{{ $specialist->id }}"
                                    data-name="{{ $specialist->name }}" 
                                    data-specialty="{{ $specialist->specialty }}"
                                    data-contact_info="{{ $specialist->contact_info }}"
                                    data-availability="{{ $specialist->availability }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('specialists.destroy', $specialist->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Specialist Modal -->
<div class="modal fade" id="createSpecialistModal" tabindex="-1" aria-labelledby="createSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSpecialistModalLabel">Fill your details here</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body">
                <form action="{{ route('specialists.store') }}" method="POST" id="createSpecialistForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <i class="fas fa-user"></i></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly required>
                    </div>
            
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                    </div>
                    <div class="mb-3">
    <label for="availability" class="form-label">Availability <i class="fas fa-calendar-alt"></i></label>
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

                    <div class="mb-3">
                      <label for="specialization">Specialization</label>
                        <select class="form-control" id="specialization" name="specialization_id">
                        <option value=""disabled selected>register specialization...</option>

                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createSpecialistForm">Save Specialist</button>
            </div>
        </div>
    </div>
</div>

<!-- View Specialist Modal -->
<div class="modal fade" id="viewSpecialistModal" tabindex="-1" aria-labelledby="viewSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSpecialistModalLabel">View Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="viewName"></span></p>
                <p><strong>Specialty:</strong> <span id="viewSpecialty"></span></p>
                <p><strong>Contact Info:</strong> <span id="viewContactInfo"></span></p>
                <p><strong>Availability:</strong> <span id="viewAvailability"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Specialist Modal -->
<div class="modal fade" id="editSpecialistModal" tabindex="-1" aria-labelledby="editSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpecialistModalLabel">Edit Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editSpecialistForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
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
                        <label for="editContactInfo" class="form-label">Contact Info</label>
                        <input type="tel" class="form-control" id="editContactInfo" name="contact_info" value="{{ old('contact_info', $specialist->contact_info) }}" required>
                        <small class="form-text text-muted primary">Must start with "07" or "06" and be 10 digits long.</small>

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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editSpecialistForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    var viewModal = document.getElementById('viewSpecialistModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('viewName').textContent = button.getAttribute('data-name');
        document.getElementById('viewSpecialty').textContent = button.getAttribute('data-specialty');
        document.getElementById('viewContactInfo').textContent = button.getAttribute('data-contact_info');
        document.getElementById('viewAvailability').textContent = button.getAttribute('data-availability');
    });

    var editModal = document.getElementById('editSpecialistModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var form = document.getElementById('editSpecialistForm');
        form.action = '/specialists/' + button.getAttribute('data-id');
        document.getElementById('editId').value = button.getAttribute('data-id');
        document.getElementById('editName').value = button.getAttribute('data-name');
        document.getElementById('editSpecialty').value = button.getAttribute('data-specialty');
        document.getElementById('editContactInfo').value = button.getAttribute('data-contact_info');
        document.getElementById('editAvailability').value = button.getAttribute('data-availability');
    });
});
</script>
