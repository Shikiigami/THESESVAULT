<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Results</title>
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
    <h2>Research Between {{$startDate->format('F j, Y') }} to {{$endDate->format('F j, Y') }}</h2>
    <table border="1">
        <thead>
            <tr>
                <th>TITLE</th>
                <th>AUTHOR</th>
                <th>PROGRAM</th>
                <th>CAMPUS</th>
                <th>DATE PUBLISHED</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1 @endphp
            @foreach($files as $file)
            <tr>
                <td>{{ $counter }}. {{$file->filename }}</td>
                <td>{{ $file->author }}</td>
                <td>{{ $file->program }}</td>
                <td>{{ $file->campus }}</td>
                <td>{{ $file->date_published }}</td>
            </tr>
            @php $counter++ @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>