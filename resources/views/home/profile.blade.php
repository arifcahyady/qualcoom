@extends('layouts.master')

@section('title') Profile @endsection

@section('content')

<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="/images/{{$user->image}}" class="img-circle" style="height: 200px; width: 200px;" alt="Avatar">
										<h3 class="name">{{$user->name}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">	
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Email <span>{{$user->email}}</span></li>
											<li>Phone<span>{{$user->nomor_telepon}}</span></li>
											<li>Alamat <span>{{$user->alamat}}</span></li>
										</ul>
									</div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">User Info</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Profile</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>NAMA</th>
												<th>EMAIL</th>
												<th>ROLE</th>
												<th>PHONE</th>
												<th>ALAMAT</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{$user->name}}</td>
												<td>{{$user->email}}</td>
												<td>{{$user->role}}</td>
												<td>{{$user->nomor_telepon}}</td>
												<td>{{$user->alamat}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>	
								</div>
									
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
@endsection