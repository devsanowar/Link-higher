@extends('website.layouts.app')
@section('title', 'Employe Page')
@section('page_id', 'employe-page')
@section('website_content')
    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Employe Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Employe</li>
            </ul>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <div class="header">
                <div class="title">Our Employe</div>
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
        </div>
    </section>
@endsection
