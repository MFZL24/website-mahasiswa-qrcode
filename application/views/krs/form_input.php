<div class="form-container-card" style="max-width: 750px; margin: 0 auto; padding: 45px; border-radius: 40px;">
    <div class="form-section-title" style="margin-bottom: 40px; display: flex; align-items: center; justify-content: center; text-align: center; flex-direction: column; gap: 15px;">
        <div style="width: 70px; height: 70px; background: var(--primary-light); color: var(--primary); border-radius: 22px; display: flex; align-items: center; justify-content: center; font-size: 32px; box-shadow: 0 8px 20px rgba(0, 104, 116, 0.1);">
            <i class="fa-solid fa-id-card-clip"></i>
        </div>
        <div>
            <h3 style="font-size: 24px; font-weight: 900; color: #1e293b; letter-spacing: -0.5px;">Plotting KRS Mahasiswa</h3>
            <p style="font-size: 14px; color: #64748b; font-weight: 600; margin-top: 5px;">Daftarkan mahasiswa ke dalam kelas akademik spesifik.</p>
        </div>
    </div>

    <form action="<?= base_url('index.php/krs/tambah') ?>" method="post">
        <div style="display: flex; flex-direction: column; gap: 30px;">
            
            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 850; color: #64748b; margin-bottom: 15px; display: block;">1. Identitas Mahasiswa</label>
                <div style="position: relative;">
                    <select name="nim" class="form-control" required style="height: 60px; border-radius: 20px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 25px 0 60px; font-weight: 700; font-size: 15px; appearance: none; cursor: pointer;">
                        <option value="">-- Pilih Mahasiswa Aktif --</option>
                        <?php foreach($mhs->result() as $m): ?>
                            <option value="<?= $m->nim ?>"><?= $m->nim ?> - <?= $m->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fa-solid fa-user-graduate" style="position: absolute; left: 24px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 18px; opacity: 0.6;"></i>
                    <i class="fa-solid fa-chevron-down" style="position: absolute; right: 24px; top: 50%; transform: translateY(-50%); color: #cbd5e1; font-size: 14px; pointer-events: none;"></i>
                </div>
            </div>
            
            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 850; color: #64748b; margin-bottom: 15px; display: block;">2. Alokasi Kelas & Matakuliah</label>
                <div style="position: relative;">
                    <select name="id_kelas" class="form-control" required style="height: 60px; border-radius: 20px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 25px 0 60px; font-weight: 700; font-size: 15px; appearance: none; cursor: pointer;">
                        <option value="">-- Pilih Jadwal Kelas --</option>
                        <?php foreach($kelas->result() as $k): ?>
                            <option value="<?= $k->id_kelas ?>">KLS <?= $k->nama_kelas ?> - <?= $k->nama_mk ?> (<?= $k->nama_dosen ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fa-solid fa-chalkboard-user" style="position: absolute; left: 24px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 18px; opacity: 0.6;"></i>
                    <i class="fa-solid fa-chevron-down" style="position: absolute; right: 24px; top: 50%; transform: translateY(-50%); color: #cbd5e1; font-size: 14px; pointer-events: none;"></i>
                </div>
            </div>

            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 850; color: #64748b; margin-bottom: 15px; display: block;">3. Periode Semester Akademik</label>
                <div style="position: relative;">
                    <select name="semester" class="form-control" required style="height: 60px; border-radius: 20px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 25px 0 60px; font-weight: 700; font-size: 15px; appearance: none; cursor: pointer;">
                        <optgroup label="Semester Ganjil">
                            <option value="Ganjil 1">Ganjil - Tingkat 1</option>
                            <option value="Ganjil 3">Ganjil - Tingkat 3</option>
                            <option value="Ganjil 5">Ganjil - Tingkat 5</option>
                            <option value="Ganjil 7">Ganjil - Tingkat 7</option>
                            <option value="Ganjil 9">Ganjil - Tingkat 9</option>
                        </optgroup>
                        <optgroup label="Semester Genap">
                            <option value="Genap 2">Genap - Tingkat 2</option>
                            <option value="Genap 4">Genap - Tingkat 4</option>
                            <option value="Genap 6">Genap - Tingkat 6</option>
                            <option value="Genap 8">Genap - Tingkat 8</option>
                        </optgroup>
                    </select>
                    <i class="fa-solid fa-layer-group" style="position: absolute; left: 24px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 18px; opacity: 0.6;"></i>
                    <i class="fa-solid fa-chevron-down" style="position: absolute; right: 24px; top: 50%; transform: translateY(-50%); color: #cbd5e1; font-size: 14px; pointer-events: none;"></i>
                </div>
            </div>
            
            <div style="background: #fffbeb; border: 1px solid #fde68a; padding: 20px; border-radius: 20px; display: flex; gap: 15px; align-items: flex-start;">
                <i class="fa-solid fa-triangle-exclamation" style="color: #d97706; font-size: 20px; margin-top: 2px;"></i>
                <p style="font-size: 13px; color: #92400e; font-weight: 700; line-height: 1.5; margin: 0;">
                    <b>Catatan Penting:</b> Plotting ini bersifat mengikat. Mahasiswa hanya dapat melakukan presensi kehadiran pada jadwal kelas yang telah Anda tentukan di atas.
                </p>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: center;">
            <a href="<?= base_url('index.php/krs') ?>" class="btn" style="background: transparent; color: #ef4444; border: 2px solid #fee2e2; padding: 16px 40px; border-radius: 20px; font-weight: 800; font-size: 14px; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">BATALKAN</a>
            <button type="submit" name="submit" class="btn-submit" style="background: var(--primary); color: white; border: none; padding: 16px 50px; border-radius: 20px; font-weight: 900; font-size: 15px; letter-spacing: 0.5px; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); cursor: pointer; transition: all 0.3s; display: flex; align-items: center; gap: 12px;">
                <i class="fa-solid fa-link-slash"></i> SIMPAN PLOTTING KRS
            </button>
        </div>
    </form>
</div>

<style>
    .form-control:focus {
        border-color: var(--primary) !important;
        background: white !important;
        box-shadow: 0 0 0 5px rgba(0, 104, 116, 0.05) !important;
    }
    .btn-submit:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 104, 116, 0.3);
        opacity: 0.95;
    }
</style>
