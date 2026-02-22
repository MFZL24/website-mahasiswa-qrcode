<div class="card-header" style="justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b;"><i class="fa-solid fa-file-contract" style="color: #3b82f6;"></i> Log Aktivitas Presensi</h3>
        <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Rekapitulasi seluruh kehadiran mahasiswa di semua mata kuliah secara real-time.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <button onclick="window.print()" class="btn btn-sm btn-edit" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; font-weight: 600; padding: 10px 20px;">
            <i class="fa-solid fa-print"></i> Cetak Laporan
        </button>
    </div>
</div>

<!-- Laporan Cards -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 35px;">
    <div style="background: #eff6ff; padding: 25px; border-radius: 20px; border: 1px solid #dbeafe; text-align: center;">
        <div style="font-size: 11px; font-weight: 800; color: #3b82f6; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">TOTAL PRESENSI</div>
        <div style="font-size: 24px; font-weight: 800; color: #1e40af;"><?= $record->num_rows() ?></div>
    </div>
    <div style="background: #f0fdf4; padding: 25px; border-radius: 20px; border: 1px solid #dcfce7; text-align: center;">
        <div style="font-size: 11px; font-weight: 800; color: #10b981; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">HARI INI</div>
        <div style="font-size: 24px; font-weight: 800; color: #166534;">
            <?php 
                $today = date('Y-m-d');
                $count_today = 0;
                foreach($record->result() as $r) if(date('Y-m-d', strtotime($r->waktu_absen)) == $today) $count_today++;
                echo $count_today;
            ?>
        </div>
    </div>
    <div style="background: #fffbeb; padding: 25px; border-radius: 20px; border: 1px solid #fef3c7; text-align: center;">
        <div style="font-size: 11px; font-weight: 800; color: #f59e0b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">PENDING</div>
        <div style="font-size: 24px; font-weight: 800; color: #92400e;">0</div>
    </div>
    <div style="background: #fdf2f8; padding: 25px; border-radius: 20px; border: 1px solid #fce7f3; text-align: center;">
        <div style="font-size: 11px; font-weight: 800; color: #db2777; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">GANGGUAN</div>
        <div style="font-size: 24px; font-weight: 800; color: #9d174d;">N/A</div>
    </div>
</div>

<div class="table-container">
    <table id="tableAbsensi">
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mahasiswa</th>
                <th>Mata Kuliah / Kelas</th>
                <th>Pertemuan</th>
                <th>Dosen Pengampu</th>
                <th>Waktu & Tanggal</th>
                <th width="100">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($record->result() as $r): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <div style="font-weight: 700; color: #1e293b;"><?= $r->nama_mhs ?></div>
                    <div style="font-size: 11px; font-family: monospace; color: #64748b;"><?= $r->nim ?></div>
                </td>
                <td>
                    <div style="font-weight: 700; color: var(--primary);"><?= $r->nama_mk ?></div>
                    <div style="font-size: 11px; color: #64748b;">Kelas <?= $r->nama_kelas ?></div>
                </td>
                <td style="text-align: center;"><span class="badge" style="background: #f1f5f9; color: #475569;">Ptm <?= $r->pertemuan_ke ?></span></td>
                <td>
                    <div style="font-size: 13px; font-weight: 600;"><?= $r->nama_dosen ?></div>
                </td>
                <td>
                    <div style="font-weight: 700; color: #1e293b;"><?= date('H:i', strtotime($r->waktu_absen)) ?> WIB</div>
                    <div style="font-size: 11px; color: #94a3b8;"><?= date('d M Y', strtotime($r->tanggal)) ?></div>
                </td>
                <td><span class="badge badge-success" style="padding: 6px 15px; border-radius: 8px;">Hadir</span></td>
            </tr>
            <?php endforeach; ?>
            
            <?php if($record->num_rows() == 0): ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 60px; color: var(--text-muted);">
                    <i class="fa-solid fa-database" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                    Belum ada data aktivitas absensi yang tercatat hari ini.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
@media print {
    .sidebar, .top-navbar, .btn { display: none !important; }
    .main-wrapper { margin-left: 0 !important; width: 100% !important; padding: 0 !important; }
    .card { box-shadow: none !important; border: none !important; }
    .table-container { box-shadow: none !important; }
}
</style>
