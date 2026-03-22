<div class="form-container-card" style="max-width: 900px; margin: 0 auto; padding: 45px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 40px 80px rgba(0,0,0,0.06);">
    <div class="form-section-title" style="margin-bottom: 40px;">
        <i class="fa-solid fa-user-graduate" style="background: var(--primary-light); color: var(--primary);"></i> 
        <span><?= isset($row) ? 'Update Identitas Mahasiswa' : 'Pendaftaran Mahasiswa Baru' ?></span>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/mahasiswa/edit') : base_url('index.php/mahasiswa/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="nim_old" value="<?= $row['nim'] ?>">
        <?php endif; ?>

        <!-- Primary Identity Info -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Nomor Induk Mahasiswa (NIM)</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="nim" class="form-control" placeholder="Contoh: 210502000" required value="<?= isset($row) ? $row['nim'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-id-card" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Tahun Masuk (Angkatan)</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="number" name="angkatan" class="form-control" placeholder="Contoh: 2024" required value="<?= isset($row) ? $row['angkatan'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-calendar-check" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div class="input-wrapper" style="margin-bottom: 35px;">
            <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap Mahasiswa</label>
            <div class="input-field-container" style="position: relative;">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap sesuai identitas resmi" required value="<?= isset($row) ? $row['nama'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                <i class="fa-solid fa-user-tag" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
            </div>
        </div>

        <!-- Academic Affiliation -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Semester Saat Ini</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="semester_aktif" id="sel-semester-admin" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer;">
                        <?php for($i = 1; $i <= 8; $i++): ?>
                            <option value="<?= $i ?>" <?= isset($row) && $row['semester_aktif'] == $i ? 'selected' : '' ?>>Semester <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <i class="fa-solid fa-layer-group" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper" id="ipk-wrapper-admin" style="<?= isset($row) && $row['semester_aktif'] > 1 ? '' : 'display: none;' ?>">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">IPK Terakhir</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="number" step="0.01" min="0" max="4.00" name="ipk_terakhir" id="input-ipk-admin" class="form-control" placeholder="Contoh: 3.50" value="<?= isset($row) ? $row['ipk_terakhir'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-chart-line" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px; margin-bottom: 45px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Fakultas Utama</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="fakultas" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer;">
                        <option value="">-- Pilih Fakultas --</option>
                        <option value="Fakultas Ilmu Komputer (FIK)" <?= isset($row) && $row['fakultas'] == 'Fakultas Ilmu Komputer (FIK)' ? 'selected' : '' ?>>Fakultas Ilmu Komputer (FIK)</option>
                        <option value="Fakultas Teknik (FT)" <?= isset($row) && $row['fakultas'] == 'Fakultas Teknik (FT)' ? 'selected' : '' ?>>Fakultas Teknik (FT)</option>
                        <option value="Fakultas Ekonomi (FE)" <?= isset($row) && $row['fakultas'] == 'Fakultas Ekonomi (FE)' ? 'selected' : '' ?>>Fakultas Ekonomi (FE)</option>
                        <option value="Fakultas Hukum (FH)" <?= isset($row) && $row['fakultas'] == 'Fakultas Hukum (FH)' ? 'selected' : '' ?>>Fakultas Hukum (FH)</option>
                    </select>
                    <i class="fa-solid fa-building-columns" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Program Studi (Prodi)</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="prodi" class="form-control" placeholder="Contoh: Teknik Informatika" required value="<?= isset($row) ? $row['prodi'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.background='white';">
                    <i class="fa-solid fa-graduation-cap" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <!-- Account Credentials (Secondary Section) -->
        <div style="background: #fafbfc; padding: 45px; border-radius: 30px; border: 2px dashed #f1f5f9; margin-bottom: 40px;">
            <div style="font-size: 15px; font-weight: 950; color: #475569; margin-bottom: 30px; display: flex; align-items: center; gap: 12px; text-transform: uppercase; letter-spacing: 1px;">
                <i class="fa-solid fa-shield-halved" style="color: #6366f1;"></i> Kredensial Akses Mahasiswa
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">USERNAME LOGIN</label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="text" name="username" class="form-control" placeholder="Buat username unik" required value="<?= isset($row) ? $row['username'] : '' ?>" style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; transition: all 0.3s;">
                        <i class="fa-solid fa-at" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">PASSWORD KEAMANAN <?= isset($row) ? '(KOSONGKAN JIKA TETAP)' : '' ?></label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="password" name="password" id="p_mhs" class="form-control" placeholder="Minimal 8 karakter" <?= isset($row) ? '' : 'required' ?> style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; transition: all 0.3s;">
                        <i class="fa-solid fa-key" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                        <span style="position: absolute; right: 18px; top: 18px; color: #94a3b8; cursor: pointer; display: flex; align-items: center; justify-content: center;" onclick="togglePassword('p_mhs')">
                            <i id="toggle-p_mhs" class="fa-solid fa-eye" style="font-size: 14px;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Submission -->
        <div style="display: flex; gap: 20px; justify-content: center; margin-top: 50px;">
            <a href="<?= base_url('index.php/mahasiswa') ?>" class="btn-cancel" style="padding: 18px 45px; border-radius: 20px; font-weight: 850; font-size: 15px; background: white; color: #e11d48; border: 2px solid #ffe4e6; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#fff1f2'; this.style.borderColor='#e11d48'" onmouseout="this.style.background='white'; this.style.borderColor='#ffe4e6'">
                MEMBATALKAN
            </a>
            <button type="submit" name="submit" class="btn-primary" style="padding: 0 65px; height: 62px; border-radius: 20px; font-size: 16px; font-weight: 950; background: var(--primary); color: white; border: none; box-shadow: 0 15px 35px rgba(0, 104, 116, 0.25); cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); letter-spacing: 0.5px;">
                <i class="fa-solid fa-floppy-disk" style="margin-right: 12px; opacity: 0.6;"></i> <?= isset($row) ? 'UPDATE DATA SEKARANG' : 'DAFTARKAN IDENTITAS BARU' ?>
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

    // Dynamic IPK Visibility for Admin
    const selSemAdmin = document.getElementById('sel-semester-admin');
    const ipkWrapAdmin = document.getElementById('ipk-wrapper-admin');
    const inputIpkAdmin = document.getElementById('input-ipk-admin');

    if (selSemAdmin) {
        selSemAdmin.addEventListener('change', function() {
            if (parseInt(this.value) > 1) {
                ipkWrapAdmin.style.display = 'block';
                inputIpkAdmin.required = true;
            } else {
                ipkWrapAdmin.style.display = 'none';
                inputIpkAdmin.required = false;
                inputIpkAdmin.value = '';
            }
        });
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
