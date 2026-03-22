<div class="form-container-card" style="max-width: 900px; margin: 0 auto; padding: 45px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 40px 80px rgba(0,0,0,0.06);">
    <div class="form-section-title" style="margin-bottom: 40px;">
        <i class="fa-solid fa-user-shield" style="background: var(--primary-light); color: var(--primary);"></i> 
        <span><?= isset($row) ? 'Update Kredensial Pengguna' : 'Registrasi Operator Sistem' ?></span>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/operator/edit') : base_url('index.php/operator/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="id_operator" value="<?= $row['id_operator'] ?>">
        <?php endif; ?>

        <!-- Basic Profile Information -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap Pengguna</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama resmi" required value="<?= isset($row) ? $row['nama'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-user" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Alamat Surat Elektronik (Email)</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="email" name="email" class="form-control" placeholder="user@uniki.ac.id" value="<?= isset($row) ? $row['email'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-envelope" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <!-- Account Credentials & Roles -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Username Akses Utama</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="username" class="form-control" placeholder="Buat ID login unik" required value="<?= isset($row) ? $row['username'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-id-badge" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Level Otoritas (Role)</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="role" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer; width: 100%;">
                        <option value="admin" <?= isset($row) && $row['role'] == 'admin' ? 'selected' : '' ?>>Root Administrator</option>
                        <option value="dosen" <?= isset($row) && $row['role'] == 'dosen' ? 'selected' : '' ?>>Tenaga Pengajar (Dosen)</option>
                        <option value="mahasiswa" <?= isset($row) && $row['role'] == 'mahasiswa' ? 'selected' : '' ?>>Akademisi (Mahasiswa)</option>
                    </select>
                    <i class="fa-solid fa-user-lock" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <!-- Security & Runtime Status -->
        <div style="background: #fafbfc; border: 2px dashed #f1f5f9; padding: 40px; border-radius: 35px; margin-bottom: 40px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">PASSWORD KEAMANAN <?= isset($row) ? '(KOSONGKAN JIKA TETAP)' : '' ?></label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="password" name="password" id="p_op" class="form-control" placeholder="Minimal karkater unik" <?= isset($row) ? '' : 'required' ?> style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; transition: all 0.3s; width: 100%;">
                        <i class="fa-solid fa-key" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                        <span style="position: absolute; right: 18px; top: 18px; color: #94a3b8; cursor: pointer; display: flex; align-items: center; justify-content: center;" onclick="togglePassword('p_op')">
                            <i id="toggle-p_op" class="fa-solid fa-eye" style="font-size: 14px;"></i>
                        </span>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">STATUS OPERASIONAL AKUN</label>
                    <div class="input-field-container" style="position: relative;">
                        <select name="status" class="form-control" required style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; appearance: none; cursor: pointer; width: 100%;">
                            <option value="active" <?= isset($row) && $row['status'] == 'active' ? 'selected' : '' ?>>AKTIF (DAPAT AKSES)</option>
                            <option value="pending" <?= isset($row) && $row['status'] == 'pending' ? 'selected' : '' ?>>MENUNGGU (PENDING)</option>
                            <option value="blocked" <?= isset($row) && $row['status'] == 'blocked' ? 'selected' : '' ?>>DIBLOKIR (AKSES MATI)</option>
                        </select>
                        <i class="fa-solid fa-shield-halved" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Controls -->
        <div style="display: flex; gap: 20px; justify-content: flex-end; margin-top: 50px; border-top: 1px solid #f1f5f9; padding-top: 40px;">
            <a href="<?= base_url('index.php/operator') ?>" class="btn-cancel" style="padding: 18px 45px; border-radius: 20px; font-weight: 850; font-size: 15px; background: white; color: #ef4444; border: 2px solid #ffe4e6; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#fff1f2'" onmouseout="this.style.background='white'">Batal</a>
            <button type="submit" name="submit" class="btn-primary" style="padding: 0 65px; height: 62px; border-radius: 22px; font-size: 16px; font-weight: 950; background: var(--primary); color: white; border: none; box-shadow: 0 15px 35px rgba(0, 104, 116, 0.25); cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); letter-spacing: 0.5px;">
                <i class="fa-solid fa-floppy-disk" style="margin-right: 12px; opacity: 0.6;"></i> <?= isset($row) ? 'UPDATE KREDENSIAL' : 'DAFTARKAN OPERATOR' ?>
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = document.getElementById('toggle-' + id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<style>
    .btn-primary:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 104, 116, 0.35);
        filter: brightness(1.1);
    }
    input:focus, select:focus {
        border-color: var(--primary) !important;
        background: white !important;
        box-shadow: 0 0 0 8px rgba(0, 104, 116, 0.05);
    }
</style>
