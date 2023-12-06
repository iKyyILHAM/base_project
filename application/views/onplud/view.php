<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Upload Gambar</h3>
				<p class="text-subtitle text-muted">Halaman Data Gambar</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?= base_url('home') ?>">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
						Upload Gambar
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<section class="section">
		<?php if ($this->session->flashdata('berhasil')) : ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<?= $this->session->flashdata('berhasil'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif; ?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Data Gambar</h4>
				<a class="btn btn-primary btn-sm float-end" href="<?= base_url('onplud/add') ?>">Tambah</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="table-berkas" class="table table-hover table-striped table-bordered" style="text-wrap: nowrap;">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th>Nama</th>
								<th>Berkas</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($upload)) : ?>
								<tr>
									<td colspan="4" class="text-center">Data Kosong</td>
								</tr>
								<?php else :
								$i = 1;
								foreach ($upload as $data) : ?>
									<tr>
										<td class="text-center"><?= $i++ ?></td>
										<td><?= $data['name'] ?></td>
										<td><?= $data['link'] ?></td>
										<td class="text-center">
											<a class="btn btn-primary btn-sm" href="<?= base_url('onplud/edit/') . $data['id'] ?>">Ubah</a>
											<a class="btn btn-danger btn-sm" href="<?= base_url('onplud/delete/') . $data['id'] ?>" onclick="hapus(event, '<?= $data['name'] ?>', <?= $data['id'] ?>)">Hapus</a>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	function hapus(event, name, id) {
		event.preventDefault();
		Swal.fire({
			title: 'Yakin mau hapus data ' + name + '?',
			text: "Aksi ini tidak dapat dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = event.target.getAttribute('href');
			}
		});
	}
</script>
