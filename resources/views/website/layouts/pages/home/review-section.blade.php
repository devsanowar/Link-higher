<!-- TESTIMONIALS WRAPPER (PLAIN HTML — no Tailwind) -->
<div class="reviews-wrapper">
  <div class="reviews-container">

    <button id="rev-prev" class="reviews-arrow reviews-prev" aria-label="Previous review">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M15 18L9 12L15 6" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

    <button id="rev-next" class="reviews-arrow reviews-next" aria-label="Next review">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M9 6L15 12L9 18" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

    <div class="reviews-viewport" role="region" aria-label="Customer reviews">
      <div id="reviews-track" class="reviews-track">
        <!-- Keep your foreach loop exactly the same; only wrapper classes changed -->
        @foreach ($reviews as $review)
        <div class="review-col">
          <div class="review-card">
            <div class="quote-icon"><span class="quote">“</span></div>

            <div class="review-text">
              <p class="review-body">{!! $review->review !!}</p>

              <div class="author-row">
                <div class="author-avatar">
                  @if(empty($review->image))
                    <img src="images/review-author-2.jpg" alt="review-avatar">
                  @else
                    <img src="{{ asset($review->image) }}" alt="review-avatar">
                  @endif
                </div>

                <div class="author-meta">
                  <h6 class="author-name">{{ $review->name ?? '' }}</h6>
                  <p class="author-profession">{{ $review->profession ?? '' }}</p>
                </div>
              </div>

            </div>
          </div>
        </div>
        @endforeach
        <!-- end loop -->
      </div>
    </div>
  </div>
</div>
<!-- END TESTIMONIALS WRAPPER -->
