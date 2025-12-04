<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Support Request</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f3f4f6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
        }

        .wrapper {
            width: 100%;
            padding: 20px 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #f3f4f6;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 20px 24px;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .logo {
            height: 48px;
            margin-bottom: 8px;
        }

        .app-name {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
        }

        h2 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #111827;
        }

        h3 {
            margin: 18px 0 8px 0;
            font-size: 15px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
        }

        p {
            margin: 0 0 10px 0;
            font-size: 13px;
            color: #4b5563;
        }

        .info-table {
            width: 100%;
            font-size: 13px;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .label {
            width: 120px;
            color: #6b7280;
        }

        .value {
            color: #111827;
            font-weight: 500;
        }

        .message-box {
            font-size: 13px;
            color: #111827;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            line-height: 1.5;
            white-space: pre-line;
        }

        .note {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 14px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">

            <div class="header">
                <div class="app-name">{{ config('app.name') }}</div>
                <div class="subtitle">New Support / Quote Request</div>
            </div>

            <div class="card">
                <h2>📩 New Support Request</h2>
                <p>A new support/quote request was submitted on your website. Below are the details:</p>

                {{-- Client Info --}}
                <h3>🧑‍💼 Client Information</h3>
                <table class="info-table">
                    <tr>
                        <td class="label">Name:</td>
                        <td class="value">{{ $support->name }}</td>
                    </tr>
                    @if ($support->email)
                        <tr>
                            <td class="label">Email:</td>
                            <td class="value">
                                <a href="mailto:{{ $support->email }}">{{ $support->email }}</a>
                            </td>
                        </tr>
                    @endif
                    @if ($support->phone)
                        <tr>
                            <td class="label">Phone:</td>
                            <td class="value">{{ $support->phone }}</td>
                        </tr>
                    @endif
                </table>

                {{-- Project Details --}}
                <h3>📦 Project Details</h3>
                <table class="info-table">
                    @if ($support->service_type)
                        <tr>
                            <td class="label">Service Type:</td>
                            <td class="value">{{ $support->service_type }}</td>
                        </tr>
                    @endif

                    @if ($support->website_url)
                        <tr>
                            <td class="label">Website URL:</td>
                            <td class="value">
                                <a href="{{ $support->website_url }}" target="_blank">
                                    {{ $support->website_url }}
                                </a>
                            </td>
                        </tr>
                    @endif

                    @if ($support->budget_range)
                        <tr>
                            <td class="label">Budget Range:</td>
                            <td class="value">{{ $support->budget_range }}</td>
                        </tr>
                    @endif
                </table>

                {{-- Message --}}
                <h3>📝 Message</h3>
                <div class="message-box">
                    {{ $support->message }}
                </div>

                <p class="note">
                    💡 Note: If the client provided an email, replying to this message will directly reach the client (Reply-To is automatically set).
                </p>
            </div>

            <div class="footer">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>

        </div>
    </div>
</body>

</html>
