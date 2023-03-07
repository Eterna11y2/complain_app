<?php
use Illuminate\Http\Request;
?>
@extends(str_contains(url()->current(), 'admin') ? 'admin_master' : 'master');
@section(str_contains(url()->current(), 'admin') ? 'admin_content' : 'content');

<div class="content-wrapper">
            <div class="content">
<div class="row">
	<div class="col-lg-6">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Update Profile</h2>
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
				<form action="/update-profile" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput3">Username</label>
                    <input type="texr" class="form-control" value="{{$user->name}}" name="user-name" id="exampleFormControlInput3" placeholder="Update Username here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Contact Number</label>
                    <input type="text" class="form-control" value="{{$user->contact}}" name="user-contact" id="exampleFormControlInput3" placeholder="Update Contact Number here">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Password</label>
                    <input type="password" class="form-control" name="user-password" id="exampleFormControlPassword3" placeholder="Update Password">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Address</label>
                    <input type="text" class="form-control" value="{{$user->address}}" name="user-address" id="exampleFormControlPassword3" placeholder="UpdateAddress">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Upload Profile Image</label>
                    <input type="file" class="form-control" name="Image" id="exampleFormControlPassword3" >
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Update</button>
                </div>
				</form>
			</div>
		</div>

    </div>
</div>

</div>
</div>

@endsection