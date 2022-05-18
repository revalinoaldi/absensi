<link href="<?= base_url('') ?>assets/plugins/DataTables/datatables.min.css" rel="stylesheet">   
<div class="main-wrapper">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-7">
							<h5 class="card-title">Report Absensi</h5>
						</div>
						<div class="col-5 text-end">
							<a href="<?= site_url('Admin/Absen/download_excel/') ?>" class="btn btn-primary">Download Excel</a>
						</div>
					</div>
					<table id="zero-conf" class="display" style="width:100%">
						<thead>
							<tr>
								<th>Tanggal Absen</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Jam Absen</th>
								<th>Durasi</th>
								<th>Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
							function setTime($val){
								return ($val < 10 ? '0'.$val : $val);
							}
							function hari($date){
								$date = date('N', strtotime($date));
								switch ($date) {
									case '1':
									return 'Senin';
									break;
									case '2':
									return 'Selasa';
									break;
									case '3':
									return 'Rabu';
									break;
									case '4':
									return 'Kamis';
									break;
									case '5':
									return 'Jumat';
									break;
									case '6':
									return 'Sabtu';
									break;
									default:
									return 'Minggu';
									break;
								}
							}
							if (@$absen['data']) {
							foreach ($absen['data'] as $val): ?>
								
								<tr>
									<td><?= date('d F Y', strtotime($val['tgl_absen'])) ?></td>
									<td><?= $val['id_karyawan'] ?></td>
									<td><?= $val['nama_karyawan'] ?></td>
									<td><?= $val['jam_datang'] ?> - <?= $val['jam_pulang'] ?></td>
									<?php  
									$datefrom = date_create($val['jam_pulang']);
									$dateto = date_create($val['jam_datang']);
									$durasi = date_diff($datefrom, $dateto);
									?>
									<td>
										<?php 
										if (@$val['jam_pulang']) {
											echo setTime($durasi->h) . ':';
											echo setTime($durasi->i) . ':';
											echo setTime($durasi->s);
										} else{
											echo "-";
										}
										?>
									</td>
									<td><?= $val['desc_kerja'] ?></td>
								</tr> 
							<?php endforeach ?>
					        <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.js"></script>