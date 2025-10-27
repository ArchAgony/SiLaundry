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
            padding: 10px;
        }

        .center {
            text-align: center;
        }

        .header {
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .info p {
            margin: 2px 0;
        }

        .footer {
            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 8px;
            text-align: center;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        td, th {
            padding: 4px 2px;
            vertical-align: top;
            font-size: 12px;
        }

        thead {
            border-bottom: 1px solid #000;
        }

        .left { text-align: left; }
        .right { text-align: right; }

        .total-row {
            border-top: 1px dashed #000;
            font-weight: bold;
            font-size: 13px;
        }

        .item-name {
            width: 40%;
        }

        .item-price {
            width: 20%;
        }

        .item-qty {
            width: 15%;
        }

        .item-subtotal {
            width: 25%;
        }

        @media print {
            .no-print {
                display: none;
            }
            
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    @php
        $firstItem = $transaksiList->first();
        $totalBayar = 0;
    @endphp

    <div class="header center">
        <h3 style="margin: 5px 0;">SI LAUNDRY</h3>
        <div style="font-size: 11px;">
            Jl. Contoh No.123<br>
            Telp: 0812-3456-7890
        </div>
    </div>

    <div class="info">
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($firstItem->tanggal_transaksi)->format('d/m/Y') }}</p>
        <p><strong>Pelanggan:</strong> {{ $firstItem->nama_pelanggan }}</p>
        <p><strong>Waktu:</strong> {{ $firstItem->created_at->format('H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="left item-name">Item</th>
                <th class="right item-price">Harga</th>
                <th class="right item-qty">Kg</th>
                <th class="right item-subtotal">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksiList as $item)
                @php
                    $harga = $item->layanan->harga_satuan ?? 0;
                    $subtotal = $harga * $item->berat;
                    $totalBayar += $subtotal;
                @endphp
                <tr>
                    <td class="left item-name">{{ $item->layanan->nama_layanan ?? '-' }}</td>
                    <td class="right item-price">{{ number_format($harga, 0, ',', '.') }}</td>
                    <td class="right item-qty">{{ $item->berat }}</td>
                    <td class="right item-subtotal">{{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tr class="total-row">
            <td class="left">TOTAL BAYAR</td>
            <td class="right">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p style="margin: 5px 0;">Terima kasih telah menggunakan layanan kami!</p>
        <p style="margin: 5px 0; font-style: italic;">~ Cucian Bersih, Hati Pun Senang ~</p>
    </div>

    <div class="center" style="margin-top: 20px;">
        <button class="no-print" onclick="window.print()" style="padding: 8px 20px; cursor: pointer;">
            🖨️ Cetak Struk
        </button>
    </div>

    <script>
        // Auto print saat halaman dibuka (opsional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>