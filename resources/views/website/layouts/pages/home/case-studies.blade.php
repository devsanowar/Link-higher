<section class="cs-slider" id="cs-slider" aria-label="Case studies slider">
    <div class="header">
        <div class="title">Case Studies</div>
        {{-- <div style="color: #6b7280; font-size: 13px">
            Seamless loop — author left, date right
        </div> --}}
    </div>

    <button class="cs-arrow left" id="cs-prev" aria-label="Previous">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="#0f172a" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button>
    <button class="cs-arrow right" id="cs-next" aria-label="Next">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 6L15 12L9 18" stroke="#0f172a" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button>

    <div class="cs-viewport">
        <div class="cs-track" id="cs-track">

            @forelse ($caseStudies as $caseStudy)
                <article class="cs-card">
                    @if($caseStudy->image)
                    <img class="cs-hero" src="{{ asset($caseStudy->image) }}" alt="case study image" />
                    @else
                    <img class="cs-hero" src="https://picsum.photos/seed/cs2/1200/800" alt="case study image" />
                    @endif
                    <div class="cs-body">
                        <div class="cs-category">{{{ $caseStudy->service->service_title ?? '' }}}</div>
                        <h3 class="cs-title">{{ $caseStudy->title ?? '' }}</h3>
                        <p class="cs-excerpt">
                            {!! Str::limit($caseStudy->description, 200, '...') !!}
                        </p>
                    </div>
                    <div class="cs-footer">
                        <div class="cs-author">
                            @if($caseStudy->user && $caseStudy->user->image)
                                <img src="{{ asset($caseStudy->user->image) }}" alt="author" />
                            @else
                                <img src="https://i.pravatar.cc/100?img=18" alt="author" />
                            @endif
                            <div class="cs-author-name">{{ $caseStudy->user->name ?? 'Unknown Author' }}</div>
                        </div>

                        <div class="cs-date">{{ $caseStudy->created_at->format('M d, Y') }}</div>
                    </div>
                </article>
            @empty
            <h2>No case studies found ! please add case studies.</h2>
            @endforelse



            <!-- Add more .cs-card elements as needed (or render via Blade). -->
        </div>
    </div>
</section>
