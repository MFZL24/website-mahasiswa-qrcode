<?php
$foto = $this->session->userdata('foto');
$img_src = (strpos($foto, 'http') === 0) ? $foto : base_url('assets/img/profile/').($foto ? $foto : 'default.png');
?>

<!-- Header Section -->
<div class="card-header" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-house-chimney-user" style="color: var(--primary);"></i> Portal Mahasiswa
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0;">Selamat datang kembali di sistem administrasi presensi akademik.</p>
    </div>
    <div style="font-size: 14px; color: #94a3b8; font-weight: 700; display: flex; align-items: center; gap: 10px; background: white; padding: 10px 20px; border-radius: 14px; border: 1px solid #f1f5f9;">
        <i class="fa-solid fa-calendar-day" style="color: var(--primary);"></i> <?= date('l, d M Y') ?>
    </div>
</div>

<!-- Premium Hero Identity -->
<div class="hero-identity" style="background: linear-gradient(135deg, #006874 0%, #004f58 100%); border-radius: 35px; padding: 40px; color: white; margin-bottom: 40px; position: relative; overflow: hidden; box-shadow: 0 25px 50px rgba(0, 104, 116, 0.25);">
    <div style="position: relative; z-index: 2; display: flex; align-items: center; gap: 30px; flex-wrap: wrap;">
        <!-- Avatar Presence -->
        <div style="position: relative; margin: 0 auto;">
            <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); padding: 8px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                <img src="<?= $img_src ?>" style="width: 110px; height: 110px; border-radius: 25px; object-fit: cover; border: 3px solid white;">
            </div>
            <div style="position: absolute; bottom: 5px; right: 5px; width: 20px; height: 20px; background: #4ade80; border-radius: 50%; border: 4px solid #005a64;"></div>
        </div>

        <div style="flex: 1; min-width: 280px; text-align: left;" class="m-center">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; flex-wrap: wrap;" class="j-center">
                <span style="background: rgba(246, 181, 83, 0.15); color: #f6b553; padding: 6px 14px; border-radius: 50px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; border: 1px solid rgba(246, 181, 83, 0.2);">
                    AKADEMIK AKTIF
                </span>
                <?php if($pending_krs > 0): ?>
                    <span style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; padding: 6px 14px; border-radius: 50px; font-size: 10px; font-weight: 800; border: 1px solid rgba(245, 158, 11, 0.2);">
                        KRS PENDING (<?= $pending_krs ?>)
                    </span>
                <?php endif; ?>
                <?php if($approved_krs > 0): ?>
                    <span style="background: rgba(16, 185, 129, 0.15); color: #10b981; padding: 6px 14px; border-radius: 50px; font-size: 10px; font-weight: 800; border: 1px solid rgba(16, 185, 129, 0.2);">
                        KRS OK (<?= $approved_krs ?>)
                    </span>
                <?php endif; ?>
            </div>
            <h2 style="color: white; margin-bottom: 10px; font-size: 32px; font-weight: 950; letter-spacing: -1px; line-height: 1.1;">Hello, <?= explode(' ', $mhs->nama)[0] ?>!</h2>
            <div style="display: flex; align-items: center; gap: 15px; opacity: 0.9; font-weight: 700; font-size: 14px; flex-wrap: wrap;" class="j-center">
                <span>NIM: <?= $mhs->nim ?></span>
                <span class="m-hide" style="width: 1px; height: 12px; background: rgba(255,255,255,0.2);"></span>
                <span><?= $mhs->prodi ?></span>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .hero-identity { padding: 30px 20px !important; text-align: center; }
        .m-center { text-align: center !important; }
        .j-center { justify-content: center !important; }
        .m-hide { display: none; }
    }
</style>
            <?php if($approved_krs > 0): ?>
            <a href="<?= base_url('index.php/mhs_fitur/scan') ?>" class="btn-scan" style="background: #f6b553; color: #002023; padding: 22px 35px; border-radius: 22px; font-weight: 900; font-size: 16px; border: none; box-shadow: 0 15px 40px rgba(246, 181, 83, 0.4); text-decoration: none; display: inline-flex; align-items: center; gap: 15px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                <i class="fa-solid fa-qrcode" style="font-size: 24px;"></i> 
                <span style="display: flex; flex-direction: column; align-items: flex-start; line-height: 1;">
                    <span style="font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px; opacity: 0.7;">Siap Scan?</span>
                    ABSEN SEKARANG
                </span>
            </a>
            <?php else: ?>
            <div style="background: rgba(255,255,255,0.1); border: 1.5px dashed rgba(255,255,255,0.3); padding: 20px 30px; border-radius: 25px; color: white; display: flex; align-items: center; gap: 15px; max-width: 300px;">
                <i class="fa-solid fa-lock" style="font-size: 20px; opacity: 0.6;"></i>
                <div style="font-size: 12px; font-weight: 700; line-height: 1.4;">Scan Absensi belum tersedia. KRS Anda harus disetujui Admin terlebih dahulu.</div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Decorative Element -->
    <i class="fa-solid fa-scroll" style="position: absolute; right: -40px; bottom: -40px; font-size: 250px; color: rgba(255,255,255,0.04); z-index: 1; transform: rotate(-15deg);"></i>
</div>

<!-- KRS Approval Success Banner -->
<?php if($approved_krs > 0 && $this->session->userdata('role') == 'mahasiswa'): ?>
    <div style="background: #ecfdf5; border: 1.5px solid #d1fae5; padding: 20px 30px; border-radius: 22px; margin-bottom: 35px; display: flex; align-items: center; gap: 20px; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.05);">
        <div style="width: 45px; height: 45px; background: #10b981; color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <h5 style="margin: 0; color: #065f46; font-size: 15px; font-weight: 900;">Administrasi Berhasil Divalidasi!</h5>
            <p style="margin: 2px 0 0; color: #047857; font-size: 13px; font-weight: 600;">Data Rencana Studi Anda (KRS) telah disetujui oleh Admin. Silakan cek menu <a href="<?= base_url('index.php/mhs_fitur/jadwal') ?>" style="color: #10b981; font-weight: 800;">Jadwal Kuliah</a>.</p>
        </div>
    </div>
<?php endif; ?>

<!-- Main Dashboard Body -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 35px;">
    
    <!-- Left Column: Attendance Log -->
    <div style="display: flex; flex-direction: column; gap: 30px;">
        <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-radius: 30px; overflow: hidden; padding: 0;">
            <div class="card-header" style="background: #fafbfc; padding: 30px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                <h3 class="card-title" style="margin: 0; font-size: 19px; font-weight: 850; color: #1e293b; display: flex; align-items: center; gap: 12px;">
                    <i class="fa-solid fa-clock-rotate-left" style="color: #94a3b8;"></i> Riwayat Kehadiran Terbaru
                </h3>
            </div>

            <div class="table-container" style="margin-top: 0; border: none; border-radius: 0;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="70" style="padding-left: 30px; text-align: center;">#</th>
                            <th>Mata Kuliah & Sesi</th>
                            <th style="text-align: center;">Pertemuan</th>
                            <th style="text-align: center;">Waktu / Tanggal</th>
                            <th width="120" style="padding-right: 30px; text-align: right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($riwayat->result() as $r) { ?>
                        <tr>
                            <td style="padding-left: 30px; text-align: center; font-weight: 800; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                            <td>
                                <div style="font-weight: 850; color: #1e293b; font-size: 15px; letter-spacing: -0.2px;"><?= $r->nama_mk ?></div>
                                <div style="font-size: 11px; color: #94a3b8; font-weight: 800; text-transform: uppercase; margin-top: 2px;">KODE: <?= $r->kode_mk ?></div>
                            </td>
                            <td style="text-align: center;">
                                <span style="background: #f1f5f9; color: #475569; padding: 8px 15px; border-radius: 12px; font-size: 12px; font-weight: 900; border: 1px solid #e2e8f0;">
                                    PTM <?= $r->pertemuan_ke ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?php if($r->waktu_absen && $r->status == 'Hadir'): ?>
                                    <div style="font-weight: 850; color: #475569; font-size: 14px;"><?= date('H:i', strtotime($r->waktu_absen)) ?> <span style="font-size: 10px; opacity: 0.5;">WIB</span></div>
                                <?php else: ?>
                                    <div style="font-weight: 850; color: #cbd5e1; font-size: 14px;">—</div>
                                <?php endif; ?>
                                <div style="font-size: 11px; color: #94a3b8; font-weight: 700; margin-top: 2px;"><?= date('d M Y', strtotime($r->tanggal)) ?></div>
                            </td>
                            <td style="padding-right: 30px; text-align: right;">
                                <?php if($r->status == 'Hadir'): ?>
                                    <span style="background: #ecfdf5; color: #059669; padding: 8px 16px; border-radius: 12px; border: 1px solid #d1fae5; font-size: 12px; font-weight: 900; display: inline-flex; align-items: center; gap: 8px;">
                                        <i class="fa-solid fa-circle-check"></i> HADIR
                                    </span>
                                <?php else: ?>
                                    <span style="background: #fff1f2; color: #e11d48; padding: 8px 16px; border-radius: 12px; border: 1px solid #ffe4e6; font-size: 12px; font-weight: 900; display: inline-flex; align-items: center; gap: 8px;">
                                        <i class="fa-solid fa-circle-xmark"></i> TERLAMBAT
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <?php if($riwayat->num_rows() == 0): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 120px 30px;">
                                <div style="background: #f8fafc; width: 100px; height: 100px; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                                    <i class="fa-solid fa-calendar-xmark" style="font-size: 45px; color: #cbd5e1;"></i>
                                </div>
                                <h4 style="font-size: 20px; font-weight: 850; color: #475569; margin-bottom: 8px;">Riwayat Masih Kosong</h4>
                                <p style="color: #94a3b8; font-size: 14px; max-width: 350px; margin: 0 auto; line-height: 1.6;">Lakukan scan QR-Code di setiap sesi perkuliahan untuk mencatat kehadiran Anda di sistem.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column: Stats & Profile Quick Info -->
    <div style="display: flex; flex-direction: column; gap: 30px;">
        <!-- Stats Card -->
        <div class="card" style="border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.03); border-radius: 30px; padding: 30px; background: white;">
            <h4 style="font-size: 16px; font-weight: 850; color: #1e293b; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-chart-simple" style="color: var(--primary);"></i> Performa Kehadiran
            </h4>
            
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div style="background: #f0fdf4; padding: 20px; border-radius: 20px; border: 1px solid #dcfce7;">
                    <div style="font-size: 10px; font-weight: 850; color: #16a34a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Total Kehadiran</div>
                    <div style="font-size: 28px; font-weight: 950; color: #166534; line-height: 1;"><?= $riwayat->num_rows() ?> <span style="font-size: 14px; font-weight: 800; opacity: 0.6;">Sesi</span></div>
                </div>

                <div style="background: #fffbeb; padding: 20px; border-radius: 20px; border: 1px solid #fde68a;">
                    <div style="font-size: 10px; font-weight: 850; color: #d97706; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Rasio Kehadiran</div>
                    <div style="font-size: 28px; font-weight: 950; color: #92400e; line-height: 1;">100 <span style="font-size: 14px; font-weight: 800; opacity: 0.6;">%</span></div>
                </div>

                <div style="background: #f8fafc; padding: 25px; border-radius: 25px; border: 1px solid #f1f5f9; text-align: center; margin-top: 10px;">
                    <div style="width: 60px; height: 60px; background: white; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: #cbd5e1; font-size: 24px; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                        <i class="fa-solid fa-medal"></i>
                    </div>
                    <h5 style="font-size: 14px; font-weight: 850; color: #475569; margin-bottom: 5px;">Status: Mahasiswa Teladan</h5>
                    <p style="font-size: 11px; color: #94a3b8; font-weight: 700;">Pertahankan performa kehadiran Anda semester ini.</p>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="<?= base_url('index.php/mhs_fitur/jadwal') ?>" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 25px; border-radius: 20px; text-decoration: none; border: 1px solid #f1f5f9; box-shadow: 0 5px 15px rgba(0,0,0,0.01); transition: all 0.3s;" onmouseover="this.style.transform='translateX(8px)'; this.style.borderColor='var(--primary)'" onmouseout="this.style.transform='translateX(0)'; this.style.borderColor='#f1f5f9'">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 40px; height: 40px; background: #eef2ff; color: #4f46e5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <span style="font-weight: 800; color: #475569; font-size: 14px;">Jadwal Perkuliahan</span>
                </div>
                <i class="fa-solid fa-chevron-right" style="font-size: 12px; color: #cbd5e1;"></i>
            </a>
            <a href="<?= base_url('index.php/mhs_fitur/krs') ?>" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 25px; border-radius: 20px; text-decoration: none; border: 1px solid #f1f5f9; box-shadow: 0 5px 15px rgba(0,0,0,0.01); transition: all 0.3s;" onmouseover="this.style.transform='translateX(8px)'; this.style.borderColor='var(--primary)'" onmouseout="this.style.transform='translateX(0)'; this.style.borderColor='#f1f5f9'">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 40px; height: 40px; background: #fdf2f8; color: #db2777; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <span style="font-weight: 800; color: #475569; font-size: 14px;">Status KRS</span>
                </div>
                <i class="fa-solid fa-chevron-right" style="font-size: 12px; color: #cbd5e1;"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .btn-scan:hover {
        transform: scale(1.05) translateY(-5px);
        box-shadow: 0 25px 60px rgba(246, 181, 83, 0.5) !important;
        filter: brightness(1.05);
    }
    tr:hover td { background: #fafbfc; }
</style>