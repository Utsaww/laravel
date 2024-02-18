<!DOCTYPE html>
<html>
   <head>
      <title>PadhLoJi</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="msapplication-TileColor" content="#0075f5">
      <meta name="theme-color" content="#0075f5">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="images/logo.png" />
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
      <link href="{{ asset('css/users/style.css') }}" rel="stylesheet"/>
      <link href="{{ asset('flatiocn/flaticon.css') }}" rel="stylesheet"/>
      <link href="{{ asset('css/users/screens.css') }}" rel="stylesheet"/>
      <link href="{{ asset('css/users/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/users/owl.theme.default.min.css') }}" rel="stylesheet">
      <script src="{{ asset('js/users/jquery.min.js') }}"></script>
      <script src="{{ asset('js/users/main.js') }}"></script>
      <script src="{{ asset('js/users/owl.carousel.min.js') }}"></script>
   </head>
   <body>
      <div class="outer-test-page">
         <div class="outer-header-test-page">
            <div class="center-wrapper">
               <div class="logo-test-otr">
                  <div class="left-text">{{ $testQuestionData[0]->test_name }}</div>
                  <div class="right-time"><a href="javascript:void(0)"><i class="flaticon-time7"></i> Time Left <span id="timer" ></span></a></div>
               </div>
            </div>
         </div>
         <div class="bottom-header-new">
            <div class="center-wrapper">
                <a>Single Choice Questions</a>
            </div>
        </div>
        <div class="text-box-main">
            <div class="text-input-main">
               <div class="over-scroll-question" id="questionDetail" >
                  <div class="question-info-data" id="qn-detail">
                     <div class="question-info">
                        <p><b>Question:</b>  What is the sign of focal length of convex mirror?</p>
                     </div>
                  </div>
                  <div class="label-info-active-data">
                     <div class="inner-label active">
                        <div class="question-info-data">
                           <label><input type="radio" name="question" value="a" /> <img src="{{ asset('img/users/iconquestion.png') }}"></label>
                        </div>
                     </div>
                     <div class="inner-label">
                        <div class="question-info-data">
                           <label><input type="radio" name="question" value="b" /> <img src="{{ asset('img/users/iconquestion.png') }}"></label>
                        </div>
                     </div>
                     <div class="inner-label">
                        <div class="question-info-data">
                           <label><input type="radio" name="question" value="c" /> <img src="{{ asset('img/users/iconquestion.png') }}"></label>
                        </div>
                     </div>
                     <div class="inner-label">
                        <div class="question-info-data">
                           <label><input type="radio" name="question" value="d" /> None of these</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="btn-info-test-page">
                  <div class="question-info-data">
                     <div class="test-submit">
                        <a class="save-test" href="javascript:void(0)" onclick="changeQuestion('next')">Save & Next</a>
                        <a class="reviev-btn" href="javascript:void(0)" id="reviewbutton" style="display:none" onclick="changeQuestion('review')">Review Later</a>
                        <a class="reviev-btn" href="javascript:void(0)" id="unreviewbutton" style="display:none" onclick="changeQuestion('un-review')">Un-Review</a>
                        <a class="clear-btn" href="javascript:void(0)" onclick="clearResponse()">Clear Selection</a>
                     </div>
                     <div class="bottm-next-left">
                        <div class="left-next">
                           <a href="javascript:void(0)" onclick="changeQuestion('previous')" ><i class="flaticon-arrow462"></i> Back</a>
                           <a href="javascript:void(0)" onclick="changeQuestion('next')" > Next <i class="flaticon-arrow465"></i></a>
                        </div>
                        <div class="right-next">
                           <a href="javascript:void(0)" onclick="confirmEndTest()">End Test</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="rigth-box-selecttion">
               <div class="top-outer-radio">
                  <div class="top-instruction">
                     <div class="row-info-ins">
                        <span class="circle-info-default answered" id="answered">01</span> 
                        <p>Answer</p>
                     </div>
                     <div class="row-info-ins">
                        <span class="circle-info-default not-answered" id="not_answered">02</span> 
                        <p>Not Answered</p>
                     </div>
                     <div class="row-info-ins">
                        <span class="circle-info-default" id="not_visited">01</span> 
                        <p>Not Visited</p> 
                     </div>
                     <div class="row-info-ins">
                        <span class="circle-info-default reviewed" id="reviewed">01 </span> 
                        <p>To be reviewed</p>
                     </div>
                     <div class="row-info-ins">
                        <span class="circle-info-default answered-review" ><span id="reviewed_answered" >01</span> <img src="{{ asset('img/users/check.png') }}"></span> 
                        <p>Answered and marked for review (will be evaluated) </p>
                     </div>
                  </div>
               </div>
               <div class="scroll-item-question">
                  <ul>
                     @foreach ($testQuestionData as $testQn)
                        <li onclick="changeQuestion('serial_no', {{$testQn->serial_no}})"><span class="circle-info-default" id="pallet_{{$testQn->serial_no}}">{{$testQn->serial_no}} <img id="pllate_image_{{$testQn->serial_no}}" style="visibility: hidden;" src="{{ asset('img/users/check.png') }}" /></span></li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </div>
      {{ Form::open(array('url' => 'updateendtest', 'method' => 'post', 'id' => 'updateendtest')) }}

         <input type="hidden" name="testId" value="{{$testId}}"  />
      {{ Form::close() }}
      <script>
         var testQuestionData = JSON.parse(decodeURIComponent("<?=rawurlencode(json_encode($testQuestionData));?>"));
         var attemptedTest = JSON.parse(decodeURIComponent("<?=rawurlencode(json_encode($attemptedTest));?>"));

         updateTestDetail(attemptedTest['serial_no']);
         startTimer(attemptedTest['time_remaining']);
         var previousTime = attemptedTest['time_remaining'];
         var timerInterval;
         function startTimer() {
            getFormattedTime(attemptedTest['time_remaining']);
            timerInterval = setInterval(function(){
               if(attemptedTest['time_remaining'] <= 0) {
                  clearInterval(timerInterval);
                  changeQuestion('end_test');
               } else {
                  attemptedTest['time_remaining'] = attemptedTest['time_remaining']-1;
                  getFormattedTime(attemptedTest['time_remaining']);
               }
            }, 1000);
         }

         function getFormattedTime(timestamp) {
            var hours = Math.floor(timestamp / 60 / 60);
            var minutes = Math.floor(timestamp / 60) - (hours * 60);
            var seconds = timestamp % 60;
            var formatted = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
            $("#timer").html(formatted);
         }

         function updateTestDetail(serialNo) {
            var optionArr = {
               1:'a',2:'b',3:'c',4:'d',
            }
            var currentQnData = testQuestionData[serialNo-1];
            var responseStr   = attemptedTest['test_answer'].split("#");
            var reviewStr     = attemptedTest['review_status'].split("#");
            var timeStr       = attemptedTest['time_status'].split("#");
            var htmlData = '<div class="question-info-data" id="qn-detail">\n\
               <div class="question-info">\n\
                  <p><b>Question:</b> ' + currentQnData['question'] + '</p>\n\
               </div>\n\
            </div>\n\
            <div class="label-info-active-data">';
            for(var i=1;i<=4;i++) {
               var optionVal = optionArr[i];
               htmlData += '<div class="inner-label">\n\
                  <div class="question-info-data">\n\
                     <label><input type="radio" name="question" value="' + optionVal + '" /> ' + currentQnData['option_'+i] + '</label>\n\
                  </div>\n\
               </div>';
            }
            htmlData += '</div>';
            $("#questionDetail").html(htmlData);
            var countArr = {
               'answered':0,'not_answered':0,'not_visited':0,'reviewed':0,'reviewed_answered':0
            }
            for(var i=0; i< testQuestionData.length; i++) {
               var classStr = "";
               $("#pallet_"+(i+1)).removeClass("answered-review answered reviewed not-answered");
               document.getElementById("pllate_image_"+(i+1)).style.visibility = "hidden"; 
               if(responseStr[i] && reviewStr[i] == 1) {
                  countArr['reviewed_answered'] += 1;
                  classStr = "answered-review";
                  document.getElementById("pllate_image_"+(i+1)).style.visibility = "visible"; 
               } else if(responseStr[i]) {
                  countArr['answered'] += 1;
                  classStr = "answered";
               } else if(reviewStr[i] == 1) {
                  countArr['reviewed'] += 1;
                  classStr = "reviewed";
               } else if(timeStr[i] > 0) {
                  classStr = "not-answered";
                  countArr['not_answered'] += 1;
               } else {
                  countArr['not_visited'] += 1;
               }
               $("#pallet_"+(i+1)).addClass(classStr);
            }
            for(var key in countArr) {
               $("#"+key).html(countArr[key]);
            }
            if(responseStr[serialNo-1]) {
               $("input[name=question][value="+ responseStr[serialNo-1] +"]").prop("checked",true);
            }

            $("#unreviewbutton").hide();
            $("#reviewbutton").hide();
            if(reviewStr[serialNo-1] == 1) {
               $("#unreviewbutton").show();
            } else {
               $("#reviewbutton").show();
            }
            attemptedTest['serial_no']=serialNo;
         }

         function changeQuestion(type, serialNo) {

            var nextSerialNo = 0;
            if(type == 'serial_no' && serialNo) {
               nextSerialNo = parseInt(serialNo);
            } else if(type == 'next' && attemptedTest['serial_no'] < testQuestionData.length) {
               nextSerialNo = parseInt(attemptedTest['serial_no'])+1;
            } else if(type == 'previous' && attemptedTest['serial_no'] > 1) {
               nextSerialNo = parseInt(attemptedTest['serial_no'])-1;
            } else if(type == 'review' || type == 'un-review') {
               nextSerialNo = parseInt(attemptedTest['serial_no']);
            } 

            if(nextSerialNo <= 0 && type != 'end_test') {
               return false;
            }

            //Time Update
            var qnTime = previousTime-attemptedTest['time_remaining'];
            var timeArr = attemptedTest['time_status'].split("#");
            timeArr[attemptedTest['serial_no']-1] = parseInt(timeArr[attemptedTest['serial_no']-1])+parseInt(qnTime);
            attemptedTest['time_status'] = timeArr.join("#");
            previousTime = attemptedTest['time_remaining'];

            //Answer Update
            var answerArr = attemptedTest['test_answer'].split("#");
            answerArr[attemptedTest['serial_no']-1] = ($("input[type='radio'][name=question]:checked").val())?$("input[type='radio'][name=question]:checked").val():"";
            attemptedTest['test_answer'] = answerArr.join("#");

            //Review Update
            if(type == 'review' || type == 'un-review') {
               var reviewArr = attemptedTest['review_status'].split("#");
               reviewArr[attemptedTest['serial_no']-1] = (type == 'review')?1:0;
               attemptedTest['review_status'] = reviewArr.join("#");
            }
            
            $.ajax({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               url: '{{url("updatetest")}}',
               type:'POST',
               data:{testId:{{$testId}},testdata:JSON.stringify(attemptedTest)},
               success:function(data){
                  console.log('Yes' + data);
               }
            });

            if(type != 'end_test') {
               updateTestDetail(nextSerialNo);
            } else {
               $("#updateendtest").submit();
            }
            
         }

         function clearResponse() {
            $('input[name=question]').attr('checked',false);
         }

         function confirmEndTest() {
            var r = confirm("Are you sure you want to end test?");
            if (r == true) {
               changeQuestion('end_test');
            } 
         }
      </script>
   </body>
</html>