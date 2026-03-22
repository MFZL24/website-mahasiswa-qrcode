<!-- Page Header -->
<div class="card-header" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 26px; font-weight: 850; color: #1e293b; display: flex; align-items: center; gap: 15px; margin: 0;">
            <i class="fa-solid fa-list-check" style="color: var(--primary);"></i> Rekapitulasi Sesi Kuliah
        </h3>
        <p style="color: #64748b; font-size: 14px; margin-top: 6px; font-weight: 500;">Pantau seluruh aktivitas pertemuan kelas dan status absensi mahasiswa secara global.</p>
    </div>
    <a href="<?= base_url('index.php/pertemuan/tambah') ?>" class="btn-primary" style="padding: 18px 32px; border-radius: 20px; font-weight: 850; background: var(--primary); color: white; display: flex; align-items: center; gap: 12px; border: none; box-shadow: 0 12px 25px rgba(0, 104, 116, 0.2); text-decoration: none; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <i class="fa-solid fa-calendar-plus" style="font-size: 20px;"></i> INPUT SESI GLOBAL
    </a>
</div>

<!-- Table Card -->
<div class="card" style="border: none; box-shadow: 0 15px 40px rgba(0,0,0,0.03); border-radius: 35px; overflow: hidden; padding: 0;">
    <div class="table-container" style="margin: 0; border: none; border-radius: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #fafbfc;">
                    <th width="80" style="padding-left: 35px; text-align: center;">#</th>
                    <th>Matakuliah & Agenda</th>
                    <th>Detail Sesi</th>
                    <th style="text-align: center;">Lokasi Kelas</th>
                    <th width="160" style="padding-right: 35px; text-align: right;">Opsi Kendali</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($record->result() as $r) { ?>
                <tr>
                    <td style="padding-left: 35px; text-align: center; font-weight: 850; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-weight: 850; color: #1e293b; font-size: 16px; letter-spacing: -0.3px;"><?= $r->nama_mk ?></div>
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 800; text-transform: uppercase; margin-top: 4px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-calendar-day" style="font-size: 10px; opacity: 0.6;"></i> <?= date('d F Y', strtotime($r->tanggal)) ?>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <span class="badge" style="background: var(--primary-light); color: var(--primary); font-weight: 900; width: fit-content; border: 1px solid rgba(0, 104, 116, 0.1);">PERTEMUAN KE-<?= $r->pertemuan_ke ?></span>
                            <div style="font-size: 13px; color: #64748b; font-weight: 700; display: flex; align-items: center; gap: 6px; padding-left: 10px;">
                                <i class="fa-regular fa-clock" style="opacity: 0.5;"></i> <?= substr($r->jam_mulai,0,5) ?> <span style="font-size: 10px; opacity: 0.6;">WIB</span>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span style="background: #f1f5f9; color: #475569; padding: 8px 18px; border-radius: 12px; font-size: 13px; font-weight: 950; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-door-open" style="font-size: 11px; opacity: 0.6;"></i> <?= $r->nama_kelas ?>
                        </span>
                    </td>
                    <td style="padding-right: 35px; text-align: right;">
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <a href="<?= base_url('index.php/pertemuan/rekap/'.$r->id_pertemuan) ?>" class="btn-action" style="background: #f0fdf4; color: #16a34a; width: 42px; height: 42px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #dcfce7; transition: all 0.3s;" title="Lihat Rekap Absensi">
                                <i class="fa-solid fa-sheet-plastic" style="font-size: 16px;"></i>
                            </a>
                            <a href="<?= base_url('index.php/pertemuan/hapus/'.$r->id_pertemuan) ?>" class="btn-action" onclick="return confirm('Hapus seluruh data sesi pertemuan ini beserta record absensinya?')" style="background: #fff1f2; color: #e11d48; width: 42px; height: 42px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #ffe4e6; transition: all 0.3s;" title="Hapus Sesi">
                                <i class="fa-solid fa-trash-can" style="font-size: 16px;"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($record->num_rows() == 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 120px 30px;">
                        <div style="width: 110px; height: 110px; background: #f8fafc; border-radius: 42px; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px;">
                            <i class="fa-solid fa-calendar-xmark" style="font-size: 50px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 900; color: #475569; margin-bottom: 10px;">Data Sesi Absen Kosong</h4>
                        <p style="color: #94a3b8; font-size: 15px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Belum ada sesi pertemuan kuliah yang tercatat dalam sistem untuk seluruh fakultas.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-action:hover { transform: scale(1.15) rotate(5deg); box-shadow: 0 8px 15px rgba(0,0,0,0.05); filter: brightness(1.05); }
    .btn-primary:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0, 104, 116, 0.3); opacity: 0.95; }
    tr:hover td { background: #fcfdfe; }
</style>
