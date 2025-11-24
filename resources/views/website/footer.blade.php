
<footer>
    <style>
        .footer-area {
            text-align: center;
            padding: 40px 20px;
            font-family: "Georgia", serif;
            color: #000;
        }

        .footer-title {
            font-size: 20px;
            font-style: italic;
            margin-bottom: 15px;
            color: #333;
        }

        .footer-links {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .footer-links a {
            display: inline-block;
            padding: 8px 14px;
            background: #f7f7f7;
            border: 1px solid #d4d4d4;
            text-decoration: none;
            color: #222;
            font-size: 15px;
            font-style: none;
            transform: skew(-12deg);
            border-radius: 4px;
            transition: 0.2s;
            white-space: nowrap;
        }

        .footer-links a:hover {
            background: #e6e6e6;
        }

        /* Mobile Responsive */
        @media (max-width: 600px) {
            .footer-links a {
                font-size: 13px;
                padding: 6px 10px;
            }
        }
    </style>

    <div class="footer-area">
        <div class="footer-title">More From Static Media</div>

        <div class="footer-links">
            @foreach ($sites as $site)
                <a href="{{ $site->site_url ?? '' }}" target="_blank">{{ $site->site_name ?? '' }}</a>
            @endforeach
        </div>
    </div>
</footer>
