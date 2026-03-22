<!-- Page Title & Header -->
<div class="card-header" style="padding: 0; margin-bottom: 40px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 26px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-calendar-week" style="color: var(--primary);"></i> Agenda Perkuliahan Mingguan
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0; font-weight: 500;">Pantau seluruh jadwal perkuliahan aktif berdasarkan plot KRS yang telah disetujui.</p>
    </div>
    <div style="font-size: 12px; font-weight: 850; color: #3b82f6; text-transform: uppercase; letter-spacing: 1.5px; background: #f0f7ff; padding: 12px 25px; border-radius: 50px; border: 1px solid #dbeafe; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-business-time"></i> Periode Perkuliahan Aktif
    </div>
</div>

<!-- Schedule Table Card - Neo Modern -->
<div class="card" style="border: none; box-shadow: 0 15px 40px rgba(0,0,0,0.03); border-radius: 35px; overflow: hidden; padding: 0; border: 1px solid #f1f5f9;">
    <div class="card-header" style="background: #fafbfc; padding: 30px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 class="card-title" style="margin: 0; font-size: 19px; font-weight: 850; color: #1e293b; display: flex; align-items: center; gap: 12px;">
            <i class="fa-solid fa-clock-rotate-left" style="color: #94a3b8;"></i> Jadwal Kuliah Mahasiswa
        </h3>
        <span style="background: white; border: 1px solid #f1f5f9; padding: 8px 18px; border-radius: 50px; font-size: 12px; font-weight: 800; color: #64748b;">TOTAL: <?= $jadwal->num_rows() ?> MK</span>
    </div>

    <div class="table-container" style="margin-top: 0; border: none; border-radius: 0;">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th width="150" style="padding-left: 30px; text-align: center;">HARI</th>
                    <th width="180">WAKTU KULIAH</th>
                    <th>MATAKULIAH & IDENTITAS</th>
                    <th>DOSEN PENGAMPU</th>
                    <th width="140" style="padding-right: 30px; text-align: right;">RUANG / KELAS</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $hari_order = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                $found = false;
                
                $sorted_jadwal = [];
                foreach($jadwal->result() as $r) {
                    $sorted_jadwal[$r->hari][] = $r;
                }

                foreach($hari_order as $h): 
                    if(isset($sorted_jadwal[$h])):
                        foreach($sorted_jadwal[$h] as $r):
                            $found = true;
                ?>
                <tr>
                    <td style="padding-left: 30px; text-align: center;">
                        <span style="background: var(--primary); color: white; padding: 10px 20px; border-radius: 14px; font-size: 13px; font-weight: 900; display: inline-block; width: 110px; text-align: center; box-shadow: 0 8px 15px rgba(0, 104, 116, 0.2); letter-spacing: 0.5px;">
                            <?= $h ?>
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 850; color: #1e293b; font-size: 15px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-regular fa-clock" style="color: #94a3b8; font-size: 14px;"></i>
                            <?= substr($r->jam_mulai,0,5) ?> - <?= substr($r->jam_selesai,0,5) ?>
                        </div>
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 700; margin-left: 24px; margin-top: 2px;">WIB (Zona Waktu)</div>
                    </td>
                    <td>
                        <div style="font-weight: 850; color: #1e293b; font-size: 16px; letter-spacing: -0.2px;"><?= $r->nama_mk ?></div>
                        <div style="font-size: 11px; color: var(--primary); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; font-family: 'JetBrains Mono', monospace;"><?= $r->kode_mk ?></div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 38px; height: 38px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 15px; border: 1px solid #f1f5f9;">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div style="font-weight: 700; color: #475569; font-size: 14px;"><?= $r->nama_dosen ?></div>
                        </div>
                    </td>
                    <td style="padding-right: 30px; text-align: right;">
                        <span style="background: #ecfdf5; color: #059669; padding: 8px 18px; border-radius: 12px; font-size: 12px; font-weight: 900; border: 1px solid #d1fae5; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-door-open" style="font-size: 10px; opacity: 0.6;"></i> <?= $r->nama_kelas ?>
                        </span>
                    </td>
                </tr>
                <?php 
                        endforeach;
                    endif;
                endforeach; 
                ?>

                <?php if(!$found): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 120px 30px;">
                        <div style="background: #f8fafc; width: 100px; height: 100px; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fa-solid fa-calendar-xmark" style="font-size: 45px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 850; color: #475569; margin-bottom: 10px;">Jadwal Belum Terdaftar</h4>
                        <p style="color: #94a3b8; font-size: 14px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Harap lakukan pengisian Kartu Rencana Studi (KRS) terlebih dahulu untuk memunculkan agenda perkuliahan mingguan Anda di sistem dashboard.</p>
                        <a href="<?= base_url('index.php/mhs_fitur/ambil') ?>" class="btn-primary" style="margin-top: 35px; background: var(--primary); color: white; padding: 15px 35px; border-radius: 16px; font-weight: 850; text-decoration: none; display: inline-block; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2);">MENU AMBIL KRS</a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    tr:hover td { background: #fafbfc; }
    .btn-primary:hover {
        transform: translateY(-5px);
        filter: brightness(1.1);
        box-shadow: 0 15px 30px rgba(0, 104, 116, 0.3);
    }

    @media (max-width: 991px) {
        .card-header { padding: 0 !important; margin-bottom: 30px !important; text-align: center; justify-content: center !important; }
        .card-header div[style*="background: #f0f7ff"] { width: 100%; justify-content: center; margin-top: 10px; }
        .card { border-radius: 25px !important; }
        .table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-container table { min-width: 900px; }
    }

    @media (max-width: 768px) {
        .card-header h3 { font-size: 22px !important; justify-content: center; }
        .card-header p { font-size: 13px !important; }
    }
</style>
