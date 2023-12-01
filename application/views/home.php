<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Dashboard</h3>
				<p class="text-subtitle text-muted">Halaman Dashboard.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active" aria-current="page">
							Dashboard
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<?php if ($this->session->flashdata('berhasil')) : ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?= $this->session->flashdata('berhasil'); ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
	<section class="row">
		<div class="col-12 col-lg-12">
			<div class="row">
				<div class="col-12">
					<div class="card">
					<div class="card-body px-4 py-4-5">
							<div class="d-flex align-items-center">
								<div class="avatar avatar-xl">
									<img src="<?= base_url('assets\images\faces/1.jpg') ?>" alt="Face 1">
								</div>
								<div class="ms-3 name">
									<h5 class="font-bold"><?= $this->session->userdata('name') ?></h5>
									<h6 class="text-muted mb-0">@<?= $this->session->userdata('username') ?></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
