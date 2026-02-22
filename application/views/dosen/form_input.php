<div class="form-container-card">
    <div class="form-section-title">
        <i class="fa-solid fa-user-tie"></i> <?= isset($row) ? 'Edit Data Dosen' : 'Tambah Data Dosen Baru' ?>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/dosen/edit') : base_url('index.php/dosen/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="nidn_old" value="<?= $row['nidn'] ?>">
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <div class="input-wrapper">
                <label>NIDN (Nomor Induk Dosen Nasional)</label>
                <div class="input-field-container">
                    <input type="text" name="nidn" class="form-control" placeholder="Masukkan NIDN" required value="<?= isset($row) ? $row['nidn'] : '' ?>">
                    <i class="fa-solid fa-address-card"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Email Institusi</label>
                <div class="input-field-container">
                    <input type="email" name="email" class="form-control" placeholder="nama@kampus.ac.id" required value="<?= isset($row) ? $row['email'] : '' ?>">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>
        </div>

        <div class="input-wrapper">
            <label>Nama Lengkap & Gelar Akademik</label>
            <div class="input-field-container">
                <input type="text" name="nama_dosen" class="form-control" placeholder="Contoh: Dr. Jaka S.Kom, M.T" required value="<?= isset($row) ? $row['nama_dosen'] : '' ?>">
                <i class="fa-solid fa-user-tag"></i>
            </div>
        </div>

        <div style="background: #fdf2f8; padding: 40px; border-radius: 24px; margin-top: 20px; border: 2px dashed #fbcfe8;">
            <div class="form-section-title" style="font-size: 16px; margin-bottom: 25px; color: #be185d;">
                <i class="fa-solid fa-shield-halved" style="width: 35px; height: 35px; font-size: 14px; background: #fce7f3; color: #be185d;"></i> Kredensial Akses Dosen
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Username</label>
                    <div class="input-field-container">
                        <input type="text" name="username" class="form-control" placeholder="Username untuk login" required value="<?= isset($row) ? $row['username'] : '' ?>">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Password Login <?= isset($row) ? '(Kosongkan jika tidak diganti)' : '' ?></label>
                    <div class="input-field-container">
                        <input type="password" name="password" id="p_dosen" class="form-control" placeholder="Password untuk login" <?= isset($row) ? '' : 'required' ?>>
                        <i class="fa-solid fa-key"></i>
                        <span class="password-toggle" onclick="togglePassword('p_dosen')">
                            <i id="toggle-p_dosen" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: center;">
            <a href="<?= base_url('index.php/dosen') ?>" class="btn btn-danger" style="background: white; color: #ef4444; border: 2px solid #fecaca; width: 140px; justify-content: center; height: 55px; border-radius: 16px;">
                Batal
            </a>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 0 60px; height: 55px; border-radius: 16px; font-size: 16px; font-weight: 700; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                <?= isset($row) ? 'UPDATE DATA DOSEN' : 'SIMPAN DATA DOSEN' ?>
            </button>
        </div>
    </form>
</div>
