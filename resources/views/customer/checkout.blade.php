@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
<style>
    /* ===== LAYOUT ===== */
    .checkout-header {
        background: linear-gradient(135deg, #fef6f9, #fff0f5);
        padding: 25px 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        border: 1px solid #ffb6c9;
    }
    .checkout-header h2 {
        font-weight: 700;
        color: #2d1b2e;
        margin: 0;
    }
    .checkout-header h2 i {
        color: #d63384;
        margin-right: 10px;
    }
    .checkout-header p {
        color: #888;
        margin: 0;
        font-size: 14px;
    }

    .card-pink {
        border-radius: 20px;
        border: 1px solid #f0e0e6;
        box-shadow: 0 5px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
    }
    .card-pink:hover {
        box-shadow: 0 10px 50px rgba(214, 51, 132, 0.08);
    }
    .card-pink .card-header {
        background: linear-gradient(135deg, #fff0f5, #fef6f9);
        border-bottom: 2px solid #ffb6c9;
        padding: 15px 25px;
        font-weight: 600;
        color: #2d1b2e;
    }
    .card-pink .card-header i {
        color: #d63384;
        margin-right: 8px;
    }
    .card-pink .card-body {
        padding: 25px;
    }

    .table-checkout {
        margin-bottom: 0;
    }
    .table-checkout thead th {
        background: #fef6f9;
        color: #d63384;
        font-weight: 600;
        border-bottom: 2px solid #ffb6c9;
        padding: 12px 15px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table-checkout tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f5edf0;
    }
    .table-checkout tbody tr:last-child td {
        border-bottom: none;
    }
    .table-checkout tbody tr:hover {
        background: #fef6f9;
    }
    .table-checkout .product-name {
        font-weight: 600;
        color: #2d1b2e;
    }
    .table-checkout .product-price {
        color: #666;
    }
    .table-checkout .product-subtotal {
        font-weight: 600;
        color: #d63384;
    }

    .summary-box {
        background: linear-gradient(135deg, #fef6f9, #fff0f5);
        border-radius: 16px;
        padding: 20px 25px;
        margin-top: 15px;
        border: 1px solid #ffb6c9;
    }
    .summary-box .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 15px;
    }
    .summary-box .summary-row:last-child {
        border-top: 2px solid #ffb6c9;
        margin-top: 8px;
        padding-top: 15px;
        font-size: 18px;
        font-weight: 700;
    }
    .summary-box .summary-label {
        color: #666;
    }
    .summary-box .summary-value {
        color: #2d1b2e;
        font-weight: 600;
    }
    .summary-box .summary-total-label {
        color: #2d1b2e;
    }
    .summary-box .summary-total-value {
        color: #d63384;
    }

    .delivery-option {
        border: 2px solid #f0e0e6;
        border-radius: 16px;
        padding: 15px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
    .delivery-option:hover {
        border-color: #ff69b4;
        background: #fef6f9;
    }
    .delivery-option.active {
        border-color: #d63384;
        background: #fff0f5;
        box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.15);
    }
    .delivery-option input[type="radio"] {
        accent-color: #d63384;
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
    .delivery-option .icon {
        font-size: 24px;
        flex-shrink: 0;
    }
    .delivery-option .delivery-text {
        flex: 1;
    }
    .delivery-option .delivery-text strong {
        display: block;
        color: #2d1b2e;
        font-weight: 600;
    }
    .delivery-option .delivery-text small {
        color: #888;
        font-size: 13px;
    }
    .delivery-option .delivery-badge {
        background: #e8f4fd;
        color: #0c5460;
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }

    .payment-card {
        border: 2px solid #f0e0e6;
        border-radius: 16px;
        padding: 18px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        text-align: center;
        margin-bottom: 10px;
    }
    .payment-card:hover {
        border-color: #ff69b4;
        background: #fef6f9;
    }
    .payment-card.active {
        border-color: #d63384;
        background: #fff0f5;
        box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.15);
    }
    .payment-card i {
        font-size: 32px;
        color: #d63384;
        display: block;
        margin-bottom: 6px;
    }
    .payment-card strong {
        display: block;
        color: #2d1b2e;
        font-weight: 600;
        font-size: 15px;
    }
    .payment-card small {
        color: #888;
        font-size: 12px;
    }

    .info-ongkir {
        background: #e8f4fd;
        border: 1px solid #b6d4e8;
        border-radius: 12px;
        padding: 10px 15px;
        font-size: 13px;
        color: #0c5460;
        margin-top: 10px;
    }
    .info-ongkir i {
        margin-right: 6px;
    }

    .form-control-custom {
        border-radius: 12px;
        padding: 12px 16px;
        border: 2px solid #f0e0e6;
        transition: all 0.3s ease;
        font-size: 14px;
        width: 100%;
        background: white;
    }
    .form-control-custom:focus {
        border-color: #ff69b4;
        box-shadow: 0 0 0 4px rgba(255, 105, 180, 0.12);
        outline: none;
    }
    .form-control-custom.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15);
    }
    .form-label-custom {
        font-weight: 600;
        color: #2d1b2e;
        font-size: 14px;
        margin-bottom: 6px;
    }
    .form-label-custom .text-danger {
        color: #dc3545;
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
        margin-top: 5px;
    }
    .btn-confirm:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 30px rgba(214, 51, 132, 0.3);
        color: white;
    }
    .btn-confirm i {
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .checkout-header h2 {
            font-size: 22px;
        }
        .table-checkout thead th {
            font-size: 11px;
        }
        .table-checkout tbody td {
            font-size: 13px;
            padding: 8px 10px;
        }
        .summary-box .summary-row {
            font-size: 14px;
        }
        .summary-box .summary-row:last-child {
            font-size: 16px;
        }
        .payment-card {
            padding: 15px;
        }
        .payment-card i {
            font-size: 26px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    <!-- HEADER -->
    <div class="checkout-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2><i class="fas fa-shopping-bag"></i> Checkout</h2>
                <p>Periksa kembali pesanan Anda sebelum melakukan pembayaran</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-pink px-3 py-2">
                    <i class="fas fa-clock me-1"></i> Selesaikan dalam 15 menit
                </span>
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- KOLOM KIRI: RINGKASAN -->
        <div class="col-lg-8">
            <div class="card-pink">
                <div class="card-header">
                    <i class="fas fa-receipt"></i> Ringkasan Pesanan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-checkout">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="product-name">{{ $item->product->nama_produk }}</td>
                                        <td class="product-price">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td class="product-subtotal">Rp {{ number_format($item->product->harga * $item->qty, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- SUMMARY -->
                    <div class="summary-box">
                        <div class="summary-row">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value" id="subtotal-text">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row" id="ongkir-summary" style="display:none;">
                            <span class="summary-label">Ongkos Kirim</span>
                            <span class="summary-value" id="ongkir-text">Rp 0</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-total-label">Total</span>
                            <span class="summary-total-value" id="total-text">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: FORM -->
        <div class="col-lg-4">
            <div class="card-pink">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Detail Pesanan
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.checkout.process') }}" method="POST" id="checkoutForm">
                        @csrf

                        <!-- JENIS PESANAN -->
                        <div class="mb-4">
                            <label class="form-label-custom">Jenis Pesanan</label>
                            <div class="delivery-option active" id="option-ambil">
                                <input type="radio" name="jenis_pesanan" value="ambil_toko" checked>
                                <span class="icon">🏪</span>
                                <div class="delivery-text">
                                    <strong>Ambil di Toko</strong>
                                    <small>Ambil sendiri di toko kami</small>
                                </div>
                            </div>
                            <div class="delivery-option" id="option-diantar">
                                <input type="radio" name="jenis_pesanan" value="diantar">
                                <span class="icon">🚗</span>
                                <div class="delivery-text">
                                    <strong>Diantar</strong>
                                    <small>Pesanan diantar ke alamat Anda</small>
                                </div>
                            </div>
                        </div>

                        <!-- ALAMAT, KECAMATAN, NO HP -->
                        <div id="alamat-section" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label-custom">Alamat Pengiriman <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat-input" class="form-control-custom" rows="2" placeholder="Masukkan alamat lengkap Anda"></textarea>
                            </div>

                            <!-- ✅ PILIHAN KECAMATAN -->
                            <div class="mb-3">
                                <label class="form-label-custom">Kecamatan <span class="text-danger">*</span></label>
                                <select name="kecamatan" id="kecamatan-select" class="form-control-custom">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    <option value="Padang Barat">Padang Barat</option>
                                    <option value="Padang Utara">Padang Utara</option>
                                    <option value="Padang Timur">Padang Timur</option>
                                    <option value="Padang Selatan">Padang Selatan</option>
                                    <option value="Nanggalo">Nanggalo</option>
                                    <option value="Kuranji">Kuranji</option>
                                    <option value="Pauh">Pauh</option>
                                    <option value="Koto Tangah">Koto Tangah</option>
                                    <option value="Lubuk Begalung">Lubuk Begalung</option>
                                    <option value="Lubuk Kilangan">Lubuk Kilangan</option>
                                    <option value="Bungus Teluk Kabung">Bungus Teluk Kabung</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Nomor HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" id="nohp-input" class="form-control-custom" placeholder="0812-3456-7890">
                            </div>

                            <div class="info-ongkir">
                                <i class="fas fa-info-circle"></i>
                                Biaya pengiriman: <strong id="ongkir-info-text">Rp 0</strong>
                            </div>
                        </div>

                        <!-- CATATAN -->
                        <div class="mb-3">
                            <label class="form-label-custom">Catatan</label>
                            <textarea name="catatan" class="form-control-custom" rows="2" placeholder=""></textarea>
                        </div>

                        <hr class="my-3">

                        <!-- METODE PEMBAYARAN -->
                        <label class="form-label-custom">Metode Pembayaran</label>

                        <div class="payment-card active" for="tunai">
                            <input type="radio" name="metode_pembayaran" id="tunai" value="tunai" class="d-none" checked>
                            <i class="fas fa-money-bill-wave"></i>
                            <strong>Tunai</strong>
                            <small>Bayar saat pesanan diterima</small>
                        </div>

                        <div class="payment-card" for="qris">
                            <input type="radio" name="metode_pembayaran" id="qris" value="qris" class="d-none">
                            <i class="fas fa-qrcode"></i>
                            <strong>QRIS</strong>
                            <small>Scan QR Code untuk pembayaran</small>
                        </div>

                        <input type="hidden" name="ongkir" id="ongkir-input" value="0">
                        <input type="hidden" name="total_harga" id="total-input" value="{{ $total }}">

                        <button type="submit" class="btn-confirm">
                            <i class="fas fa-check-circle"></i> Konfirmasi Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== PAYMENT CARD TOGGLE =====
    document.querySelectorAll('.payment-card').forEach(function(card) {
        card.addEventListener('click', function() {
            document.querySelectorAll('.payment-card').forEach(function(c) {
                c.classList.remove('active');
            });
            this.classList.add('active');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    // ===== DELIVERY OPTION TOGGLE =====
    const optionAmbil = document.getElementById('option-ambil');
    const optionDiantar = document.getElementById('option-diantar');
    const alamatSection = document.getElementById('alamat-section');
    const ongkirSummary = document.getElementById('ongkir-summary');
    const ongkirText = document.getElementById('ongkir-text');
    const totalText = document.getElementById('total-text');
    const totalInput = document.getElementById('total-input');
    const ongkirInput = document.getElementById('ongkir-input');
    const kecamatanSelect = document.getElementById('kecamatan-select');
    const ongkirInfoText = document.getElementById('ongkir-info-text');

    const subtotal = {{ $total }};

    // ===== MAP ONGKIR PER KECAMATAN =====
    const ongkirMap = {
        'Padang Barat': 4000,
        'Padang Utara': 6000,
        'Padang Timur': 7000,
        'Padang Selatan': 8000,
        'Nanggalo': 9000,
        'Kuranji': 10000,
        'Pauh': 11000,
        'Koto Tangah': 12000,
        'Lubuk Begalung': 13000,
        'Lubuk Kilangan': 15000,
        'Bungus Teluk Kabung': 18000
    };

    // ===== FUNGSI UPDATE SUMMARY =====
    function updateSummary(jenis) {
        const ongkir = parseInt(ongkirInput.value) || 0;

        if (jenis === 'diantar') {
            alamatSection.style.display = 'block';
            ongkirSummary.style.display = 'flex';
            const total = subtotal + ongkir;
            ongkirText.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(ongkir);
            totalText.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            totalInput.value = total;
        } else {
            alamatSection.style.display = 'none';
            ongkirSummary.style.display = 'none';
            ongkirInput.value = 0;
            totalText.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
            totalInput.value = subtotal;
        }
    }

    // ===== KECAMATAN CHANGE =====
    kecamatanSelect.addEventListener('change', function() {
        const ongkir = ongkirMap[this.value] || 0;
        ongkirInput.value = ongkir;
        ongkirInfoText.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(ongkir);

        const jenis = document.querySelector('input[name="jenis_pesanan"]:checked').value;
        updateSummary(jenis);
    });

    // ===== DELIVERY OPTION CLICK =====
    optionAmbil.addEventListener('click', function() {
        document.querySelectorAll('.delivery-option').forEach(function(el) {
            el.classList.remove('active');
        });
        this.classList.add('active');
        this.querySelector('input[type="radio"]').checked = true;
        ongkirInput.value = 0;
        kecamatanSelect.value = '';
        ongkirInfoText.textContent = 'Rp 0';
        updateSummary('ambil_toko');
    });

    optionDiantar.addEventListener('click', function() {
        document.querySelectorAll('.delivery-option').forEach(function(el) {
            el.classList.remove('active');
        });
        this.classList.add('active');
        this.querySelector('input[type="radio"]').checked = true;
        updateSummary('diantar');
    });

    // ===== DEFAULT =====
    updateSummary('ambil_toko');

    // ==========================================================
    // ===== VALIDASI FORM =====
    // ==========================================================
    const checkoutForm = document.getElementById('checkoutForm');
    const alamatInput = document.getElementById('alamat-input');
    const nohpInput = document.getElementById('nohp-input');

    alamatInput.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
    nohpInput.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });

    checkoutForm.addEventListener('submit', function(e) {
        const jenisPesanan = document.querySelector('input[name="jenis_pesanan"]:checked');
        let errorMessage = '';

        alamatInput.classList.remove('is-invalid');
        nohpInput.classList.remove('is-invalid');

        if (jenisPesanan && jenisPesanan.value === 'diantar') {
            if (!alamatInput.value.trim()) {
                errorMessage = 'Silakan masukkan alamat pengiriman!';
                alamatInput.classList.add('is-invalid');
                alamatInput.focus();
            } else if (!kecamatanSelect.value) {
                errorMessage = 'Silakan pilih kecamatan!';
                kecamatanSelect.classList.add('is-invalid');
                kecamatanSelect.focus();
            } else if (!nohpInput.value.trim()) {
                errorMessage = 'Silakan masukkan nomor HP!';
                nohpInput.classList.add('is-invalid');
                nohpInput.focus();
            } else if (nohpInput.value.trim().replace(/\D/g, '').length < 10) {
                errorMessage = 'Nomor HP minimal 10 digit!';
                nohpInput.classList.add('is-invalid');
                nohpInput.focus();
            }
        }

        if (errorMessage) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: errorMessage,
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor: '#d63384'
            });
        }
    });
});
</script>
@endsection
