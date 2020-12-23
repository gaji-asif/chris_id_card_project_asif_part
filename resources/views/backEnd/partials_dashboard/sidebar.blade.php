<nav class="pcoded-navbar">
		<div class="sidebar_toggle"><a href=""><i class="icon-close icons"></i></a></div>
		<div class="pcoded-inner-navbar main-menu">
			<div class="">
				
				<div class="main-menu-content">
					<ul>
						<li class="more-details">
							<a href=""><i class="ti-user"></i>View Profile</a>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class="ti-layout-sidebar-left"></i>{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
					</ul>
				</div>
			</div>

			<div class="pcoded-navigation-label">Navigation</div>
			<ul class="pcoded-item pcoded-left-item">
				<li class="pcoded-hasmenu dashboard active pcoded-trigger">
					<a href="{{url('/test')}}" class="waves-effect waves-dark">
						<span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
						<span class="pcoded-mtext">Dashboard</span>
						<span class="pcoded-mcaret"></span>
					</a>

				</li>

				

		</ul>
	</div>
</nav>