<div class="card-header" style="flex-direction: column; align-items: flex-start; gap: 15px;">
    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
        <h3 class="card-title">Manajemen Data Dosen</h3>
        <a href="<?= base_url('index.php/dosen/tambah') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Dosen Baru
        </a>
    </div>

    <!-- Kotak Pencarian -->
    <div style="width: 100%; background: #f0fdf4; padding: 15px; border-radius: 12px; border: 1px solid #dcfce7;">
        <form action="<?= base_url('index.php/dosen') ?>" method="get" style="display: flex; gap: 10px;">
            <div style="flex: 1; position: relative;">
                <input type="text" name="q" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Cari dosen berdasarkan nama, NIDN, atau username..." 
                       style="width: 100%; padding: 12px 15px 12px 40px; border-radius: 10px; border: 1px solid #bbf7d0; outline: none;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 15px; top: 15px; color: #4ade80;"></i>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 0 25px; background: #16a34a; border-color: #16a34a;">CARI</button>
            <?php if(isset($keyword) && $keyword != ''): ?>
                <a href="<?= base_url('index.php/dosen') ?>" class="btn btn-danger" style="display: flex; align-items: center; justify-content: center; width: 45px; padding: 0;"><i class="fa-solid fa-xmark"></i></a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="120">NIDN</th>
                <th>Nama Dosen & Gelar</th>
                <th>Info Akun</th>
                <th>Status Akun</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($record->result() as $r) { ?>
            <tr style="<?= $r->status == 'pending' ? 'background: #fffbeb;' : '' ?>">
                <td><span class="badge badge-success"><?= $r->nidn ?></span></td>
                <td>
                    <div style="font-weight: 700; color: var(--primary);"><?= $r->nama_dosen ?></div>
                    <div style="font-size: 11px; color: var(--text-muted);"><?= $r->email ?></div>
                </td>
                <td>
                    <div style="font-size: 13px;"><i class="fa-solid fa-user-check" style="width: 15px;"></i> User: <?= $r->username ?></div>
                </td>
                <td>
                    <?php if($r->status == 'pending'): ?>
                        <span class="badge" style="background: #fbbf24; color: #92400e;">PENDING</span>
                    <?php elseif($r->status == 'active'): ?>
                        <span class="badge" style="background: #dcfce7; color: #166534;">AKTIF</span>
                    <?php else: ?>
                        <span class="badge" style="background: #fee2e2; color: #991b1b;">BLOKIR</span>
                    <?php endif; ?>
                </td>
                <td style="display: flex; gap: 8px;">
                    <?php if($r->status == 'pending'): ?>
                        <a href="<?= base_url('index.php/dosen/activate/'.$r->id_operator) ?>" class="btn btn-sm" style="background: #10b981; color: white;" title="Setujui Akun">
                            <i class="fa-solid fa-user-check"></i>
                        </a>
                    <?php endif; ?>

                    <a href="<?= base_url('index.php/dosen/edit/'.$r->nidn) ?>" class="btn btn-sm btn-edit" title="Edit Data">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="<?= base_url('index.php/dosen/hapus/'.$r->nidn) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data dosen ini?')" title="Hapus">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
            <?php if($record->num_rows() == 0): ?>
                <tr><td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">Data dosen tidak ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
