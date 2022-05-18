<link href="<?= base_url('') ?>assets/plugins/DataTables/datatables.min.css" rel="stylesheet">   
<div class="main-wrapper">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Absensi List - <?= $list ?></h5>
					<table id="zero-conf" class="display" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Jam Datang</th>
								<th>Jam Pulang</th>
								<th>Durasi</th>
								<th>Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1; 
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
							foreach ($absen['data'] as $val): ?>
								
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $val['id_karyawan'] ?></td>
									<td><?= $val['nama_karyawan'] ?></td>
									<td><?= $val['jam_datang'] ?></td>
									<td><?= $val['jam_pulang'] ?></td>
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

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.js"></script>