<div class="card-header" style="justify-content: space-between;">
    <h3 class="card-title"><i class="fa-solid fa-clipboard-user"></i> Rekap Kehadiran Mahasiswa</h3>
    <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$ptm->id_kelas) ?>" class="btn btn-sm btn-edit" style="color: #64748b; background: #f1f5f9; border: none;">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div style="padding: 20px;">
    <!-- Info Pertemuan -->
    <div style="background: white; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div>
            <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Mata Kuliah</span>
            <h4 style="margin: 5px 0 0; color: #1e293b; font-weight: 800;"><?= $ptm->nama_mk ?></h4>
        </div>
        <div style="text-align: right;">
            <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Kelas / Pertemuan</span>
            <h4 style="margin: 5px 0 0; color: #1e293b; font-weight: 800;"><?= $ptm->nama_kelas ?> / Ke-<?= $ptm->pertemuan_ke ?></h4>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Tanggal Pelaksanaan</span>
            <p style="margin: 5px 0 0; color: #475569; font-weight: 600;"><?= date('d F Y', strtotime($ptm->tanggal)) ?></p>
        </div>
        <div style="text-align: right;">
            <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Total Kehadiran</span>
            <p style="margin: 5px 0 0; color: #10b981; font-weight: 800; font-size: 18px;"><?= $absensi->num_rows() ?> <small style="font-size: 12px; font-weight: 400; color: #64748b;">Mahasiswa</small></p>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Waktu Absen</th>
                    <th width="120">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($absensi->result() as $a): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="font-family: monospace; font-weight: 700; color: #64748b;"><?= $a->nim ?></td>
                    <td style="font-weight: 700; color: #1e293b;"><?= $a->nama_mhs ?></td>
                    <td><i class="fa-regular fa-clock" style="margin-right: 5px; color: #94a3b8;"></i> <?= date('H:i:s', strtotime($a->waktu_absen)) ?> WIB</td>
                    <td><span class="badge badge-success" style="padding: 6px 15px; border-radius: 8px;">Hadir</span></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if($absensi->num_rows() == 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 60px; color: var(--text-muted);">
                        <i class="fa-solid fa-user-slash" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                        Belum ada mahasiswa yang melakukan absensi pada pertemuan ini.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
