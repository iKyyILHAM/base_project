<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Ubah Data Berkas</h3>
				<p class="text-subtitle text-muted">Halaman Ubah Berkas.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?= base_url('upload') ?>">Berkas</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Ubah Data Berkas
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<section class="section">
		<?php if ($this->session->flashdata('gagal')) : ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?= $this->session->flashdata('gagal'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif; ?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Ubah Data Berkas</h4>
				<a class="btn btn-primary float-end" href="<?= base_url('upload') ?>">Kembali</a>
			</div>
			<div class="card-body">
				<form id="upload-imgbb-update" method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="hidden" name="id" value="<?= $upload['id'] ?>">
						<input type="text" name="name" id="name" class="form-control" value="<?= $upload['name'] ?>">
					</div>
					<div class="mb-3">
						<div class="">
							<label for="username" class="form-label">Hasil Berkas</label>
						</div>
						<img src="<?= $upload['link'] ?>" alt="">
					</div>
					<div class="mb-3">
						<label for="berkas" class="form-label">Berkas</label>
						<div name="berkas">
							<input type="file" name="image" class="imgbb-filepond">
							<input type="hidden" required data-parsley-required="true" name="link" id="link" class="input-disini form-control" value="<?= $upload['link'] ?>">
							<span class="text-danger" style="font-size: 10px;">*Pilih file jika ingin mengubah file</span>
						</div>
					</div>
					<div class="mb-3">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<script>
	$(document).ready(function() {
		$('#upload-imgbb-update').submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: '<?= base_url('onplud/update') ?>',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
			}).done(function(response) {
				response = JSON.parse(response)
				if (response.status === 'success') {
					Swal.fire({
						icon: "success",
						title: "Berhasil disimpan",
						text: "Berhasil menyimpan data",
						showConfirmButton: false,
						timer: 1500
					}).then(() => {
						window.location.href = '<?= base_url('onplud') ?>';
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Terjadi Kesalahan",
						text: response.message.replace(/<[^>]*>/g, ''),
						showConfirmButton: false,
						timer: 1500
					});
				}
			}).fail(function(error) {
				console.error('Error:', error);
			});
		});
	});
</script>
