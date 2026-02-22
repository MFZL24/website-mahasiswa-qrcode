<div class="form-container-card">
    <div class="form-section-title">
        <i class="fa-solid fa-user-graduate"></i> <?= isset($row) ? 'Edit Data Mahasiswa' : 'Registrasi Mahasiswa Baru' ?>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/mahasiswa/edit') : base_url('index.php/mahasiswa/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="nim_old" value="<?= $row['nim'] ?>">
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <div class="input-wrapper">
                <label>NIM (Nomor Induk Mahasiswa)</label>
                <div class="input-field-container">
                    <input type="text" name="nim" class="form-control" placeholder="Contoh: 2022001" required value="<?= isset($row) ? $row['nim'] : '' ?>">
                    <i class="fa-solid fa-id-card"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Tahun Angkatan</label>
                <div class="input-field-container">
                    <input type="number" name="angkatan" class="form-control" placeholder="Contoh: 2022" required value="<?= isset($row) ? $row['angkatan'] : '' ?>">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div class="input-wrapper">
            <label>Nama Lengkap Sesuai KTP</label>
            <div class="input-field-container">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required value="<?= isset($row) ? $row['nama'] : '' ?>">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>

        <div class="input-wrapper">
            <label>Program Studi</label>
            <div class="input-field-container">
                <select name="prodi" class="form-control select-pure" required>
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="Informatika" <?= isset($row) && $row['prodi'] == 'Informatika' ? 'selected' : '' ?>>S1 - Informatika</option>
                    <option value="Sistem Informasi" <?= isset($row) && $row['prodi'] == 'Sistem Informasi' ? 'selected' : '' ?>>S1 - Sistem Informasi</option>
                    <option value="Teknik Komputer" <?= isset($row) && $row['prodi'] == 'Teknik Komputer' ? 'selected' : '' ?>>D3 - Teknik Komputer</option>
                </select>
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <div style="background: #f8fafc; padding: 40px; border-radius: 24px; margin-top: 20px; border: 2px dashed #e2e8f0;">
            <div class="form-section-title" style="font-size: 16px; margin-bottom: 25px;">
                <i class="fa-solid fa-lock" style="width: 35px; height: 35px; font-size: 14px;"></i> Konfigurasi Akun Login
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Username</label>
                    <div class="input-field-container">
                        <input type="text" name="username" class="form-control" placeholder="Buat username unik" required value="<?= isset($row) ? $row['username'] : '' ?>">
                        <i class="fa-solid fa-at"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Password Akun <?= isset($row) ? '(Kosongkan jika tidak diganti)' : '' ?></label>
                    <div class="input-field-container">
                        <input type="password" name="password" id="p_mhs" class="form-control" placeholder="Buat password aman" <?= isset($row) ? '' : 'required' ?>>
                        <i class="fa-solid fa-key"></i>
                        <span class="password-toggle" onclick="togglePassword('p_mhs')">
                            <i id="toggle-p_mhs" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: center;">
            <a href="<?= base_url('index.php/mahasiswa') ?>" class="btn btn-danger" style="background: white; color: #ef4444; border: 2px solid #fecaca; width: 140px; justify-content: center; height: 55px; border-radius: 16px;">
                Batal
            </a>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 0 60px; height: 55px; border-radius: 16px; font-size: 16px; font-weight: 700; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                <?= isset($row) ? 'UPDATE DATA MAHASISWA' : 'DAFTARKAN MAHASISWA' ?>
            </button>
        </div>
    </form>
</div>
