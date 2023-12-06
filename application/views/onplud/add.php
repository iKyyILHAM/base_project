<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Upload Gambar</h3>
				<p class="text-subtitle text-muted">Halaman Upload Gambar.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.html">Berkas</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Tambah Gambar
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<section class="section">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Tambah ImgBB</h4>
				<a class="btn btn-primary float-end" href="<?= base_url('upload') ?>">Kembali</a>
			</div>
			<div class="card-body">
				<form id="upload-imgbb" data-parsley-validate method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" required data-parsley-required="true" name="name" id="name" class="form-control">
					</div>
					<div class="mb-3">
						<label for="berkas" class="form-label">Berkas</label>
						<div name="berkas">
							<input type="file" name="image" class="imgbb-filepond">
							<input type="hidden" required data-parsley-required="true" name="link" id="link" class="input-disini form-control" placeholder="Waiting to upload">
						</div>
					</div>
					<div class="mb-3">
						<button class="btn btn-primary button-simpan" style="display: none;" type="submit">Simpan</button>
						<button class="btn btn-primary button-disable" style="display: block;" type="button" disabled>Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<script>
	$(document).ready(function() {
		$('#upload-imgbb').submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: '<?= base_url('onplud/create') ?>',
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
