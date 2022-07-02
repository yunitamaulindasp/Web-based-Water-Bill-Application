<?php
	$saluran = $_POST['saluran'];
?>
<div class="slider-area">
	<div class="single-slider slider-height d-flex align-items-center ">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-8 col-lg-9">
					<section class="pricing-card-area">
						<div class="container">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-6 col-sm-10">
									<div class="single-card text-center mb-30">
										<div class="card-top">
											<h3>Masukkan Kode Dibawah Ini!</h3>
										</div>
										<div class="card-mid">
											<form action="cek-captcha.php" method="POST">
												<input type="hidden" name="saluran" id="saluran" value="<?php echo $saluran; ?>">
												<br><img src="captcha.php" /></br>
												<p>Enter Image Text</p>
												<input name="captcha" type="text">
												<input name="submit" type="submit" value="Submit">
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
