<!DOCTYPE html>
<html lang="en">
<head>
	@include('backEnd.partials_dashboard.header')
	<style type="text/css">
		
		.modal-header{
			background-color: #448aff;
			color: #FFFFFF;
		}
		
	</style>
</head>
<body>

	<div class="theme-loader">
		<div class="loader-track">
			<div class="preloader-wrapper">
				<div class="spinner-layer spinner-blue">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-yellow">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-green">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">
			@include('backEnd.partials_dashboard.header_top')

			<div class="showChat_inner">
				<div class="media chat-inner-header">
					<a class="back_chatBox">
						<i class="fa fa-chevron-left"></i> Josephin Doe
					</a>
				</div>
				<div class="media chat-messages">
					<a class="media-left photo-table" href="#!">
						<img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
					</a>
					<div class="media-body chat-menu-content">
						<div class="">
							<p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
							<p class="chat-time">8:20 a.m.</p>
						</div>
					</div>
				</div>
				<div class="media chat-messages">
					<div class="media-body chat-menu-reply">
						<div class="">
							<p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
							<p class="chat-time">8:20 a.m.</p>
						</div>
					</div>
					<div class="media-right photo-table">
						<a href="#!">
							<img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
						</a>
					</div>
				</div>
				<div class="chat-reply-box">
					<div class="right-icon-control">
						<form class="form-material">
							<div class="form-group form-primary">
								<input type="text" name="footer-email" class="form-control" required="">
								<span class="form-bar"></span>
								<label class="float-label"><i class="fa fa-search m-r-10"></i>Share Your Thoughts</label>
							</div>
						</form>
						<div class="form-icon ">
							<button class="btn btn-success btn-icon  waves-effect waves-light">
								<i class="fa fa-paper-plane "></i>
							</button>
						</div>
					</div>
				</div>
			</div>

			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">
					<!-- @include('backEnd.partials_dashboard.sidebar') -->
					<div class="pcoded-content">
						<!-- <div class="page-header">
							<div class="page-block">
								<div class="row align-items-center">
									<div class="col-md-8">
										<div class="page-header-title">
											<h5 class="m-b-10">Dashboard</h5>
											<p class="m-b-0">Welcome to Our System</p>
										</div>
									</div>
									<div class="col-md-4">
										<ul class="breadcrumb">
											<li class="breadcrumb-item">
												<a href="index-2.html"> <i class="fa fa-home"></i> </a>
											</li>
											<li class="breadcrumb-item"><a href="">Dashboard</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div> -->

						<div class="pcoded-inner-content">

							<div class="main-body">
								<div class="page-wrapper">
									<div class="page-body">
										@yield('mainContentDashboard')
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <div class="has-modal modal fade" id="showDetaildModal">
      <div class="modal-dialog modal-dialog-centered" id="modalSize">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="showDetaildModalTile">New Client Information</h4>
				<button type="button" class="close icons" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" id="showDetaildModalBody">

			</div>

			<!-- Modal footer -->

		</div>
	</div>
</div>
@include('backEnd.partials_dashboard.footer')
</body>
</html>
