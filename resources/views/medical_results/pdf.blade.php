<!DOCTYPE html>
<html>
<head>
    <title>Medical Results</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Medical Results for: {{ $medicalRecord->patient->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Med ID</th>
                <th>Created by</th>
                <th>Patient</th>
                <th>Result</th>
                <th>Prescription</th>
                <th>Advice</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicalRecord->medicalResults as $result)
                <tr>
                    <td>{{ $result->medicalRecord->id }}</td>
                    <td>{{ $result->doctor->name }}</td>
                    <td>{{ $result->medicalRecord->patient->name }}</td>
                    <td>{{ $result->result }}</td>
                    <td>{{ $result->prescription }}</td>
                    <td>{{ $result->advice }}</td>
                    <td>{{ $result->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
