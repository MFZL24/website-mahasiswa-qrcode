<div class="form-container-card" style="max-width: 1000px;">
    <div class="form-section-title">
        <i class="fa-solid fa-user-gear"></i> Pengaturan Profil Pengguna
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fa-solid fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: 300px 1fr; gap: 40px;">
        <!-- Sisi Kiri: Foto & Password -->
        <div style="text-align: center;">
            <div style="position: relative; display: inline-block; margin-bottom: 30px;">
                <?php 
                    $foto = $user['foto'] ? $user['foto'] : 'default.png';
                    $foto_path = base_url('assets/img/profile/').$foto;
                ?>
                <img src="<?= $foto_path ?>" id="preview-foto" style="width: 200px; height: 200px; border-radius: 30px; object-fit: cover; border: 5px solid #f1f5f9; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                <label for="foto-input" style="position: absolute; bottom: -10px; right: -10px; background: var(--primary); color: white; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 4px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <i class="fa-solid fa-camera"></i>
                </label>
            </div>

            <div style="background: #f8fafc; padding: 25px; border-radius: 24px; border: 1px solid #e2e8f0; text-align: left;">
                <div class="form-section-title" style="font-size: 15px; margin-bottom: 20px;">
                    <i class="fa-solid fa-lock" style="width: 30px; height: 30px; font-size: 14px;"></i> Ganti Password
                </div>
                <form action="<?= base_url('index.php/profile/update_password') ?>" method="post">
                    <div class="input-wrapper" style="margin-bottom: 15px;">
                        <label style="font-size: 11px;">Password Baru</label>
                        <div class="input-field-container">
                            <input type="password" name="password_baru" id="p_baru" class="form-control" placeholder="******" required minlength="6" style="padding: 12px 12px 12px 45px; font-size: 14px;">
                            <i class="fa-solid fa-key" style="left: 15px; font-size: 14px;"></i>
                            <span class="password-toggle" onclick="togglePassword('p_baru')" style="right: 15px;">
                                <i id="toggle-p_baru" class="fa-solid fa-eye" style="font-size: 14px;"></i>
                            </span>
                        </div>
                    </div>
                    <div class="input-wrapper" style="margin-bottom: 20px;">
                        <label style="font-size: 11px;">Ulangi Password</label>
                        <div class="input-field-container">
                            <input type="password" name="konfirmasi_password" id="p_konf" class="form-control" placeholder="******" required minlength="6" style="padding: 12px 12px 12px 45px; font-size: 14px;">
                            <i class="fa-solid fa-check-double" style="left: 15px; font-size: 14px;"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; height: 45px; border-radius: 12px; font-size: 13px;">
                        UPDATE PASSWORD
                    </button>
                </form>
            </div>
        </div>

        <!-- Sisi Kanan: Biodata -->
        <form action="<?= base_url('index.php/profile/update') ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="foto" id="foto-input" style="display: none;" onchange="previewImage(this)">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="input-wrapper">
                    <label>Username (Permanen)</label>
                    <div class="input-field-container">
                        <input type="text" class="form-control" value="<?= $user['username'] ?>" readonly style="background: #f1f5f9; color: #94a3b8;">
                        <i class="fa-solid fa-at"></i>
                    </div>
                </div>
                <div class="input-wrapper">
                    <label>Role Pengguna</label>
                    <div class="input-field-container">
                        <input type="text" class="form-control" value="<?= strtoupper($user['role']) ?>" readonly style="background: #f1f5f9; color: #94a3b8;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                </div>
            </div>

            <div class="input-wrapper">
                <label>Nama Lengkap</label>
                <div class="input-field-container">
                    <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <div class="input-wrapper">
                <label>Email Aktif</label>
                <div class="input-field-container">
                    <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" placeholder="nama@email.com">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>

            <div class="input-wrapper">
                <label>Nomor Telepon/WhatsApp</label>
                <div class="input-field-container">
                    <input type="text" name="telepon" class="form-control" value="<?= $user['telepon'] ?>" placeholder="08xxxxxxxxxx">
                    <i class="fa-solid fa-phone"></i>
                </div>
            </div>

            <div class="input-wrapper">
                <label>Alamat Lengkap</label>
                <div class="input-field-container">
                    <textarea name="alamat" class="form-control" style="height: 120px; padding-left: 55px; padding-top: 15px;" placeholder="Masukkan alamat lengkap..."><?= $user['alamat'] ?></textarea>
                    <i class="fa-solid fa-map-location-dot" style="top: 20px;"></i>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 0 50px; height: 55px; border-radius: 16px; font-weight: 700;">
                    SIMPAN PERUBAHAN BIODATA
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-foto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
