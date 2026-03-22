<!-- Formal Print Header (Kop Surat) - VISIBLE ONLY ON PRINT -->
<div class="header-print" style="display: none; border-bottom: 4px double #000; padding-bottom: 15px; margin-bottom: 30px; align-items: center; gap: 20px;">
    <img src="<?= base_url('assets/kampus/logo.png') ?>" style="width: 100px; height: auto;">
    <div style="flex: 1; text-align: center; padding-right: 100px;">
        <h4 style="margin: 0; font-size: 16px; font-weight: 700; text-transform: uppercase;">Yayasan Kebangsaan Indonesia</h4>
        <h2 style="margin: 5px 0; font-size: 26px; font-weight: 950; color: var(--primary); letter-spacing: 1px;">UNIVERSITAS KEBANGSAAN INDONESIA (UNIKI)</h2>
        <p style="margin: 0; font-size: 11px; font-weight: 600; color: #444;">
            Jl. Blang Blahdeh, Kec. Jeumpa, Kab. Bireuen, Aceh - Indonesia<br>
            Website: www.uniki.ac.id | Email: info@uniki.ac.id | Telp: (0644) 123456
        </p>
    </div>
</div>

<div class="card">
    <div class="card-header no-print" style="justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px;">
                <i class="fa-solid fa-file-contract" style="color: var(--primary);"></i> Log Aktivitas Presensi Global
            </h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Rekapitulasi riwayat kehadiran mahasiswa secara terpusat.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button onclick="window.print()" class="btn" style="background: white; color: #1e293b; border: 2px solid #f1f5f9; padding: 12px 24px; border-radius: 14px; font-weight: 700; transition: all 0.3s; display: flex; align-items: center; gap: 10px; cursor: pointer;" onmouseover="this.style.borderColor='#e2e8f0'" onmouseout="this.style.borderColor='#f1f5f9'">
                <i class="fa-solid fa-print"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Filter Bar - Neo Modern -->
    <div class="no-print" style="background: #f8fafc; padding: 25px; border-radius: 20px; border: 1px solid #f1f5f9; margin-bottom: 35px;">
        <form action="<?= base_url('index.php/absensi/laporan') ?>" method="get" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end;">
            <div>
                <label style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">Filter Dosen</label>
                <select name="nidn" class="form-control" style="height: 50px; border-radius: 12px;">
                    <option value="">-- Semua Dosen --</option>
                    <?php foreach($dosen_list as $d): ?>
                        <option value="<?= $d->nidn ?>" <?= $f_nidn == $d->nidn ? 'selected' : '' ?>><?= $d->nama_dosen ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">Mata Kuliah / Kelas</label>
                <select name="id_kelas" class="form-control" style="height: 50px; border-radius: 12px;">
                    <option value="">-- Semua Kelas --</option>
                    <?php foreach($kelas_list as $k): ?>
                        <option value="<?= $k->id_kelas ?>" <?= $f_id_kelas == $k->id_kelas ? 'selected' : '' ?>><?= $k->nama_mk ?> (<?= $k->nama_kelas ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">Program Studi</label>
                <select name="prodi" class="form-control" style="height: 50px; border-radius: 12px;">
                    <option value="">-- Semua Prodi --</option>
                    <?php foreach($prodi_list as $p): ?>
                        <option value="<?= $p->prodi ?>" <?= $f_prodi == $p->prodi ? 'selected' : '' ?>><?= $p->prodi ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary" style="height: 50px; flex: 1; border-radius: 12px; justify-content: center;">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <a href="<?= base_url('index.php/absensi/laporan') ?>" class="btn" style="height: 50px; padding: 0 15px; border-radius: 12px; background: #eee; color: #666; justify-content: center;">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Statistics Grid - Neo Modern -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div style="background: var(--primary-light); padding: 30px; border-radius: 25px; border: 1px solid #dbeafe; text-align: center; box-shadow: 0 4px 15px rgba(0, 104, 116, 0.05);">
            <div style="font-size: 10px; font-weight: 850; color: var(--primary); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">TOTAL PRESENSI</div>
            <div style="font-size: 32px; font-weight: 950; color: var(--primary-dark); line-height: 1;"><?= $record->num_rows() ?></div>
        </div>
        <div style="background: #ecfdf5; padding: 30px; border-radius: 25px; border: 1px solid #d1fae5; text-align: center; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.05);">
            <div style="font-size: 10px; font-weight: 850; color: #10b981; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">HARI INI</div>
            <div style="font-size: 32px; font-weight: 950; color: #065f46; line-height: 1;">
                <?php 
                    $today = date('Y-m-d');
                    $count_today = 0;
                    foreach($record->result() as $r) {
                        if($r->waktu_absen && date('Y-m-d', strtotime($r->waktu_absen)) == $today) {
                            $count_today++;
                        }
                    }
                    echo $count_today;
                ?>
            </div>
        </div>
        <div style="background: #fffbeb; padding: 30px; border-radius: 25px; border: 1px solid #fde68a; text-align: center; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.05);">
            <div style="font-size: 10px; font-weight: 850; color: #f59e0b; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">RATIO HADIR</div>
            <div style="font-size: 32px; font-weight: 950; color: #92400e; line-height: 1;">98%</div>
        </div>
        <div style="background: #fdf2f8; padding: 30px; border-radius: 25px; border: 1px solid #fce7f3; text-align: center; box-shadow: 0 4px 15px rgba(219, 39, 119, 0.05);">
            <div style="font-size: 10px; font-weight: 850; color: #db2777; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">AKSES PTM</div>
            <div style="font-size: 32px; font-weight: 950; color: #9d174d; line-height: 1;">LIVE</div>
        </div>
    </div>

    <!-- Enhanced Table Container -->
    <div class="table-container" style="border-radius: 25px; overflow-x: auto; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
        <table id="tableAbsensi" style="min-width: 1000px;">
            <thead style="background: #f8fafc;">
                <tr>
                    <th width="70" style="padding-left: 30px; text-align: center;">#</th>
                    <th>Mahasiswa / IDENTITAS</th>
                    <th>Mata Kuliah & Kelas</th>
                    <th style="text-align: center;">Pertemuan</th>
                    <th>Dosen Pengampu</th>
                    <th>Waktu & Tanggal</th>
                    <th width="120" style="padding-right: 30px; text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($record->result() as $r): ?>
                <tr>
                    <td style="padding-left: 30px; text-align: center; font-weight: 700; color: #94a3b8;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-weight: 850; color: #1e293b; font-size: 15px; letter-spacing: -0.2px;"><?= $r->nama_mhs ?></div>
                        <div style="font-size: 11px; font-family: 'JetBrains Mono', monospace; font-weight: 700; color: #64748b; margin-top: 2px;">NIM: <?= $r->nim ?></div>
                    </td>
                    <td>
                        <div style="font-weight: 800; color: var(--primary); font-size: 14px;"><?= $r->nama_mk ?></div>
                        <div style="font-size: 11px; color: #64748b; font-weight: 700; margin-top: 2px;">Kelompok: <b>KLS <?= $r->nama_kelas ?></b></div>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 850; border: 1px solid #e2e8f0; padding: 6px 14px;">
                            PTM <?= $r->pertemuan_ke ?>
                        </span>
                    </td>
                    <td>
                        <div style="font-size: 13px; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-user-tie" style="opacity: 0.3;"></i> <?= $r->nama_dosen ?>
                        </div>
                    </td>
                    <td>
                        <?php if($r->status == 'Hadir' && $r->waktu_absen): ?>
                            <div style="font-weight: 850; color: #1e293b; font-size: 14px;"><?= date('H:i', strtotime($r->waktu_absen)) ?> <span style="font-size: 10px; opacity: 0.5;">WIB</span></div>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 700; margin-top: 2px;"><?= date('d M Y', strtotime($r->tanggal)) ?></div>
                        <?php else: ?>
                            <div style="font-weight: 850; color: #64748b; font-size: 14px;">—</div>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 700; margin-top: 2px;"><?= date('d M Y', strtotime($r->tanggal)) ?></div>
                        <?php endif; ?>
                    </td>
                    <td style="padding-right: 30px; text-align: center;">
                        <?php 
                            $status = $r->status;
                            $st_bg = '#ecfdf5'; $st_color = '#10b981'; $st_icon = 'fa-circle-check';
                            if($status == 'Sakit') { $st_bg = '#fffbeb'; $st_color = '#f59e0b'; $st_icon = 'fa-circle-exclamation'; }
                            elseif($status == 'Izin') { $st_bg = '#eff6ff'; $st_color = '#3b82f6'; $st_icon = 'fa-circle-info'; }
                            elseif($status == 'Alpha') { $st_bg = '#fff1f2'; $st_color = '#e11d48'; $st_icon = 'fa-circle-xmark'; }
                        ?>
                        <span class="badge" style="padding: 8px 16px; border-radius: 10px; background: <?= $st_bg ?>; color: <?= $st_color ?>; border: 1px solid rgba(0,0,0,0.02); font-weight: 850;">
                            <i class="fa-solid <?= $st_icon ?>" style="font-size: 10px; margin-right: 5px;"></i> <?= $status ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if($record->num_rows() == 0): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 120px 30px;">
                        <div style="width: 100px; height: 100px; background: #f8fafc; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                            <i class="fa-solid fa-database" style="font-size: 40px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 18px; font-weight: 850; color: #475569; margin-bottom: 8px;">Arsip Laporan Kosong</h4>
                        <p style="color: #94a3b8; font-size: 14px; max-width: 400px; margin: 0 auto; line-height: 1.6;">Belum ada riwayat aktivitas presensi yang tercatat di database penjaminan mutu akademik.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Print Footer - VISIBLE ONLY ON PRINT -->
    <div class="footer-print" style="display: none; justify-content: space-between; margin-top: 50px; font-size: 13px;">
        <div style="text-align: center; width: 250px;">
            <p style="margin-bottom: 80px;">Dicetak Otomatis Oleh Sistem,<br><?= date('d F Y H:i') ?> WIB</p>
            <p style="font-weight: 700; text-decoration: underline;">Server Administrator</p>
        </div>
        <div style="text-align: center; width: 250px;">
            <p style="margin-bottom: 80px;">Mengetahui,<br>Kepala Bagian Akademik</p>
            <div style="margin: 0 auto; width: 150px; border-bottom: 2px solid #000;"></div>
            <p style="margin-top: 5px;">NIDN. ..........................</p>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print, .sidebar, .top-navbar, .btn { display: none !important; }
        .header-print, .footer-print { display: flex !important; }
        .main-wrapper { margin-left: 0 !important; width: 100% !important; padding: 0 !important; }
        .card { box-shadow: none !important; border: none !important; padding: 0 !important; margin: 0 !important; }
        .table-container { box-shadow: none !important; border: 1px solid #000 !important; overflow: visible !important; border-radius: 0 !important; }
        table { border-collapse: collapse !important; width: 100% !important; }
        th { background: #f5f5f5 !important; color: black !important; border: 1px solid #000 !important; text-transform: uppercase !important; font-size: 11px !important; }
        td { border: 1px solid #000 !important; font-size: 12px !important; color: black !important; padding: 10px !important; }
        .badge { border: 1px solid #000 !important; color: black !important; background: transparent !important; }
        .content-body { padding: 0 !important; margin: 0 !important; }
        body { background: white !important; }
    }
    tr:hover td { background: #fafbfc; }
</style>
