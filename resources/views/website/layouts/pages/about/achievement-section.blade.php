<div id="statistic-5" class="statistic-section">
    <div class="container">
        <div class="statistic-5-wrapper">
            <div class="statistic-row">
                @foreach ($achievements as $achievement)
                    <div class="statistic-col">
                        <div class="statistic-block wow fadeInUp">
                            <!-- Digit -->
                            <div class="statistic-digit">
                                <h2>
                                    <span class="count-element">{{ $achievement->count_value }}+</span>
                                </h2>
                            </div>
                            <!-- Text -->
                            <div class="statistic-text">
                                <h5>{{ $achievement->title ?? '' }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
