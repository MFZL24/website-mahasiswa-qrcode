<?php
// Hitung sisa waktu jika QR masih aktif
$is_expired = $is_expired ?? true;
$qr_expired_ts = ($qr && isset($qr->expired_at)) ? strtotime($qr->expired_at) : 0;
$sisa_detik = $qr_expired_ts - time();
?>

<div class="card-header" style="justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
    <div>
        <h3 class="card-title"><i class="fa-solid fa-clipboard-user"></i> Manajemen Absensi Pertemuan</h3>
        <p style="color:#64748b; font-size:13px; margin-top:4px;"><?= $ptm->nama_mk ?> — Pertemuan ke-<?= $ptm->pertemuan_ke ?> (<?= date('d M Y', strtotime($ptm->tanggal)) ?>)</p>
    </div>
    <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$ptm->id_kelas) ?>" class="btn btn-sm" style="background:#f1f5f9; color:#475569; border-radius:12px; padding:10px 20px;">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div style="padding:20px;">

<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success" style="margin-bottom:20px; border-radius:14px; display:flex; align-items:center; gap:10px;">
    <i class="fa-solid fa-circle-check"></i> <?= $this->session->flashdata('success') ?>
</div>
<?php endif; ?>

<?php if (!$is_expired): ?>
<!-- ============ SESI MASIH AKTIF ============ -->
<div style="background: linear-gradient(135deg, #006874, #00a3b8); border-radius:24px; padding:30px; color:white; margin-bottom:25px; display:flex; flex-direction:column; align-items:center; text-align:center;">
    <div style="font-size:48px; font-weight:900; font-family:monospace; letter-spacing:3px; margin-bottom:10px;" id="countdown">--:--</div>
    <div style="font-size:13px; font-weight:700; opacity:0.8; text-transform:uppercase; letter-spacing:1px; margin-bottom:20px;">Sesi Scan QR Sedang Berlangsung</div>
    <div style="display:inline-flex; align-items:center; gap:10px; background:rgba(255,255,255,0.15); padding:10px 20px; border-radius:50px; font-size:14px; font-weight:600;">
        <span style="width:8px; height:8px; background:#4ade80; border-radius:50%; display:inline-block; animation:pulse 1.5s infinite;"></span>
        Berakhir pukul <?= date('H:i', $qr_expired_ts) ?> WIB
    </div>
</div>

<div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:16px; padding:20px; margin-bottom:25px; display:flex; gap:15px; align-items:flex-start;">
    <i class="fa-solid fa-circle-info" style="color:#16a34a; font-size:20px; margin-top:2px;"></i>
    <div>
        <div style="font-weight:800; color:#166534; margin-bottom:5px;">Daftar absensi akan tampil otomatis setelah sesi berakhir.</div>
        <div style="font-size:13px; color:#15803d; line-height:1.6;">Mahasiswa yang belum scan akan otomatis tercatat sebagai <b>ALPHA</b>. Halaman ini akan memuat ulang secara otomatis.</div>
    </div>
</div>

<!-- Status & List Scan Real-time -->
<div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
    <!-- Counter Box -->
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 20px; padding: 30px; text-align: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <div style="font-size: 64px; font-weight: 900; color: #006874; line-height: 1;"><?= $absensi->num_rows() ?></div>
        <div style="font-size: 14px; font-weight: 700; color: #64748b; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px;">Mahasiswa Berhasil Scan</div>
    </div>

    <!-- Live Feed Box -->
    <div style="background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px); border: 1px dashed #cbd5e1; border-radius: 20px; padding: 25px;">
        <div style="font-size: 14px; font-weight: 800; color: #475569; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-bolt-lightning" style="color: #f59e0b;"></i> AKTIVITAS TERBARU
        </div>
        
        <?php if($absensi->num_rows() > 0): ?>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <?php foreach($absensi->result() as $a): ?>
                    <div style="background: rgba(0, 104, 116, 0.08); border: 1px solid rgba(0, 104, 116, 0.1); padding: 10px 18px; border-radius: 12px; display: flex; align-items: center; gap: 10px; animation: fadeInSlide 0.5s ease-out; opacity: 0.85;">
                        <div style="width: 8px; height: 8px; background: #006874; border-radius: 50%;"></div>
                        <div>
                            <div style="font-size: 13px; font-weight: 700; color: #006874;"><?= $a->nama ?></div>
                            <div style="font-size: 11px; color: #64748b; font-family: monospace;"><?= $a->nim ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 30px; color: #94a3b8;">
                <i class="fa-solid fa-hourglass-start" style="font-size: 32px; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
                <div style="font-size: 13px; font-weight: 600;">Menunggu scan pertama...</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    @keyframes fadeInSlide {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 0.85; transform: translateY(0); }
    }
</style>

<style>
    @keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.3;} }
</style>
<script>
    // Countdown Timer
    const expiredAt = <?= $qr_expired_ts * 1000 ?>;
    function updateCountdown() {
        const diff = expiredAt - Date.now();
        if (diff <= 0) {
            document.getElementById('countdown').textContent = '00:00';
            // Reload halaman saat sesi habis
            setTimeout(() => location.reload(), 1500);
            return;
        }
        const m = Math.floor(diff / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        document.getElementById('countdown').textContent =
            String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
        setTimeout(updateCountdown, 1000);
    }
    updateCountdown();
    // Auto refresh setiap 15 detik untuk update list scan realtime
    setTimeout(() => location.reload(), 15000);
</script>

<?php else: ?>
<!-- ============ SESI SUDAH HABIS ============ -->

<!-- Summary Bar -->
<?php
    $total = $absensi->num_rows();
    $hadir = 0; $alpa = 0; $sakit = 0; $izin = 0;
    $rows = $absensi->result();
    foreach($rows as $r) {
        if($r->status == 'Hadir') $hadir++;
        elseif($r->status == 'Sakit') $sakit++;
        elseif($r->status == 'Izin') $izin++;
        else $alpa++; // Ini untuk counter Alpha
    }
?>
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px; margin-bottom:25px;">
    <div style="background:white; border:1px solid #e2e8f0; border-radius:16px; padding:18px; text-align:center;">
        <div style="font-size:28px; font-weight:900; color:#1e293b;"><?= $total ?></div>
        <div style="font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:1px;">Total</div>
    </div>
    <div style="background:#ecfdf5; border:1px solid #bbf7d0; border-radius:16px; padding:18px; text-align:center;">
        <div style="font-size:28px; font-weight:900; color:#059669;"><?= $hadir ?></div>
        <div style="font-size:11px; font-weight:700; color:#16a34a; text-transform:uppercase; letter-spacing:1px;">Hadir</div>
    </div>
    <div style="background:#fefce8; border:1px solid #fde68a; border-radius:16px; padding:18px; text-align:center;">
        <div style="font-size:28px; font-weight:900; color:#d97706;"><?= $sakit + $izin ?></div>
        <div style="font-size:11px; font-weight:700; color:#b45309; text-transform:uppercase; letter-spacing:1px;">Sakit/Izin</div>
    </div>
    <div style="background:#fff1f2; border:1px solid #fecdd3; border-radius:16px; padding:18px; text-align:center;">
        <div style="font-size:28px; font-weight:900; color:#e11d48;"><?= $alpa ?></div>
        <div style="font-size:11px; font-weight:700; color:#be123c; text-transform:uppercase; letter-spacing:1px;">Alpha</div>
    </div>
</div>

<div style="background:#fffbeb; border:1px solid #fde68a; border-radius:14px; padding:15px 20px; margin-bottom:20px; display:flex; gap:12px; align-items:center;">
    <i class="fa-solid fa-pen-to-square" style="color:#d97706; font-size:18px;"></i>
    <div style="font-size:13px; color:#92400e; font-weight:600;">
        Sesi absensi telah berakhir. Mahasiswa yang tidak scan otomatis tercatat <b>ALPHA</b>. Anda masih dapat mengubah status manual di bawah.
    </div>
</div>

<div class="table-container" style="overflow-x:auto;">
    <table>
        <thead>
            <tr>
                <th width="45">No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th style="text-align:center; width:120px;">Waktu Scan</th>
                <th style="text-align:center; width:130px;">Status</th>
                <th style="text-align:center; width:180px;">Ubah Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($rows as $a): 
            $status = $a->status ?: 'Alpha';
            $sc = '#ef4444'; $sb = '#fff1f2';
            if($status=='Hadir'){ $sc='#059669'; $sb='#ecfdf5'; }
            elseif($status=='Izin'){ $sc='#3b82f6'; $sb='#eff6ff'; }
            elseif($status=='Sakit'){ $sc='#d97706'; $sb='#fefce8'; }
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td style="font-weight:700;"><?= $a->nama ?></td>
            <td style="font-family:monospace; font-size:12px; color:#64748b;"><?= $a->nim ?></td>
            <td style="text-align:center;">
                <?php if($a->waktu_absen && $a->status == 'Hadir'): ?>
                    <span style="font-size:13px; font-weight:700; color:#475569;">
                        <i class="fa-regular fa-clock" style="color:#94a3b8;"></i> <?= date('H:i', strtotime($a->waktu_absen)) ?>
                    </span>
                <?php else: ?>
                    <span style="color:#cbd5e1; font-size:12px;">—</span>
                <?php endif; ?>
            </td>
            <td style="text-align:center;">
                <span style="background:<?= $sb ?>; color:<?= $sc ?>; padding:6px 14px; border-radius:8px; font-size:11px; font-weight:800; letter-spacing:0.5px;">
                    <?= strtoupper($status) ?>
                </span>
            </td>
            <td>
                <form action="<?= base_url('index.php/dosen_fitur/update_status') ?>" method="post" style="display:flex; gap:5px; justify-content:center;">
                    <input type="hidden" name="id_pertemuan" value="<?= $ptm->id_pertemuan ?>">
                    <input type="hidden" name="nim" value="<?= $a->nim ?>">
                    <button type="submit" name="status" value="Hadir" class="btn btn-sm" title="Set Hadir" style="background:#10b981; color:white; border-radius:8px; padding:7px 10px;"><i class="fa-solid fa-check"></i></button>
                    <button type="submit" name="status" value="Sakit" class="btn btn-sm" title="Set Sakit" style="background:#f59e0b; color:white; border-radius:8px; padding:7px 10px;"><i class="fa-solid fa-briefcase-medical"></i></button>
                    <button type="submit" name="status" value="Izin" class="btn btn-sm" title="Set Izin" style="background:#3b82f6; color:white; border-radius:8px; padding:7px 10px;"><i class="fa-solid fa-envelope"></i></button>
                    <button type="submit" name="status" value="Alpha" class="btn btn-sm" title="Set Alpha" style="background:#ef4444; color:white; border-radius:8px; padding:7px 10px;"><i class="fa-solid fa-xmark"></i></button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($rows)): ?>
        <tr>
            <td colspan="6" style="text-align:center; padding:50px; color:#94a3b8;">
                <i class="fa-solid fa-users-slash" style="font-size:40px; display:block; margin-bottom:15px; opacity:0.3;"></i>
                Tidak ada mahasiswa yang terdaftar di kelas ini.
            </td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>
</div>
