@extends('users.includes.app')

@section('content')
    <section class="banner-header">
        <div class="center-wrapper">
            <div class="banner-main">
                <div class="banner-left-content">
                    <h1>{!! $moduleName !!}</h1>
                    <p>While observing the latest developments in IIT JEE including the Examination Mode, pattern, and other changes, we at Padhloji have come with a comprehensive JEE preparation course for aspirants who are planning to appear at the national level entrance exam.</p>
                </div>  
                <div class="right-img"><img src="{{ asset('img/users/InnerPage_Header.svg') }}"></div>
            </div>
            <div class="bratekram">
                {!! $urlString !!}
            </div>
        </div>
    </section>
    <!--<section class="banner">
        <img src="{{ asset('img/users/bannerInner.png') }}">
        <p>{!! $moduleName !!}</p>
        <p>{!! $urlString !!}</p>
        <p>{!! $detailContent !!}</p>
    </section>-->
    <section class="materialData">
        <div class="center-wrapper">
            @if(isset($testList) && count($testList) > 0)
                <div class="budgetLeft">
                    <div class="innerContent">
                        @foreach ($testList as $type => $name)
                           <div class="accordianOuter">
                                <a href="{{ url(setPrettyUrl($moduleName). '/' . $type . '/list')  }}">
                                    <h4>{{$name}} <img src="{{ asset('img/users/faq_next.svg') }}"> </h4>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section> 
    <section class="test-mock-outer">
        <div class="center-wrapper">
           <div class="outer-test-mock">
             <div class="mockImg"><img src="{{ asset('img/users/MockTest_SVG.svg') }}"></div>
              <div class="mock-content">
               <p>Looking for a one-stop solution to practice online mock test for every competitive exam? Then you are at right destination. Padhloji provides you wide range of test series prepared by the best educators in the country to help you prepare online for any competitive exam with ease.</p>
                <a href="">Take Mock Test</a>
               </div>
            </div>
        </div>
    </section> 
@endsection