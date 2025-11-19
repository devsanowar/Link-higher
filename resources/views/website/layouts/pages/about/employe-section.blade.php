<section class="team-section">
    <div class="container">
        <div class="header">
            <div class="title">Our Team</div>
            <p class="section-subtitle">Meet the talented professionals behind our success</p>
        </div>

        <div class="team-grid">


            @forelse ($employes as $employe)
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset($employe->image ?? 'Employe Image') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">{{ $employe->name ?? '' }}</h3>
                    <p class="team-role">{{ $employe->profession ?? '' }}</p>
                </div>
            @empty
                <div class="team-card">
                    <div class="team-image">
                        <img src="https://via.placeholder.com/300x300" alt="Team Member">
                    </div>
                    <h3 class="team-name">Michael Brown</h3>
                    <p class="team-role">Project Manager</p>
                </div>
            @endforelse

        </div>

        <div class="text-center my-4">
            <a href="{{ route('employe.page') }}" class="btn btn-primary btn-lg custom-arrow-btn">
                More
                <span class="arrow"></span>
            </a>
        </div>


    </div>
</section>
