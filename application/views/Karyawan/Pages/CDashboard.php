<?php function setTime($val){
	return ($val < 10 ? '0'.$val : $val);
} 
?>
<div class="main-wrapper">
	<?php  

	if (@$this->session->flashdata('notif')) {
		echo $this->session->flashdata('notif');
		$this->session->unset_userdata('notif');
	}
	?>
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="card">
				<div class="card-header">
					<div class="row justify-content-center">
						<div class="col-4">
							<span>Jam Kerja</span>
						</div>
						<div class="col-8 text-end">
							<?= $hari  ?>
						</div>
					</div>
				</div>
				<div class="card-body text-center">
					<blockquote class="blockquote mb-0">
						<h5>Waktu Sekarang</h5>
						<h5 id="jam"></h5>
						<?php if ($checkHarian['status'] == true && !$absenHariIni['status']): ?>
							<a href="<?= site_url('Karyawan/Dashboard/absen_masuk/'.$data['data']['id']) ?>" class="btn btn-primary">
								<i class="fas fa-play"></i> Absen Masuk
							</a>
							<?php else: ?>
								<?php foreach ($absenHariIni['data'] as $data): ?>
									<?php if (!$data['jam_pulang'] && !$data['desc_kerja']): ?>
										<form method="post" action="<?= site_url('Karyawan/Task/prosesEditTask') ?>">
											<div class="row mb-3">
												<div class="col-sm-12">
													<input type="text" name="tgl" class="form-control" id="tglTaks" readonly="" value="<?= date('d-m-Y', strtotime($data['tgl_absen'])) ?>" hidden>

													<input type="text" name="employee" class="form-control" id="employee" readonly="" value="<?= $data['id_karyawan'] ?>" hidden>

													<input type="text" name="id" class="form-control" id="id" readonly="" value="<?= $data['id'] ?>" hidden>
												</div>
											</div>
											<div class="row mb-3">
												<label for="desc" class="form-label">Deskripsi Pekerjaan</label>
												<div class="col-sm-12">
													<textarea class="form-control" name="desc" id="desc"><?= $data['desc_kerja'] ?></textarea>
												</div>
											</div>
											<div class="row justify-content-end">
												<div class="col text-center">
													<input type="submit" class="btn btn-primary" name="save" value="Absen Pulang">
												</div>
											</div>
											<small class="mt-3"><i> <i class="fas fa-info-circle"></i> Note : Harap isi dekripsi pekerjaan untuk melakukan Absen Pulang</i></small>
										</form>
										<?php else: ?>
											<h6 class="text-danger">Sudah Melakukan Absen</h6>
										<?php endif ?>
									<?php endforeach ?>
								<?php endif ?>

							</blockquote>
						</div>
					</div>
				</div>
				<?php if (@$absenHariIni['data']): ?>
					<?php foreach ($absenHariIni['data'] as $data): ?>
						<div class="col-md-6 col-xs-12">
							<div class="card">
								<div class="card-header">
									<div class="row justify-content-center">
										<div class="col-12">
											<span>Report Absen Harian</span>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Tanggal Absen
										</div>
										<div class="col-6 text-end">
											<strong><?= date('d F Y', strtotime($data['tgl_absen'])) ?></strong>
										</div>
									</div>
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Absen Masuk
										</div>
										<div class="col-6 text-end">
											<?php  
											$datelast = date_create(date('H:i:s', strtotime($data['jam_datang'])));
											echo date_format($datelast, 'H:i:s');
											?> WIB
										</div>
									</div>
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Absen Pulang
										</div>
										<div class="col-6 text-end">
											<?php 
											if (@$data['jam_pulang']) {
												$datelast = date_create(date('H:i:s', strtotime($data['jam_pulang'])));
												echo date_format($datelast, 'H:i:s');
											} else{
												echo "-";
											}
											?> WIB
										</div>
									</div>
									<?php  
									$datefrom = date_create($data['jam_pulang']);
									$dateto = date_create($data['jam_datang']);
									$durasi = date_diff($datefrom, $dateto);
									?>
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Durasi
										</div>
										<div class="col-6 text-end">
											<?php 


											if (@$data['jam_pulang']) {
												echo setTime($durasi->h) . ':';
												echo setTime($durasi->i) . ':';
												echo setTime($durasi->s);
											} else{
												echo "-";
											}
											?>
										</div>
									</div>
									<div class="row justify-content-center mb-3 ">
										<div class="col-6">
											Deskripsi Pekerjaan
										</div>
										<div class="col-6 text-end" style="text-align: justify;">
											<p><?= @$data['desc_kerja'] ? $data['desc_kerja'] : '-'; ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					<?php else: ?>
						<div class="col-md-6 col-xs-12">
							<div class="card">
								<div class="card-header">
									<div class="row justify-content-center">
										<div class="col-12">
											<span>Report Absen Harian</span>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Tanggal Absen
										</div>
										<div class="col-6 text-end">
											<strong>-</strong>
										</div>
									</div>
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Absen Masuk
										</div>
										<div class="col-6 text-end">
											- WIB
										</div>
									</div>
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Absen Pulang
										</div>
										<div class="col-6 text-end">
											- WIB
										</div>
									</div>
									
									<div class="row justify-content-center mb-3">
										<div class="col-6">
											Durasi
										</div>
										<div class="col-6 text-end">
											- WIB
										</div>
									</div>
									<div class="row justify-content-center mb-3 ">
										<div class="col-6">
											Deskripsi Pekerjaan
										</div>
										<div class="col-6 text-end" style="text-align: justify;">
											<p>-</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif ?>

				</div>
			</div>

			<script type="text/javascript">
				window.onload = function() { 
					setInterval(() => {
						var e = document.getElementById('jam'),
						d = new Date(), h, m, s;
						h = set(d.getHours());
						m = set(d.getMinutes());
						s = set(d.getSeconds());

						e.innerHTML = h +':'+ m +':'+ s + ' WIB';
					}, 1000)
				}

				function set(e) {
					e = e < 10 ? '0'+ e : e;
					return e;
				}
			</script>

			<script src="<?= base_url() ?>assets/js/pages/dashboard.js"></script>
