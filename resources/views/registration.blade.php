@extends('master')
@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="app-brand">
                <a href="/index.html">
                    <img src="{{asset('assets/img/login-image.png')}}"  width="50" height="53" alt="">

                  <span class="brand-name">CMS</span>
                </a>
              </div>
            </div>

            <div class="card-body p-5">
              <h4 class="text-dark mb-5">Customer Registration</h4>
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
              <form action="/register" method='post'>
                @csrf
                <div class="row">
                    
                  <div class="form-group col-md-12 mb-4">
                      <input type="text" class="form-control input-lg" value="{{old('name')}}" name="name" id="name" aria-describedby="emailHelp" placeholder="Username">
                    </div>

                    <div class="form-group col-md-12 mb-4">
                      <input type="email" class="form-control input-lg" value="{{old('email')}}" name="email" id="email" aria-describedby="nameHelp" placeholder="Email">
                    </div>

                    <div class="form-group col-md-12 mb-4">
                      <input type="text" class="form-control input-lg" value="{{old('contact')}}" name="contact" id="contact" aria-describedby="nameHelp" placeholder="Contact Number">
                    </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password">
                  </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name="confirm-password" id="cpassword" placeholder="Confirm Password">
                  </div>

                  <div class="col-md-12">
                    

                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign Up</button>

                    <p>Already have an account?
                      <a class="text-blue" href="/login">Sign in</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection