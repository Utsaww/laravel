@extends('users.includes.app')

@section('content')
    <section class="banner-header">
        <div class="center-wrapper">
            <div class="banner-main">
                <div class="banner-left-content">
                    <h1>{!! $moduleName !!}</h1>
                    <p>{!! $detailContent !!}</p>
                </div>  
                <div class="right-img"><img src="{{ asset('img/users/InnerPage_Header.svg') }}"></div>
            </div>
            <div class="bratekram">
                {!! $urlString !!}
            </div>
        </div>
    </section>
    <section class="materialData">
        <div class="center-wrapper">
            @if(isset($testList) && count($testList) > 0)
                <div class="budgetLeft">
                    <div class="innerContent">
                        @foreach ($testList as $test)
                            @if(!empty($test->is_submodule))
                                <div class="accordianOuter">
                                    <a href="{{ url(setPrettyUrl($courseName). '/' . $type . '/' . setPrettyUrl($className) .'/' . setPrettyUrl($test->name) . '/list')  }}">
                                        <h4>{{$test->name}} <img src="{{ asset('img/users/faq_next.svg') }}"> </h4>
                                    </a>
                                </div>
                            @else
                                <div @if($test->status == 1 || $test->status == 3 || $test->status == 4 || $test->status == 5) onclick="downloadFile('{{ asset('storage/' . $test->featured_image, 'Question_Paper') }}')" @elseif(Session::has('studentLoggedIn') && Session::get('studentLoggedIn')) onclick="redirectTo('{{ url('instruction/' . $test->test_id) }}')" @else onclick="alert('Login to view Details')" @endif class="accordianOuter">
                                    <h4>{{$test->test_name}} </h4>
                                </div>
                            @endif
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