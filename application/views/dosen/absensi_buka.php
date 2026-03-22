<!-- Page Header -->
<div class="card-header" style="padding: 0; background: transparent; border: none; margin-bottom: 45px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 32px; font-weight: 950; color: #1e293b; display: flex; align-items: center; gap: 15px; letter-spacing: -1.5px; margin: 0;">
            <i class="fa-solid fa-qrcode" style="color: var(--primary);"></i> Aktivasi Presensi Digital
        </h3>
        <p style="color: #64748b; font-size: 16px; margin-top: 5px; font-weight: 500;">Pilih kelas perkuliahan hari ini untuk memulai sesi pemindaian QR-Code.</p>
    </div>
</div>

<!-- Instruction Banner -->
<div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1.5px solid #bbf7d0; padding: 30px; border-radius: 30px; margin-bottom: 45px; display: flex; align-items: flex-start; gap: 20px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.05);">
    <div style="width: 55px; height: 55px; background: white; color: #16a34a; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        <i class="fa-solid fa-wand-magic-sparkles"></i>
    </div>
    <div style="flex: 1;">
        <h4 style="color: #166534; font-weight: 900; font-size: 18px; margin-bottom: 5px; letter-spacing: -0.5px;">Panel Kontrol Presensi</h4>
        <p style="color: #15803d; font-size: 15px; line-height: 1.6; margin: 0; font-weight: 600;">
            Klik <b style="color: #166534;">"Kelola Sesi Pertemuan"</b> pada salah satu kelas di bawah, lalu pilih (atau buat baru) pertemuan untuk mengaktifkan kode QR bagi mahasiswa Anda.
        </p>
    </div>
</div>

<!-- Class Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 30px;">
    <?php foreach($kelas->result() as $k): ?>
    <div class="class-presensi-card" style="background: white; border-radius: 40px; border: 2.5px solid #f1f5f9; padding: 40px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative; overflow: hidden; display: flex; flex-direction: column;">
        
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px;">
            <div style="background: #eff6ff; color: #2563eb; padding: 8px 18px; border-radius: 12px; font-size: 11px; font-weight: 900; border: 1.5px solid #dbeafe; text-transform: uppercase; letter-spacing: 0.5px;">
                Kelas <?= $k->nama_kelas ?>
            </div>
            <div style="width: 50px; height: 50px; background: #f8fafc; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 24px; border: 1.5px solid #f1f5f9;">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <h3 style="font-size: 22px; font-weight: 950; color: #1e293b; margin-bottom: 12px; line-height: 1.3; min-height: 58px;"><?= $k->nama_mk ?></h3>
        
        <div style="display: flex; items-center; gap: 15px; margin-bottom: 35px; background: #f8fafc; padding: 15px 20px; border-radius: 20px; border: 1.5px solid #f1f5f9;">
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <span style="font-size: 9px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">JADWAL</span>
                <span style="font-size: 13px; font-weight: 800; color: #475569; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-regular fa-calendar-check" style="color: var(--primary); font-size: 14px;"></i> <?= $k->hari ?>
                </span>
            </div>
            <div style="width: 1.5px; background: #e2e8f0; height: 35px;"></div>
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <span style="font-size: 9px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">WAKTU</span>
                <span style="font-size: 13px; font-weight: 900; color: #475569; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-regular fa-clock" style="color: var(--primary); font-size: 14px;"></i> <?= substr($k->jam_mulai,0,5) ?> WIB
                </span>
            </div>
        </div>

        <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$k->id_kelas) ?>" class="btn-activate-class" style="width: 100%; height: 62px; background: #0f172a; color: white; border-radius: 20px; font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 12px; transition: all 0.3s; box-shadow: 0 10px 20px rgba(15, 23, 42, 0.15);">
            Keloa Sesi Pertemuan <i class="fa-solid fa-arrow-right-long"></i>
        </a>
    </div>
    <?php endforeach; ?>
    
    <?php if($kelas->num_rows() == 0): ?>
    <div style="grid-column: 1/-1; text-align: center; padding: 120px 50px; background: #f8fafc; border-radius: 40px; border: 3px dashed #f1f5f9;">
        <div style="width: 100px; height: 100px; background: white; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02);">
            <i class="fa-solid fa-calendar-xmark" style="font-size: 45px; color: #cbd5e1;"></i>
        </div>
        <h4 style="font-size: 22px; font-weight: 950; color: #475569; margin-bottom: 10px;">Jadwal Tidak Ditemukan</h4>
        <p style="color: #94a3b8; font-size: 16px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Anda belum memiliki jadwal mengajar aktif yang terdaftar di portofolio akademik semester ini.</p>
    </div>
    <?php endif; ?>
</div>

<style>
    .class-presensi-card:hover { 
        transform: translateY(-12px); 
        box-shadow: 0 30px 60px -15px rgba(0,0,0,0.1); 
        border-color: var(--primary-light); 
    }
    .btn-activate-class:hover {
        background: var(--primary) !important;
        transform: scale(1.02);
        box-shadow: 0 15px 30px rgba(0, 104, 116, 0.2) !important;
    }
    .class-presensi-card { animation: fadeInUp 0.5s ease-out forwards; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .card-header { text-align: center; justify-content: center !important; margin-bottom: 30px !important; }
        .card-header h3 { font-size: 24px !important; justify-content: center; }
        .card-header p { font-size: 14px !important; }
        
        div[style*="background: linear-gradient"] { 
            padding: 20px !important; 
            border-radius: 20px !important; 
            flex-direction: column !important; 
            align-items: center !important; 
            text-align: center !important; 
            margin-bottom: 30px !important;
        }
        
        .class-presensi-card { 
            padding: 25px !important; 
            border-radius: 25px !important; 
        }
        .class-presensi-card h3 { font-size: 18px !important; min-height: auto !important; margin-bottom: 20px !important; }
        
        div[style*="display: flex; items-center"] { 
            flex-direction: column !important; 
            gap: 15px !important; 
            padding: 15px !important; 
        }
        div[style*="width: 1.5px"] { display: none; }
        .btn-activate-class { height: 55px !important; font-size: 13px !important; border-radius: 15px !important; }
    }
</style>
