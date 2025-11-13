        <section id="post-slider" aria-label="Blog posts slider">
            <div class="header">
                <div class="title">Here to learn about SEO & marketing?</div>
                {{-- <div style="font-size: 13px; color: #6b7280">
          Seamless loop — no reverse
        </div> --}}
            </div>

            <button class="ps-arrow left" id="ps-prev" aria-label="Previous">
                &#10094;
            </button>
            <button class="ps-arrow right" id="ps-next" aria-label="Next">
                &#10095;
            </button>

            <div class="ps-viewport">
                <div class="ps-track" id="ps-track">
                    @foreach ($posts as $post)
                        <article class="post-card">
                            @if ($post->featured_image)
                                <img src="{{ asset($post->featured_image) }}" class="post-image" alt="img2" />
                            @else
                                <img src="https://picsum.photos/seed/2/800/600" class="post-image" alt="img2" />
                            @endif

                            <div class="post-body">
                                <div class="post-meta">
                                    <span class="post-category">{{ $post->category->category_name }}</span><span class="custom_date">{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <p class="post-desc">
                                    {!!  Str::limit($post->long_description, 80, '...') !!}
                                </p>
                                <div class="post-author">

                                    @if($post->user && $post->user->image)
                                    <img src="{{ asset($post->user->image) }}" class="author-av" alt="a" />
                                    @else
                                    <img src="https://i.pravatar.cc/100?img=11" class="author-av" alt="a" />

                                    @endif
                                    <div class="author-name">{{ $post->user->name ?? '' }}</div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
