@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
<div class="container mt-4">
    <a href="{{ route('specializations.create') }}" class="btn btn-secondary w-100 mb-3">Register new specialization</a>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Specializations Table
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specializations as $specialization)
                        <tr>
                            <th scope="row">{{ $specialization->id }}</th>
                            <td>{{ $specialization->name }}</td>
                            <td>
                                
                                <a href="{{ route('specializations.edit', $specialization->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <form action="{{ route('specializations.destroy', $specialization->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this specialization?')">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')

<!-- DataTables Initialization -->


