@if(empty($disableFooter))
    <footer id="footer">
        <div class="top-footerData">
            <div class="center-wrapper">
                <h1>Have any query, you can contact us at</h1>
                <p>contact@padhloji.com</p>
            </div>
        </div>
        <div class="footer-bottom main-ft">
            <div class="center-wrapper">
                <div class="main-footer-update">
                    <div class="outer-part">
                    <div class="left-part-about">
                        <div class="logo-data-new">
                            <img style="max-width: 210px;" src="{{ asset('img/users/Logo_png.png') }}">
                        </div>
                        <ul>
                            <li>
                            <div class="social-icon">
                                <a href="https://www.youtube.com/channel/UCc_04ngejdNr0pCIaSuslFg" target="_blank"><img src="{{ asset('img/users/youtube_Social.svg') }}"></a>
                                <a href="https://www.facebook.com/Padhloji-105381045331301" target="_blank"><img src="{{ asset('img/users/Facebook_Social.svg') }}"></a>
                                <a href="https://www.instagram.com/padhloji/" target="_blank"><img src="{{ asset('img/users/instagram_Social.svg') }}"></a>
                                <a href="https://twitter.com/padhloji" target="_blank"><img src="{{ asset('img/users/twitter_Social.svg') }}"></a>
                            </div>
                            </li>
                            <li><img class="social" src="{{ asset('images/whatsapp.png') }}"> +91 7037000721  </li>
                            <li><img class="social" src="{{ asset('img/users/Email_icon_Footer.svg') }}">  contact@padhloji.com </li>
                        </ul>
                    </div>
                    <div class="right-part-ft">
                        <div class="outer-ul-part-main">
                            <div class="lft-pro-ul-data">
                                <ul>
                                <li>Free Study Material</li>
                                <li><a href="{{ url('JEE/4/JEE+Main/list') }}">Previous Year JEE (Main)</a></li>
                                <li><a href="{{ url('JEE/4/JEE+Advanced/list') }}">Previous Year JEE (Advanced)</a></li>
                                <li><a href="{{ url('NEET/4/list') }}">Previous Year NEET</a></li>
                                <li><a href="{{ url('NTSE/4/list') }}">Previous Year  NTSE</a></li>
                                <li><a href="{{ url('Academics/4/list') }}">NCERT Book Solution</a></li>
                                </ul>
                            </div>
                            <div class="lft-pro-ul-data">
                                <ul>
                                <li>About Exams</li>
                                <li><a href="{{ url('aboutexam/jee_main') }}">JEE (Main)</a></li>
                                <li><a href="{{ url('aboutexam/jee_advanced') }}">JEE (Advanced)</a></li>
                                <li><a href="{{ url('aboutexam/neet') }}">NEET</a></li>
                                <li><a href="{{ url('aboutexam/ntse') }}">NTSE</a></li>
                                </ul>
                            </div>
                            <div class="lft-pro-ul-data">
                                <ul>
                                <li>Quick Links</li>
                                <li><a href="{{ url('aboutus') }}">About PadhloJi</a></li>
                                <!--<li><a href="{{ url('message') }}">Mentor’s Message</a></li>-->
                                <li><a href="{{ url('disclaimer') }}">Disclaimer</a></li>
                                <li><a href="{{ url('policy') }}"> Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="bottom-ft-main">
                    <p>© 2021, Padhloji. All right reserved.</p>
                </div>
            </div>
        </div>
    </footer>
@endif
<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }
    $(document).ready(function(){
    $('.container').click(function(){
    $('.nav-rgt').slideToggle();	
    });
    $('#open-submenu').click(function(){
        if(screen.width<=768){
            $('#sub1').slideToggle();
        }
    });	
    $('#open-submenu1').click(function(){
        if(screen.width<=768){
    $('#sub2').slideToggle();
        }
    });	
    $('#open-submenu2').click(function(){
        if(screen.width<=768){
    $('#sub3').slideToggle();	
        }
    } );
        $('#open-submenu3').click(function(){
            if(screen.width<=768){
    $('#sub4').slideToggle();	
            }
    } );
        $('#open-submenu9').click(function(){
            if(screen.width<=768){
    $('#sub9').slideToggle();	
            }
    });
    });
    
    function redirectTo(link) {
        window.location.href = link;
    }
    function downloadFile(uri, name) {
        window.open(uri, '_blank');
    }
    function logout() {
        $("#logoutform").submit();
    }
    $(document).ready(function () {
        $(".canel-info").click(function(){
            $(".error-div").remove()
            $(".main-popup").hide();
        })
    });
    @if (Session::has('loginmsg') || (Session::get('modulename') == 'login' && $errors->count() > 0))
        $(document).ready(function() {
            $("#login-popup").show();
        });
    @endif
    @if (Session::has('registermsg') || (Session::get('modulename') == 'register' && $errors->count() > 0))
        $(document).ready(function() {
            $("#register-popup").show();
        });
    @endif
</script>
