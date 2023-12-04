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
    <h2>Number of Research by Program Between {{$start_date->format('F j, Y') }} to {{$end_date->format('F j, Y') }}</h2>
    
    <table border="1">
        <thead>
            <tr>
                <th>Program</th>
                <th>Total No. of Research By Program</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($label_program as $index => $program)
                <tr>
                    <td>{{ $program }}</td>
                    <td class="center">{{ $count_research[$index] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
