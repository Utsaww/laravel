@extends('users.includes.app')

@section('content')
    <section class="banner">
        <div id="slider" class="owl-carousel owl-theme">
            <a href="{{ url('test-series') }}"><div class="item"><img src="{{ asset('img/users/HomePageBanner.jpg') }}"></div></a>
           
           <div class="item"><img src="{{ asset('img/users/banner.png') }}"></div>
        </div>
     </section>
     <section class="stydyMaterial">
        <div class="center-wrapper">
           <div class="studyPart">
              <h2>Explore free study material </h2>
              <div class="outer-dounload-tab">
                 <div class="tab">
                     @foreach ($courses as $cId => $cName)
                        <button class="tablinks cr_{{$cId}}" onclick="openCity({{$cId}})" >{{$cName}}</button>
                     @endforeach
                 </div>
                 <div class="tabcontent">
                    <div class="innerSectionContent">
                        <?php $courseCountArr = array(); ?>
                        @foreach ($testList as $course_Id => $testCourse)
                           @foreach ($testCourse as $type => $test)
                              <?php 
                                 if(empty($courseCountArr[$course_Id])) {
                                    $courseCountArr[$course_Id] = 0;
                                 }
                                 $courseCountArr[$course_Id]++;
                                 if($courseCountArr[$course_Id] >= 5) {
                                    continue;
                                 }
                              ?>
                              <div class="leftSectData all_courses course_{{$course_Id}}">
                                    <a href="{{ url(setPrettyUrl($courses[$course_Id]). "/" . $type . '/list')  }}" ><h3>{{$test['name']}}</h3></a>
                              </div>
                           @endforeach
                        @endforeach
                        @foreach ($courses as $cId => $cName)
                           @if(!empty($courseCountArr[$cId]) && $courseCountArr[$cId] >= 5)
                              <div class="leftSectData all_courses course_{{$cId}}">
                                 <a href="{{ url(setPrettyUrl($cName). '/list')  }}"><img src="{{ asset('img/users/elips.png') }}"><span> View all</span></a>
                              </div>
                           @endif
                        @endforeach
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <section class="subscribe">
        <div class="center-wrapper">
           <div class="outer-subscribes">
              <div class="leftArrow">
                 <h1>Subscribe</h1>
                 <img src="{{ asset('img/users/Subscribe_ArrowPath.svg') }}">
              </div>
              <div class="packgeData">
                 <div class="packageImage"><img src="{{ asset('img/users/Youtube_Card.svg') }}"></div>
                 <div class="buttonBTnInfo">
                    <p>Videos from mentors</p>
                    <a href=""><img src="{{ asset('img/users/Youtube_Subscribe.svg') }}"></a>
                 </div>
              </div>
              <div class="packgeData last">
                 <div class="packageImage"><img src="{{ asset('img/users/Subscribe_Card.svg') }}"></div>
                 <div class="buttonBTnInfo">
                    <p>Get latest updates on Email</p>
                    <div class="subsInput"><input type="text" placeholder="Enter email address"><button class="subscribes"><img src="{{ asset('img/users/Subscribe_icon.svg') }}"></button></div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <script>
        function openCity(id) {
            $(".all_courses").hide();
            $(".course_"+id).show();
            $(".tablinks").removeClass('active');
            $(".cr_"+id).addClass('active');
        }
     </script>
     <script>
         @if(!empty($courseId))
            openCity({{$courseId}})
         @endif
         $(document).ready(function () {
            $('#slider').owlCarousel({
               loop:false,
               rewind:true,
               margin: 10,
               items: 1,
               autoplay:true,
               autoplayHoverPause: true,
               nav:false,
               dots:true,
            });
         });
     </script>     
@endsection