@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>Projects</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
            <li class="breadcrumb-item">Projects</li>
            <li class="breadcrumb-item active">Index</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    @if (@session('success'))

            <div class="alert alert-success m-auto col-md-6">
                {{session('success')}}
            </div>
            @endif
    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow-lg">
                <div class="card-body">
                    <a class="btn btn-primary float-end mt-3" href="{{route('projects.create')}}">create new project</a>

                    <h5 class="card-title text-center">All Projects</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Created BY</th>
                                    <th>Deadline</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                <tr>
                                    <td>{{$project->name}}</td>
                                    <td>{{$project->status}}</td>
                                    <td>{{$project->created_at}}</td>
                                    <td>{{$project->user->name}}</td>
                                    <td>{{$project->deadline}}</td>
                                    <td><div class="dropdown">
                                        <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="bi bi-three-dots"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item text-center" href="{{route('projects.show',$project->id)}}"><i class="fa-solid fa-eye text-info"></i></a></li>
                                          <li><a class="dropdown-item text-center" href="{{route('projects.edit',$project->id)}}"><i class="fa-solid fa-pen-to-square text-warning"></i></a></li>
                                          <li><form action="{{route('projects.destroy',$project->id)}}" method="POST">@csrf
                                            <button class="dropdown-item text-center" ><i class="fa-solid fa-trash text-danger"></i></button></li>
                                        </form>
                                        </ul>
                                      </div></td>
                                </tr>
                                @empty
                                No Projects Found;
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
