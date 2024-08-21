@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>tasks</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item">tasks</li>
            <li class="breadcrumb-item active">show</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if (@session('success'))

            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            <div class="card shadow-lg">
                <div class="card-body">



                    <h5 class="card-title text-center">{{$task->name}} </h5>
                    <hr>
                    <p><strong>Description : </strong> {{$task->description}} </p>
                    <hr>
                    <p><strong>Status : </strong> {{$task->status}} <a  class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Edit Status
                      </a>
                       </p>
                    <hr>
                    <p><strong>Deadline : </strong> {{$task->deadline}} </p>
                    <hr>
                    <p><strong>Created By : </strong> {{$task->createdBy->name}} </p>
                    <hr>
                    <p><strong>Assigned To : </strong> {{$task->assignedTo->name}} </p>
                    <hr>
                    <p><strong>Created At : </strong> {{$task->created_at}} </p>
                    <hr>
                    <p><strong>description : </strong> {{$task->description}} </p>
                    @if ($task->file)
                    <hr>
                    <p><strong>task file name : </strong> {{$task->file}} </p>
                    <hr>
                    <form action="{{route('tasks.download',$task->id)}}" method="POST">
                        @csrf
                    <button class="btn btn-success">Download task File</button>
                    </form>
                    @endif



                </div>
            </div>

        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit task Status</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('tasks.update-status',$task->id)}}" method="post">
            @csrf
            <div class="form-group">
                    <div class="col-md-12">
                        <label for="inputPassword5" class="form-label">Status</label>
                        <select name="status" class="form-control ronded-pill" >
                            <option value="pending">pending</option>
                            <option value="processing">processing</option>
                            <option value="completed">completed</option>
                            <option value="cancelled">cancelled</option>

                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button class="btn btn-primary mt-3" type="submit">Edit status</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection
