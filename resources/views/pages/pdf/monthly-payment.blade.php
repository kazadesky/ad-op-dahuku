<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Pembayaran Bulanan</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 8px;
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
            Laporan Pembayaran Bulan {{ $month }} Tahun {{ $year }}
        @elseif($year)
            Laporan Pembayaran Bulanan Tahun {{ $year }}
        @else
            Laporan Pembayaran Bulanan Tahun {{ \Carbon\Carbon::now()->year }}
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Santri</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlyPayments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}.</td>
                    <td>{{ $payment->student->name }}</td>
                    <td>{{ $payment->student->classRoom->name }}</td>
                    <td>{{ $payment->moon->name }}</td>
                    <td>{{ $payment->year }}</td>
                    <td>Rp. {{ number_format($payment->price, 0, ',', '.') }}</td>
                    <td>{{ $payment->status }}</td>
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
