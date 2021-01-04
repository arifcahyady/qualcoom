@extends('layouts.master')

@section('title') Edit @endsection


@section('content')
	
	<div class="main">
		<div class="main-content">
			<div class="container-flui">
				<h3 class="page-title">Edit Tables</h3>
				<div class="row">
					<div class="col-md-12">
						<form action='/pengurus/{{$user->id}}/edit' method='post' enctype="multipart/form-data">
      		@csrf
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Nama Lengkap</label>
		    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Lengkap" value="{{ $user->name }}">
		  </div>

		    <div class="form-group">
		    <label for="exampleFormControlInput1">Phone</label>
		    <input name="nomor_telepon" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Phone Number" value="{{ $user->nomor_telepon }}">
		  </div>

		   <div class="form-group">
		    <label for="exampleFormControlSelect1">Role</label>
		    <select name="role" class="form-control" id="exampleFormControlSelect1">
		      <option value="nasabah" @if($user->role == 'nasabah') selected @endif>Nasabah</option>
		      <option value="bendahara" @if($user->role == 'bendahara') selected @endif>Bendahara</option>
		      <option value="pengurus1" @if($user->role == 'pengurus1') selected @endif>Pengurus 1</option>
		      <option value="pengurus2" @if($user->role == 'pengurus2') selected @endif>Pengurus 2</option>
		       <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
		    </select>
		  </div>


		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Alamat</label>
		    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $user->alamat }}</textarea>
		  </div>

		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Avatar</label>
		    <input type="file" name="image" class="form-control">
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




