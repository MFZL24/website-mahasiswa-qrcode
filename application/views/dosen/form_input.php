<div class="form-container-card" style="max-width: 900px; margin: 0 auto; padding: 45px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 40px 80px rgba(0,0,0,0.06);">
    <div class="form-section-title" style="margin-bottom: 40px;">
        <i class="fa-solid fa-user-tie" style="background: #fdf2f8; color: #db2777;"></i> 
        <span><?= isset($row) ? 'Update Identitas Tenaga Pengajar' : 'Pendaftaran Dosen Baru' ?></span>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/dosen/edit') : base_url('index.php/dosen/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="nidn_old" value="<?= $row['nidn'] ?>">
        <?php endif; ?>

        <!-- Primary Professional Info -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Nomor Induk Dosen (NIDN)</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="nidn" class="form-control" placeholder="Contoh: 0012345678" required value="<?= isset($row) ? $row['nidn'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc;">
                    <i class="fa-solid fa-address-card" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Email Institusi</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="email" name="email" class="form-control" placeholder="nama@uniki.ac.id" required value="<?= isset($row) ? $row['email'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc;">
                    <i class="fa-solid fa-envelope" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div class="input-wrapper" style="margin-bottom: 45px;">
            <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Nama Lengkap & Gelar Akademik</label>
            <div class="input-field-container" style="position: relative;">
                <input type="text" name="nama_dosen" class="form-control" placeholder="Contoh: Dr. Syahrul, S.Kom, M.T" required value="<?= isset($row) ? $row['nama_dosen'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc;">
                <i class="fa-solid fa-user-tag" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
            </div>
        </div>

        <!-- Account Credentials (Security Context) -->
        <div style="background: #fffcfd; padding: 45px; border-radius: 35px; border: 2px dashed #fce7f3; margin-bottom: 40px;">
            <div style="font-size: 15px; font-weight: 950; color: #db2777; margin-bottom: 30px; display: flex; align-items: center; gap: 12px; text-transform: uppercase; letter-spacing: 1.5px;">
                <i class="fa-solid fa-key-skeleton"></i> Autentikasi Keamanan Dosen
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #94a3b8; margin-bottom: 10px; display: block; font-size: 12px;">USERNAME AKSES</label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="text" name="username" class="form-control" placeholder="ID login dosen" required value="<?= isset($row) ? $row['username'] : '' ?>" style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #f1f5f9;">
                        <i class="fa-solid fa-user-check" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #94a3b8; margin-bottom: 10px; display: block; font-size: 12px;">KATA SANDI <?= isset($row) ? '(LEBIHKAN JIKA TETAP)' : '' ?></label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="password" name="password" id="p_dosen" class="form-control" placeholder="Proteksi identitas" <?= isset($row) ? '' : 'required' ?> style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #f1f5f9;">
                        <i class="fa-solid fa-lock" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                        <span style="position: absolute; right: 18px; top: 18px; color: #94a3b8; cursor: pointer;" onclick="togglePassword('p_dosen')">
                            <i id="toggle-p_dosen" class="fa-solid fa-eye" style="font-size: 14px;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Actions -->
        <div style="display: flex; gap: 20px; justify-content: center; margin-top: 50px;">
            <a href="<?= base_url('index.php/dosen') ?>" class="btn-cancel" style="padding: 18px 45px; border-radius: 20px; font-weight: 850; font-size: 15px; background: white; color: #64748b; border: 2px solid #f1f5f9; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#94a3b8'" onmouseout="this.style.background='white'; this.style.borderColor='#f1f5f9'">
                Batal
            </a>
            <button type="submit" name="submit" class="btn-primary" style="padding: 0 65px; height: 62px; border-radius: 20px; font-size: 16px; font-weight: 950; background: #006874; color: white; border: none; box-shadow: 0 15px 35px rgba(0, 104, 116, 0.25); cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); letter-spacing: 0.5px;">
                <i class="fa-solid fa-floppy-disk" style="margin-right: 12px; opacity: 0.6;"></i> <?= isset($row) ? 'SIMPAN PERUBAHAN DATA' : 'DAFTARKAN DOSEN' ?>
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
    input:focus {
        border-color: #006874 !important;
        background: white !important;
        box-shadow: 0 0 0 8px rgba(0, 104, 116, 0.05);
    }
</style>
