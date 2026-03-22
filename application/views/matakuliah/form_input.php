<div class="form-container-card" style="max-width: 900px; margin: 0 auto; padding: 45px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 40px 80px rgba(0,0,0,0.06);">
    <div class="form-section-title" style="margin-bottom: 40px;">
        <i class="fa-solid fa-book-bookmark" style="background: #fffbeb; color: #d97706;"></i> 
        <span><?= isset($row) ? 'Update Kurikulum Matakuliah' : 'Registrasi Matakuliah Baru' ?></span>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/matakuliah/edit') : base_url('index.php/matakuliah/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="id" value="<?= $row['id_mk'] ?>">
        <?php endif; ?>

        <!-- Primary Course Configuration -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Kode Identitas MK</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="kode_mk" class="form-control" placeholder="Contoh: MK-CS101" required value="<?= isset($row) ? $row['kode_mk'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc;">
                    <i class="fa-solid fa-barcode" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Bobot Kredit (SKS)</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="sks" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer;">
                        <?php for($i=1; $i<=6; $i++): ?>
                            <option value="<?= $i ?>" <?= isset($row) && $row['sks'] == $i ? 'selected' : ($i==3 ? 'selected' : '') ?>><?= $i ?> Satuan Kredit Semester (SKS)</option>
                        <?php endfor; ?>
                    </select>
                    <i class="fa-solid fa-list-ol" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div class="input-wrapper" style="margin-bottom: 35px;">
            <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Nama Lengkap Matakuliah</label>
            <div class="input-field-container" style="position: relative;">
                <input type="text" name="nama_mk" class="form-control" placeholder="Contoh: Algoritma dan Struktur Data" required value="<?= isset($row) ? $row['nama_mk'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 800; border: 2px solid #f1f5f9; background: #fafbfc;">
                <i class="fa-solid fa-font" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
            </div>
        </div>

        <!-- Academic Placement -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 35px; margin-bottom: 45px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Program Studi Target</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="prodi" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer;">
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="Informatika" <?= isset($row) && $row['prodi'] == 'Informatika' ? 'selected' : '' ?>>S1 - Informatika</option>
                        <option value="Sistem Informasi" <?= isset($row) && $row['prodi'] == 'Sistem Informasi' ? 'selected' : '' ?>>S1 - Sistem Informasi</option>
                        <option value="Teknik Komputer" <?= isset($row) && $row['prodi'] == 'Teknik Komputer' ? 'selected' : '' ?>>D3 - Teknik Komputer</option>
                        <option value="Manajemen Informatika" <?= isset($row) && $row['prodi'] == 'Manajemen Informatika' ? 'selected' : '' ?>>D3 - Manajemen Informatika</option>
                        <option value="Teknik Elektro" <?= isset($row) && $row['prodi'] == 'Teknik Elektro' ? 'selected' : '' ?>>S1 - Teknik Elektro</option>
                    </select>
                    <i class="fa-solid fa-graduation-cap" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Penempatan Semester</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="semester" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer;">
                        <?php for($i=1; $i<=14; $i++): ?>
                            <option value="<?= $i ?>" <?= isset($row) && $row['semester'] == $i ? 'selected' : '' ?>>Paket Semester <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <i class="fa-solid fa-layer-group" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <!-- Submission Actions -->
        <div style="display: flex; gap: 20px; justify-content: flex-end; margin-top: 50px; border-top: 1px solid #f1f5f9; padding-top: 40px;">
            <button type="reset" class="btn-reset" style="padding: 18px 40px; border-radius: 20px; font-weight: 850; font-size: 15px; background: white; color: #94a3b8; border: 2px solid #f1f5f9; transition: all 0.3s; cursor: pointer;">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </button>
            <button type="submit" name="submit" class="btn-primary" style="padding: 0 65px; height: 62px; border-radius: 22px; font-size: 16px; font-weight: 950; background: var(--primary); color: white; border: none; box-shadow: 0 15px 35px rgba(0, 104, 116, 0.25); cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); letter-spacing: 0.5px;">
                <i class="fa-solid fa-floppy-disk" style="margin-right: 12px; opacity: 0.6;"></i> <?= isset($row) ? 'UPDATE DATA MATAKULIAH' : 'SIMPAN DATA KURIKULUM' ?>
            </button>
        </div>
    </form>
</div>

<style>
    .btn-primary:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 104, 116, 0.35);
        filter: brightness(1.1);
    }
    .btn-reset:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
    }
    input:focus, select:focus {
        border-color: var(--primary) !important;
        background: white !important;
        box-shadow: 0 0 0 8px rgba(0, 104, 116, 0.05);
    }
</style>
