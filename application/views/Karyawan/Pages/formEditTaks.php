<div class="main-wrapper">
  <?php  
    if (@$this->session->flashdata('notif')) {
      echo $this->session->flashdata('notif');
      $this->session->unset_userdata('notif');
    }
  ?>
  <div class="row">
    <?php foreach ($absenHarian['data'] as $data): ?>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Edit Taks</h5>
        
          <form method="post" action="<?= site_url('Karyawan/Task/prosesEditTask') ?>">
            <div class="row mb-3">
              <label for="tglTaks" class="col-sm-2 col-form-label">Tanggal Absen</label>
              <div class="col-sm-10">
                <input type="text" name="tgl" class="form-control" id="tglTaks" readonly="" value="<?= date('d-m-Y', strtotime($data['tgl_absen'])) ?>">

                <input type="text" name="employee" class="form-control" id="employee" readonly="" value="<?= $data['id_karyawan'] ?>" hidden>
                
                <input type="text" name="id" class="form-control" id="id" readonly="" value="<?= $data['id'] ?>" hidden>
              </div>
            </div>
            <div class="row mb-3">
              <label for="desc" class="col-sm-2 col-form-label">Deskripsi Pekerjaan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="desc" id="desc"><?= $data['desc_kerja'] ?></textarea>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col text-end">
                <a href="<?= site_url('Karyawan/Task') ?>" class="btn btn-danger" >Cancel</a>
                <input type="submit" class="btn btn-primary" name="save" value="Save Change">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>
