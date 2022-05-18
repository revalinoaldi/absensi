<link href="<?= base_url() ?>assets/plugins/DataTables/datatables.min.css" rel="stylesheet">  
<div class="main-wrapper">
	<?php  
	if (@$this->session->flashdata('notif')) {
		echo $this->session->flashdata('notif');
		$this->session->unset_userdata('notif');
	}
	?>
	<div class="row">
		<div class="col-6">
			<div class="card stat-widget">
				<div class="card-body">
					<h5 class="card-title">Employee</h5>
					<h2><?= count($employee['data']); ?></h2>
					<p>Total Employee</p>
					<div class="progress">
						<div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="card stat-widget">
				<div class="card-body">
					<h5 class="card-title">Absen</h5>
					<h2>0</h2>
					<p>Absen Hari Ini</p>
					<div class="progress">
						<div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalImportData" tabindex="-1" aria-labelledby="modalImportDataLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalImportDataLabel">Import Data Employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= site_url('Admin/Karyawan/importData ') ?>" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="mb-3">
							<label for="formFileSm" class="form-label">Import Excel/CSV <span class="text-danger">*</span></label>
							<input class="form-control form-control-sm" name="importData" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" id="formFileSm" type="file">
							<small><i>Please use format field in excel/csv (NIP | Nama | Email | Password)</i></small>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalAddEmployee" tabindex="-1" aria-labelledby="modalAddEmployeeLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalAddEmployeeLabel">Add New Employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= site_url('Admin/Karyawan/action') ?>" method="POST">
					<div class="modal-body">
						<div class="mb-3">
							<label for="id" class="form-label">NIP<span class="text-danger">*</span></label>
							<input type="text" name="id" class="form-control" id="id" placeholder="Enter the NIP" required="">
						</div>
						<div class="mb-3">
							<label for="fullname" class="form-label">Full Name<span class="text-danger">*</span></label>
							<input type="text" name="name" class="form-control" id="fullname" placeholder="Enter the Fullname" required="">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email<span class="text-danger">*</span></label>
							<input type="email" name="email" class="form-control" id="email" placeholder="Enter the Email" required="">
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password<span class="text-danger">*</span></label>
							<input type="password" name="pass" class="form-control" id="password" placeholder="Enter the Password" required="">
						</div>
						<div class="mb-3">
							<label for="repassword" class="form-label">Re-Password<span class="text-danger">*</span></label>
							<input type="password" name="repass" class="form-control" id="repassword" placeholder="Enter the Re-Password" required="">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i data-feather="x-circle"></i> Close</button>
						<button type="submit" class="btn btn-primary"><i data-feather="save"></i> Save Record</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- .End Modal -->
	<div class="row">
		<div class="col-12">
			<div class="card table-widget">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<h5 class="card-title">Employee List</h5>
						</div>
						<div class="col-6 text-end " style="padding-right: 50px;">
							<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalImportData">
								Import Employee
							</button>
							<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddEmployee" class="btn btn-primary"><i class="fas fa-plus"></i> New Employee</a>

						</div>
					</div>
					<div class="table-responsive">
						<table class="table display" >
							<thead>
								<tr>
									<th scope="col">Full Name</th>
									<th scope="col">NIP</th>
									<th scope="col">Email</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($employee['data'] as $emp): ?>
									<?php if ($emp['email'] != 'admin@admin.com'): ?>
										<tr>
											<th scope="row"><img src="<?= base_url() ?>assets/images/avatars/profile-image.png" alt=""><?= $emp['nama_karyawan'] ?></th>
											<td><?= $emp['id_karyawan'] ?></td>
											<td><?= $emp['email'] ?></td>
											<td><?= $emp['level'] ?></td>
											<td>
												<a href="" title="Remove from Record">
													<span class="badge bg-danger"><i class="fas fa-trash-alt"></i></span>
												</a> 
												&nbsp;
												<a href="" title="Edit this Record">
													<span class="badge bg-primary"><i class="fas fa-edit"></i></span>
												</a>
											</td>
										</tr>
									<?php endif ?>

								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.js"></script>