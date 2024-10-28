<!-- resources/views/specialists/show.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Specialist Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Specialist Details</h1>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $specialistData['name'] }}</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Contact Information</th>
                            <td>{{ $specialistData['contact_info'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Specialization</th>
                            <td>{{ $specialistData['specialization'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Availability</th>
                            <td>
                                <ul class="list-group">
                                    @foreach ($specialistData['availability'] as $day)
                                        <li class="list-group-item">{{ $day }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
