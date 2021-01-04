@extends('layouts.master')

@section('title') Edit @endsection


@section('content')
	
	<div class="main">
		<div class="main-content">
			<div class="container-flui">
				<h3 class="page-title">Edit Tables</h3>
				<div class="row">
					<div class="col-md-12">
						<form action='/sampah/{{$trash->id}}/edit' method='post' enctype="multipart/form-data">
      		@csrf
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Jenis Sampah</label>
		    <input name="jenis_sampah" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Jenis Sampah" value="{{ $trash->jenis_sampah }}">
		  </div>

		    <div class="form-group">
		    <label for="exampleFormControlInput1">Harga</label>
		    <input name="harga" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Harga" value="{{ $trash->harga }}">
		  </div>

	      <div class="modal-footer">
	      <a href="/dashboard"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
	      <button type="submit" class="btn btn-warning">Update</button>
      	  </div>
       	</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection




