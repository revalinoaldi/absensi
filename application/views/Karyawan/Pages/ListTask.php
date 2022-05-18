<?php  
function setTime($val)
{
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
		<?php if (@$absenHarian['status']): ?>
			<?php foreach ($absenHarian['data'] as $data): ?>
				
				<div class="col-md-6 col-xs-12">
					<div class="card">
						<div class="card-header">
							<div class="row justify-content-center mb-3">
								<div class="col-5">
									<span>Report Absen Harian</span>
								</div>
								<div class="col-7 text-end">
									<?php if (!$data['jam_pulang'] && !$data['desc_kerja']): ?>
										<a href="<?= site_url('Karyawan/Task/editTaks/'.$data['id']) ?>" class="btn btn-primary btn-sm m-b-xs"><i data-feather="edit"></i> Edit</a>
									<?php endif ?>

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
							// $durasi = abs(strtotime($data['jam_pulang']) - strtotime($data['jam_datang']));
							?>
							<div class="row justify-content-center mb-3">
								<div class="col-6">
									Durasi
								</div>
								<div class="col-6 text-end">
									<?php 


									if (@$data['jam_pulang']) {
									// $datelast = date_create();
									// echo date('H:i:s', strtotime($durasi));
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
			<div class="col-xs-12">
				<h3>Belum pernah melakukan absen...</h3>
			</div>
		<?php endif ?>

	</div>
</div>
