@extends('admin_master')
@section('admin_content')

<div class="card card-default m-5" style='width:50%;'>
        <div class="card-header card-header-border-bottom">
            <h2>Create Staff</h2>
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
            <form class="form-pill" method="POST" action="/admin/create_staff">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput3">Username</label>
                    <input type="texr" class="form-control" value="{{old('name')}}" name="name" id="exampleFormControlInput3" placeholder="Enter Username here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Email address</label>
                    <input type="email" class="form-control" value="{{old('email')}}" name="email" id="exampleFormControlInput3" placeholder="Enter Email here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Contact Number</label>
                    <input type="text" class="form-control" value="{{old('contact')}}" name="contact" id="exampleFormControlInput3" placeholder="Enter Contact Number here">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleFormControlPassword3" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm-password" id="exampleFormControlPassword3" placeholder="ConfirmPassword">
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection