<section id="about-3" class="mision-vision-about-section">
    <div class="container">

        <div class="row-mission">

            <!-- Mission -->
            <div class="col-mission">
                <div class="text-block">
                    <h3 class="title">{{ $missionVision->mission_title ?? '' }}</h3>

                    <p class="description">
                        {!! $missionVision->mission ?? '' !!}
                    </p>
                </div>
            </div>

            <!-- Vision -->
            <div class="col-mission">
                <div class="text-block">
                    <h3 class="title">{{ $missionVision->vision_title ?? '' }}</h3>
                    <p class="description">
                        {!! $missionVision->vision ?? '' !!}
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>
