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
            <!-- EXAMPLE CARDS: replace these with your server-side loop (.cs-card) -->
            <article class="cs-card">
                <img class="cs-hero" src="https://picsum.photos/seed/cs1/1200/800" alt="case study image" />
                <div class="cs-body">
                    <div class="cs-category">Performance</div>
                    <h3 class="cs-title">
                        How Company X reduced delivery time by 40%
                    </h3>
                    <p class="cs-excerpt">
                        Short summary / excerpt of the case study. Keep it to 2 lines
                        for consistent card heights and neat layout.
                    </p>
                </div>
                <div class="cs-footer">
                    <div class="cs-author">
                        <img src="https://i.pravatar.cc/100?img=32" alt="author" />
                        <div class="cs-author-name">Jabir IT</div>
                    </div>
                    <div class="cs-date">Nov 12, 2025</div>
                </div>
            </article>

            <article class="cs-card">
                <img class="cs-hero" src="https://picsum.photos/seed/cs2/1200/800" alt="case study image" />
                <div class="cs-body">
                    <div class="cs-category">UX</div>
                    <h3 class="cs-title">Redesigning checkout — conversion up 25%</h3>
                    <p class="cs-excerpt">
                        Short summary highlighting the problem, solution and measurable
                        impact for easy scannability.
                    </p>
                </div>
                <div class="cs-footer">
                    <div class="cs-author">
                        <img src="https://i.pravatar.cc/100?img=18" alt="author" />
                        <div class="cs-author-name">Sadia</div>
                    </div>
                    <div class="cs-date">Oct 29, 2025</div>
                </div>
            </article>

            <article class="cs-card">
                <img class="cs-hero" src="https://picsum.photos/seed/cs3/1200/800" alt="case study image" />
                <div class="cs-body">
                    <div class="cs-category">Operations</div>
                    <h3 class="cs-title">Automating inventory — errors reduced</h3>
                    <p class="cs-excerpt">
                        A concise summary that communicates the before/after in one or
                        two short sentences.
                    </p>
                </div>
                <div class="cs-footer">
                    <div class="cs-author">
                        <img src="https://i.pravatar.cc/100?img=10" alt="author" />
                        <div class="cs-author-name">Fahim</div>
                    </div>
                    <div class="cs-date">Sep 18, 2025</div>
                </div>
            </article>

            <article class="cs-card">
                <img class="cs-hero" src="https://picsum.photos/seed/cs4/1200/800" alt="case study image" />
                <div class="cs-body">
                    <div class="cs-category">Strategy</div>
                    <h3 class="cs-title">Scaling sales team — revenue x2</h3>
                    <p class="cs-excerpt">
                        Brief summary of tactics used and measurable business impact.
                    </p>
                </div>
                <div class="cs-footer">
                    <div class="cs-author">
                        <img src="https://i.pravatar.cc/100?img=22" alt="author" />
                        <div class="cs-author-name">Riaz</div>
                    </div>
                    <div class="cs-date">Aug 05, 2025</div>
                </div>
            </article>

            <!-- Add more .cs-card elements as needed (or render via Blade). -->
        </div>
    </div>
</section>
