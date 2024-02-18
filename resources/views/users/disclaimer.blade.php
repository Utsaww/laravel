@extends('users.includes.app')

@section('content')
<section class="banner">
      <img src="images/Disclaimer_banner.jpg">
</section>
<section class="materialData">
<div class="center-wrapper">
    <div class="faqs-outer">
      <p>The information contained in this website is for general information purposes only. The information is provided by Padhloji Edtech Pvt. Ltd. and while we try to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the entireness, accuracy, reliability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any belief you place on such information is therefore strictly at your own risk.</p>
      <p>In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arise out of, or in connection with, the use of this website.</p>
        <p>Through this website you are able to link to other websites which are not under the control of Padhloji Edtech Pvt. Ltd. We have no control over the any activity done by those sites. The inclusion of any links does not necessarily imply a recommendation or support of the views expressed within them.</p>
        <p>Every effort is made to keep the  website working properly. However, Padhloji Edtech Pvt. Ltd. takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.Padhloji Edtech Pvt. Ltd. is located at –

</p>
        <p><b>Address:</b> House No.196,D-Block, 3C Smita Apartments, Sham Nagar, Kanpur (U.P.), India, 208013</p>
        <p><b>Email:</b> contact@padhloji.com</p>
<p><b>Website:</b> www.padhloji.com
</p>
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
     