@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>tasks</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item">tasks</li>
            <li class="breadcrumb-item active">Edit</li>
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



                    <h5 class="card-title text-center">Edit task</h5>

                    <!-- Create New task -->
                    <form action="{{route('tasks.update',$task->id)}}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="" class="form-label"> Name</label>
                            <input type="text" class="form-control rounded-pill" value="{{$task->name}}" name="name" id="inputName5">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail5" class="form-label">description</label>
                            <input type="text" class="form-control rounded-pill" value="{{$task->description}}" name="description" id="inputEmail5">
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">file</label>
                            <input type="file" class="form-control rounded-pill" name="file" id="inputPassword5">
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                            </div>
                        <div class="col-md-12">
                            <label for="inputAddress5" class="form-label">Deadline</label>
                            <input type="date" class="form-control rounded-pill" value="{{$task->deadline}}" name="deadline" id="inputAddress5" >
                            @error('deadline')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">assign to</label>
                            <select name="assigned_to" class="form-control ronded-pill" >
                                <option selected value="{{$task->assignedTo->id}}">{{$task->assignedTo->name}}</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach

                            </select>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">project</label>
                                <select name="project" class="form-control ronded-pill" >
                                    <option selected value="{{$task->project->id}}">{{$task->project->name}}</option>
                                    @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach

                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>


                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Submit</button>
                            <button type="reset" class="btn btn-secondary rounded-pill px-4">Reset</button>
                        </div>
                    </form><!-- End create task Form -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
