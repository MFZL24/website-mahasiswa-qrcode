<div class="card">
    <div class="card-header" style="justify-content: space-between; align-items: center; margin-bottom: 35px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px;">
                <i class="fa-solid fa-shield-halved" style="color: var(--primary);"></i> Manajemen Administrator
            </h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Kelola akun pengelola sistem dengan akses penuh ke data akademik UNIKI.</p>
        </div>
        <a href="<?= base_url('index.php/operator/tambah') ?>" class="btn-primary" style="padding: 14px 28px; border-radius: 16px; font-weight: 700; background: var(--primary); color: white; border: none; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); transition: all 0.3s; display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <i class="fa-solid fa-user-plus" style="font-size: 18px;"></i> Tambah Admin Baru
        </a>
    </div>

    <!-- Filter Section - Neo Modern -->
    <div style="width: 100%; background: var(--primary-light); padding: 25px; border-radius: 20px; border: 1px solid #bfdbfe; margin-bottom: 35px;">
        <form action="<?= base_url('index.php/operator') ?>" method="get" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <div style="flex: 2; position: relative; min-width: 300px;">
                <input type="text" name="q" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Cari nama, username, atau email admin..." 
                       style="width: 100%; padding: 15px 15px 15px 48px; border-radius: 14px; border: 1px solid #bfdbfe; outline: none; background: white; font-weight: 600; color: #1e293b; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(0, 104, 116, 0.1)';">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 18px; top: 18px; color: var(--primary); font-size: 16px;"></i>
            </div>
            <button type="submit" class="btn-primary" style="padding: 0 35px; border-radius: 14px; background: var(--primary-dark); color: white; border: none; font-weight: 700; cursor: pointer;">CARI DATA</button>
            <?php if(isset($keyword) && $keyword != ''): ?>
                <a href="<?= base_url('index.php/operator') ?>" class="btn-danger" style="display: flex; align-items: center; justify-content: center; width: 50px; border-radius: 14px; padding: 0; text-decoration: none;"><i class="fa-solid fa-rotate-right"></i></a>
            <?php endif; ?>
        </form>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success" style="border: none; box-shadow: 0 10px 20px rgba(5, 150, 105, 0.1); border-radius: 16px; margin-bottom: 30px;">
            <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Enhanced Table Container -->
    <div class="table-container" style="border-radius: 20px; overflow-x: auto; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
        <table style="min-width: 800px;">
            <thead style="background: #f8fafc;">
                <tr>
                    <th width="70" style="padding-left: 30px; text-align: center;">No</th>
                    <th>Identitas Pengelola</th>
                    <th style="text-align: center;">Status Akun</th>
                    <th width="150" style="padding-right: 30px; text-align: right;">Kelola</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($record->result() as $r) { ?>
                <tr>
                    <td style="padding-left: 30px; text-align: center; font-weight: 700; color: #94a3b8;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px; box-shadow: 0 8px 15px rgba(0, 104, 116, 0.2);">
                                <?= strtoupper(substr($r->username, 0, 1)) ?>
                            </div>
                            <div>
                                <div style="font-weight: 800; color: #1e293b; font-size: 16px;"><?= $r->nama ? $r->nama : 'Belum Atur Nama' ?></div>
                                <div style="font-size: 12px; color: #64748b; font-weight: 600; display: flex; align-items: center; gap: 6px; margin-top: 2px;">
                                    <i class="fa-solid fa-signature" style="font-size: 10px; opacity: 0.6;"></i> <?= $r->username ?> 
                                    <span style="opacity: 0.3;">|</span>
                                    <i class="fa-solid fa-envelope" style="font-size: 10px; opacity: 0.6;"></i> <?= $r->email ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <?php if($r->status == 'active'): ?>
                            <span class="badge" style="background: #dcfce7; color: #15803d; padding: 8px 16px; border-radius: 10px; border: 1px solid #bbf7d0;">
                                <i class="fa-solid fa-circle-check"></i> AKTIF
                            </span>
                        <?php else: ?>
                            <span class="badge" style="background: #fff1f2; color: #e11d48; padding: 8px 16px; border-radius: 10px; border: 1px solid #ffe4e6;">
                                <i class="fa-solid fa-circle-xmark"></i> TERBLOKIR
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="padding-right: 30px; text-align: right;">
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <a href="<?= base_url('index.php/operator/edit/'.$r->id_operator) ?>" class="btn-action" style="background: #eff6ff; color: #2563eb; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s; border: 1px solid #dbeafe;" title="Ubah Profil">
                                <i class="fa-solid fa-user-gear"></i>
                            </a>

                            <?php if($r->username != $this->session->userdata('username')): ?>
                                <?php if($r->status == 'active'): ?>
                                    <a href="<?= base_url('index.php/operator/block/'.$r->id_operator) ?>" class="btn-action" style="background: #fff7ed; color: #ea580c; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s; border: 1px solid #ffedd5;" title="Kunci Akun">
                                        <i class="fa-solid fa-user-lock"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('index.php/operator/activate/'.$r->id_operator) ?>" class="btn-action" style="background: #ecfdf5; color: #059669; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s; border: 1px solid #d1fae5;" title="Buka Kunci">
                                        <i class="fa-solid fa-user-check"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="<?= base_url('index.php/operator/delete/'.$r->id_operator) ?>" class="btn-action btn-del" style="background: #fff1f2; color: #e11d48; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s; border: 1px solid #ffe4e6;" title="Hapus Permanen" onclick="return confirm('Apakah Anda yakin ingin menghapus administrator ini?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php if($record->num_rows() == 0): ?>
                    <tr><td colspan="4" style="text-align: center; padding: 100px; color: #94a3b8; font-weight: 600;">
                        <i class="fa-solid fa-users-slash" style="font-size: 50px; opacity: 0.2; display: block; margin-bottom: 20px;"></i>
                        Tidak ada data administrator yang ditemukan.
                    </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-action { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .btn-action:hover { transform: scale(1.1); filter: brightness(0.95); }
    .btn-del:hover { background: #e11d48 !important; color: white !important; box-shadow: 0 8px 15px rgba(225, 29, 72, 0.2); }
</style>
