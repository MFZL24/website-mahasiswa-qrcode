<?php
$total_sks = 0;
?>
<!-- Page Header -->
<div class="card-header" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-graduation-cap" style="color: var(--primary);"></i> Detail Rencana Studi
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0;">Monitoring pengambilan mata kuliah dan beban SKS mahasiswa semester berjalan.</p>
    </div>
    <div style="display: flex; gap: 15px;">
        <a href="<?= base_url('index.php/krs/batch_approve/'.$mhs->nim) ?>" class="btn" onclick="return confirm('Setujui semua mata kuliah untuk mahasiswa ini?')" style="background: var(--primary); color: white; border: none; padding: 12px 24px; border-radius: 14px; font-weight: 850; transition: all 0.3s; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2);" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-check-double"></i> Setujui Semua (ACC)
        </a>
        <a href="<?= base_url('index.php/krs') ?>" class="btn" style="background: white; color: #475569; border: 2px solid #f1f5f9; padding: 12px 24px; border-radius: 14px; font-weight: 700; transition: all 0.3s; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='#f1f5f9'; this.style.color='#475569'">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<!-- Profil Mahasiswa Card -->
<div style="background: white; padding: 35px; border-radius: 35px; border: 1px solid #f1f5f9; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 40px; position: relative; overflow: hidden;">
    <div style="width: 90px; height: 90px; background: var(--primary-light); color: var(--primary); border-radius: 25px; display: flex; align-items: center; justify-content: center; font-size: 42px; position: relative; z-index: 2; box-shadow: 0 8px 15px rgba(0, 104, 116, 0.1);">
        <i class="fa-solid fa-user-graduate"></i>
    </div>
    <div style="flex: 1; position: relative; z-index: 2;">
        <h2 style="margin: 0; color: #1e293b; font-size: 28px; font-weight: 900; letter-spacing: -0.5px;"><?= $mhs->nama ?></h2>
        <div style="margin-top: 5px; display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <span style="font-size: 15px; color: #64748b; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-id-card-clip" style="color: var(--primary); opacity: 0.6;"></i> <b style="color: #1e293b;"><?= $mhs->nim ?></b>
            </span>
            <span style="width: 1px; height: 12px; background: #e2e8f0;"></span>
            <span style="font-size: 15px; color: #64748b; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-school" style="color: var(--primary); opacity: 0.6;"></i> <b><?= $mhs->prodi ?></b>
            </span>
        </div>
    </div>
    <i class="fa-solid fa-file-contract" style="position: absolute; right: -20px; bottom: -20px; font-size: 180px; color: rgba(0, 104, 116, 0.03); transform: rotate(-15deg);"></i>
</div>

<!-- KRS Table Card -->
<div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-radius: 25px; overflow: hidden; padding: 0;">
    <div class="card-header" style="background: #fafbfc; padding: 25px 30px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-layer-group" style="color: #94a3b8;"></i>
        <h4 style="margin: 0; font-size: 16px; font-weight: 850; color: #1e293b;">Daftar Mata Kuliah Diambil</h4>
    </div>
    <div class="table-container" style="margin-top: 0; border: none; border-radius: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th width="50" style="padding-left: 30px; text-align: center;">#</th>
                    <th>Matakuliah / Kode</th>
                    <th width="80" style="text-align: center;">SKS</th>
                    <th>Dosen Pengampu</th>
                    <th style="text-align: center;">Status Admin</th>
                    <th width="120" style="padding-right: 30px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($record->result() as $r): $total_sks += $r->sks; ?>
                <tr>
                    <td style="padding-left: 30px; text-align: center; font-weight: 800; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-weight: 850; color: #1e293b; font-size: 15px; letter-spacing: -0.2px;"><?= $r->nama_mk ?></div>
                        <div style="font-size: 11px; color: var(--primary); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-top: 2px; font-family: 'JetBrains Mono', monospace;"><?= $r->kode_mk ?></div>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-weight: 850; color: #475569; font-size: 14px;"><?= $r->sks ?></span>
                    </td>
                    <td>
                         <div style="font-weight: 700; color: #475569; font-size: 14px;"><?= $r->nama_dosen ?></div>
                    </td>
                    <td style="text-align: center;">
                        <?php if($r->is_approved == 1): ?>
                            <span style="background: #ecfdf5; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 11px; font-weight: 900; border: 1px solid #d1fae5;">
                                <i class="fa-solid fa-check"></i> DISETUJUI
                            </span>
                        <?php else: ?>
                            <span style="background: #fffbeb; color: #d97706; padding: 6px 14px; border-radius: 10px; font-size: 11px; font-weight: 900; border: 1px solid #fef3c7;">
                                <i class="fa-solid fa-clock"></i> PENDING
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="padding-right: 30px; text-align: right;">
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <?php if($r->is_approved == 0): ?>
                            <a href="<?= base_url('index.php/krs/approve/'.$r->id_krs.'/'.$mhs->nim) ?>" class="btn-acc" style="width: 38px; height: 38px; background: #f0fdf4; color: #10b981; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #dcfce7; transition: all 0.3s;" title="Setujui (ACC)">
                                <i class="fa-solid fa-check"></i>
                            </a>
                            <?php endif; ?>
                            <a href="<?= base_url('index.php/krs/hapus/'.$r->id_krs.'/'.$mhs->nim) ?>" class="btn-del" onclick="return confirm('Apakah Anda yakin ingin membatalkan pengambilan mata kuliah ini untuk mahasiswa?')" style="width: 38px; height: 38px; background: #fff1f2; color: #e11d48; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #ffe4e6; transition: all 0.3s;" title="Hapus Pengambilan">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>

                
                <?php if($record->num_rows() > 0): ?>
                <tr style="background: #f8fafc;">
                    <td colspan="2" style="padding: 25px 30px; text-align: right; font-weight: 900; color: #64748b; font-size: 13px; letter-spacing: 1px;">TOTAL BEBAN AKADEMIK :</td>
                    <td style="text-align: center; padding: 25px 0;">
                        <span style="background: var(--primary); color: white; padding: 10px 20px; border-radius: 12px; font-weight: 950; font-size: 15px; box-shadow: 0 4px 12px rgba(0, 104, 116, 0.15);"><?= $total_sks ?> SKS</span>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>

                <?php if($record->num_rows() == 0): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 100px 30px;">
                        <div style="background: #f8fafc; width: 100px; height: 100px; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fa-solid fa-book-medical" style="font-size: 45px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 800; color: #475569; margin-bottom: 8px;">KRS Belum Diisi</h4>
                        <p style="color: #94a3b8; font-size: 14px; max-width: 350px; margin: 0 auto; line-height: 1.6;">Rencana studi mahasiswa ini masih kosong untuk periode semester aktif.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-del:hover { background: #e11d48 !important; color: white !important; transform: scale(1.15) rotate(5deg); box-shadow: 0 8px 15px rgba(225, 29, 72, 0.2); }
    tr:hover td { background: #fcfdfe; }
</style>
