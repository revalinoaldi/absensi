<link href="<?= base_url('') ?>assets/plugins/DataTables/datatables.min.css" rel="stylesheet">   

<div class="main-wrapper">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Absensi List</h5>
					<table id="zero-conf" class="display" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Absen</th>
								<th style="text-align: center;">Total Absen</th>
								<th style="text-align: center;">#</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1; 
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
									<td><?= $i++ ?></td>
									<td><?= hari($val['tgl_absen']).', '. date('d F Y', strtotime($val['tgl_absen'])) ?></td>
									<td style="text-align: center;"><?= $val['total_absen'] ?> Absensi</td>
									<td style="text-align: center;">
										<a href="<?= site_url('Admin/Absen/detail/'.date('Y-m-d', strtotime($val['tgl_absen']))) ?>" title="Remove from Record">
											<i data-feather="chevron-right"></i>
										</a> 
									</td>
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