<!-- Page Header -->
<div class="card-header" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-clipboard-user" style="color: var(--primary);"></i> Monitoring Kehadiran (Admin)
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0;">Laporan detil presensi mahasiswa untuk sesi perkuliahan tertentu.</p>
    </div>
    <a href="<?= base_url('index.php/pertemuan') ?>" class="btn" style="background: white; color: #475569; border: 2px solid #f1f5f9; padding: 12px 24px; border-radius: 14px; font-weight: 700; transition: all 0.3s; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='#f1f5f9'; this.style.color='#475569'">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Rekap
    </a>
</div>

<!-- Info Pertemuan Box -->
<div style="background: white; padding: 35px; border-radius: 35px; border: 1px solid #f1f5f9; margin-bottom: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); position: relative; overflow: hidden;">
    <div style="grid-column: span 2;">
        <span style="font-size: 11px; font-weight: 850; color: var(--primary); text-transform: uppercase; letter-spacing: 1.5px;">Mata Kuliah / Sesi</span>
        <h2 style="margin: 8px 0 0; color: #1e293b; font-size: 24px; font-weight: 900; letter-spacing: -0.5px;"><?= $ptm->nama_mk ?> <span style="color: #cbd5e1; font-weight: 600;">|</span> <span style="color: var(--primary);">Pertemuan <?= $ptm->pertemuan_ke ?></span></h2>
    </div>
    <div>
        <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Kelas & Ruang</span>
        <p style="margin: 8px 0 0; color: #475569; font-weight: 800; font-size: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-door-open" style="color: var(--primary); opacity: 0.6;"></i> <?= $ptm->nama_kelas ?>
        </p>
    </div>
    <div>
        <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Tanggal & Waktu</span>
        <p style="margin: 8px 0 0; color: #475569; font-weight: 800; font-size: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-regular fa-calendar-check" style="color: var(--primary); opacity: 0.6;"></i> <?= date('d M Y', strtotime($ptm->tanggal)) ?>
        </p>
    </div>
    <div style="background: var(--primary-light); padding: 20px; border-radius: 20px; text-align: center; border: 1px solid rgba(0, 104, 116, 0.1);">
        <span style="font-size: 10px; font-weight: 850; color: var(--primary); text-transform: uppercase; letter-spacing: 1px;">Total Hadir</span>
        <div style="font-size: 28px; font-weight: 950; color: var(--primary); line-height: 1; margin-top: 5px;"><?= $absensi->num_rows() ?> <small style="font-size: 13px; font-weight: 700;">MHS</small></div>
    </div>
    <i class="fa-solid fa-chart-line" style="position: absolute; right: -25px; top: -25px; font-size: 150px; color: rgba(0, 104, 116, 0.03); transform: rotate(15deg);"></i>
</div>

<!-- Table Card -->
<div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-radius: 25px; overflow: hidden; padding: 0;">
    <div class="table-container" style="margin-top: 0; border: none; border-radius: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #fafbfc;">
                    <th width="80" style="padding-left: 35px; text-align: center;">#</th>
                    <th width="180">NIM / ID</th>
                    <th>Nama Lengkap Mahasiswa</th>
                    <th width="200" style="text-align: center;">Waktu Presensi</th>
                    <th width="140" style="padding-right: 35px; text-align: right;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($absensi->result() as $a): ?>
                <tr>
                    <td style="padding-left: 35px; text-align: center; font-weight: 850; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-family: 'JetBrains Mono', monospace; font-weight: 800; color: var(--primary); font-size: 14px;">
                            <?= $a->nim ?>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; background: #f8fafc; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-weight: 800; font-size: 13px; border: 1px solid #f1f5f9;">
                                <?= strtoupper(substr($a->nama_mhs, 0, 1)) ?>
                            </div>
                            <div style="font-weight: 800; color: #1e293b; font-size: 15px;"><?= $a->nama_mhs ?></div>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-size: 13px; color: #64748b; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="fa-regular fa-clock" style="color: var(--primary); opacity: 0.6;"></i> <?= date('H:i:s', strtotime($a->waktu_absen)) ?> <span style="font-size: 10px; opacity: 0.5;">WIB</span>
                        </span>
                    </td>
                    <td style="padding-right: 35px; text-align: right;">
                        <?php 
                            $status = strtoupper($a->status);
                            $bg = '#ecfdf5'; $color = '#059669'; $border = '#d1fae5'; $icon = 'fa-circle-check';
                            if($status == 'SAKIT') { $bg = '#fffbeb'; $color = '#92400e'; $border = '#fde68a'; $icon = 'fa-briefcase-medical'; }
                            elseif($status == 'IZIN') { $bg = '#eff6ff'; $color = '#2563eb'; $border = '#dbeafe'; $icon = 'fa-envelope-open-text'; }
                            elseif($status == 'ALPHA') { $bg = '#fff1f2'; $color = '#e11d48'; $border = '#ffe4e6'; $icon = 'fa-circle-xmark'; }
                        ?>
                        <span class="badge" style="background: <?= $bg ?>; color: <?= $color ?>; padding: 8px 18px; border-radius: 12px; border: 1px solid <?= $border ?>; font-size: 11px; font-weight: 900; letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa-solid <?= $icon ?>" style="font-size: 10px;"></i> <?= $status ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if($absensi->num_rows() == 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 120px 30px;">
                        <div style="background: #f8fafc; width: 110px; height: 110px; border-radius: 40px; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px;">
                            <i class="fa-solid fa-users-slash" style="font-size: 45px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 900; color: #475569; margin-bottom: 10px;">Sesi Belum Memiliki Peserta</h4>
                        <p style="color: #94a3b8; font-size: 15px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Tidak ada rekapitulasi data scan masuk yang terdeteksi untuk sesi pertemuan ini.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    tr:hover td { background: #fafbfc; }
</style>
