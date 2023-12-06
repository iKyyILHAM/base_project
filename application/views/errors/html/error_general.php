<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="container pt-5 text-center">
	<div class="row">
		<div class="col-md-12">
			<p style="font-size: 200px;" class="fw-bold"><?php echo $heading; ?></p>
			<h1 class="text-center pt-2 fw-bold">Oops! Tujuan sedang tidak beres.</h1>
			<div class="card">
				<div class="card-body border rounded">
				<div id="container" style="display: none">
						<?php echo $message; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p>Created with Coffe by <a href="https://ikyyilham.github.io/">IkyyDEV</a></p>
</div>
