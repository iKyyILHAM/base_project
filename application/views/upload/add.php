<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Tambah Data Berkas</h3>
				<p class="text-subtitle text-muted">Halaman Tambah Data Berkas.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.html">Berkas</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Tambah Data Berkas
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<section class="section">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Tambah Berkas</h4>
				<a class="btn btn-primary float-end" href="<?= base_url('upload') ?>">Kembali</a>
			</div>
			<div class="card-body">
				<form id="uploadForm" data-parsley-validate method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" data-parsley-required="true" name="name" id="name" class="form-control">
					</div>
					<div class="mb-3">
						<label for="berkas" class="form-label">Berkas</label>
						<div name="berkas">
							<input type="file" class="form-control" name='berkas_input' id='berkas_input'>
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
		
		$('#uploadForm').submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: '<?= base_url('upload/create') ?>',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					response = JSON.parse(response)
					if (response.status === 'success') {
						Swal.fire({
							position: "top-end",
							icon: "success",
							title: "Berhasil disimpan",
							showConfirmButton: false,
							timer: 1500
						}).then(() => {
							window.location.href = '<?= base_url('upload') ?>';
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
				},
				error: function(error) {
					console.error('Error:', error);
				}
			});
		});

	});
</script>
