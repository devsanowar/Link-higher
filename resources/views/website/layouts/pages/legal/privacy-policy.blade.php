@extends('website.layouts.app')
@section('title', 'Privacy Policy')
@section('website_content')

    <section id="service-page-breadcrumb">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Privacy Policy Page</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Privacy Policy</li>
            </ul>
        </div>
    </section>


    <!-- PRIVACY PAGE
                         ============================================= -->
    <section id="privacy-page"
        class=" pb--80 xl:!pb-[80px] lg:max-xl:!pb-[60px] md:max-lg:!pb-[50px] inner-page-hero division pt-[0px] lg:max-xl:pt-[0px] md:max-lg:!mt-[0px] md:max-lg:pt-[0px]">
        <div class="container">
            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                    <!-- INNER PAGE TITLE -->
                   
                    <!-- TEXT BLOCK -->
                    <div class="txt-block legal-info">


                        {!! $privacyPolicy->privacy_policy_content ?? '' !!}

                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>
    <!-- END PRIVACY PAGE -->

    <!-- END SINGLE PROJECT-1 -->
    <hr
        class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
@endsection
