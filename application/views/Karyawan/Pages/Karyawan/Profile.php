<div class="main-wrapper">
  <?php  
  if (@$this->session->flashdata('notif')) {
    echo $this->session->flashdata('notif');
    $this->session->unset_userdata('notif');
  }
  ?>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Profile Karyawan</h5>
          <form class="row g-3 needs-validation" novalidate method="post" action="<?= site_url('Karyawan/Employee/editProfile') ?>">
            <div class="col-12">
              <label for="validationCustom01" class="form-label">NIP</label>
              <input type="text" class="form-control" readonly="" name="id" id="validationCustom01" value="<?= $data['data']['id'] ?>" required>
              <div class="invalid-feedback">
                NIP was Required!
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom02" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" id="validationCustom02" value="<?= $data['data']['nama'] ?>" required>
              <div class="invalid-feedback">
                Nama Lengkap was Required!
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom03" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="validationCustom03" value="<?= $data['data']['email'] ?>" required>
              <div class="invalid-feedback">
                Email was Required!
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom04" class="form-label">New Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Enter Password" id="validationCustom04">
              <div class="invalid-feedback">
                Password was Required!
              </div>
            </div>
            <div class="col-12">
              <label for="validationCustom05" class="form-label">Re-Type Password</label>
              <input type="password" class="form-control" name="repass" placeholder="Enter Re-Type Password" id="validationCustom05">
              <div class="invalid-feedback">
                Retype Password was Required!
              </div>
            </div>
            <div class="col-12 text-end">
              <a href="<?= site_url('Karyawan/Task') ?>" class="btn btn-danger" >Cancel</a>
              <input type="submit" class="btn btn-primary" name="save" value="Save Change">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>