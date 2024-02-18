
    <?php

$courses = \DB::select('select id,name from blog_tags where status = 1 and deleted_at is null');
$classes = \DB::select('select id,name from blog_categories where status = 1 and deleted_at is null');
$statusesArr = [ 0 => 'In Active',1 => 'NCERT Solutions', 2 => 'Mock Test', 3 => 'Important Questions',
        4 => 'Previous Year Solved Papers', 5 => 'Content' ];
foreach ($courses as $key => $value) {
    $courseId=$value->id;
     $testData = \DB::select('select B.course_content, B.status, B.name as test_name, B.id as test_id, B.content, B.status, B.featured_image, BMC.category_id, C.name as class_name from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC ON BMC.blog_id = B.id left join blog_categories C on C.id = BMC.category_id where BTM.tag_id = ' . $courseId . ' and B.status IN (1,2,3,4,5) and B.deleted_at is null');
        $testList = array();
        foreach($testData as $test) {
            if(!isset($testList[$test->status])) {
                $testList[$test->status] = $statusesArr[$test->status];
            }
        }
       $subcourse[$value->id]=$testList;     
}
?>
<header id="header">
	<div class="header-part">
		<div class="bottom-header">
			<div class="center-wrapper">
			<div class="header-outer">
				<div class="logo-data">
					<a href="{{ url('/') }}">
					<img style="max-width: 258px;" src="{{ asset('img/users/Logo_png.png') }}">
					</a>
				</div>
				<div class="nav-rgt">
					<ul>
						<li>
						<a href="javascript:void(0)">Free Study Material <span class="glyph-icon flaticon-caret5 down"></span></a>
						<div id="sub4" class="dropdownul new">
							<div class="inner-menu-div">
								<?php 
									$courseData = \DB::select('select * from blog_tags where status = 1 and deleted_at is null');
								?>	
								<ul>
									@foreach ($courseData as $course)
										<li><a href="{{ url(setPrettyUrl($course->name) . "/" . "list") }}">{{$course->name}}</a>
                                                                               <div class="dropdownul new submenuInner">
                                                                                   @foreach ($subcourse[$course->id] as $type => $name)  
                                                                                    <div class="inner-menu-div">
                                                                                     <ul><li><a href="{{ url(setPrettyUrl($course->name). '/' . $type . '/list')  }}">{{$name}}</a></li></ul>
                                                                                    </div> 
                                                                                   @endforeach
                                                                                </div> 
                                                                                </li>
									@endforeach
								</ul>
							</div>
						</div>
						</li>
						<li>
						<a href="javascript:void(0)">More <span class="glyph-icon flaticon-caret5 down"></span></a>
						<div id="sub4" class="dropdownul new">
							<div class="inner-menu-div">
								<ul>
									<li><a href="{{ url('aboutus') }}">ABOUT PadhloJi</a> </li>
                                                                        <!--<li><a href="{{ url('message') }}">Mentor's Messages</a> </li>-->
                                                                        <li><a href="#footer">Contact us</a></li>
                                                                     <!--   <li><a href="{{ url('testimonials') }}">Our Testimonials</a> </li>
                                                                        <li><a href="{{ url('faqs') }}">FAQs</a> </li>-->
								</ul>
							</div>
						</div>
						</li>
                                                <li >
                                                <a href="">About Exams <span class="glyph-icon flaticon-caret5 down"></span></a>
                                                <div id="sub4" class="dropdownul new">
                                                <div class="inner-menu-div">
                                                <ul>
                                                    <li><a href="{{ url('aboutexam/ntse') }}">About NTSE</a> </li>
<!--                                                    <li><a href="{{ url('aboutexam/kvpy') }}">About KVPY</a> </li>-->
                                                    <li><a  href="{{ url('aboutexam/jee_main') }}">About JEE (Main)</a> </li>
                                                    <li><a  href="{{ url('aboutexam/jee_advanced') }}">About JEE (Advanced)</a> </li>
                                                    <li><a  href="{{ url('aboutexam/neet') }}">About NEET</a> </li>
                                                    <!--<li><a  href="{{ url('aboutexam/nse_olympiad') }}">About NSE/OLYMPIADS</a> </li>-->
                                                  </ul>
                                                </div>
                                                </div>
                                                </li>
<!--						<li>
						<a href="#footer">Contact us</a>
						</li>-->
                                                <li>
                                                <a href="#">Test <span class="glyph-icon flaticon-caret5 down"></span></a>
                                                <div id="sub4" class="dropdownul new">
                                                <div class="inner-menu-div">
                                                <ul>
                                                    <li><a href="https://exam.padhloji.com/login" target="_blank">Start Test</a> </li>
                                                    <li><a href="{{ url('test-series') }}">Test Series</a> </li>
                                                  </ul>
                                                </div>
                                                </div>
                                                </li>
						@if(Session::has('studentLoggedIn') && Session::get('studentLoggedIn'))
							<?php
							$userData = json_decode(Session::get('studentData'), true);
							?>
							<li class="login-btn" >
								<a href="javascript:void(0)" onclick="logout()">Logout</a>
							</li>
							<li class="login-btn" style="margin-right: 5px"><a href="javascript:void(0)">{{ $userData['name'] }}</a></li>
						@else
							<li class="login-btn">
								<a href="javascript:void(0)" onclick="$('#login-popup').show();" > Login</a>
							</li>
							<li class="login-btn" style="margin-right: 5px">
								<a href="javascript:void(0)" onclick="$('#register-popup').show();" > Register</a>
							</li>
						@endif
						
					</ul>
				</div>
				<div class="container" onclick="myFunction(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
			</div>
			</div>
		</div>
	</div>
</header>

<!--Login popup start-->
<div class="main-popup" id="login-popup">
    <div class="inner-part-popup">
        <div class="study-material">
            <div class="left-study-material">
				<h1>Free <br>Study Material</h1>
				<div class="banner-login">
					<img src="{{ asset('img/users/Login_Popup.svg') }}">
				</div>
            </div>
            <div class="login-outer-main-stdy">
				{{ Form::open(array('url' => 'studentlogin', 'method' => 'post')) }}
					@csrf
					<div class="login-inf">
						<div class="canel-info"><img src="{{ asset('img/users/cancel.png') }}"></div>
						<h1>To learn from best study <br> material, Enroll now!</h1>    
						<div class="user-form-info" style="display:block;">
							@if (Session::has('loginmsg'))
								<div class="outer-input-part-data error-div" style="color:red">
									{!! Session::get('loginmsg') !!}
								</div>
							@endif
							@foreach ($errors->all() as $error)
								<div class="outer-input-part-data error-div" style="color:red">
										{{ $error }}
								</div>
							@endforeach
							<div class="outer-input-part-data">
								<input type="text" name="email" placeholder="Email ID / Phone No." required>
							</div>
							<div class="outer-input-part-data">
								<input type="password" name="password" placeholder="Password" required>
							</div>
							<div class="outer-input-part-data">
								<button type="submit">Login</button>
							</div>
						</div>
					</div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!--Login popup end-->
<div class="main-popup" id="register-popup">
    <div class="inner-part-popup" style="height: 520px;">
        <div class="study-material">
            <div class="left-study-material">
				<h1>Free <br>Study Material</h1>
				<div class="banner-login">
					<img src="{{ asset('img/users/Login_Popup.svg') }}">
				</div>
            </div>
            <div class="login-outer-main-stdy">
				{{ Form::open(array('url' => 'studentregister', 'method' => 'post')) }}
					@csrf
					<div class="login-inf">
						<div class="canel-info"><img src="{{ asset('img/users/cancel.png') }}"></div>
						<h1>To learn from best study <br> material, Enroll now!</h1>  
						<div class="user-form-info">
							@if (Session::has('registermsg'))
								<div class="outer-input-part-data error-div" style="color:red">
									{!! Session::get('registermsg') !!}
								</div>
							@endif
							@foreach ($errors->all() as $error)
								<div class="outer-input-part-data error-div" style="color:red">
									{{ $error }}
								</div>
							@endforeach
							<div class="outer-input-part-data">
								<input type="text" name="name" placeholder="Name" required>
							</div>
							<div class="outer-input-part-data">
								<input type="text" name="email" placeholder="Email ID/Phone No" required>
							</div>
							<div class="outer-input-part-data">
								<input type="password" name="password" placeholder="Password" required>
							</div>
							<div class="outer-input-part-data">
							<select name="class_id" required>
								<option value="" selected>Grade</option>  
								@foreach ($classes as $class)
									<option value="{{$class->id}}">{{$class->name}}</option>
								@endforeach  
							</select>
							</div>
							<div class="outer-input-part-data">
								<select name="course_id" required>
									<option value="" selected>Appearing for</option>
									@foreach ($courses as $course)
										<option value="{{$course->id}}">{{$course->name}}</option>
									@endforeach  
								</select>
							</div>
							<div class="outer-input-part-data">
								<button type="submit">Register</button>
							</div>
						</div>
					</div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
{{ Form::open(array('url' => 'studentlogout', 'method' => 'post', 'id' => 'logoutform')) }}
	@csrf
	<input type="hidden" name="logout" value="1" />
{{ Form::close() }}