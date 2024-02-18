@extends('users.includes.app')

@section('content')

<section class="banner">
      <img src="images/testimonial.jpg">
</section>
<section class="materialData">
<div class="center-wrapper">
    <div class="page_content">
                <div class="brief_content">
                    <h3>Welcome to PADHLOJI</h3>
                    <p>Competition is everywhere and it is getting tough with each passing day. Many times, the
						dreams of students who wish to succeed in their goals may remain a dream because of the lack
						of proper guidance and focused training. If a student guided in the right way for the competitive
						exams then success can be achieved. PADHLOJI provides services through classroom-based coaching
						and digital learning, which supplement our classroom courses and allow students to engage in
						self-paced learning. PADHLOJI also offers short-term classroom courses to prepare students for
						upcoming examinations. PADHLOJI have 110+ classroom centres (the "PADHLOJI CLASSES"). With an aim to
						nurture the aspirants of Junior class students, PADHLOJI offer test preparatory courses to students in
						Class 9th &amp; 10th. In addition, PADHLOJI provides training to these students for central and state board
						examinations, and for Junior Competitive Scholarship tests and merit tests, such as Olympiads
						and National Talent Search Examination (NTSE).</p>
                </div>
			</div>
	</div>
</section>
<section>
<div class="center-wrapper">
<div class="page_content">
                <div class="brief_content">
                    <h3>Our Testimonial</h3>
                    <br>
                    <br>
  <div id="testimonial-slider" class="owl-carousel">
          <div class="testimonial">
            <div class="pic">
              <img src="images/userCircle.png">
            </div>
            <p class="description">
              The institute in which you get knowledge as well as manners, that institute is “aspirations”. This institution is like a family in which we get nurtured. We are given full freedom to ask any question without any hesitation or fear. This institution provides us with extra knowledge too. We just have to focus & learn the concepts / formulas that are being teached by the teacher. I think it is not only a tuition.
            </p>
            <h3 class="title">ABHIGYAN</h3>
            <small class="post">CLASS 10</small>
          </div>

          <div class="testimonial">
            <div class="pic">
              <img src="images/userCircle.png">
            </div>
            <p class="description">
             I joined aspirations in 9th standard. Aspirations is a place which makes our dreams come true. It helps us to form base. To me aspirations is not an institute, it is my home. We are not taught maths or science but we are taught to make our aim clear in our mind. The best part about aspirations is that we are not only taught maths & science but many amazing tricks which can help us to perform better.
            </p>
            <h3 class="title">MUJTABAH</h3>
            <small class="post">CLASS 9 </small>
          </div>

          <div class="testimonial">
            <div class="pic">
              <img src="images/userCircle.png">
            </div>
            <p class="description">
              The institute in which you get knowledge as well as manners, that institute is “aspirations”. This institution is like a family in which we get nurtured. We are given full freedom to ask any question without any hesitation or fear. This institution provides us with extra knowledge too. We just have to focus & learn the concepts / formulas that are being teached by the teacher. I think it is not only a tuition.
            </p>
            <h3 class="title">ABHIGYAN</h3>
            <small class="post">CLASS 10</small>
          </div>
        </div>
        </div>
        </div>
    </div>
</section>
<section class="test-mock-outer">
  <div class="center-wrapper">
     <div class="outer-test-mock">
       <div class="mockImg"><img src="images/MockTest_SVG.svg"></div>
        <div class="mock-content">
         <p>Looking for a one-stop solution to practice online mock test for every competitive exam? Then you are at right destination. Padhloji provides you wide range of test series prepared by the best educators in the country to help you prepare online for any competitive exam with ease.</p>
          <a href="">Take Mock Test</a>
         </div>
      </div>
    </div>
</section>

<!--Login popup start-->
<div class="main-popup1" style='display:none'>
    <div class="inner-part-popup">
        <div class="study-material">
            <div class="left-study-material">
            <h1>Free <br>Study Material</h1>
            <div class="banner-login">
                <img src="images/Login_Popup.svg">
            </div>
            </div>
            <div class="login-outer-main-stdy">
            <div class="login-inf">
            <div class="canel-info"><img src="images/cancel.png"></div>
            <h1>To learn from best study <br> material, Enroll now!</h1>    
             <div class="mobile-number-form" style="display:block;">
              <div class="outer-input-part-data mobile">
                  <span>+91</span>
                 <input type="text" placeholder="Enter Mobile Number">
                </div>
                <div class="outer-input-part-data">
                    <a href="">Next</a>
                </div>
                 <div class="or-info">OR</div>
                 <div class="icon-info"><a href=""><img src="images/google.png"> Continue with Google</a></div>
                 <div class="icon-info"><a href=""><img src="images/facebook1.png"> Continue with Facebook</a></div>
             </div>
            <div class="verify-otp-info" style="display:none">
                <p>Please enter OTP sent to your <br> mobile <b>9999999999</b> <a href=""><img src="images/edit.png"> Edit</a></p>
                <div class="otp-input-main">
                 <div class="dis-otp">
                <div class="space-input">
                  <input type="text" maxlength="1">
                </div>
                     <div class="space-input">
                  <input type="text" maxlength="1">
                </div>
                     <div class="space-input" >
                  <input type="text" maxlength="1">
                </div>
                     <div class="space-input">
                  <input type="text" maxlength="1">
                </div>
                 </div>
                <div class="resend-otp">
                 <a href="">Resend OTP</a>
                </div>
                </div>
                <div class="outer-input-part-data disabled">
                    <a href="">Verify & Proceed</a>
                </div>
            </div>
            <div class="user-form-info" style="display:none;">
                <div class="outer-input-part-data">
                 <input type="text" placeholder="Name">
                </div>
                <div class="outer-input-part-data">
                  <input type="email" placeholder="Email ID">
                </div>
                <div class="outer-input-part-data">
                  <select>
                  <option selected>Grade</option>  
                  </select>
                </div>
                <div class="outer-input-part-data">
                  <select>
                  <option selected>Appearing for</option>  
                  </select>
                </div>
                <div class="outer-input-part-data">
                    <a href="">Next</a>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--Login popup end-->
<script>
    $(document).ready(function() {
      $("#testimonial-slider").owlCarousel({
        items: 2,
        itemsDesktop: [1000, 2],
        itemsDesktopSmall: [990, 2],
        itemsTablet: [768, 1],
        pagination: true,
        navigation: false,
        navigationText: ["", ""],
        slideSpeed: 1000,
        autoPlay: true,
        responsiveClass:true,
        responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:2,
            nav:true,
            loop:false
        }
       }
      });
    });
  </script>
<script>
    $(document).ready(function () {
        $(".login-btn a").click(function(){
            $(".main-popup").show();
        })
        $(".canel-info").click(function(){
            $(".main-popup").hide();
        })
	  });
</script>
@endsection
     
     