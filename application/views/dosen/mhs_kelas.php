<?php
$info_kelas = $kelas;
?>
<!-- Page Header -->
<div class="card-header" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-users" style="color: var(--primary);"></i> Daftar Mahasiswa Kelas
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0;">Seluruh mahasiswa yang terdaftar secara resmi di mata kuliah ini melalui sistem KRS.</p>
    </div>
    <a href="<?= base_url('index.php/dosen_fitur/jadwal') ?>" class="btn" style="background: white; color: #475569; border: 2px solid #f1f5f9; padding: 12px 24px; border-radius: 14px; font-weight: 700; transition: all 0.3s; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='#f1f5f9'; this.style.color='#475569'">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Jadwal
    </a>
</div>

<!-- Info Alert/Banner -->
<div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 30px;">
    <div style="width: 70px; height: 70px; background: var(--primary-light); color: var(--primary); border-radius: 22px; display: flex; align-items: center; justify-content: center; font-size: 32px; box-shadow: 0 8px 20px rgba(0, 104, 116, 0.1);">
        <i class="fa-solid fa-graduation-cap"></i>
    </div>
    <div style="flex: 1;">
        <h2 style="margin: 0; color: #1e293b; font-size: 20px; font-weight: 900; letter-spacing: -0.3px;"><?= $info_kelas->nama_mk ?></h2>
        <div style="margin-top: 5px; display: flex; align-items: center; gap: 15px;">
            <span class="badge badge-primary" style="background: #eef2ff; color: #4f46e5; border: 1px solid #e0e7ff; font-weight: 850;">KLS <?= $info_kelas->nama_kelas ?></span>
            <span style="width: 1px; height: 12px; background: #e2e8f0;"></span>
            <span style="font-size: 13px; color: #64748b; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-user-group" style="opacity: 0.5;"></i> Total Peserta: <b><?= $mahasiswa->num_rows() ?> Mahasiswa</b>
            </span>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-radius: 25px; overflow: hidden; padding: 0;">
    <div class="table-container" style="margin-top: 0; border: none; border-radius: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th width="80" style="padding-left: 30px; text-align: center;">#</th>
                    <th width="180">NIM / ID</th>
                    <th>Nama Mahasiswa</th>
                    <th width="250" style="padding-right: 30px;">Program Studi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($mahasiswa->result() as $m): ?>
                <tr>
                    <td style="padding-left: 30px; text-align: center; font-weight: 800; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-family: 'JetBrains Mono', monospace; font-weight: 800; color: var(--primary); font-size: 14px; letter-spacing: 0.5px;">
                            <?= $m->nim ?>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; background: #f8fafc; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-weight: 800; font-size: 13px; border: 1px solid #f1f5f9;">
                                <?= strtoupper(substr($m->nama, 0, 1)) ?>
                            </div>
                            <div style="font-weight: 800; color: #1e293b; font-size: 15px;"><?= $m->nama ?></div>
                        </div>
                    </td>
                    <td style="padding-right: 30px;">
                        <span class="badge" style="background: #f1f5f9; color: #475569; padding: 8px 15px; border-radius: 10px; font-weight: 800;"><?= $m->prodi ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if($mahasiswa->num_rows() == 0): ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 100px 30px;">
                        <div style="background: #f8fafc; width: 100px; height: 100px; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fa-solid fa-user-slash" style="font-size: 45px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 800; color: #475569; margin-bottom: 8px;">Kelas Masih Kosong</h4>
                        <p style="color: #94a3b8; font-size: 14px; max-width: 350px; margin: 0 auto; line-height: 1.6;">Belum ada mahasiswa yang terdaftar di kelas ini untuk semester berjalan.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    tr:hover td { background: #fafbfc; }
    @media (max-width: 768px) {
        .card-header { text-align: center; justify-content: center !important; flex-direction: column !important; gap: 20px !important; }
        .card-header h3 { font-size: 20px !important; justify-content: center; }
        .card-header a { width: 100%; justify-content: center; }
        
        div[style*="background: white; padding: 30px"] { 
            flex-direction: column !important; 
            padding: 25px !important; 
            text-align: center !important;
            gap: 20px !important;
        }
        div[style*="width: 70px; height: 70px"] { margin: 0 auto; }
        div[style*="display: flex; align-items: center; gap: 15px"] { 
            flex-direction: column !important; 
            gap: 10px !important; 
        }
        div[style*="width: 1px"] { display: none; }
        
        .table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-container table { min-width: 650px; }
    }
</style>
