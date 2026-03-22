<?php 
// Ambil info prodi/kelas dari data pertama 
$first = $pertemuan->row();
?>

<!-- Page Header -->
<div class="card-header" style="padding: 0; background: transparent; border: none; margin-bottom: 45px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 32px; font-weight: 950; color: #1e293b; display: flex; align-items: center; gap: 15px; letter-spacing: -1.5px; margin: 0;">
            <i class="fa-solid fa-layer-group" style="color: var(--primary);"></i> Kelola Pertemuan
        </h3>
        <p style="color: #64748b; font-size: 16px; margin-top: 5px; font-weight: 500;">
            Manajemen sesi pengajaran untuk mata kuliah <b><?= isset($first->nama_mk) ? $first->nama_mk : 'Perkuliahan' ?></b>
        </p>
    </div>
    <a href="<?= base_url('index.php/dosen_fitur/tambah_pertemuan/'.$this->uri->segment(3)) ?>" class="btn-primary" style="padding: 20px 35px; border-radius: 22px; font-weight: 900; background: #0f172a; color: white; border: none; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.2); transition: all 0.4s; display: flex; align-items: center; gap: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;">
        <i class="fa-solid fa-calendar-plus" style="font-size: 20px;"></i> Buat Sesi Baru
    </a>
</div>

<!-- Meeting List Grid -->
<div style="display: grid; grid-template-columns: 1fr; gap: 25px;">
    <?php foreach ($pertemuan->result() as $p) { ?>
    <div class="meeting-row-premium" style="background: white; border-radius: 35px; border: 2px solid #f1f5f9; padding: 30px 40px; display: grid; grid-template-columns: 100px 1fr 150px 340px 120px; align-items: center; gap: 30px; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        
        <!-- Meeting Badge -->
        <div style="text-align: center; background: #f8fafc; padding: 15px; border-radius: 25px; border: 1.5px solid #f1f5f9;">
            <span style="font-size: 10px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 2px;">PTM</span>
            <span style="font-size: 24px; font-weight: 950; color: var(--primary); font-family: 'JetBrains Mono', monospace;">#<?= $p->pertemuan_ke ?></span>
        </div>

        <!-- Date Info -->
        <div>
            <div style="font-size: 18px; font-weight: 900; color: #1e293b; letter-spacing: -0.5px;"><?= date('d M Y', strtotime($p->tanggal)) ?></div>
            <div style="font-size: 13px; color: #94a3b8; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-calendar-day" style="color: var(--primary); font-size: 12px;"></i> Sesi Kuliah
            </div>
        </div>

        <!-- Time Info -->
        <div>
            <div style="font-size: 15px; font-weight: 850; color: #475569; font-family: 'JetBrains Mono', monospace; display: flex; align-items: center; gap: 8px;">
                <i class="fa-regular fa-clock" style="color: #cbd5e1; font-size: 14px;"></i> <?= substr($p->jam_mulai, 0, 5) ?> - <?= substr($p->jam_selesai, 0, 5) ?>
            </div>
            <div style="font-size: 11px; color: #94a3b8; font-weight: 800; margin-top: 4px; text-transform: uppercase; letter-spacing: 1px;">Durasi Perkuliahan</div>
        </div>

        <!-- QR Control Action -->
        <div style="background: #f8fafc; padding: 12px 15px; border-radius: 25px; border: 1.5px solid #f1f5f9; display: flex; gap: 10px; align-items: center;">
            <div style="flex: 1;">
                <select id="durasi_<?= $p->id_pertemuan ?>" style="width: 100%; height: 48px; background: white; border: 1.5px solid #eef2f6; border-radius: 15px; padding: 0 12px; font-weight: 850; color: #1e293b; font-size: 12px; cursor: pointer; outline: none; transition: 0.3s; appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23CBD5E1%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 15px top 50%; background-size: 10px auto;">
                    <option value="15">15 MENIT</option>
                    <option value="30" selected>30 MENIT</option>
                    <option value="45">45 MENIT</option>
                    <option value="60">60 MENIT</option>
                </select>
            </div>
            <button onclick="aktifkanQR('<?= $p->id_pertemuan ?>')" class="btn-qr-trigger" style="flex: 1.4; height: 48px; background: var(--primary); color: white; border: none; border-radius: 15px; font-weight: 900; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; box-shadow: 0 8px 15px rgba(0, 104, 116, 0.15);">
                <i class="fa-solid fa-qrcode" style="font-size: 14px;"></i> AKTIFKAN QR
            </button>
        </div>

        <!-- Utility Options -->
        <div style="display: flex; gap: 12px; justify-content: flex-end; align-items: center;">
            <a href="<?= base_url('index.php/dosen_fitur/rekap_absensi/'.$p->id_pertemuan) ?>" class="btn-util" style="width: 48px; height: 48px; background: white; color: var(--primary); border-radius: 16px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 2px solid #f1f5f9; transition: all 0.3s;" title="Rekap Absensi">
                <i class="fa-solid fa-clipboard-user" style="font-size: 18px;"></i>
            </a>
            <a href="<?= base_url('index.php/dosen_fitur/hapus_pertemuan/'.$p->id_pertemuan) ?>" class="btn-util btn-del-util" onclick="return confirm('Hapus sesi pertemuan ini?')" style="width: 48px; height: 48px; background: white; color: #f43f5e; border-radius: 16px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 2px solid #f1f5f9; transition: all 0.3s;" title="Hapus">
                <i class="fa-solid fa-trash-can" style="font-size: 18px;"></i>
            </a>
        </div>
    </div>
    </div>
    <?php } ?>

    <?php if ($pertemuan->num_rows() == 0): ?>
    <div style="text-align: center; padding: 120px 50px; background: #f8fafc; border-radius: 40px; border: 3px dashed #f1f5f9;">
        <div style="width: 100px; height: 100px; background: white; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02);">
            <i class="fa-solid fa-calendar-xmark" style="font-size: 45px; color: #cbd5e1;"></i>
        </div>
        <h4 style="font-size: 22px; font-weight: 950; color: #475569; margin-bottom: 10px;">Belum Ada Sesi Baru</h4>
        <p style="color: #94a3b8; font-size: 16px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Atur agenda perkuliahan hari ini dengan membuat sesi pertemuan baru untuk kelas ini.</p>
    </div>
    <?php endif; ?>
</div>

<div style="margin-top: 50px;">
    <a href="<?= base_url('index.php/dosen_fitur/absensi') ?>" style="display: inline-flex; align-items: center; gap: 12px; color: #64748b; font-weight: 800; text-decoration: none; font-size: 14px; transition: 0.3s;" onmouseover="this.style.color='var(--primary)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='#64748b'; this.style.transform='translateX(0)'">
        <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Pilih Kelas
    </a>
</div>

<script>
function aktifkanQR(idPtm) {
    const durasi = document.getElementById('durasi_' + idPtm).value;
    const url = "<?= base_url('index.php/dosen_fitur/generate_qr/') ?>" + idPtm + "/" + durasi;
    window.location.href = url;
}
</script>

<style>
    .meeting-row-premium:hover { 
        transform: scale(1.02); 
        border-color: var(--primary-light); 
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05); 
    }
    .btn-qr-trigger:hover { 
        background: #0f172a !important; 
        box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); 
    }
    .btn-util:hover { transform: scale(1.1); filter: brightness(0.95); }
    .btn-del-util:hover { background: #e11d48 !important; color: white !important; border-color: #e11d48 !important; }
    
    select:focus { border-color: var(--primary) !important; box-shadow: 0 0 0 4px rgba(0, 104, 116, 0.05); }

    .meeting-row-premium { animation: slideInX 0.5s ease-out forwards; }
    @keyframes slideInX {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @media (max-width: 991px) {
        .meeting-row-premium { 
            grid-template-columns: 80px 1fr 120px !important; 
            padding: 25px !important;
            gap: 20px !important;
        }
        .btn-qr-trigger { font-size: 10px !important; }
    }

    @media (max-width: 768px) {
        .card-header { text-align: center; justify-content: center !important; }
        .card-header h3 { font-size: 26px !important; justify-content: center; }
        .btn-primary { width: 100%; justify-content: center; padding: 15px !important; border-radius: 15px !important; }
        .meeting-row-premium { 
            grid-template-columns: 1fr !important; 
            padding: 25px !important;
            text-align: center;
            border-radius: 25px !important;
        }
        .meeting-row-premium > div { display: flex; flex-direction: column; align-items: center; }
        .btn-qr-trigger { width: 100%; border-radius: 12px !important; height: 50px !important; }
        .btn-util { width: 60px !important; height: 60px !important; border-radius: 20px !important; }
    }
</style>

<script>
function aktifkanQR(idPtm) {
    const durasi = document.getElementById('durasi_' + idPtm).value;
    if(!durasi) return;
    const url = "<?= base_url('index.php/dosen_fitur/generate_qr/') ?>" + idPtm + "/" + durasi;
    window.location.href = url;
}
</script>
