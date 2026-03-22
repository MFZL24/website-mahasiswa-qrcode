<div class="form-container-card" style="max-width: 650px; margin: 0 auto; padding: 45px; border-radius: 40px;">
    <div class="form-section-title" style="margin-bottom: 40px;">
        <i class="fa-solid fa-calendar-plus" style="color: var(--primary);"></i> Tambah Sesi Perkuliahan
    </div>

    <div style="background: var(--primary-light); padding: 25px; border-radius: 25px; margin-bottom: 35px; border: 1px solid rgba(0, 104, 116, 0.1); display: flex; align-items: center; gap: 20px;">
        <div style="width: 50px; height: 50px; background: white; color: var(--primary); border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 4px 10px rgba(0,0,0,0.02); border: 1px solid rgba(0, 104, 116, 0.05);">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <div style="font-size: 11px; font-weight: 850; color: var(--primary); text-transform: uppercase; letter-spacing: 1px;">Mata Kuliah / Kelas Terpilih</div>
            <div style="font-weight: 800; color: #1e293b; font-size: 16px; margin-top: 2px;"><?= $kelas->nama_mk ?> <span style="color: #64748b; font-weight: 600;">(<?= $kelas->nama_kelas ?>)</span></div>
        </div>
    </div>

    <form action="<?= base_url('index.php/dosen_fitur/simpan_pertemuan') ?>" method="post">
        <input type="hidden" name="id_kelas" value="<?= $kelas->id_kelas ?>">

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 850; color: #64748b; margin-bottom: 12px; display: block;">Pertemuan Ke-</label>
                <div style="position: relative;">
                    <input type="number" name="pertemuan_ke" class="form-control" value="<?= $next_ptm ?>" required min="1" max="16" style="height: 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 20px 0 50px; font-weight: 700; font-size: 16px;">
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

            <div class="input-wrapper">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 850; color: #64748b; margin-bottom: 12px; display: block;">Jam Selesai</label>
                <div style="position: relative;">
                    <input type="time" name="jam_selesai" class="form-control" value="<?= date('H:i', strtotime('+90 minutes')) ?>" required style="height: 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 20px 0 50px; font-weight: 700; font-size: 16px;">
                    <i class="fa-solid fa-clock-rotate-left" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #f43f5e; font-size: 16px; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
        
        <div class="input-wrapper" style="margin-top: 25px;">
            <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 850; color: #64748b; margin-bottom: 12px; display: block;">Tanggal Pelaksanaan</label>
            <div style="position: relative;">
                <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>" style="height: 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 0 20px 0 50px; font-weight: 700; font-size: 16px;">
                <i class="fa-solid fa-calendar-day" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--primary); font-size: 16px; opacity: 0.6;"></i>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: flex-end;">
            <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$kelas->id_kelas) ?>" class="btn" style="background: #f1f5f9; color: #475569; border: none; padding: 15px 30px; border-radius: 18px; font-weight: 800; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">BATALKAN</a>
            <button type="submit" name="submit" class="btn-submit" style="background: var(--primary); color: white; border: none; padding: 15px 40px; border-radius: 18px; font-weight: 900; font-size: 14px; letter-spacing: 1px; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); cursor: pointer; transition: all 0.3s;">SIMPAN SESI BARU</button>
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
    @media (max-width: 768px) {
        .form-container-card { padding: 30px 20px !important; border-radius: 25px !important; }
        .form-section-title { font-size: 20px !important; margin-bottom: 30px !important; text-align: center; justify-content: center; }
        
        div[style*="background: var(--primary-light)"] { 
            flex-direction: column !important; 
            text-align: center !important; 
            padding: 20px !important; 
            gap: 15px !important; 
        }
        
        div[style*="display: grid; grid-template-columns: 1fr 1fr"] { 
            grid-template-columns: 1fr !important; 
            gap: 20px !important; 
        }
        
        div[style*="margin-top: 50px; display: flex"] { 
            flex-direction: column-reverse !important; 
            gap: 12px !important; 
        }
        div[style*="margin-top: 50px; display: flex"] .btn, 
        div[style*="margin-top: 50px; display: flex"] .btn-submit { 
            width: 100% !important; 
            padding: 16px !important; 
            justify-content: center; 
            border-radius: 15px !important;
        }
    }
</style>
