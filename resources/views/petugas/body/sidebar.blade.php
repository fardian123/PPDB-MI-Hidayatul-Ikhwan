<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('backend/assets/images/hidayatulikhwan.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Petugas</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		<li>
			<a href="{{ route('petugas.dashboard') }}">
				<div class="parent-icon"><i class='bx bx-home-alt'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>


		<li class="menu-label">Calon Peserta Didik</li>
		
		<li>
			<a href="{{route('petugas.master_peserta_didik') }}">
				<div class="parent-icon"><i class='bx bx-detail'></i>
				</div>
				<div class="menu-title">Data Master Pendaftar</div>
			</a>
		</li>
		

		
	</ul>
	
	
	

	
	<!--end navigation-->
</div>