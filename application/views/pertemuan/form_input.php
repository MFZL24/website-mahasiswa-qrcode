<div class="form-container-card" style="max-width: 700px; margin: 0 auto; padding: 45px; border-radius: 40px;">
    <div class="form-section-title" style="margin-bottom: 40px; display: flex; align-items: center; justify-content: center; text-align: center; flex-direction: column; gap: 15px;">
        <div style="width: 70px; height: 70px; background: var(--primary-light); color: var(--primary); border-radius: 22px; display: flex; align-items: center; justify-content: center; font-size: 32px; box-shadow: 0 8px 20px rgba(0, 104, 116, 0.1);">
            <i class="fa-solid fa-calendar-plus"></i>
        </div>
        <div>
            <h3 style="font-size: 24px; font-weight: 900; color: #1e293b; letter-spacing: -0.5px;">Buka Sesi Presensi Global</h3>
            <p style="font-size: 14px; color: #64748b; font-weight: 600; margin-top: 5px;">Admin dapat membuka sesi presensi manual untuk kelas tertentu.</p>
        </div>
    </div>

    <form action="<?= base_url('index.php/pertemuan/tambah') ?>" method="post">
        <div style="display: flex; flex-direction: column; gap: 30px;">
            
            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 850; color: #64748b; margin-bottom: 15px; display: block;">1. Target Kelas & Matakuliah</label>
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

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                <div class="input-wrapper">
                    <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 850; color: #64748b; margin-bottom: 12px; display: block;">Pertemuan Ke-</label>
                    <div style="position: relative;">
                        <input type="number" name="pertemuan_ke" class="form-control" placeholder="1-16" required min="1" max="16" style="height: 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 20px 0 50px; font-weight: 700; font-size: 16px;">
                        <i class="fa-solid fa-hashtag" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 16px; opacity: 0.6;"></i>
                    </div>
                </div>
                
                <div class="input-wrapper">
                    <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 850; color: #64748b; margin-bottom: 12px; display: block;">Jam Mulai</label>
                    <div style="position: relative;">
                        <input type="time" name="jam_mulai" class="form-control" value="<?= date('H:i') ?>" required style="height: 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 20px 0 50px; font-weight: 700; font-size: 16px;">
                        <i class="fa-solid fa-clock" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 16px; opacity: 0.6;"></i>
                    </div>
                </div>
            </div>
            
            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 850; color: #64748b; margin-bottom: 12px; display: block;">Tanggal Pelaksanaan</label>
                <div style="position: relative;">
                    <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>" style="height: 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 20px 0 50px; font-weight: 700; font-size: 16px;">
                    <i class="fa-solid fa-calendar-day" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 16px; opacity: 0.6;"></i>
                </div>
            </div>

            <div style="background: var(--primary-light); border: 1px solid rgba(0, 104, 116, 0.1); padding: 20px; border-radius: 20px; display: flex; gap: 15px; align-items: flex-start;">
                <i class="fa-solid fa-circle-info" style="color: var(--primary); font-size: 20px; margin-top: 2px;"></i>
                <p style="font-size: 13px; color: #004f58; font-weight: 700; line-height: 1.5; margin: 0;">
                    <b>Informasi:</b> Sesi yang dibuat secara manual oleh admin tidak akan otomatis men-generate token QR kecuali diakses melalui panel dosen yang bersangkutan.
                </p>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: center;">
            <a href="<?= base_url('index.php/pertemuan') ?>" class="btn" style="background: transparent; color: #ef4444; border: 2px solid #fee2e2; padding: 16px 40px; border-radius: 20px; font-weight: 800; font-size: 14px; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">BATALKAN</a>
            <button type="submit" name="submit" class="btn-submit" style="background: var(--primary); color: white; border: none; padding: 16px 50px; border-radius: 20px; font-weight: 900; font-size: 15px; letter-spacing: 0.5px; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); cursor: pointer; transition: all 0.3s; display: flex; align-items: center; gap: 12px;">
                <i class="fa-solid fa-calendar-check"></i> SIMPAN SESI GLOBAL
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
