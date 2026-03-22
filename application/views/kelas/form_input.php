<div class="form-container-card" style="max-width: 1000px; margin: 0 auto; padding: 45px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 40px 80px rgba(0,0,0,0.06);">
    <div class="form-section-title" style="margin-bottom: 40px;">
        <i class="fa-solid fa-graduation-cap" style="background: var(--primary-light); color: var(--primary);"></i> 
        <span><?= isset($row) ? 'Update Konfigurasi Kelas' : 'Pembukaan Kelas Perkuliahan Baru' ?></span>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/kelas/edit') : base_url('index.php/kelas/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="id" value="<?= $row['id_kelas'] ?>">
        <?php endif; ?>

        <!-- Primary Course & Lecturer Assignment -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 35px; margin-bottom: 35px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Mata Kuliah Kurikulum</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="id_mk" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer; width: 100%;">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php foreach($mk->result() as $m): ?>
                            <option value="<?= $m->id_mk ?>" <?= isset($row) && $row['id_mk'] == $m->id_mk ? 'selected' : '' ?>>[<?= $m->kode_mk ?>] <?= $m->nama_mk ?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fa-solid fa-book" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>

            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Dosen Pengampu Utama</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="nidn" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer; width: 100%;">
                        <option value="">-- Pilih Dosen Pengampu --</option>
                        <?php foreach($dosen->result() as $d): ?>
                            <option value="<?= $d->nidn ?>" <?= isset($row) && $row['nidn'] == $d->nidn ? 'selected' : '' ?>><?= $d->nama_dosen ?> (<?= $d->nidn ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fa-solid fa-user-tie" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 35px; margin-bottom: 45px;">
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Identitas Nama Kelas</label>
                <div class="input-field-container" style="position: relative;">
                    <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: IF-21A-Pagi" required value="<?= isset($row) ? $row['nama_kelas'] : '' ?>" style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 800; border: 2px solid #f1f5f9; background: #fafbfc;">
                    <i class="fa-solid fa-door-open" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label style="font-weight: 800; color: #475569; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">Semester Akademik</label>
                <div class="input-field-container" style="position: relative;">
                    <select name="semester" class="form-control" required style="height: 60px; padding-left: 55px; border-radius: 18px; font-weight: 700; border: 2px solid #f1f5f9; background: #fafbfc; appearance: none; cursor: pointer; width: 100%;">
                        <optgroup label="Semester Ganjil">
                            <?php for($i=1; $i<=13; $i+=2): ?>
                                <option value="Ganjil <?= $i ?>" <?= isset($row) && $row['semester'] == 'Ganjil '.$i ? 'selected' : '' ?>>Ganjil - <?= $i ?></option>
                            <?php endfor; ?>
                        </optgroup>
                        <optgroup label="Semester Genap">
                            <?php for($i=2; $i<=14; $i+=2): ?>
                                <option value="Genap <?= $i ?>" <?= isset($row) && $row['semester'] == 'Genap '.$i ? 'selected' : '' ?>>Genap - <?= $i ?></option>
                            <?php endfor; ?>
                        </optgroup>
                    </select>
                    <i class="fa-solid fa-layer-group" style="position: absolute; left: 20px; top: 20px; color: #cbd5e1; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <!-- Weekly Schedule Configuration -->
        <div style="background: #fafbfc; padding: 45px; border-radius: 35px; border: 2px dashed #f1f5f9; margin-bottom: 45px;">
            <div style="font-size: 15px; font-weight: 950; color: #475569; margin-bottom: 30px; display: flex; align-items: center; gap: 12px; text-transform: uppercase; letter-spacing: 1.5px;">
                <i class="fa-solid fa-calendar-clock" style="color: #3b82f6;"></i> Penjadwalan Mingguan
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">HARI KULIAH</label>
                    <div class="input-field-container" style="position: relative;">
                        <select name="hari" class="form-control" required style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; width: 100%;">
                            <?php $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; 
                            foreach($hari as $h): ?>
                                <option value="<?= $h ?>" <?= isset($row) && $row['hari'] == $h ? 'selected' : '' ?>><?= $h ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa-solid fa-calendar-day" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">JAM MULAI (WIB)</label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="time" name="jam_mulai" class="form-control" required value="<?= isset($row) ? $row['jam_mulai'] : '08:00' ?>" style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; width: 100%;">
                        <i class="fa-solid fa-clock" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label style="font-weight: 800; color: #64748b; margin-bottom: 10px; display: block; font-size: 12px;">JAM SELESAI (WIB)</label>
                    <div class="input-field-container" style="position: relative;">
                        <input type="time" name="jam_selesai" class="form-control" required value="<?= isset($row) ? $row['jam_selesai'] : '10:00' ?>" style="height: 55px; padding-left: 50px; border-radius: 15px; font-weight: 700; border: 1px solid #e2e8f0; width: 100%;">
                        <i class="fa-solid fa-clock-rotate-left" style="position: absolute; left: 18px; top: 18px; color: #cbd5e1;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Submission Controls -->
        <div style="display: flex; gap: 20px; justify-content: flex-end; margin-top: 50px; border-top: 1px solid #f1f5f9; padding-top: 40px;">
            <button type="reset" class="btn-reset" style="padding: 18px 40px; border-radius: 20px; font-weight: 850; font-size: 15px; background: white; color: #94a3b8; border: 2px solid #f1f5f9; transition: all 0.3s; cursor: pointer;">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </button>
            <button type="submit" name="submit" class="btn-primary" style="padding: 0 65px; height: 62px; border-radius: 22px; font-size: 16px; font-weight: 950; background: var(--primary); color: white; border: none; box-shadow: 0 15px 35px rgba(0, 104, 116, 0.25); cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); letter-spacing: 0.5px;">
                <i class="fa-solid fa-paper-plane" style="margin-right: 12px; opacity: 0.6;"></i> <?= isset($row) ? 'UPDATE KONFIGURASI KELAS' : 'BUKA SESI KELAS BARU' ?>
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
