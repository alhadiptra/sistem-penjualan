<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan - MochiHaanShop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            padding: 30px 35px;
            background: white;
            color: #000;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header .title {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
        }
        .header .subtitle {
            font-size: 16px;
            font-weight: 600;
            margin-top: 4px;
        }
        .header .date {
            font-size: 14px;
            color: #333;
            margin-top: 2px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            padding: 12px 20px;
            border: 1px solid #000;
            margin-bottom: 20px;
            background: #f9f9f9;
        }
        .info .item {
            text-align: center;
        }
        .info .item .label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info .item .value {
            font-size: 18px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background: #f0f0f0;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        td {
            color: #000;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        .grand-total {
            text-align: right;
            margin-top: 15px;
            padding: 10px 18px;
            border: 1px solid #000;
            background: #f9f9f9;
            font-size: 16px;
            font-weight: 700;
        }

        .footer {
            margin-top: 25px;
            padding-top: 12px;
            border-top: 2px solid #000;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #555;
        }

        @page {
            margin: 15px 20px;
        }
        @media print {
            body {
                padding: 15px 20px;
            }
            .info {
                break-inside: avoid;
            }
            table {
                break-inside: auto;
            }
            tr {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">MOCHIHAANSHOP</div>
        <div class="subtitle">Laporan Penjualan Bulanan</div>
        <div class="date">Periode: {{ date('F Y', strtotime($bulan)) }}</div>
    </div>

    <div class="info">
        <div class="item">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ $orders->count() }}</div>
        </div>
        <div class="item">
            <div class="label">Pendapatan (Selesai)</div>
            <div class="value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="item">
            <div class="label">Total Seluruh Pesanan</div>
            <div class="value">Rp {{ number_format($totalAll, 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:14%;">No. Order</th>
                <th style="width:18%;">Pelanggan</th>
                <th style="width:15%;">Tanggal</th>
                <th style="width:14%;">Kecamatan</th>
                <th style="width:10%;">Metode</th>
                <th style="width:14%; text-align:right;">Total</th>
                <th style="width:10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $key => $order)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order->no_order }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $order->kecamatan ?? '-' }}</td>
                    <td>{{ ucfirst($order->metode_pembayaran) }}</td>
                    <td class="text-right">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding:30px;">Tidak ada pesanan pada bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($orders->count() > 0)
        <div class="grand-total">
            Grand Total: Rp {{ number_format($totalAll, 0, ',', '.') }}
        </div>
    @endif

    <div class="footer">
        <span>Dicetak: {{ date('d F Y H:i:s') }}</span>
        <span>MochiHaanShop - Padang</span>
        <span>Hal. 1 / 1</span>
    </div>

</body>
</html>
