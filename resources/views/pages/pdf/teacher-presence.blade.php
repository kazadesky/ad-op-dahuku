<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Kehadiran Guru</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
            color: #333;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 10pt;
            color: #666;
        }

        .page-number:after {
            content: counter(page);
        }

        .date {
            float: left;
            text-align: left;
        }

        .page-break {
            page-break-after: always;
        }

        .title {
            font-size: 18pt;
            font-weight: bold;
            color: #333;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="header">
        @if ($month && $year)
            Laporan Kehadiran Guru Bulan {{ $month }} Tahun {{ $year }}
        @elseif ($year)
            Laporan Kehadiran Guru Tahun {{ $year }}
        @else
            Laporan Kehadiran Guru Tahun {{ \Carbon\Carbon::now()->year }}
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Guru Piket</th>
                <th>Guru</th>
                <th>Pelajaran</th>
                <th>Kelas</th>
                <th>Hari, Tanggal</th>
                <th>Jam</th>
                <th>Status Kehadiran</th>
                <th>Guru Pengganti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacherPresences as $index => $presence)
                <tr>
                    <td>{{ $index + 1 }}.</td>
                    <td>{{ $presence->teacherPicket->name }}</td>
                    <td>{{ $presence->teacher->name }}</td>
                    <td>{{ $presence->lesson->name }}</td>
                    <td>{{ $presence->classRoom->name }}</td>
                    <td>{{ $presence->day->name }},
                        {{ \Carbon\Carbon::parse($presence->updated_at)->format('d-m-Y') }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($presence->time->start)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($presence->time->finish)->format('H:i') }}
                    </td>
                    <td>{{ $presence->status }}</td>
                    <td>{{ $presence->substituteTeacher ? $presence->substituteTeacher->name : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="date">
            Tanggal Cetak: {{ date('d-m-Y') }}
        </div>
        <div class="page-number">
            Halaman: <span class="page-number"></span> -
        </div>
    </div>
</body>

</html>
