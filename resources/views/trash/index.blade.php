@extends('layouts.master')

@section('title') Jenis Sampah @endsection

@section('content')

	<div class="main">
		<div class="main-content">
			<div class="container-flui">
				<h3 class="page-title">Info Tables</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Sampah</h3>
									<div class="right" style="background-color: deepskyblue;">
											<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Tambah Sampah</button>
										</div>
									</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>JENIS SAMPAH</th>
												<th>HARGA</th>
												<th>CREATED</th>
												<th>UPDATED</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											@foreach($sampah as $trash)

											<tr>
												<td>{{ $trash->jenis_sampah }}</td>
												<td><a href="/user/{{$trash->id}}/profile">{{ $trash->harga }}</a></td>
												<td>{{ $trash->created_at }}</td>
												<td>{{ $trash->updated_at }}</td>
												<td>
													<a href="/sampah/{{$trash->id}}/update" class="text-warning" style="margin-right: 5px;"><i class="lnr lnr-pencil"></i>Edit</a>
													<a href="/sampah/{{$trash->id}}/delete" class="text-danger ml-4" onclick='return confirm("Data akan di hapus Lanjutkan ?")'><i class="lnr lnr-trash"></i>Delete</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sampah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <form action='sampah/create' method='post' enctype="multipart/form-data">
      	@csrf


		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Jenis</label>
		    <select name="jenis_sampah" class="form-control" id="exampleFormControlSelect1" value="{{old('jenis_sampah')}}">
		      <option value="plastik">Plastik</option>
		      <option value="alumunium">Alumunium</option>
		      <option value="besi">Besi</option>
		      <option value="kertas">Kertas</option>
		    </select>
		  </div>


		   <div class="form-group {{$errors->has('harga') ? 'has-error' : ''}}">
		    <label for="exampleFormControlInput1">Harga</label>
		    <input name="harga" type="number" class="form-control" id="exampleFormControlInput1" placeholder="harga">
		  	@if($errors->has('harga'))
		    	<span class="help-lock">{{$errors->first('harga')}}</span>
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
