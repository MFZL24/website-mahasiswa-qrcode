<div class="card-header" style="flex-direction: column; align-items: flex-start; gap: 15px;">
    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
        <h3 class="card-title">Manajemen Akun Administrator</h3>
        <a href="<?= base_url('index.php/operator/tambah') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus-circle"></i> Tambah Admin Baru
        </a>
    </div>

    <!-- Kotak Pencarian -->
    <div style="width: 100%; background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0;">
        <form action="<?= base_url('index.php/operator') ?>" method="get" style="display: flex; gap: 10px;">
            <div style="flex: 1; position: relative;">
                <input type="text" name="q" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Cari admin berdasarkan nama, username, atau email..." 
                       style="width: 100%; padding: 12px 15px 12px 40px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 15px; top: 15px; color: #94a3b8;"></i>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 0 25px;">CARI</button>
            <?php if(isset($keyword) && $keyword != ''): ?>
                <a href="<?= base_url('index.php/operator') ?>" class="btn btn-danger" style="display: flex; align-items: center; justify-content: center; width: 45px; padding: 0;"><i class="fa-solid fa-xmark"></i></a>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success" style="margin: 20px;"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Lengkap & Akun Admin</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($record->result() as $r) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <div style="font-weight: 700; color: var(--text-main);"><?= $r->nama ? $r->nama : 'Belum Atur Nama' ?></div>
                    <div style="font-size: 11px; color: var(--text-muted);"><i class="fa-solid fa-at"></i> <?= $r->username ?> | <?= $r->email ?></div>
                </td>
                <td>
                    <?php if($r->status == 'active'): ?>
                        <span class="badge" style="background: #dcfce7; color: #166534;"><i class="fa-solid fa-check-circle"></i> AKTIF</span>
                    <?php else: ?>
                        <span class="badge" style="background: #fee2e2; color: #991b1b;"><i class="fa-solid fa-ban"></i> DIBLOKIR</span>
                    <?php endif; ?>
                </td>
                <td style="display: flex; gap: 5px;">
                    <a href="<?= base_url('index.php/operator/edit/'.$r->id_operator) ?>" class="btn btn-sm btn-edit" title="Edit Akun">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <?php if($r->username != $this->session->userdata('username')): ?>
                        <?php if($r->status == 'active'): ?>
                            <a href="<?= base_url('index.php/operator/block/'.$r->id_operator) ?>" class="btn btn-sm" style="background: #f59e0b; color: white;" title="Blokir">
                                <i class="fa-solid fa-user-slash"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('index.php/operator/activate/'.$r->id_operator) ?>" class="btn btn-sm" style="background: #10b981; color: white;" title="Aktifkan">
                                <i class="fa-solid fa-user-check"></i>
                            </a>
                        <?php endif; ?>

                        <a href="<?= base_url('index.php/operator/delete/'.$r->id_operator) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus admin ini?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
            <?php if($record->num_rows() == 0): ?>
                <tr><td colspan="4" style="text-align: center; padding: 40px; color: #94a3b8;">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
