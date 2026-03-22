<?php
// Hitung sisa waktu jika QR masih aktif
$is_expired = $is_expired ?? true;
$qr_expired_ts = ($qr && isset($qr->expired_at)) ? strtotime($qr->expired_at) : 0;
$sisa_detik = $qr_expired_ts - time();
?>

<!-- Page Header -->
<div class="card-header" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-clipboard-user" style="color: var(--primary);"></i> Manajemen Absensi
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0;"><b><?= $ptm->nama_mk ?></b> — PTM ke-<?= $ptm->pertemuan_ke ?> (<?= date('d M Y', strtotime($ptm->tanggal)) ?>)</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <?php if (!$is_expired): ?>
            <a href="<?= base_url('index.php/dosen_fitur/view_qr/'.$ptm->id_pertemuan) ?>" class="btn btn-primary" style="padding: 12px 24px; border-radius: 14px; font-weight: 700; background: var(--primary); box-shadow: 0 8px 20px rgba(0, 104, 116, 0.2); border: none;">
                <i class="fa-solid fa-expand"></i> LAYAR PENUH QR
            </a>
        <?php endif; ?>
        <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$ptm->id_kelas) ?>" class="btn" style="background: white; color: #475569; border: 2px solid #f1f5f9; padding: 12px 24px; border-radius: 14px; font-weight: 700; transition: all 0.3s;" onmouseover="this.style.borderColor='#e2e8f0'; this.style.color='#1e293b'" onmouseout="this.style.borderColor='#f1f5f9'; this.style.color='#475569'">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div style="padding: 0;">

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success" style="margin-bottom: 30px; border-radius: 18px; border: none; box-shadow: 0 10px 20px rgba(5, 150, 105, 0.1);">
        <i class="fa-solid fa-circle-check"></i> <?= $this->session->flashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (!$is_expired): ?>
<!-- ============ SESI MASIH AKTIF ============ -->
<div style="background: linear-gradient(135deg, #006874 0%, #004f58 100%); border-radius: 30px; padding: 45px; color: white; margin-bottom: 35px; display: flex; flex-direction: column; align-items: center; text-align: center; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 104, 116, 0.25);">
    <div style="font-size: 56px; font-weight: 900; font-family: 'JetBrains Mono', monospace; letter-spacing: 5px; margin-bottom: 12px; text-shadow: 0 10px 20px rgba(0,0,0,0.2);" id="countdown">--:--</div>
    <div style="font-size: 14px; font-weight: 800; opacity: 0.8; text-transform: uppercase; letter-spacing: 2.5px; margin-bottom: 30px;">Sesi QR-Scanner Berjalan</div>
    
    <!-- Large Scan Monitor -->
    <?php 
        // Generate QR Image for this screen too
        if($qr) {
            include_once APPPATH . 'libraries/phpqrcode/qrlib.php';
            ob_start();
            QRcode::png($qr->token, null, QR_ECLEVEL_L, 10, 2);
            $qr_img = 'data:image/png;base64,' . base64_encode(ob_get_contents());
            ob_end_clean();
        }
    ?>
    <?php if($qr): ?>
    <div style="background: white; padding: 25px; border-radius: 35px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); margin-bottom: 30px; position: relative;">
        <img src="<?= $qr_img ?>" style="width: 200px; height: 200px; display: block; filter: contrast(1.1);">
        <div style="position: absolute; bottom: -12px; left: 50%; transform: translateX(-50%); background: #f6b553; color: #002023; padding: 5px 15px; border-radius: 10px; font-size: 11px; font-weight: 900; letter-spacing: 1px; box-shadow: 0 5px 10px rgba(0,0,0,0.1);">
            TOKEN: <?= $qr->token ?>
        </div>
    </div>
    <?php endif; ?>

    <div style="display: flex; flex-direction: column; gap: 15px; margin-top: 30px;">
        <div style="display: inline-flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 12px 25px; border-radius: 50px; font-size: 14px; font-weight: 700; border: 1px solid rgba(255,255,255,0.2);">
            <span style="width: 10px; height: 10px; background: #4ade80; border-radius: 50%; display: inline-block; animation: pulse 1.5s infinite; box-shadow: 0 0 10px #4ade80;"></span>
            Otomatis berakhir pukul <b><?= date('H:i', $qr_expired_ts) ?> WIB</b>
        </div>
        
        <a href="<?= base_url('index.php/dosen_fitur/akhiri_sesi/'.$ptm->id_pertemuan) ?>" onclick="return confirm('Akhiri sesi presensi sekarang? Seluruh mahasiswa yang belum scan akan otomatis dianggap Alpha.')" style="background: #e11d48; color: white; padding: 12px 30px; border-radius: 50px; font-size: 13px; font-weight: 900; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 10px 20px rgba(225, 29, 72, 0.2); transition: all 0.3s; width: fit-content; margin: 0 auto;">
            <i class="fa-solid fa-power-off"></i> AKHIRI SESI SEKARANG
        </a>
    </div>
    
    <i class="fa-solid fa-bolt-lightning" style="position: absolute; right: -20px; bottom: -20px; font-size: 150px; color: rgba(255,255,255,0.05); transform: rotate(-15deg);"></i>
</div>

<div class="card" style="border: none; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); padding: 35px; border: 1px solid #f1f5f9; display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: center;">
    <div>
        <h4 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-users-viewfinder" style="color: var(--primary);"></i> Monitoring Sesi
        </h4>
        <p style="color: #64748b; font-size: 14px; line-height: 1.6; font-weight: 500;">
            Halaman ini akan memuat ulang secara otomatis setiap 15 detik untuk memperbarui daftar scan. Mahasiswa yang tidak melakukan scan hingga sesi berakhir akan otomatis dicatat sebagai <b style="color: #e11d48;">ALPHA</b>.
        </p>
    </div>
    <div style="text-align: center; background: #f8fafc; padding: 25px; border-radius: 20px; border: 2px dashed #e2e8f0;">
        <div style="font-size: 48px; font-weight: 950; color: var(--primary); line-height: 1;"><?= $absensi->num_rows() ?></div>
        <div style="font-size: 12px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Hadir Terdeteksi</div>
    </div>
</div>

<div style="margin-top: 35px;">
    <h4 style="font-size: 16px; font-weight: 800; color: #475569; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; padding-left: 10px;">
        <i class="fa-solid fa-clock-rotate-left" style="opacity: 0.5;"></i> Aktivitas Terbaru
    </h4>
    
    <?php if($absensi->num_rows() > 0): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 15px;">
            <?php foreach($absensi->result() as $a): ?>
                <div style="background: white; border: 1px solid #f1f5f9; padding: 18px; border-radius: 20px; display: flex; align-items: center; gap: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.02); animation: fadeInUp 0.4s ease-out; opacity: 0.9;">
                    <div style="width: 44px; height: 44px; min-width: 44px; background: var(--primary-light); color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 18px;">
                        <?= strtoupper(substr($a->nama, 0, 1)) ?>
                    </div>
                    <div style="overflow: hidden;">
                        <div style="font-size: 14px; font-weight: 800; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $a->nama ?></div>
                        <div style="font-size: 11px; color: #64748b; font-family: 'JetBrains Mono', monospace; font-weight: 700; margin-top: 2px;"><?= $a->nim ?></div>
                    </div>
                    <div style="margin-left: auto; color: #10b981; font-size: 14px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 60px; background: white; border-radius: 25px; border: 2px dashed #f1f5f9;">
            <i class="fa-solid fa-hourglass-start" style="font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 15px;"></i>
            <p style="font-size: 14px; font-weight: 700; color: #94a3b8;">Belum ada data scan masuk.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    const expiredAt = <?= $qr_expired_ts * 1000 ?>;
    function updateCountdown() {
        const diff = expiredAt - Date.now();
        if (diff <= 0) {
            document.getElementById('countdown').textContent = '00:00';
            setTimeout(() => location.reload(), 1500);
            return;
        }
        const m = Math.floor(diff / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        document.getElementById('countdown').textContent = String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
        setTimeout(updateCountdown, 1000);
    }
    updateCountdown();
    setTimeout(() => location.reload(), 15000);
</script>

<?php else: ?>
<!-- ============ SESI SUDAH HABIS ============ -->

<?php
    $total = $absensi->num_rows();
    $hadir = 0; $alpa = 0; $sakit = 0; $izin = 0;
    $rows = $absensi->result();
    foreach($rows as $r) {
        if($r->status == 'Hadir') $hadir++;
        elseif($r->status == 'Sakit') $sakit++;
        elseif($r->status == 'Izin') $izin++;
        else $alpa++;
    }
?>

<!-- Statistics Panel -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 35px;">
    <div style="background: white; border: 1px solid #f1f5f9; border-radius: 25px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
        <div style="width: 45px; height: 45px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: #64748b; font-size: 20px;">
            <i class="fa-solid fa-users"></i>
        </div>
        <div style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $total ?></div>
        <div style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-top: 8px;">Daftar Kelas</div>
    </div>
    <div style="background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 25px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.05);">
        <div style="width: 45px; height: 45px; background: #dcfce7; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: #16a34a; font-size: 20px;">
            <i class="fa-solid fa-check-double"></i>
        </div>
        <div style="font-size: 32px; font-weight: 950; color: #166534; line-height: 1;"><?= $hadir ?></div>
        <div style="font-size: 11px; font-weight: 800; color: #15803d; text-transform: uppercase; letter-spacing: 1px; margin-top: 8px;">Hadir</div>
    </div>
    <div style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 25px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.05);">
        <div style="width: 45px; height: 45px; background: #dbeafe; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: #2563eb; font-size: 20px;">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        <div style="font-size: 32px; font-weight: 950; color: #1e40af; line-height: 1;"><?= $sakit + $izin ?></div>
        <div style="font-size: 11px; font-weight: 800; color: #2563eb; text-transform: uppercase; letter-spacing: 1px; margin-top: 8px;">Izin / Sakit</div>
    </div>
    <div style="background: #fff1f2; border: 1px solid #ffe4e6; border-radius: 25px; padding: 25px; text-align: center; box-shadow: 0 4px 15px rgba(225, 29, 72, 0.05);">
        <div style="width: 45px; height: 45px; background: #ffe4e6; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: #e11d48; font-size: 20px;">
            <i class="fa-solid fa-user-xmark"></i>
        </div>
        <div style="font-size: 32px; font-weight: 950; color: #9f1239; line-height: 1;"><?= $alpa ?></div>
        <div style="font-size: 11px; font-weight: 800; color: #be123c; text-transform: uppercase; letter-spacing: 1px; margin-top: 8px;">Alpha</div>
    </div>
</div>

<!-- Info Banner -->
<div class="alert" style="background: #fffbeb; color: #92400e; border: 1px solid #fde68a; padding: 18px 25px; border-radius: 20px; font-size: 14px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;">
    <i class="fa-solid fa-pen-nib" style="font-size: 20px; opacity: 0.7;"></i>
    <p style="margin: 0; font-weight: 600;">Sesi absensi telah berakhir. Anda masih dapat memperbarui status kehadiran mahasiswa secara manual di tabel bawah jika diperlukan.</p>
</div>

<!-- Attendance Table Card -->
<div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-radius: 25px; overflow: hidden; padding: 0;">
    <div class="table-container" style="margin-top: 0; border: none; border-radius: 0;">
        <table style="width: 100%;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th width="70" style="padding-left: 30px; text-align: center;">#</th>
                    <th>Mahasiswa / Identitas</th>
                    <th style="text-align: center;">Profil</th>
                    <th style="text-align: center; width: 140px;">Waktu Presensi</th>
                    <th style="text-align: center; width: 140px;">Status Akumulasi</th>
                    <th style="text-align: center; width: 220px; padding-right: 30px;">Tindakan Manual</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($rows as $a): 
                    $status = $a->status ?: 'Alpha';
                    $badge_class = 'badge-danger'; 
                    $icon = 'fa-user-xmark';
                    if($status == 'Hadir') { $badge_class = 'badge-success'; $icon = 'fa-circle-check'; }
                    elseif($status == 'Izin') { $badge_class = 'badge-primary'; $icon = 'fa-share-from-square'; }
                    elseif($status == 'Sakit') { $badge_class = 'badge-warning'; $icon = 'fa-briefcase-medical'; }
                ?>
                <tr>
                    <td style="padding-left: 30px; text-align: center; font-weight: 700; color: #94a3b8;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-weight: 800; color: #1e293b; font-size: 15px;"><?= $a->nama ?></div>
                        <div style="font-size: 12px; color: #64748b; font-family: 'JetBrains Mono', monospace; font-weight: 700; margin-top: 2px;"><?= $a->nim ?></div>
                    </td>
                    <td style="text-align: center;">
                        <div style="width: 36px; height: 36px; background: #f1f5f9; color: #475569; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; border: 1px solid #e2e8f0;">
                            <?= strtoupper(substr($a->nama, 0, 1)) ?>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <?php if($a->waktu_absen && $a->status == 'Hadir'): ?>
                            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; color: #475569; font-weight: 700; font-size: 13px;">
                                <i class="fa-regular fa-clock" style="color: #94a3b8;"></i> <?= date('H:i', strtotime($a->waktu_absen)) ?>
                            </div>
                        <?php else: ?>
                            <span style="color: #cbd5e1; font-size: 14px;">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge <?= $badge_class ?>" style="padding: 8px 14px; border-radius: 10px;">
                            <i class="fa-solid <?= $icon ?>" style="font-size: 10px;"></i> <?= $status ?>
                        </span>
                    </td>
                    <td style="padding-right: 30px; text-align: center;">
                        <form action="<?= base_url('index.php/dosen_fitur/update_status') ?>" method="post" style="display: flex; gap: 8px; justify-content: flex-end;">
                            <input type="hidden" name="id_pertemuan" value="<?= $ptm->id_pertemuan ?>">
                            <input type="hidden" name="nim" value="<?= $a->nim ?>">
                            <button type="submit" name="status" value="Hadir" class="btn-tool" title="Set Hadir" style="background: #10b981; color: white; border: none; width: 34px; height: 34px; border-radius: 10px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-check"></i></button>
                            <button type="submit" name="status" value="Sakit" class="btn-tool" title="Set Sakit" style="background: #f59e0b; color: white; border: none; width: 34px; height: 34px; border-radius: 10px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-briefcase-medical"></i></button>
                            <button type="submit" name="status" value="Izin" class="btn-tool" title="Set Izin" style="background: #3b82f6; color: white; border: none; width: 34px; height: 34px; border-radius: 10px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-envelope"></i></button>
                            <button type="submit" name="status" value="Alpha" class="btn-tool" title="Set Alpha" style="background: #e11d48; color: white; border: none; width: 34px; height: 34px; border-radius: 10px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($rows)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 100px 30px;">
                        <div style="background: #f8fafc; width: 100px; height: 100px; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fa-solid fa-users-slash" style="font-size: 45px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 800; color: #475569; margin-bottom: 8px;">Daftar Kosong</h4>
                        <p style="color: #94a3b8; font-size: 14px; max-width: 350px; margin: 0 auto; line-height: 1.6;">Tidak ada mahasiswa yang terdaftar di kelas ini untuk diproses.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-tool:hover {
        transform: scale(1.15);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        filter: brightness(1.1);
    }
    @keyframes pulse { 
        0%, 100% { opacity: 1; transform: scale(1); } 
        50% { opacity: 0.5; transform: scale(0.9); } 
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 0.9; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .card-header { text-align: center; justify-content: center !important; }
        .card-header h3 { font-size: 20px !important; justify-content: center; }
        .card-header div[style*="display: flex; gap: 10px"] { width: 100%; justify-content: center; }
        
        div[style*="background: linear-gradient"] { padding: 30px 20px !important; }
        #countdown { font-size: 42px !important; }
        
        div[style*="display: grid; grid-template-columns: 2fr 1fr"] { 
            grid-template-columns: 1fr !important; 
            padding: 25px !important;
            text-align: center;
        }
        div[style*="display: grid; grid-template-columns: 2fr 1fr"] > div:first-child h4 { justify-content: center; }
        
        div[style*="display: grid; grid-template-columns: repeat(4, 1fr)"] { 
            grid-template-columns: repeat(2, 1fr) !important; 
            gap: 15px !important;
        }
        
        .table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-container table { min-width: 850px; }
        
        .alert { flex-direction: column; text-align: center; }
    }
</style>

<?php endif; ?>
</div>
