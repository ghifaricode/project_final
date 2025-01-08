<!DOCTYPE html>
<html>
<head>
    <title>Laporan Homestay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            color: #333;
        }
        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            cursor: pointer;
        }
        .download-btn:hover {
            background-color: #45a049;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <button onclick="downloadPDF()" class="download-btn">Download PDF</button>

    <div id="content-to-download">
        <h1>Laporan Homestay</h1>

        <h2>Statistik Umum</h2>
        <table>
            <tr>
                <th>Total Users</th>
                <th>Total Rooms</th>
                <th>Total Reservations</th>
                <th>Total Payments</th>
            </tr>
            <tr>
                <td>{{ $total_users }}</td>
                <td>{{ $total_rooms }}</td>
                <td>{{ $total_reservations }}</td>
                <td>{{ $total_payments }}</td>
            </tr>
        </table>

        <h2>Pendapatan Bulanan</h2>
        <table>
            <tr>
                <th>Bulan</th>
                <th>Total Pendapatan</th>
            </tr>
            @foreach($monthly_income as $income)
            <tr>
                <td>{{ $income->month }}</td>
                <td>Rp {{ number_format($income->total_amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <h2>Kamar Populer</h2>
        <table>
            <tr>
                <th>Nama Kamar</th>
                <th>Jumlah Reservasi</th>
            </tr>
            @foreach($popular_rooms as $room)
            <tr>
                <td>{{ $room->name }}</td>
                <td>{{ $room->reservations_count }}</td>
            </tr>
            @endforeach
        </table>

        <h2>Status Reservasi</h2>
        <table>
            <tr>
                <th>Status</th>
                <th>Jumlah</th>
            </tr>
            @foreach($reservation_status as $status)
            <tr>
                <td>{{ $status->status }}</td>
                <td>{{ $status->total }}</td>
            </tr>
            @endforeach
        </table>

        <h2>Penggunaan Metode Pembayaran</h2>
        <table>
            <tr>
                <th>Metode Pembayaran</th>
                <th>Jumlah Penggunaan</th>
            </tr>
            @foreach($payment_methods_usage as $method)
            <tr>
                <td>{{ $method->name }}</td>
                <td>{{ $method->payments_count }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <script>
        function downloadPDF() {
            const element = document.getElementById('content-to-download');
            const options = {
                margin: 1,
                filename: 'laporan-homestay.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().set(options).from(element).save();
        }
    </script>
</body>
</html>