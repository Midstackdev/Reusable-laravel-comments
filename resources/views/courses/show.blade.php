@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <comments endpoint={{ route('course.comment.index', $course) }}></comments>
        </div>
    </div>
</div>
@endsection