@extends('website.layouts.app')
@section('title', 'Home Page')
@section('page_id', 'home-page')
@section('website_content')

    @include('website.layouts.pages.home.hero-section')
    <!-- END HERO-7 -->

    <!-- BRANDS-1
                                         ============================================= -->
    @include('website.layouts.pages.home.trusted-client-section')


    <!-- FEATURES-6
                                         ============================================= -->
    @include('website.layouts.pages.home.feature-section')
    <!-- END FEATURES-6 -->
    <!-- DIVIDER LINE -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
    <!-- TEXT CONTENT
                                         ============================================= -->
    @include('website.layouts.pages.home.smart-strategy-section')
    <!-- END TEXT CONTENT -->


    <!-- TEXT CONTENT
                                         ============================================= -->
    {{-- @include('website.layouts.pages.home.smart-work-flow-section') --}}
    <!-- END TEXT CONTENT -->
    <!-- FEATURES-2
                                         ============================================= -->
    @include('website.layouts.pages.home.goal-progress-section')
    <!-- END FEATURES-2 -->
    <!-- BOX CONTENT
                                         ============================================= -->
    @include('website.layouts.pages.home.site-section')
    <!-- END BOX CONTENT -->

    @include('website.layouts.pages.home.post-slider')

    <!-- END TEXT CONTENT -->
    <!-- STATISTIC-1
                                         ============================================= -->
    {{-- @include('website.layouts.pages.home.achievement-section') --}}
    <!-- END STATISTIC-1 -->
    <!-- DIVIDER LINE -->

    <!-- FEATURES-13
                                         ============================================= -->
    @include('website.layouts.pages.home.why-chose-us-section')
    <!-- END FEATURES-13 -->

    @include('website.layouts.pages.home.case-studies')

    {{-- @include('website.layouts.pages.home.customer-focus-tone-section') --}}
    <!-- END BOX CONTENT -->
    <!-- TESTIMONIALS-2
                                         ============================================= -->
    @include('website.layouts.pages.home.review-section')
    <!-- END TESTIMONIALS-2 -->

    <!-- END FAQs-3 -->
    @include('website.layouts.pages.home.cta-section')
    <!-- END BANNER-7 -->
    @include('website.layouts.pages.home.faq-section')

@endsection

@push('scripts')
    <script>
        (function() {
            const track = document.getElementById("ps-track");
            const prevBtn = document.getElementById("ps-prev");
            const nextBtn = document.getElementById("ps-next");
            const slider = document.getElementById("post-slider");

            if (!track) return;

            let visible = getVisibleCount();
            let slideWidth = 0;
            let index = 0; // logical index: 0..(n-1)
            let autoTimer = null;
            let isTransitioning = false;

            // create clones for seamless loop
            function addClones() {
                removeClones();
                const cards = Array.from(track.querySelectorAll(".post-card"));
                if (cards.length === 0) return;
                visible = getVisibleCount();
                // if posts less than visible, still clone but logic will handle it
                // append first visible clones
                for (let i = 0; i < visible; i++) {
                    const node = cards[i % cards.length].cloneNode(true);
                    node.classList.add("clone");
                    track.appendChild(node);
                }
                // prepend last visible clones
                for (let i = cards.length - visible; i < cards.length; i++) {
                    const node =
                        cards[(i + cards.length) % cards.length].cloneNode(true);
                    node.classList.add("clone");
                    track.insertBefore(node, track.firstChild);
                }
            }

            function removeClones() {
                track.querySelectorAll(".clone").forEach((n) => n.remove());
            }

            function getVisibleCount() {
                if (window.matchMedia("(max-width:640px)").matches) return 1;
                if (window.matchMedia("(max-width:1000px)").matches) return 2;
                return 3;
            }

            function recalc() {
                addClones();
                const firstCard = track.querySelector(".post-card");
                if (!firstCard) return;
                // compute width including gap
                const style = getComputedStyle(track);
                const gap = parseFloat(style.gap || 0) || 12;
                slideWidth = firstCard.getBoundingClientRect().width + gap;
                // place track to show the first real slide
                const startOffset = -slideWidth * visible;
                track.style.transition = "none";
                track.style.transform = `translateX(${startOffset}px)`;
                // reset logical index
                index = 0;
                // allow transitions on next frame
                requestAnimationFrame(() => {
                    track.style.transition = "";
                });
            }

            function moveTo(newIndex) {
                if (isTransitioning) return;
                const cards = Array.from(
                    track.querySelectorAll(".post-card:not(.clone)")
                );
                if (cards.length === 0) return;
                isTransitioning = true;
                const total = cards.length;
                const startOffset = -slideWidth * visible;
                const targetOffset = startOffset - newIndex * slideWidth;
                track.style.transition = "transform 0.8s cubic-bezier(.25,.8,.25,1)";
                track.style.transform = `translateX(${targetOffset}px)`;

                function onEnd() {
                    track.removeEventListener("transitionend", onEnd);
                    // normalize
                    if (newIndex >= total) {
                        newIndex = newIndex - total;
                        track.style.transition = "none";
                        const resetOffset = startOffset - newIndex * slideWidth;
                        track.style.transform = `translateX(${resetOffset}px)`;
                    } else if (newIndex < 0) {
                        newIndex = newIndex + total;
                        track.style.transition = "none";
                        const resetOffset = startOffset - newIndex * slideWidth;
                        track.style.transform = `translateX(${resetOffset}px)`;
                    }
                    index = newIndex;
                    // small timeout before allowing next transition
                    setTimeout(() => {
                        isTransitioning = false;
                        track.style.transition = "";
                    }, 20);
                }

                track.addEventListener("transitionend", onEnd);
            }

            function next() {
                moveTo(index + 1);
            }

            function prev() {
                moveTo(index - 1);
            }

            nextBtn &&
                nextBtn.addEventListener("click", () => {
                    next();
                    restartAuto();
                });
            prevBtn &&
                prevBtn.addEventListener("click", () => {
                    prev();
                    restartAuto();
                });

            // Auto
            function startAuto() {
                stopAuto();
                autoTimer = setInterval(() => {
                    next();
                }, 4000);
            }

            function stopAuto() {
                if (autoTimer) {
                    clearInterval(autoTimer);
                    autoTimer = null;
                }
            }

            function restartAuto() {
                stopAuto();
                startAuto();
            }

            // Pause on hover/focus
            slider && slider.addEventListener("mouseenter", stopAuto);
            slider && slider.addEventListener("mouseleave", startAuto);
            slider && slider.addEventListener("focusin", stopAuto);
            slider && slider.addEventListener("focusout", startAuto);

            // responsive
            let resizeTimer = null;
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(recalc, 120);
            });

            // init (short timeout to allow server-rendered DOM to appear)
            setTimeout(() => {
                recalc();
                startAuto();
            }, 60);

            // expose for debugging
            window.psSlider = {
                recalc,
                next,
                prev,
                startAuto,
                stopAuto
            };
        })();
    </script>

    <script>
        (function() {
            const track = document.getElementById("cs-track");
            const prevBtn = document.getElementById("cs-prev");
            const nextBtn = document.getElementById("cs-next");
            const slider = document.getElementById("cs-slider");

            if (!track) return;

            let visible = getVisibleCount();
            let slideWidth = 0;
            let index = 0; // logical index over original slides
            let autoTimer = null;
            let isTransitioning = false;

            function getVisibleCount() {
                if (window.matchMedia("(max-width:640px)").matches) return 1;
                if (window.matchMedia("(max-width:1000px)").matches) return 2;
                return 3;
            }

            function removeClones() {
                track.querySelectorAll(".clone").forEach((n) => n.remove());
            }

            function addClones() {
                removeClones();
                const cards = Array.from(track.querySelectorAll(".cs-card"));
                if (cards.length === 0) return;
                visible = getVisibleCount();
                // append first visible clones
                for (let i = 0; i < visible; i++) {
                    const node = cards[i % cards.length].cloneNode(true);
                    node.classList.add("clone");
                    track.appendChild(node);
                }
                // prepend last visible clones
                for (let i = cards.length - visible; i < cards.length; i++) {
                    const node =
                        cards[(i + cards.length) % cards.length].cloneNode(true);
                    node.classList.add("clone");
                    track.insertBefore(node, track.firstChild);
                }
            }

            function recalc() {
                addClones();
                const first = track.querySelector(".cs-card");
                if (!first) return;
                const style = getComputedStyle(track);
                const gap = parseFloat(style.gap) || 18;
                slideWidth = first.getBoundingClientRect().width + gap;
                visible = getVisibleCount();
                // position to show first real slide
                const startOffset = -slideWidth * visible;
                track.style.transition = "none";
                track.style.transform = `translateX(${startOffset}px)`;
                index = 0;
                requestAnimationFrame(() => {
                    track.style.transition = "";
                });
            }

            function moveTo(newIndex) {
                if (isTransitioning) return;
                const originals = Array.from(
                    track.querySelectorAll(".cs-card:not(.clone)")
                );
                if (originals.length === 0) return;
                isTransitioning = true;
                const total = originals.length;
                const startOffset = -slideWidth * visible;
                const targetOffset = startOffset - newIndex * slideWidth;
                track.style.transition = "transform 0.8s cubic-bezier(.25,.8,.25,1)";
                track.style.transform = `translateX(${targetOffset}px)`;

                function onEnd() {
                    track.removeEventListener("transitionend", onEnd);
                    // normalize index if out of bounds
                    if (newIndex >= total) {
                        newIndex = newIndex - total;
                        track.style.transition = "none";
                        const resetOffset = startOffset - newIndex * slideWidth;
                        track.style.transform = `translateX(${resetOffset}px)`;
                    } else if (newIndex < 0) {
                        newIndex = newIndex + total;
                        track.style.transition = "none";
                        const resetOffset = startOffset - newIndex * slideWidth;
                        track.style.transform = `translateX(${resetOffset}px)`;
                    }
                    index = newIndex;
                    setTimeout(() => {
                        isTransitioning = false;
                        track.style.transition = "";
                    }, 20);
                }

                track.addEventListener("transitionend", onEnd);
            }

            function next() {
                moveTo(index + 1);
            }

            function prev() {
                moveTo(index - 1);
            }

            nextBtn &&
                nextBtn.addEventListener("click", () => {
                    next();
                    restartAuto();
                });
            prevBtn &&
                prevBtn.addEventListener("click", () => {
                    prev();
                    restartAuto();
                });

            // Auto
            function startAuto() {
                stopAuto();
                autoTimer = setInterval(() => {
                    next();
                }, 4200);
            }

            function stopAuto() {
                if (autoTimer) {
                    clearInterval(autoTimer);
                    autoTimer = null;
                }
            }

            function restartAuto() {
                stopAuto();
                startAuto();
            }

            // Pause on hover/focus
            slider && slider.addEventListener("mouseenter", stopAuto);
            slider && slider.addEventListener("mouseleave", startAuto);
            slider && slider.addEventListener("focusin", stopAuto);
            slider && slider.addEventListener("focusout", startAuto);

            // Responsive
            let resizeTimer = null;
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(recalc, 120);
            });

            // Init (short timeout to allow server-side rendering)
            setTimeout(() => {
                recalc();
                startAuto();
            }, 60);

            // Expose for debug
            window.csSlider = {
                recalc,
                next,
                prev,
                startAuto,
                stopAuto
            };
        })();
    </script>


    <script>
        (function() {
            const track = document.getElementById('reviews-track');
            const prev = document.getElementById('rev-prev');
            const next = document.getElementById('rev-next');
            if (!track) return;

            let visible = getVisibleCount();
            let slideW = 0;
            let index = 0;
            let autoTimer = null;
            let isTransitioning = false;

            function getVisibleCount() {
                if (window.matchMedia('(max-width:640px)').matches) return 1;
                if (window.matchMedia('(max-width:1000px)').matches) return 2;
                return 3;
            }

            // clone helpers for seamless loop
            function removeClones() {
                track.querySelectorAll('.clone').forEach(n => n.remove());
            }

            function addClones() {
                removeClones();
                const nodes = Array.from(track.querySelectorAll(':scope > .review-col'));
                if (nodes.length === 0) return;
                visible = getVisibleCount();
                for (let i = 0; i < visible; i++) {
                    const clone = nodes[i % nodes.length].cloneNode(true);
                    clone.classList.add('clone');
                    track.appendChild(clone);
                }
                for (let i = nodes.length - visible; i < nodes.length; i++) {
                    const clone = nodes[(i + nodes.length) % nodes.length].cloneNode(true);
                    clone.classList.add('clone');
                    track.insertBefore(clone, track.firstChild);
                }
            }

            function recalc() {
                addClones();
                const first = track.querySelector('.review-col');
                if (!first) return;
                // compute gap if any (fallback 16)
                const gap = parseFloat(getComputedStyle(track).gap) || 16;
                slideW = first.getBoundingClientRect().width + gap;
                visible = getVisibleCount();
                const startOffset = -slideW * visible;
                track.style.transition = 'none';
                track.style.transform = `translateX(${startOffset}px)`;
                index = 0;
                requestAnimationFrame(() => {
                    track.style.transition = ''
                });
                // ensure arrows visible
                [prev, next].forEach(b => {
                    if (b) b.style.display = '';
                });
            }

            function moveTo(newIndex) {
                if (isTransitioning) return;
                const originals = Array.from(track.querySelectorAll(':scope > .review-col:not(.clone)'));
                if (originals.length === 0) return;
                isTransitioning = true;
                const total = originals.length;
                const startOffset = -slideW * visible;
                const targetOffset = startOffset - (newIndex * slideW);
                track.style.transition = 'transform 700ms cubic-bezier(.25,.8,.25,1)';
                track.style.transform = `translateX(${targetOffset}px)`;

                function onEnd() {
                    track.removeEventListener('transitionend', onEnd);
                    if (newIndex >= total) {
                        newIndex = newIndex - total;
                        track.style.transition = 'none';
                        const resetOffset = startOffset - (newIndex * slideW);
                        track.style.transform = `translateX(${resetOffset}px)`;
                    } else if (newIndex < 0) {
                        newIndex = newIndex + total;
                        track.style.transition = 'none';
                        const resetOffset = startOffset - (newIndex * slideW);
                        track.style.transform = `translateX(${resetOffset}px)`;
                    }
                    index = newIndex;
                    setTimeout(() => {
                        isTransitioning = false;
                        track.style.transition = ''
                    }, 20);
                }

                track.addEventListener('transitionend', onEnd);
            }

            function nextSlide() {
                moveTo(index + 1);
            }

            function prevSlide() {
                moveTo(index - 1);
            }

            next && next.addEventListener('click', () => {
                nextSlide();
                restartAuto();
            });
            prev && prev.addEventListener('click', () => {
                prevSlide();
                restartAuto();
            });

            function startAuto() {
                stopAuto();
                autoTimer = setInterval(() => {
                    nextSlide();
                }, 4200);
            }

            function stopAuto() {
                if (autoTimer) {
                    clearInterval(autoTimer);
                    autoTimer = null;
                }
            }

            function restartAuto() {
                stopAuto();
                startAuto();
            }

            const wrapper = document.querySelector('.reviews-container');
            wrapper && wrapper.addEventListener('mouseenter', stopAuto);
            wrapper && wrapper.addEventListener('mouseleave', startAuto);
            wrapper && wrapper.addEventListener('focusin', stopAuto);
            wrapper && wrapper.addEventListener('focusout', startAuto);

            let rt = null;
            window.addEventListener('resize', () => {
                clearTimeout(rt);
                rt = setTimeout(recalc, 120);
            });

            // init after DOM render
            setTimeout(() => {
                recalc();
                startAuto();
            }, 60);

            // expose for debug
            window.reviewsSlider = {
                recalc,
                nextSlide,
                prevSlide,
                startAuto,
                stopAuto
            };
        })();
    </script>


   <script>
(function () {
    const qs = document.querySelectorAll('.q');

    qs.forEach(q => {
        q.addEventListener('click', () => {

            const idx = q.dataset.index;
            const ans = document.querySelector('.a[data-index="' + idx + '"]');
            const arrow = q.querySelector('.arrow');
            const isOpen = ans.classList.contains('open');

            // যদি ইতিমধ্যে ওপেন থাকে → ক্লিক করলে ক্লোজ করে দাও
            if (isOpen) {
                ans.classList.remove('open');
                ans.style.maxHeight = 0;
                arrow.style.transform = '';
                return; // এখানে শেষ
            }

            // প্রথমে সবকিছু বন্ধ করে দাও
            document.querySelectorAll('.a').forEach(a => {
                a.classList.remove('open');
                a.style.maxHeight = 0;
            });
            document.querySelectorAll('.q .arrow').forEach(ar => {
                ar.style.transform = '';
            });

            // ক্লিক করা প্রশ্ন ওপেন হবে
            ans.classList.add('open');
            ans.style.maxHeight = ans.scrollHeight + 'px';
            arrow.style.transform = 'rotate(180deg)';
        });
    });
})();
</script>



@endpush
