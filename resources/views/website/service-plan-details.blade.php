@extends('website.layouts.app')
@section('title', 'Service Plan Details Page')
@section('website_content')


    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Plan Details Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Details Page</li>
            </ul>
        </div>
    </section>

    <div id="plan-details-page">

        <div class="container">

            <div class="card">
                <section id="service-first-section" class="row" aria-label="Product top">
                    <div class="img-col">
                        <div class="img-wrap" aria-hidden="false">
                            <figure class="zoom">
                                <img src="{{ asset($package->service->image) }}" alt="Product image">
                            </figure>
                        </div>
                    </div>

                    <aside class="info">
                        <div class="brand">Service - {{ $package->service->service_title ?? '' }}</div>
                        <h1>{{ $package->name ?? '' }}</h1>
                        <div class="price">
                            @if ($package->discount && $package->discount_type)
                                <span style="color: red; text-decoration: line-through; margin-right: 10px;">
                                    ${{ number_format($package->price, 2) }}
                                </span>
                                <span style="font-weight: bold; font-weight: 500;">
                                    ${{ number_format($package->final_price, 2) }}
                                </span>
                            @else
                                <span style="color: #111; font-weight: 500;">
                                    ${{ number_format($package->price, 2) }}
                                </span>
                            @endif
                        </div>

                        @php
                            $features = is_string($package->features)
                                ? json_decode($package->features, true)
                                : $package->features;

                            $features = $features ?? [];
                        @endphp

                        <ul class="features" aria-label="Product features">
                            @if (count($features) > 0)
                                @foreach ($features as $feat)
                                    <li>
                                        <div class="bullet" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 6L9 17l-5-5" />
                                            </svg>
                                        </div>
                                        <div class="feat-text">{{ $feat }}</div>
                                    </li>
                                @endforeach
                            @else
                                <li>No features available.</li>
                            @endif
                        </ul>


                        <!-- plain POST form (no AJAX) -->
                        <form action="{{ route('cart.addPlan', $package->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="buy-now">Buy now</button>
                        </form>
                    </aside>
                </section>

                <section id="faq-section" class="faq" aria-label="FAQ">
                    <h2 class="custom-section-title">FAQ</h2>

                    @foreach ($faqs as $faq)
                        <div class="q" data-index="0">
                            <div class="q-text">{{ $faq->question ?? '' }}</div>
                            <div class="arrow">▾</div>
                        </div>
                        <div class="a" data-index="0">
                            <p>{!! $faq->answer ?? '' !!}
                            </p>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Simple accordion for FAQ
        (function() {
            const qs = document.querySelectorAll('.q');
            qs.forEach(q => q.addEventListener('click', () => {
                const idx = q.dataset.index;
                const ans = document.querySelector('.a[data-index="' + idx + '"]');
                const open = ans.classList.contains('open');
                // close all
                document.querySelectorAll('.a.open').forEach(a => {
                    a.classList.remove('open');
                    a.style.maxHeight = 0
                });
                document.querySelectorAll('.q .arrow').forEach(ar => ar.style.transform = '');
                if (!open) {
                    ans.classList.add('open');
                    ans.style.maxHeight = ans.scrollHeight + 'px';
                    q.querySelector('.arrow').style.transform = 'rotate(180deg)';
                }
            }));
        })();
    </script>
@endpush
