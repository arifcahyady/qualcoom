@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

	<div class="main">
		<div class="main-content">
			<div class="container-flui">
				<h3 class="page-title">Info Tables</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Users</h3>
									<div class="right" style="background-color: deepskyblue;">
											<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Tambah Pengurus</button>
										</div>
									</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>NAMA</th>
												<th>EMAIL</th>
												<th>ROLE</th>
												<th>ALAMAT</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data as $user)

											<tr>
												<td><a href="/user/{{$user->id}}/profile">{{ $user->name }}</a></td>
												<td><a href="/user/{{$user->id}}/profile">{{ $user->email }}</a></td>
												<td>{{ $user->role }}</td>
												<td>{{ $user->alamat }}</td>
												<td>
													<a href="/pengurus/{{$user->id}}/update" class="text-warning" style="margin-right: 5px;"><i class="lnr lnr-pencil"></i>Edit</a>
													<a href="/pengurus/{{$user->id}}/delete" class="text-danger ml-4" onclick='return confirm("Data akan di hapus Lanjutkan ?")'><i class="lnr lnr-trash"></i>Delete</a>
												</td>
											</tr>

											@endforeach
										</tbody>
									</table>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <form action='/pengurus/create' method='post' enctype="multipart/form-data">
      	@csrf
		  <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
		    <label for="exampleFormControlInput1">Nama Lengkap</label>
		    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Lengkap" value="{{old('name')}}">
		    @if($errors->has('name'))
		    	<span class="help-lock">{{$errors->first('name')}}</span>
		    @endif
		  </div>

		   <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
		    <label for="exampleFormControlInput1">Email</label>
		    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
		  	@if($errors->has('email'))
		    	<span class="help-lock">{{$errors->first('email')}}</span>
		    @endif
		  </div>

		 <div class="form-group">
		    <label for="exampleFormControlInput1">Password</label>
		    <input name="password" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Password">
		    
		  </div>

		  
		   <div class="form-group">
		    <label for="exampleFormControlInput1">Nomor Telephone</label>
		    <input name="nomor_telepon" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nomor Telephone" value="{{old('nomor_telepon')}}">
		  </div>

		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Role</label>
		    <select name="role" class="form-control" id="exampleFormControlSelect1" value="{{old('role')}}">
		      <option value="bendahara">Bendahara</option>
		      <option value="pengurus1">Pengurus 1</option>
		      <option value="pengurus2">Pengurus 2</option>
		    </select>
		  </div>


		  <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
		    <label for="exampleFormControlTextarea1">Alamat</label>
		    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('alamat')}}</textarea>
		    @if($errors->has('alamat'))
		    	<span class="help-lock">{{$errors->first('alamat')}}</span>
		    @endif
		  </div>

		   <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
		    <label for="exampleFormControlTextarea1">Avatar</label>
		    <input type="file" name="image" class="form-control">
		    @if($errors->has('image'))
		    	<span class="help-lock">{{$errors->first('image')}}</span>
		    @endif
		  </div>

	      <div class="modal-footer">
	      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary">Tambah</button>
      	  </div>
       </form>

    </div>
  </div>
</div>

@endsection
<!-- 
@section('content')

	@if(session('sukses'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>Good!</strong> {{ session('sukses') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@endif
	<div class="row mb-5">
		<div class="col-6">
			<h1>Data Siswa</h1>
		</div>
		<div class="col-6 float-right">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				Tambah Pengurus 1
			</button>
		</div>
	</div>
	<table class="table table-hover">
	<tr>
		<th>NAMA LENGKAP</th>
		<th>EMAIL</th>
		<th>PASSWORD</th>
		<th>NOMOR TELEPHONE</th>
		<th>ALAMAT</th>
		<th>IMAGE</th>
		<th>AKSI</th>
	</tr>

	@foreach($data as $siswa)

	<tr>
		<td>{{ $siswa->nama_depan }}</td>
		<td>{{ $siswa->nama_belakang }}</td>
		<td>{{ $siswa->jenis_kelamin }}</td>
		<td>{{ $siswa->agama }}</td>
		<td>{{ $siswa->alamat }}</td>
		<td>
			<a href="/siswa/{{$siswa->id}}/edit" class="text-warning">Edit</a>
			<a href="/siswa/{{$siswa->id}}/delete" class="text-danger ml-4" onclick='return confirm("Data akan di hapus Lanjutkan ?")'>Delete</a>
		</td>
	</tr>

	@endforeach
	</table>

@endsection -->