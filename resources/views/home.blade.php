@extends('layouts.app')

@section('content')
<body>
    <main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <img class="mr-3" src="../assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Hi, {{  Auth::user()->name }}!</h6>
            <small>Since {{ Auth::user()->created_at }}</small>
        </div>
        <div class="pb-3 mb-0 align-items-center w-100">
            <div class="pr-4 float-right" style="color: springgreen ;"><strong>50</strong> done</div>
            <div class="pr-4 float-right" style="color: gold;"><strong>50</strong> active</div>
            <div class="pr-4 float-right" style="color: deepskyblue;"><strong>50</strong> today</div>
        </div>
  </div>

<form action="">
    <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Set up your task</h6>
            <div class="media text-muted pt-3">
            <div class="pt-4 d-flex form-group" style="width:70%;">
                <div class="pl-4 pr-3 form-group">
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Task Name">
                </div>
                <div class="pr-4 form-group" style="width: 65%;">
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Task description">
                </div>
            </div>
                <div class="pt-4 row">
                    <div class="pr-5">
                        <input class="form-control" type="date" value="2020-06-01" id="example-date-input">
                    </div>
                </div>
                <div class="pt-4 pl-5">
                    <button type="button" class="btn" style="background-color: #9561e2; color: white;">Add Task</button>
                </div>
    </div>
</form>
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Your all tasks</h6>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Task Name</strong>
          <div>
            <a class="act-buttons" href="#">Done!</a>
            <a class="act-buttons" href="#">Edit</a>
            <a class="act-buttons" href="#">Delete</a>
          </div>
        </div>
        <span class="d-block">from: @username</span>
        <span class="d-block">to: {{ Auth::user()->name }}</span>
        <span class="d-block">deadline: <strong>2020-01-01</strong></span>
      </div>
    </div>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Task Name</strong>
          <div>
            <a class="act-buttons" href="#">Done!</a>
            <a class="act-buttons" href="#">Edit</a>
            <a class="act-buttons" href="#">Delete</a>
          </div>
        </div>
        <span class="d-block">from: @username</span>
        <span class="d-block">to: {{ Auth::user()->name }}</span>
        <span class="d-block">deadline: <strong>2020-01-01</strong></span>
      </div>
    </div>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Task Name</strong>
          <div>
            <a class="act-buttons" href="#">Done!</a>
            <a class="act-buttons" href="#">Edit</a>
            <a class="act-buttons" href="#">Delete</a>
          </div>
        </div>
        <span class="d-block">from: @username</span>
        <span class="d-block">to: {{ Auth::user()->name }}</span>
        <span class="d-block">deadline: <strong>2020-01-01</strong></span>
      </div>
    </div>
    <small class="d-block text-right mt-3">
      <a href="#">Complete all tasks!</a>
    </small>
  </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="offcanvas.js"></script>
</body>
@endsection
