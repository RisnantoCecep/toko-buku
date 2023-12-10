<div class="container pt-7 pb-5 mt-5">

    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-5 shadow-lg my-5">
          <div class="card-body p-10">
            <div class="row">
              <div class="col-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Registration</h1>
                  </div>
                    <?php if($this->session->flashdata('warning')): ?>
                        <div class="alert alert-warning"><?= $this->session->flashdata('warning') ?></div>
                    <?php endif ?>
                  <form class="user" method="post" action="<?= base_url('register/registrasi') ?>">

                    <div class="form-group mb-3">
                        <label for="">Nama lengkap</label>
                        <input type="text" name="name" class="form-control form-control-user" id="exampleInputName" aria-describedby="nameHelp" placeholder="Nama lengkap">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Alamat email</label>
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Alamat email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nomor telepon</label>
                        <input type="text" name="phone" class="form-control form-control-user" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Nomor telepon">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Kata sandi</label>
                        <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Kata sandi">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Konfirmasi kata sandi</label>
                        <input type="password" name="password2" class="form-control form-control-user" id="exampleInputPassword" placeholder="Konfirmasi kata sandi">
                    </div>
                    <div class="custom-text small">
                        <p class="custom-text small"><span class="text-danger">*</span> Sudah Punya Akun? <a href="<?= base_url('login')?>">Login</a></p>
                    </div>

                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                    <button type="submit" class="btn btn-outline-danger btn-user btn-block col-12">Kirim</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

</div>
  

