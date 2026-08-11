@extends('layouts.app')

@section('title', 'Scan QRIS')

@push('styles')
<style>
    .qris-container {
        max-width: 480px;
        margin: 0 auto;
        background: white;
        border-radius: 24px;
        padding: 40px 30px 30px;
        box-shadow: 0 15px 60px rgba(0,0,0,0.08);
        text-align: center;
        border: 1px solid #f5edf0;
    }

    .qris-header h4 {
        font-weight: 700;
        color: #2d1b2e;
        margin: 0;
    }
    .qris-header p {
        color: #999;
        font-size: 14px;
        margin: 2px 0 0;
    }
    .qris-header p strong {
        color: #d63384;
    }

    .qr-box {
        background: #fef6f9;
        border-radius: 16px;
        padding: 25px;
        margin: 20px 0;
        border: 2px dashed #ffb6c9;
        min-height: 140px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .qr-box img {
        max-width: 200px;
        width: 100%;
    }
    .qr-box i {
        font-size: 70px;
        color: #d63384;
    }

    .amount {
        font-size: 36px;
        font-weight: 700;
        color: #d63384;
        margin: 5px 0 12px;
    }

    .badge-pending {
        background: #ffc107;
        color: #212529;
        padding: 4px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-success {
        background: #28a745;
        color: white;
        padding: 4px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .timer-wrap {
        margin: 15px 0 5px;
    }
    .timer-wrap .timer-label {
        font-size: 13px;
        color: #999;
    }
    .timer-wrap .timer {
        font-size: 24px;
        font-weight: 700;
        color: #dc3545;
    }

    .divider {
        border: none;
        border-top: 1px solid #f0e0e6;
        margin: 20px 0;
    }

    .btn-confirm {
        background: linear-gradient(135deg, #ff69b4, #d63384);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 14px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }
    .btn-confirm:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 20px rgba(214,51,132,0.3);
        color: white;
    }
    .btn-confirm:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .qris-footer {
        font-size: 12px;
        color: #bbb;
        margin-top: 15px;
    }
    .qris-footer i {
        color: #d63384;
    }

    @media (max-width: 480px) {
        .qris-container {
            padding: 25px 18px 20px;
        }
        .amount {
            font-size: 28px;
        }
        .qr-box img {
            max-width: 150px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="qris-container">

        <!-- HEADER -->
        <div class="qris-header">
            <h4>📱 Scan QRIS</h4>
            <p>Pesanan <strong>{{ $order->no_order }}</strong></p>
        </div>

        <!-- QRIS -->
        <div class="qr-box">
            @if(isset($qrisResult['success']) && $qrisResult['success'])
                <img src="data:image/png;base64,{{ $qrisResult['qris_base64'] }}" alt="QRIS">
            @else
                <i class="fas fa-qrcode"></i>
                <p class="text-muted" style="font-size:14px;margin-top:8px;">QRIS Code</p>
                @if(isset($qrisResult['message']))
                    <p class="text-danger small">{{ $qrisResult['message'] }}</p>
                @endif
            @endif
        </div>

        <!-- TOTAL -->
        <div class="amount">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>

        <!-- STATUS -->
        <div>
            @if($order->status_pembayaran == 'sudah_dibayar')
                <span class="badge-success">✅ Sudah Dibayar</span>
            @else
                <span class="badge-pending">⏳ Belum Dibayar</span>
            @endif
        </div>

        <!-- TIMER -->
        <div class="timer-wrap">
            <div class="timer-label">Batas pembayaran</div>
            <div class="timer" id="timer">15:00</div>
        </div>

        <hr class="divider">

        <!-- TOMBOL KONFIRMASI -->
        @if($order->status_pembayaran != 'sudah_dibayar')
            <form action="{{ route('customer.qris.confirm', $order) }}" method="POST">
                @csrf
                <button type="submit" class="btn-confirm" id="btn-konfirmasi">
                    <i class="fas fa-check me-1"></i> Saya Sudah Bayar
                </button>
            </form>
        @endif

        <!-- FOOTER -->
        <div class="qris-footer">
            <i class="fas fa-info-circle"></i> Scan QRIS untuk melakukan pembayaran
        </div>

    </div>
</div>

<script>
    // ===== TIMER =====
    let timeLeft = 15 * 60;
    const timerEl = document.getElementById('timer');
    const interval = setInterval(() => {
        const m = String(Math.floor(timeLeft / 60)).padStart(2, '0');
        const s = String(timeLeft % 60).padStart(2, '0');
        timerEl.textContent = m + ':' + s;
        timeLeft--;
        if (timeLeft < 0) {
            clearInterval(interval);
            timerEl.textContent = '⏰ Waktu habis!';
            timerEl.style.color = '#dc3545';
            document.getElementById('btn-konfirmasi').disabled = true;
        }
    }, 1000);

    // ===== CEK STATUS PEMBAYARAN =====
    @if($order->status_pembayaran == 'sudah_dibayar')
        document.getElementById('btn-konfirmasi').disabled = true;
    @endif
</script>
@endsection
