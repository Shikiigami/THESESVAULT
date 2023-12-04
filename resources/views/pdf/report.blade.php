<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Report</title>
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
        h2{
            text-align: center;
        }
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Number of Approved Research by College</h2>
    
    <table>
        <thead>
            <tr>
                <th>College Name</th>
                <th>Total Number of Research</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($myresults as $result)
                <tr>
                    <td>{{ $result->{'myCollege Name'} }}</td>
                    <td class="center">{{ $result->{'myTotal Count'} }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
