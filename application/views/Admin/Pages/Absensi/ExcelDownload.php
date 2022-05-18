<?php  
	$filename = 'Report Absensi '.date('d-m-Y His').'.xls';
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
?>

<table id="zero-conf" class="display" border="1" cellspacing="0" cellpadding="8" style="width:100%">
	<thead>
		<tr>
			<th>Tanggal Absen</th>
			<th>NIP</th>
			<th>Full Name</th>
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
		foreach ($absen['data'] as $val): ?>

			<tr>
				<td style="text-align: right;"><?= hari($val['tgl_absen']) ?>, <?= date('d F Y', strtotime($val['tgl_absen'])) ?></td>
				<td>'<?= $val['id_karyawan'] ?></td>
				<td><?= $val['nama_karyawan'] ?></td>
				<td style="text-align: center;"><?= $val['jam_datang'] ?> - <?= $val['jam_pulang'] ?></td>
				<?php  
				$datefrom = date_create($val['jam_pulang']);
				$dateto = date_create($val['jam_datang']);
				$durasi = date_diff($datefrom, $dateto);
				?>
				<td style="text-align: center;">
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