@extends('users.includes.app')

@section('content')
    

<section class="banner">
    <img src="{{ asset('img/users/bannerInner.png') }}">
</section>
<section class="materialData">
    <div class="center-wrapper">
        <div class="paperDataOuter">
            <div class="labelInfo">
                <h1>
                    @if($testQuestionData && $testQuestionData[0] && $testQuestionData[0]->test_name)
                        {{ $testQuestionData[0]->test_name }}
                    @else
                        No Test Available
                    @endif
                </h1>
                <div class="btnDownload">
                <a href=""><img src="{{ asset('img/users/download.png') }}"></a>
                <a href=""><img src="{{ asset('img/users/copy.png') }}"></a>
                </div>
            </div>
            <div class="paperInfo">
                <!--<h5>PHYSICS</h5>-->
                @if($testQuestionData)
                    @foreach ($testQuestionData as $test)
                        <div class="qustinLabel">
                            <table>
                                <tr>
                                    <td>
                                        <p><b>Question:</b> {!! $test->question !!}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>Options:</b></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>(a)</b> {!! $test->option_1 !!}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>(b)</b> {!! $test->option_2 !!}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>(c)</b> {!! $test->option_3 !!}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>(d)</b> {!! $test->option_4 !!}</p>
                                    </td>
                                </tr>
                            </table>
                            <div class="answerData">
                                <table>
                                    <tr>
                                        <td>
                                        <p><b>Answer:</b> {!! $test->answer !!}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <p><b>Solutions:</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <p>{!! $test->solution !!}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @else
                    No Question Available
                @endif
            </div>
        </div>
    </div>
</section>
     
     
@endsection