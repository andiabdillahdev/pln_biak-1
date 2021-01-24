<!doctype html>
<html lang="en">

<head>
	<title>Dashboard | PANEL UPT PLN</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist-custom.css') }}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/
	jquery.dataTables.min.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html">PLN BIAK</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('assets/img/user.png') }}" class="img-circle" alt="Avatar"> <span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target=".modal-account"><i class="lnr lnr-user"></i> <span>My Account</span></a></li>
								<li><a href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>	  
								</li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{ url('home') }}" class="home-das"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="{{ url('admin/laporan') }}" class="laporan"><i class="fa fa-file-text-o"></i> <span>Data Laporan</span></a></li>
						<li><a href="{{ url('admin/data-agent') }}" class="data-agent"><i class="fa fa-users"></i> <span>Data Agent</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		
		@yield('content')
		
		<!-- MODAL UPDATE ACCOUNT -->
		<div class="modal modal-account" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Update Akun Login</h4>
					</div>
					<form method="POST" action="{{ url('admin/updateakun') }}">
						@csrf
						<div class="modal-body" style="padding: 20px 50px 0 50px">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" required="" placeholder="Nama..." autocomplete="off" name="name" value="{{ Auth::user()->name }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Email Login</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" required="" placeholder="Email..." autocomplete="off" name="email" value="{{ Auth::user()->email }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password</label>
								<div class="col-sm-9">
									<input type="hidden" name="id" value="{{ Auth::user()->id }}">
									<input type="text" class="form-control" placeholder="Password..." autocomplete="off" name="password" value="" style="margin-bottom: 5px;">
									<span class="text-info">Info: Masukkan password baru untuk mengganti password</span>
								</div>
							</div>
						</div>
						<div class="modal-footer row">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-primary mr-2">Update</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">dasdas</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/chartist/js/chartist.min.js') }}"></script>
	<script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
	<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
	@yield('js')
	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable();
			$(document).tooltip({ selector: '[data-toggle1="tooltip"]' });
		});
	</script>
</body>

</html>
