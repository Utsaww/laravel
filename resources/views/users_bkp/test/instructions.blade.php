@extends('users.includes.app')

@section('content')
    <section class="je-main-outer">
    <h1>{{$testData[0]->name}}</h1>
    </section> 
    <section class="start-test-info">
    <h3>Instructions </h3>
    <p>Read the instructions carefully</p>
    <div class="top-ins">
        <p>1) There is no limit to attempt the questions in this assignment. </p> 
        <p> 2) Questions can be single/multiple choice, short text or numeric. </p>
        <p>3) Type of question will be mentioned along with the question.</p>
        <p>4) One question can be attempted only once. </p>
        <p>5) You will find the answers/solutions along with the question upon submitting your answer.</p>
    </div>
    <a href="{{route('testpage', $testId)}}">Start Test</a>
    </section>
@endsection