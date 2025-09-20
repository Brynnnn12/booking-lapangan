<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Booking - {{ $booking->id }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .receipt-container {
            max-width: 400px;
            margin: 0 auto;
            border: 2px solid #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
            font-size: 10px;
        }

        .booking-info {
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
        }

        .info-label {
            font-weight: bold;
            min-width: 120px;
        }

        .info-value {
            text-align: right;
        }

        .divider {
            border-top: 1px dashed #666;
            margin: 15px 0;
        }

        .total-section {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #dee2e6;
            margin: 20px 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: bold;
        }

        .barcode-section {
            text-align: center;
            margin: 20px 0;
        }

        .barcode {
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            border-top: 1px solid #333;
            padding-top: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-canceled {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <h1>BreezeShield</h1>
            <p>Sistem Booking Lapangan Futsal</p>
            <p>Jl. Contoh No. 123, Kota Example</p>
            <p>Telp: (021) 12345678</p>
        </div>

        <!-- Booking Info -->
        <div class="booking-info">
            <div class="info-row">
                <span class="info-label">No. Booking:</span>
                <span class="info-value">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Booking:</span>
                <span class="info-value">
                    @if ($booking->booking_date)
                        @if (is_string($booking->booking_date))
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}
                        @else
                            {{ $booking->booking_date->format('d/m/Y') }}
                        @endif
                    @else
                        N/A
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Waktu:</span>
                <span class="info-value">
                    {{ is_string($booking->start_time) ? $booking->start_time : $booking->start_time->format('H:i') }} -
                    {{ is_string($booking->end_time) ? $booking->end_time : $booking->end_time->format('H:i') }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Durasi:</span>
                <span class="info-value">{{ $booking->getDurationInHours() }} jam</span>
            </div>
            <div class="info-row">
                <span class="info-label">Customer:</span>
                <span class="info-value">{{ $booking->user->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Lapangan:</span>
                <span class="info-value">{{ $booking->field->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Lokasi:</span>
                <span class="info-value">{{ $booking->field->location }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value">
                    <span class="status-badge status-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </span>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Pricing -->
        <div class="info-row">
            <span class="info-label">Harga per Jam:</span>
            <span class="info-value">Rp {{ number_format($booking->field->price_per_hour, 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Durasi:</span>
            <span class="info-value">{{ $booking->getDurationInHours() }} jam</span>
        </div>

        <div class="divider"></div>

        <!-- Total -->
        <div class="total-section">
            <div class="total-row">
                <span>TOTAL PEMBAYARAN:</span>
                <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Barcode Section -->
        <div class="barcode-section">
            <p style="font-size: 10px; margin-bottom: 5px;">Kode Booking:</p>
            <div class="barcode">
                {!! $barcode !!}
            </div>
            <p style="font-size: 10px; margin-top: 5px; font-family: monospace;">
                {{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima Kasih atas Kunjungan Anda!</strong></p>
            <p>Struk ini dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
            <p>Simpan struk ini sebagai bukti booking</p>
            <p>Untuk informasi lebih lanjut, hubungi customer service</p>
        </div>
    </div>
</body>

</html>
