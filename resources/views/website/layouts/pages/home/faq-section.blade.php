<section id="faq-section" class="faq" aria-label="FAQ" style="margin-top: 0">
    <div class="container">
        <h2 class="custom-section-title">FAQ</h2>

        @foreach ($faqs as $i => $faq)
            <div class="q" data-index="{{ $i }}">
                <div class="q-text">{{ $faq->question }}</div>
                <div class="arrow" style="{{ $i==0 ? 'transform: rotate(180deg);' : '' }}">▾</div>
            </div>

            <div class="a {{ $i == 0 ? 'open' : '' }}"
                 data-index="{{ $i }}"
                 style="max-height: {{ $i == 0 ? '300px' : '0' }};">
                <p>{!! $faq->answer !!}</p>
            </div>
        @endforeach
    </div>
</section>
