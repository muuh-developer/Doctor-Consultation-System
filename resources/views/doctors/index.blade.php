<!-- resources/views/doctors/index.blade.php -->

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
    @if($usertype != 3)

    <button type="button" class="btn btn-secondary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#createDoctorModal">
        Add Doctor informations
    </button>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            @if($usertype == 3)
            Available Doctor Records
            @else
            Your Records
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>sex</th>
                        <th>Speciality</th>
                        <th>Contact Info</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->gender }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>{{ $doctor->contact_info }}</td>
                            <td>
                        
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editDoctorModal"
                                        data-id="{{ $doctor->id }}"
                                        data-name="{{ $doctor->name }}" 
                                        data-specialization="{{ $doctor->specialization }}"
                                        data-contact_info="{{ $doctor->contact_info }}"
                                        data-availability="{{ $doctor->availability }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Doctor Modal -->
<div class="modal fade" id="createDoctorModal" tabindex="-1" aria-labelledby="createDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDoctorModalLabel">Add Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctors.store') }}" method="POST" id="createDoctorForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{ auth()->user()->name }}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" required>
                    </div> 
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                         <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createDoctorForm">Save Doctor</button>
            </div>
        </div>
    </div>
</div>

<!-- View Doctor Modal -->
<div class="modal fade" id="viewDoctorModal" tabindex="-1" aria-labelledby="viewDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDoctorModalLabel">View Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="viewName"></span></p>
                <p><strong>Specialization:</strong> <span id="viewSpecialization"></span></p>
                <p><strong>Contact Info:</strong> <span id="viewContactInfo"></span></p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Doctor Modal -->
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editDoctorForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{ auth()->user()->name }}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" >
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSpecialization" class="form-label">Specialization</label>
                        <input type="text" class="form-control" id="editSpecialization" name="specialization" >
                    </div>
                    <div class="mb-3">
                        <label for="editContactInfo" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" id="editContactInfo" name="contact_info" >
                    </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editDoctorForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    var viewModal = document.getElementById('viewDoctorModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('viewName').textContent = button.getAttribute('data-name');
        document.getElementById('viewSpecialization').textContent = button.getAttribute('data-specialization');
        document.getElementById('viewContactInfo').textContent = button.getAttribute('data-contact_info');
        document.getElementById('viewAvailability').textContent = button.getAttribute('data-availability');
    });

    var editModal = document.getElementById('editDoctorModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var form = document.getElementById('editDoctorForm');
        form.action = '/doctors/' + button.getAttribute('data-id');
        document.getElementById('editId').value = button.getAttribute('data-id');
        document.getElementById('editName').value = button.getAttribute('data-name');
        document.getElementById('editSpecialization').value = button.getAttribute('data-specialization');
        document.getElementById('editContactInfo').value = button.getAttribute('data-contact_info');
        document.getElementById('editAvailability').value = button.getAttribute('data-availability');
    });
});
</script>
