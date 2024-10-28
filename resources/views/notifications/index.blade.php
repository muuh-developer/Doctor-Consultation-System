@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center">Notifications</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($notifications->isEmpty())
                <p>No notifications found.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Doctor</th>
                            <th>Appointment ID</th>
                            <th>Message</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->id }}</td>
                                <td>{{ $notification->doctor->name }}</td>
                                <td>{{ $notification->appointment->id }}</td>
                                <td>{{ $notification->message }}</td>
                                <td>{{ $notification->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
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
            @endif
        </div>
    </div>
</div>

@include('layouts.templates.footer')
@include('layouts.templates.scripts')
