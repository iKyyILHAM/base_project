<?php
$current_page = get_current_page();
?>
<div id="sidebar" class="active">
	<div class="sidebar-wrapper active">
		<div class="sidebar-header position-relative">
			<div class="justify-content-between align-items-center">
				<div class="logo text-center">
					<a href="#"><img src="<?= base_url('assets\images\logo/logo.svg') ?>" alt="Logo" srcset="" /></a>
				</div>

				<div class="sidebar-toggler x">
					<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
				</div>
			</div>
		</div>
		<div class="sidebar-menu">
			<ul class="menu">
				<li class="sidebar-title">Menu</li>

				<li class="sidebar-item <?= is_active('home', $current_page) ?>">
					<a href="<?= base_url('home') ?>" class="sidebar-link">
						<i class="bi bi-grid-fill"></i>
						<span>Dashboard</span>
					</a>
				</li>


				<?php if ($this->session->userdata('role') === '1') : ?>
					<li class="sidebar-item <?= is_active('user', $current_page) ?>">
						<a href="<?= base_url('user') ?>" class="sidebar-link">
							<i class="bi bi-person-fill"></i>
							<span>User</span>
						</a>
					</li>
				<?php endif; ?>


				<li class="sidebar-item <?= is_active('upload', $current_page) ?>">
					<a href="<?= base_url('upload') ?>" class="sidebar-link">
						<i class="bi bi-archive-fill"></i>
						<span>Berkas</span>
					</a>
				</li>

				<li class="sidebar-item <?= is_active('onplud', $current_page) ?>">
					<a href="<?= base_url('onplud') ?>" class="sidebar-link">
						<i class="bi bi-card-image"></i>
						<span>ImgBB Uploader</span>
					</a>
				</li>

				<li class="sidebar-title">Setting</li>

				<li class="sidebar-item">
					<a style="cursor: pointer;" class="sidebar-link" onclick="logout()">
						<i class="bi bi-power"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<script>
	function logout() {
		Swal.fire({
			title: 'Yakin mau keluar dari sistem?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Keluar!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = '<?= base_url('home/logout') ?>';
			}
		});
	}
</script>
