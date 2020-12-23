<style type="text/css">
	.pcoded-header{
		background-color: #FFFFFF !important;
		box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0;
	}
	.waves-light{
		color: #000000;
	}
</style>
<nav class="navbar header-navbar pcoded-header">
	<div class="navbar-wrapper">
		<div class="navbar-logo">
			
			<div class="mobile-search waves-effect waves-light">
				<div class="header-search">
					<div class="main-search morphsearch-search">
						<div class="input-group">
							<span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
							<input type="text" class="form-control" placeholder="Enter Keyword">
							<span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
						</div>
					</div>
				</div>
			</div>
			<!--  <a href="#" style="margin: 0 auto; font-size: 25px; font-weight: bold;">
				ADON
			</a>  -->
			<!--  <a href="http://gp.today" style="margin: 0 auto; font-size: 25px; font-weight: bold; letter-spacing: 2px">
				MEDICSPOT
			</a>  -->
			<a href="http://gp.today">
				<img src="{{asset('public/images/logo-ms.svg')}}">
			</a> 
			<a class="mobile-options waves-effect waves-light">
				<i class="ti-more"></i>
			</a>
		</div>
		<div class="navbar-container container-fluid">
			
			<ul class="nav-right">
				<li class="user-profile header-notification">
					<a class="waves-effect waves-light">
						<img src="{{asset('public/assets/images/user_icon.png')}}" class="img-radius" alt="User-Profile-Image">
						<span style="color: #000000;">{{ Auth::user()->name }}</span>
						<i style="color: #000000;" class="ti-angle-down"></i>
					</a>
					<ul class="show-notification profile-notification">
						<li class="waves-effect waves-light">
							<a href="{{route('allDeletedPrescribes')}}">
								<i class="ti-user"></i> All Deleted Prescribes
							</a>
						</li>

						<li class="waves-effect waves-light">
							<a class="dropdown-item" href="{{ route('logout') }}"" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
						
					</ul> 
				</li>
			</ul>
		</div>
	</div>
</nav>