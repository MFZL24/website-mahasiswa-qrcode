<div class="card-header" style="padding: 0; background: transparent; border: none; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h2 style="font-size: 32px; font-weight: 950; color: #1e293b; margin: 0; letter-spacing: -1.5px; display: flex; align-items: center; gap: 15px;">
            <i class="fa-solid fa-calendar-day" style="color: var(--primary);"></i> Jadwal Perkuliahan
        </h2>
        <p style="color: #64748b; font-size: 16px; margin-top: 5px; font-weight: 500;">Daftar mata kuliah dan kelas yang Anda ampu pada semester berjalan.</p>
    </div>
    <div style="background: white; padding: 10px 25px; border-radius: 20px; border: 1.5px solid #f1f5f9; box-shadow: 0 10px 20px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 12px;">
        <div style="width: 12px; height: 12px; background: #10b981; border-radius: 50%; box-shadow: 0 0 10px #10b981;"></div>
        <span style="font-size: 13px; font-weight: 850; color: #1e293b; text-transform: uppercase; letter-spacing: 1px;">Semester Genap 2026</span>
    </div>
</div>

<div class="table-container" style="border-radius: 35px; overflow-x: auto; border: 1.5px solid #f1f5f9; box-shadow: 0 20px 50px rgba(0,0,0,0.03); background: white;">
    <table style="width: 100%; border-collapse: collapse; min-width: 900px;">
        <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
            <tr>
                <th width="40" style="padding: 25px 0 25px 35px; text-align: left; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">#</th>
                <th style="padding: 25px 20px; text-align: left; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Mata Kuliah / Info Akademik</th>
                <th style="padding: 25px 20px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Kelompok Kelas</th>
                <th style="padding: 25px 20px; text-align: left; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Jadwal Mengajar</th>
                <th width="120" style="padding: 25px 20px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Status</th>
                <th width="150" style="padding: 25px 35px 25px 20px; text-align: right; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Panel</th>
            </tr>
        </thead>
        <tbody>
            <?php if($jadwal->num_rows() > 0): ?>
                <?php $no=1; foreach ($jadwal->result() as $r) { ?>
                <tr style="border-bottom: 1.5px solid #f8fafc; transition: all 0.3s;">
                    <td style="padding-left: 35px; vertical-align: middle;">
                        <span style="font-size: 14px; font-weight: 850; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></span>
                    </td>
                    <td style="padding: 30px 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 48px; height: 48px; min-width: 48px; background: var(--primary-light); color: var(--primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px; border: 1.5px solid #dcefe7;">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div>
                                <div style="font-size: 17px; font-weight: 950; color: #1e293b; letter-spacing: -0.3px;"><?= $r->nama_mk ?></div>
                                <div style="font-size: 12px; color: #94a3b8; font-weight: 700; margin-top: 3px;">
                                    <span style="background: #f1f5f9; padding: 2px 8px; border-radius: 6px; color: #64748b; margin-right: 5px;"><?= $r->kode_mk ?></span>
                                    <span>• Semester <?= $r->sem_mk ?></span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 30px 20px; text-align: center;">
                        <div style="display: inline-flex; align-items: center; gap: 8px; background: #eff6ff; color: #2563eb; padding: 8px 18px; border-radius: 12px; font-size: 13px; font-weight: 900; border: 1.5px solid #dbeafe;">
                            <i class="fa-solid fa-layer-group" style="font-size: 11px; opacity: 0.7;"></i> KLS <?= $r->nama_kelas ?>
                        </div>
                    </td>
                    <td style="padding: 30px 20px;">
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <div style="font-weight: 900; color: #1e293b; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-calendar-check" style="color: #64748b; font-size: 12px; opacity: 0.5;"></i> <?= $r->hari ?>
                            </div>
                            <div style="font-size: 12px; font-family: 'JetBrains Mono', monospace; font-weight: 700; color: #64748b; background: #f8fafc; padding: 4px 10px; border-radius: 8px; border: 1px solid #f1f5f9; width: fit-content;">
                                <i class="fa-solid fa-clock" style="margin-right: 5px; opacity: 0.5;"></i> <?= substr($r->jam_mulai,0,5) ?> - <?= substr($r->jam_selesai,0,5) ?>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 30px 20px; text-align: center;">
                        <span style="padding: 8px 16px; border-radius: 10px; background: #ecfdf5; color: #10b981; font-size: 11px; font-weight: 900; border: 1.5px solid #d1fae5; display: inline-flex; align-items: center; gap: 6px;">
                            AKTIF
                        </span>
                    </td>
                    <td style="padding: 30px 35px 30px 20px; text-align: right;">
                        <a href="<?= base_url('index.php/dosen_fitur/mhs_kelas/'.$r->id_kelas) ?>" class="btn-action-premium" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 22px; background: white; color: #1e293b; border: 2.5px solid #f1f5f9; border-radius: 16px; font-size: 13px; font-weight: 850; text-decoration: none; transition: all 0.3s;">
                            <i class="fa-solid fa-users-rectangle" style="color: var(--primary);"></i> Daftar
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 100px 30px;">
                        <h4 style="font-size: 20px; font-weight: 950; color: #475569;">Jadwal Masih Kosong</h4>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    .btn-action-premium:hover {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
        box-shadow: 0 10px 20px rgba(0, 104, 116, 0.15);
        transform: translateY(-3px);
    }
    @media (max-width: 768px) {
        .card-header { text-align: center; justify-content: center !important; }
        .card-header h2 { font-size: 24px !important; justify-content: center; }
        .card-header p { font-size: 14px !important; }
        .table-container { border-radius: 20px !important; }
    }
</style>
