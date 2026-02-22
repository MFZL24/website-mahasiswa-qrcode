<div class="form-container-card">
    <div class="form-section-title">
        <i class="fa-solid fa-user-shield"></i> <?= isset($row) ? 'Edit Akun Pengguna' : 'Tambah User Operator Baru' ?>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/operator/edit') : base_url('index.php/operator/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="id_operator" value="<?= $row['id_operator'] ?>">
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="input-wrapper">
                <label>Nama Lengkap</label>
                <div class="input-field-container">
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required value="<?= isset($row) ? $row['nama'] : '' ?>">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Email</label>
                <div class="input-field-container">
                    <input type="email" name="email" class="form-control" placeholder="user@email.com" value="<?= isset($row) ? $row['email'] : '' ?>">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="input-wrapper">
                <label>Username</label>
                <div class="input-field-container">
                    <input type="text" name="username" class="form-control" placeholder="admin123" required value="<?= isset($row) ? $row['username'] : '' ?>">
                    <i class="fa-solid fa-id-badge"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Role / Hak Akses</label>
                <div class="input-field-container">
                    <select name="role" class="form-control select-pure" required>
                        <option value="admin" <?= isset($row) && $row['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                        <option value="dosen" <?= isset($row) && $row['role'] == 'dosen' ? 'selected' : '' ?>>Dosen</option>
                        <option value="mahasiswa" <?= isset($row) && $row['role'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                    </select>
                    <i class="fa-solid fa-user-lock"></i>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="input-wrapper" style="margin-bottom: 0;">
                <label>Password Akun <?= isset($row) ? '(Kosongkan jika tidak diganti)' : '' ?></label>
                <div class="input-field-container">
                    <input type="password" name="password" id="p_op" class="form-control" placeholder="******" <?= isset($row) ? '' : 'required' ?>>
                    <i class="fa-solid fa-key"></i>
                    <span class="password-toggle" onclick="togglePassword('p_op')">
                        <i id="toggle-p_op" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="input-wrapper" style="margin-bottom: 0;">
                <label>Status Akun</label>
                <div class="input-field-container">
                    <select name="status" class="form-control select-pure" required>
                        <option value="active" <?= isset($row) && $row['status'] == 'active' ? 'selected' : '' ?>>Aktif (Dapat Login)</option>
                        <option value="pending" <?= isset($row) && $row['status'] == 'pending' ? 'selected' : '' ?>>Pending (Menunggu Persetujuan)</option>
                        <option value="blocked" <?= isset($row) && $row['status'] == 'blocked' ? 'selected' : '' ?>>Blokir (Akses Dicabut)</option>
                    </select>
                    <i class="fa-solid fa-toggle-on"></i>
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 12px; justify-content: flex-end;">
            <a href="<?= base_url('index.php/operator') ?>" class="btn btn-danger" style="background: white; color: #ef4444; border: 2px solid #fecaca; width: 140px; justify-content: center; height: 55px; border-radius: 16px;">Batal</a>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 0 40px; height: 55px; border-radius: 16px; font-weight: 700; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                <?= isset($row) ? 'UPDATE USER' : 'SIMPAN OPERATOR' ?>
            </button>
        </div>
    </form>
</div>
