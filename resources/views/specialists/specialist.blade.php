<!-- resources/views/specialists/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Specialists</title>
</head>
<body>
    <h1>Specialists and Their Specializations</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Specialist Name</th>
                <th>Specialization</th>
            </tr>
        </thead>
        <tbody>
            @foreach($specialists as $specialist)
                <tr>
                    <td>{{ $specialist->name }}</td>
                    <td>{{ $specialist->specialization->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
