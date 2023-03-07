@extends('admin_master')
@section('admin_content')

<div class="card card-default m-5" style='width:50%;'>
        <div class="card-header card-header-border-bottom">
            <h2>Edit User</h2>
        </div>

        <div class="card-body">

              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach  
                    </ul>
                </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              <form class="form-pill" action="/admin/edit_user" method="POST">
                @csrf
                  <input type="text" name = "id" id="id"  value= '{{$user->id}}' hidden  >

                  <div class="form-group ">
                    <label for="exampleFormControlPassword3">Name</label> 
                    <input type="text" class="form-control input-lg" value='{{$user->name}}' name="name" >
                  </div>
                  
                  <div class="form-group ">
                  <label for="exampleFormControlInput3">Email address</label>
                    <input type="text" class="form-control input-lg" value= '{{$user->email}}' disabled  >
                  </div>
                  
                  <div class="form-group ">
                  <label for="exampleFormControlInput3">Contact Number</label>
                    <input type="password" class="form-control input-lg" name = "password" id="email" aria-describedby="emailHelp" placeholder="Enter New Password">
                  </div>

                  <div class="form-group ">
                  <label for="exampleFormControlPassword3">Password</label>
                    <input type="password" class="form-control input-lg" name = "confirm-password" id="password" placeholder="Confirm Password">
                  </div>

                  
                  <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Update</button>
                </div>

                    
                 
              </form>
              </div>
    </div>

@endsection