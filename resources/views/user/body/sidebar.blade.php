<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('backend/assets/images/hidayatulikhwan.png')}}" class="logo-icon" alt="logo icon">
		</div>

		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		<li>
			<a href="{{ route('user.dashboard') }}">
				<div class="parent-icon"><i class='bx bx-home-alt'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>


		<li class="menu-label">Calon Peserta Didik</li>

		<li>
			<a href="{{route("user.pendaftaran")}}">
				<div class="parent-icon"><i class='bx bx-receipt'></i>
				</div>
				<div class="menu-title">Formulir Pendaftaran</div>
			</a>
		</li>

		<li>
			<a href="{{route("user.hasil-seleksi")}}">
				<div class="parent-icon"><i class='bx bx-user-check'></i>
				</div>
				<div class="menu-title">Hasil Seleksi</div>
			</a>
		</li>
	</ul>





	<!--end navigation-->
</div>