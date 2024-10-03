<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {   
            text-align: left;
            padding: 5px;
            border: 1px solid #000;
        }
        th{
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        h2, h1{
            text-align: center;
        }
        .center{
            text-align: center;
        }

    </style>
</head>
<body>
    <h1>Login Report - Year {{ $year }}</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Program</th>
                <th>Login Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logins as $login)
            <tr>
                <td>{{ $login->program }}</td>
                <td>{{ $login->login_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
