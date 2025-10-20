<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            width: 80mm;
            margin: 0 auto;
        }

        .center {
            text-align: center;
        }

        .header {
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
            margin-bottom: 5px;
        }

        .footer {
            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 5px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 3px 0;
            vertical-align: top;
        }

        .left { text-align: left; }
        .right { text-align: right; }
        .center { text-align: center; }

        /* Lebar kolom disesuaikan supaya rapi */
        .col-item { width: 35%; }
        .col-harga { width: 20%; }
        .col-berat { width: 15%; }
        .col-subtotal { width: 30%; }

        .total {
            border-top: 1px dashed #000;
            font-weight: bold;
            padding-top: 4px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header center">
        <strong>SI LAUNDRY</strong><br>
        Jl. Contoh No.123<br>
        Telp: 0812-3456-7890
    </div>

    <div>
        <p>
            <b>No. Transaksi:</b> {{ $transaksi->id }}<br>
            <b>Tanggal:</b> {{ $transaksi->tanggal_transaksi }}<br>
            <b>Pelanggan:</b> {{ $transaksi->nama_pelanggan }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="left col-item">Item</th>
                <th class="right col-harga">Harga</th>
                <th class="right col-berat">Kg</th>
                <th class="right col-subtotal">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="left col-item">{{ $layanan->nama_layanan ?? '-' }}</td>
                <td class="right col-harga">Rp {{ number_format($layanan->harga_satuan, 0, ',', '.') }}</td>
                <td class="right col-berat">{{ $transaksi->berat }}</td>
                <td class="right col-subtotal">Rp {{ number_format($layanan->harga_satuan * $transaksi->berat, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3" class="right"><b>Total Bayar</b></td>
                <td class="right"><b>Rp {{ number_format($layanan->harga_satuan * $transaksi->berat, 0, ',', '.') }}</b></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan kami!</p>
        <p>~ Cucian Bersih, Hati Pun Senang ~</p> <br>
        <br>
        <br>
        <br>
        <br>
        <button class="no-print" onclick="window.print()">🖨️ Cetak</button>
    </div>
</body>
</html>
