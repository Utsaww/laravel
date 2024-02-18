@extends('users.includes.app')

@section('content')

<section class="banner">
      <img src="images/faq.jpg">
</section>
<section class="materialData">
<div class="center-wrapper">
    <div class="faqs-outer"><h1>1. What is Accounting?</h1><p>Accounting is the process of recording, assessing, and communicating financial transactions like sales, purchase and expenses to helps organizations and individuals to understand the financial health. </p><h1>2. What are the types of Accounting?</h1><p>-  Financial accounting</p><p>-  Management accounting</p><p>- Cost accounting</p><p>- Tax accounting</p><p>- Auditing</p><h1>3. What is Financial Accounting?</h1><p>Financial accounting is a particular type of accounting that includes a method of documenting, summarising, and reporting the transactions arising from business operations for a period. Financial accounting reflects the accounting on "accrual basis" over the accounting on "cash basis"</p><h1>4. What is Management Accounting?</h1><p>Managerial accounting is the practice of identifying, measuring, analysing, interpreting, and communicating financial information to managers for the pursuit of an organization's goals.</p><h1>5. What is Cost Accounting?</h1><p>The Cost accounting is a subcategory of managerial accounting. Cost accountants are responsible for documenting, presenting and reviewing manufacturing costs. They oversee all variable and fixed costs to see if output aligns with the cost to produce a product. They also work with managers to decide on future decisions based on the financial forecast and the progress of production.</p><h1>6. What is Tax Accounting?</h1><p>Tax accounting focuses on tax returns and payments rather than the preparation of public financial statements. An accountant or tax advisor can also help you calculate how much tax you should be pay, how to finance your future tax payments, and which tax accounting methods work best for your business.</p><h1>7. What is Auditing?</h1><p>Auditing is defined as the on-site verification activity, such as inspection or examination, of a process or quality system, to ensure compliance to requirements. Some audits have special administrative purposes, such as auditing documents, risk, or performance, or following up on completed corrective actions.</p><h1>8. What is Audit Report?</h1><p>An auditor's report is a written letter from the auditor containing their opinion on whether a company's financial statements comply with generally accepted accounting principles (GAAP) and are free from material misstatement.</p></div>
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
     
     