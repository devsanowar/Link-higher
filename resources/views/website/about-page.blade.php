@extends('website.layouts.app')
@section('title', 'About Page')
@section('page_id', 'about-page')
@section('website_content')

    @include('website.layouts.pages.about.about-section')


    <!-- END ABOUT-2 -->

    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">


    @include('website.layouts.pages.about.mission-vision-section')

    <!-- STATISTIC-5
                                         ============================================= -->
    @include('website.layouts.pages.about.achievement-section')
    <!-- END STATISTIC-5 -->
    <!-- TEXT CONTENT
                                         ============================================= -->
    @include('website.layouts.pages.about.who-we-are-section')
    <!-- END TEXT CONTENT -->


    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- BRANDS-1
                                         ============================================= -->
    @include('website.layouts.pages.about.trusted-client-section')
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- TEAM-1
                                         ============================================= -->
    @include('website.layouts.pages.about.employe-section')



    <!-- TESTIMONIALS-2
                                         ============================================= -->
   @include('website.layouts.pages.about.testimonial-section')
    <!-- END TESTIMONIALS-2 -->


<section id="newsletter-1" class="newsletter-section"
    style="background: url('{{ asset('frontend/images/hero-bg-3.png') }}') repeat;">

    <div class="newsletter-overlay">
        <div class="container">
            <div class="newsletter-row">

                <!-- LEFT CONTENT -->
                <div class="newsletter-col left-col">
                    <div class="newsletter-txt">
                        <h4>Stay up to date with our news, ideas and updates</h4>
                    </div>
                </div>

                <!-- RIGHT FORM -->
                <div class="newsletter-col right-col">
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" placeholder="Your email address" required>
                            <button type="submit" class="btn">Subscribe Now</button>
                        </div>
                        <label class="form-notification"></label>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>


    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">


@endsection

@push('scripts')
    <script>
        $(function() {
            $('.video-popup2').magnificPopup({
                type: 'iframe',
                iframe: {
                    patterns: {
                        youtube: {
                            index: ['youtube.com/', 'youtu.be/'],
                            id: function(url) {
                                // watch?v=ID
                                var vMatch = url.match(/[?&]v=([^?&]+)/);
                                if (vMatch && vMatch[1]) return vMatch[1];

                                // youtu.be/ID
                                var short = url.match(/youtu\.be\/([^?&/]+)/);
                                if (short && short[1]) return short[1];

                                // embed/ID
                                var embed = url.match(/embed\/([^?&/]+)/);
                                if (embed && embed[1]) return embed[1];

                                return null;
                            },
                            src: 'https://www.youtube.com/embed/%id%?autoplay=1&rel=0'
                        }
                    }
                }
            });

        });
    </script>

    <script>
(function(){
  const track = document.getElementById('reviews-track');
  const prev = document.getElementById('rev-prev');
  const next = document.getElementById('rev-next');
  if(!track) return;

  let visible = getVisibleCount();
  let slideW = 0;
  let index = 0;
  let autoTimer = null;
  let isTransitioning = false;

  function getVisibleCount(){
    if(window.matchMedia('(max-width:640px)').matches) return 1;
    if(window.matchMedia('(max-width:1000px)').matches) return 2;
    return 3;
  }

  // clone helpers for seamless loop
  function removeClones(){ track.querySelectorAll('.clone').forEach(n=>n.remove()); }
  function addClones(){
    removeClones();
    const nodes = Array.from(track.querySelectorAll(':scope > .review-col'));
    if(nodes.length === 0) return;
    visible = getVisibleCount();
    for(let i=0;i<visible;i++){
      const clone = nodes[i % nodes.length].cloneNode(true);
      clone.classList.add('clone');
      track.appendChild(clone);
    }
    for(let i=nodes.length-visible;i<nodes.length;i++){
      const clone = nodes[(i+nodes.length)%nodes.length].cloneNode(true);
      clone.classList.add('clone');
      track.insertBefore(clone, track.firstChild);
    }
  }

  function recalc(){
    addClones();
    const first = track.querySelector('.review-col');
    if(!first) return;
    // compute gap if any (fallback 16)
    const gap = parseFloat(getComputedStyle(track).gap) || 16;
    slideW = first.getBoundingClientRect().width + gap;
    visible = getVisibleCount();
    const startOffset = -slideW * visible;
    track.style.transition = 'none';
    track.style.transform = `translateX(${startOffset}px)`;
    index = 0;
    requestAnimationFrame(()=>{ track.style.transition = '' });
    // ensure arrows visible
    [prev, next].forEach(b => { if(b) b.style.display = ''; });
  }

  function moveTo(newIndex){
    if(isTransitioning) return;
    const originals = Array.from(track.querySelectorAll(':scope > .review-col:not(.clone)'));
    if(originals.length === 0) return;
    isTransitioning = true;
    const total = originals.length;
    const startOffset = -slideW * visible;
    const targetOffset = startOffset - (newIndex * slideW);
    track.style.transition = 'transform 700ms cubic-bezier(.25,.8,.25,1)';
    track.style.transform = `translateX(${targetOffset}px)`;

    function onEnd(){
      track.removeEventListener('transitionend', onEnd);
      if(newIndex >= total){
        newIndex = newIndex - total;
        track.style.transition = 'none';
        const resetOffset = startOffset - (newIndex * slideW);
        track.style.transform = `translateX(${resetOffset}px)`;
      } else if(newIndex < 0){
        newIndex = newIndex + total;
        track.style.transition = 'none';
        const resetOffset = startOffset - (newIndex * slideW);
        track.style.transform = `translateX(${resetOffset}px)`;
      }
      index = newIndex;
      setTimeout(()=>{ isTransitioning = false; track.style.transition = '' }, 20);
    }

    track.addEventListener('transitionend', onEnd);
  }

  function nextSlide(){ moveTo(index + 1); }
  function prevSlide(){ moveTo(index - 1); }

  next && next.addEventListener('click', ()=>{ nextSlide(); restartAuto(); });
  prev && prev.addEventListener('click', ()=>{ prevSlide(); restartAuto(); });

  function startAuto(){ stopAuto(); autoTimer = setInterval(()=>{ nextSlide(); }, 4200); }
  function stopAuto(){ if(autoTimer){ clearInterval(autoTimer); autoTimer = null; } }
  function restartAuto(){ stopAuto(); startAuto(); }

  const wrapper = document.querySelector('.reviews-container');
  wrapper && wrapper.addEventListener('mouseenter', stopAuto);
  wrapper && wrapper.addEventListener('mouseleave', startAuto);
  wrapper && wrapper.addEventListener('focusin', stopAuto);
  wrapper && wrapper.addEventListener('focusout', startAuto);

  let rt = null;
  window.addEventListener('resize', ()=>{ clearTimeout(rt); rt = setTimeout(recalc, 120); });

  // init after DOM render
  setTimeout(()=>{ recalc(); startAuto(); }, 60);

  // expose for debug
  window.reviewsSlider = { recalc, nextSlide, prevSlide, startAuto, stopAuto };
})();
</script>

@endpush
