<div class="card-header" style="justify-content: space-between; align-items: center;">
    <div>
        <h3 class="card-title"><i class="fa-solid fa-clipboard-user"></i> Manajemen Absensi Pertemuan</h3>
        <p style="color: #64748b; font-size: 13px; margin-top: 5px;">Kelola status kehadiran mahasiswa (Hadir, Sakit, Izin, Alpa).</p>
    </div>
    <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$ptm->id_kelas) ?>" class="btn btn-sm btn-edit" style="color: #64748b; background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 20px;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pertemuan
    </a>
</div>

<div style="padding: 20px;">
    <!-- Info Panel -->
    <div style="background: #f8fafc; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 30px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        <div>
            <span style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Mata Kuliah</span>
            <div style="font-weight: 800; color: #1e293b; margin-top: 5px;"><?= $ptm->nama_mk ?></div>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Pertemuan</span>
            <div style="font-weight: 800; color: #1e293b; margin-top: 5px;">Ke-<?= $ptm->pertemuan_ke ?> (<?= date('d M Y', strtotime($ptm->tanggal)) ?>)</div>
        </div>
        <div style="text-align: right;">
            <div style="display: inline-flex; gap: 10px;">
                <div style="text-align: center; background: white; padding: 8px 15px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <div style="font-size: 10px; font-weight: 700; color: #64748b;">TOTAL SISWA</div>
                    <div style="font-size: 18px; font-weight: 800; color: var(--primary);"><?= $absensi->num_rows() ?></div>
                </div>
                <div style="text-align: center; background: #ecfdf5; padding: 8px 15px; border-radius: 12px; border: 1px solid #d1fae5;">
                    <div style="font-size: 10px; font-weight: 700; color: #059669;">HADIR</div>
                    <div style="font-size: 18px; font-weight: 800; color: #059669;">
                        <?php 
                            $hadir = 0; 
                            foreach($absensi->result() as $row) if($row->status == 'Hadir') $hadir++;
                            echo $hadir;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success" style="margin-bottom: 25px; border-radius: 15px;"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>NIM / Mahasiswa</th>
                    <th width="150" style="text-align: center;">Waktu Scan</th>
                    <th width="150" style="text-align: center;">Status Sekarang</th>
                    <th width="200" style="text-align: center;">Ubah Status (Manual)</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($absensi->result() as $a): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <div style="font-weight: 800; color: #1e293b;"><?= $a->nama ?></div>
                        <div style="font-size: 12px; color: #64748b; font-family: monospace;"><?= $a->nim ?></div>
                    </td>
                    <td style="text-align: center;">
                        <?php if($a->waktu_absen): ?>
                            <div style="font-weight: 600; font-size: 13px; color: #475569;">
                                <i class="fa-regular fa-clock" style="margin-right: 5px; color: #94a3b8;"></i> 
                                <?= date('H:i', strtotime($a->waktu_absen)) ?>
                            </div>
                        <?php else: ?>
                            <span style="color: #cbd5e1; font-size: 12px;">--:--</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php 
                            $status = $a->status ?: 'Alpa';
                            $color = '#ef4444'; $bg = '#fff1f2';
                            if($status == 'Hadir') { $color = '#10b981'; $bg = '#ecfdf5'; }
                            else if($status == 'Izin') { $color = '#3b82f6'; $bg = '#eff6ff'; }
                            else if($status == 'Sakit') { $color = '#f59e0b'; $bg = '#fffbeb'; }
                        ?>
                        <span class="badge" style="background: <?= $bg ?>; color: <?= $color ?>; padding: 8px 15px; border-radius: 10px; font-weight: 800; min-width: 80px;">
                            <?= strtoupper($status) ?>
                        </span>
                    </td>
                    <td>
                        <form action="<?= base_url('index.php/dosen_fitur/update_status') ?>" method="post" style="display: flex; gap: 5px; justify-content: center;">
                            <input type="hidden" name="id_pertemuan" value="<?= $ptm->id_pertemuan ?>">
                            <input type="hidden" name="nim" value="<?= $a->nim ?>">
                            
                            <button type="submit" name="status" value="Hadir" class="btn btn-sm" style="background: #10b981; color: white; padding: 5px 10px;" title="Set Hadir"><i class="fa-solid fa-check"></i></button>
                            <button type="submit" name="status" value="Sakit" class="btn btn-sm" style="background: #f59e0b; color: white; padding: 5px 10px;" title="Set Sakit"><i class="fa-solid fa-briefcase-medical"></i></button>
                            <button type="submit" name="status" value="Izin" class="btn btn-sm" style="background: #3b82f6; color: white; padding: 5px 10px;" title="Set Izin"><i class="fa-solid fa-envelope"></i></button>
                            <button type="submit" name="status" value="Alpa" class="btn btn-sm" style="background: #ef4444; color: white; padding: 5px 10px;" title="Set Alpa"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
