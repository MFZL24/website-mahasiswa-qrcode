<div class="card-header">
    <h3 class="card-title"><i class="fa-solid fa-users-viewfinder"></i> Monitoring KRS per Mahasiswa</h3>
    <a href="<?= base_url('index.php/krs/tambah') ?>" class="btn btn-primary">
        <i class="fa-solid fa-plus-circle"></i> Input KRS Manual
    </a>
</div>

<div style="background: #f8fafc; padding: 20px; border-radius: 15px; margin-bottom: 25px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 15px;">
    <i class="fa-solid fa-circle-info" style="color: #3b82f6; font-size: 20px;"></i>
    <p style="font-size: 14px; color: #64748b; margin: 0;">Tabel di bawah menampilkan ringkasan beban studi (SKS) dan jumlah mata kuliah yang diambil oleh setiap mahasiswa pada semester aktif.</p>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mahasiswa / NIM</th>
                <th>Program Studi</th>
                <th width="120" style="text-align: center;">Total MK</th>
                <th width="120" style="text-align: center;">Total SKS</th>
                <th width="120" style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($record->result() as $r) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <div style="font-weight: 700; color: #1e293b;"><?= $r->nama ?></div>
                    <div style="font-size: 12px; color: #64748b; font-family: monospace;"><?= $r->nim ?></div>
                </td>
                <td><span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 600;"><?= $r->prodi ?></span></td>
                <td style="text-align: center;">
                    <span class="badge" style="background: #eff6ff; color: #2563eb; padding: 6px 15px; border-radius: 8px;">
                        <?= $r->total_mk ?> Matakuliah
                    </span>
                </td>
                <td style="text-align: center;">
                    <?php 
                        $sks_color = ($r->total_sks > 20) ? '#10b981' : '#6366f1';
                        $sks_bg = ($r->total_sks > 20) ? '#ecfdf5' : '#eef2ff';
                    ?>
                    <span class="badge" style="background: <?= $sks_bg ?>; color: <?= $sks_color ?>; padding: 6px 15px; border-radius: 8px; font-weight: 800;">
                        <?= $r->total_sks ?: 0 ?> SKS
                    </span>
                </td>
                <td style="text-align: center;">
                    <a href="<?= base_url('index.php/krs/detail/'.$r->nim) ?>" class="btn btn-sm" style="background: var(--primary); color: white; padding: 8px 15px; border-radius: 8px; font-weight: 600;">
                        <i class="fa-solid fa-eye"></i> DETAIL
                    </a>
                </td>
            </tr>
            <?php } ?>
            <?php if($record->num_rows() == 0): ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 60px; color: var(--text-muted);">
                    <i class="fa-solid fa-users-slash" style="font-size: 50px; display: block; margin-bottom: 20px; opacity: 0.2;"></i>
                    Belum ada data mahasiswa atau KRS yang tercatat.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
