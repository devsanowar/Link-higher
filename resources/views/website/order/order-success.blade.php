<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Order Confirmation - #{{ $order->order_number ?? $order->id }}</title>
    <style>
        :root {
            --bg: #f6f7fb;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #0f172a;
            --primary: #0d6efd;
            --success: #16a34a;
            --radius: 12px;
            --max: 980px;
            --shadow: 0 6px 18px rgba(13, 16, 30, 0.08);
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color: var(--accent);
        }

        body {
            background: var(--bg);
            margin: 0;
            padding: 32px 18px;
            -webkit-font-smoothing: antialiased
        }

        .wrap {
            max-width: var(--max);
            margin: 0 auto
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden
        }

        .card-inner {
            padding: 28px
        }

        .brand {
            display: flex;
            gap: 16px;
            align-items: center
        }

        .brand img {
            height: 56px;
            object-fit: contain
        }

        .brand h1 {
            font-size: 18px;
            margin: 0;
            letter-spacing: 0.2px
        }

        .top {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            border-bottom: 1px solid #eef2f7;
            padding-bottom: 20px
        }

        .customer {
            min-width: 220px
        }

        .customer p {
            margin: 4px 0;
            color: var(--muted)
        }

        .order-meta {
            text-align: right
        }

        .order-meta .meta-row {
            margin-bottom: 6px
        }

        .order-number {
            font-weight: 700;
            font-size: 16px
        }

        .muted {
            color: var(--muted)
        }

        .items {
            margin-top: 20px
        }

        .items table {
            width: 100%;
            border-collapse: collapse
        }

        .items thead th {
            background: #fbfdff;
            text-align: left;
            padding: 12px;
            font-weight: 600;
            color: var(--muted);
            border-bottom: 1px solid #eef2f7
        }

        .items tbody td {
            padding: 12px 12px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle
        }

        .product-row {
            display: flex;
            gap: 12px;
            align-items: center
        }

        .thumb {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 8px;
            background: #f3f4f6
        }

        .prod-title {
            font-weight: 600;
            max-width: 420px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .prod-meta {
            color: var(--muted);
            font-size: 13px
        }

        .totals {
            display: flex;
            justify-content: flex-end;
            margin-top: 16px
        }

        .totals .box {
            width: 360px;
            background: #fbfdff;
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #eef2f7
        }

        .totals .row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0
        }

        .totals .row.total {
            font-weight: 700;
            font-size: 18px;
            border-top: 1px dashed #e6eef8;
            padding-top: 12px;
            margin-top: 8px
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 18px
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 0;
            cursor: pointer
        }

        .btn-print {
            background: #fff;
            border: 1px solid #e6eef8
        }

        .btn-primary {
            background: var(--primary);
            color: #fff
        }

        .notice {
            margin-top: 18px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            color: var(--muted);
            font-size: 14px
        }

        @media (max-width:880px) {
            .top {
                flex-direction: column;
                align-items: stretch
            }

            .order-meta {
                text-align: left;
                margin-top: 12px
            }

            .totals .box {
                width: 100%
            }

            .brand img {
                height: 46px
            }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="card">
            <div class="card-inner">
                <div class="top">
                    <div class="brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($website_settings->website_logo ?? '/images/logo.png') }}" alt="logo">
                        </a>
                        <div>
                            <h1>Order Confirmation</h1>
                            <div class="muted">Thank you for your purchase. Your order has been placed successfully.
                            </div>
                        </div>
                    </div>

                    <div class="order-meta">
                        <div class="meta-row muted">Invoice</div>
                        <div class="order-number">#{{ $order->order_number ?? $order->id }}</div>
                        <div class="meta-row muted">Placed on {{ optional($order->created_at)->format('F j, Y') }}</div>
                        <div class="meta-row muted">Payment: {{ strtoupper($order->payment_method ?? 'COD') }}</div>
                        <div class="meta-row" style="margin-top:8px"><strong class="muted">Status:</strong> <span
                                style="color:var(--success); font-weight:700">{{ ucfirst($order->status ?? 'pending') }}</span>
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:24px; margin-top:20px; flex-wrap:wrap">
                    <div class="customer">
                        <h3 style="margin:0 0 8px 0">Billing To</h3>
                        <p style="font-weight:600; margin:0 0 6px 0">
                            {{ $order->billing_name ?? ($order->first_name . ' ' . $order->last_name ?? '') }}</p>
                        <p class="muted" style="margin:0">{{ $order->billing_email ?? ($order->email ?? '') }}</p>
                        <p class="muted" style="margin:0">{{ $order->billing_address ?? ($order->address ?? '') }}</p>
                        <p class="muted" style="margin:0">{{ $order->billing_city ?? ($order->city ?? '') }}
                            {{ $order->billing_zip ?? ($order->zip ?? '') }}</p>
                        <p class="muted" style="margin:8px 0 0 0">{{ $order->notes ?? '' }}</p>
                    </div>

                    <div style="flex:1"></div>

                    <div style="min-width:260px;text-align:right">
                        <h3 style="margin:0 0 8px 0">Order Details</h3>
                        <p class="muted" style="margin:0">Items:
                            <strong>{{ $order->items->sum('quantity') ?? ($order->orderItems->sum('quantity') ?? 0) }}</strong>
                        </p>
                        <p class="muted" style="margin:6px 0 0 0">Subtotal:
                            <strong>${{ number_format($order->subtotal ?? ($order->total_price ?? 0), 2) }}</strong></p>
                        <p class="muted" style="margin:6px 0 0 0">Total:
                            <strong>${{ number_format($order->total_amount ?? ($order->total_price ?? ($order->total ?? 0)), 2) }}</strong>
                        </p>
                    </div>
                </div>

                <div class="items">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th style="text-align: right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($order->items ?? $order->orderItems as $item)
                                @php
                                    $i++;
                                    $meta = (array) ($item->meta ?? ($item->product ?? []));
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="product-row">
                                            <div>
                                                <div class="prod-title">
                                                    {{ $item->name ?? ($meta['product_name'] ?? 'Item') }}</div>
                                                @if (!empty($meta['service_title']) || !empty($meta['service_category']))
                                                    <div class="prod-meta">{{ $meta['service_title'] ?? '' }}
                                                        {{ !empty($meta['service_title']) && !empty($meta['service_category']) ? '•' : '' }}
                                                        {{ $meta['service_category'] ?? '' }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td style="text-align:right">
                                        ${{ number_format($item->line_total ?? $item->price * $item->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="totals">
                    <div class="box">
                        <div class="row">
                            <div>Subtotal</div>
                            <div>${{ number_format($order->subtotal ?? ($order->total_price ?? 0), 2) }}</div>
                        </div>
                        {{-- No shipping as requested --}}
                        <div class="row total">
                            <div>Total</div>
                            <div>${{ number_format($order->total_amount ?? ($order->total_price ?? 0), 2) }}</div>
                        </div>
                    </div>
                </div>

                <div class="notice">Your order is being processed. You will receive an email confirmation at
                    <strong>{{ $order->billing_email ?? ($order->email ?? '') }}</strong>.</div>

                <div class="actions">
                    <button class="btn btn-print" onclick="window.print()">🖨️ Print</button>
                    <a href="{{ route('home') }}" class="btn btn-primary" style="text-decoration:none; color:#fff">Back
                        to Home</a>
                    <a href="{{ route('service.page') }}" class="btn"
                        style="background:#111827; color:#fff; text-decoration:none">Shop Again</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
