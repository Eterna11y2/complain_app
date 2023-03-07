@extends('master')
@section('content')

<div class="container d-flex align-items-center justify-content-center  ">
<div class="card-body p-5">
<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Complain Form</h2>
			</div>
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
			<div class="card-body">
				<form class="form-pill" method="POST" action='/create_complain' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Main Category</label>
						        <select class="form-control" id="maincategory" name="maincategory">
                                    <option style = "display: none;" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect4">Select Subcategory</label>
                                    <select class="form-control" id="subcategory-select" name="subcategory-select">
                                        <option style = "display: none;" disabled selected>Select Subcategory</option>
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">State</label>
						        <select class="form-control" name="state-select" id="state-select">
                                    <option style = "display: none;" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
						<label for="exampleFormControlInput3">Complain Details</label>
						<textarea class="form-control rounded" value="{{old('complainTextarea')}}" name="complainTextarea" id="complainTextarea" rows="5"></textarea>
					</div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload File OR Image <small>(If any)</small></label>
                        <input type="file" class="form-control-file" name="images[]" id="file" multiple>
                    </div>
                    <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Submit</button>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        
        $('#maincategory').on('change', function() {
            var categoryID = $(this).val();
            $.ajax({
            url: '/admin/get_subcat_ajax/'+categoryID,
            type: 'GET',
            success: function(data) {
                $('#subcategory-select').empty();
                $('#subcategory-select').append('<option style = "display: none;" value="" selected disabled>Select Subcategory</option>');
                data.forEach(function(subcategory) {
                    $('#subcategory-select').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            },
            error: function() {
                alert('Unable to fetch OR there\'s not sub category of this category');
            }
        });
        
        });

    })
</script>
@endsection