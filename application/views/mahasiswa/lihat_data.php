<div class="card">
    <div class="card-header" style="justify-content: space-between; align-items: center; margin-bottom: 35px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px;">
                <i class="fa-solid fa-user-graduate" style="color: var(--primary);"></i> Direktori Mahasiswa
            </h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Manajemen database identitas mahasiswa dan status registrasi akademik.</p>
        </div>
        <a href="<?= base_url('index.php/mahasiswa/tambah') ?>" class="btn-primary" style="padding: 14px 28px; border-radius: 16px; font-weight: 700; background: var(--primary); color: white; border: none; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); transition: all 0.3s; display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <i class="fa-solid fa-plus-circle" style="font-size: 18px;"></i> Registrasi Mahasiswa
        </a>
    </div>

    <!-- Filter Section - Neo Modern -->
    <div style="width: 100%; background: var(--primary-light); padding: 25px; border-radius: 20px; border: 1px solid #dbeafe; margin-bottom: 35px;">
        <form action="<?= base_url('index.php/mahasiswa') ?>" method="get" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <div style="flex: 2; position: relative; min-width: 300px;">
                <input type="text" name="q" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Cari Nama Lengkap atau NIM..." 
                       style="width: 100%; padding: 15px 15px 15px 48px; border-radius: 14px; border: 1px solid #bfdbfe; outline: none; background: white; font-weight: 600; color: #1e293b; transition: all 0.3s;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(0, 104, 116, 0.1)';">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 18px; top: 18px; color: var(--primary); font-size: 16px;"></i>
            </div>
            <div style="flex: 1; min-width: 250px;">
                <select name="f" style="width: 100%; padding: 15px; border-radius: 14px; border: 1px solid #bfdbfe; outline: none; background: white; font-weight: 700; color: #1e293b; cursor: pointer;">
                    <option value="">-- Semua Fakultas --</option>
                    <option value="Fakultas Ilmu Komputer (FIK)" <?= $this->input->get('f') == 'Fakultas Ilmu Komputer (FIK)' ? 'selected' : '' ?>>Fakultas Ilmu Komputer (FIK)</option>
                    <option value="Fakultas Teknik (FT)" <?= $this->input->get('f') == 'Fakultas Teknik (FT)' ? 'selected' : '' ?>>Fakultas Teknik (FT)</option>
                    <option value="Fakultas Ekonomi (FE)" <?= $this->input->get('f') == 'Fakultas Ekonomi (FE)' ? 'selected' : '' ?>>Fakultas Ekonomi (FE)</option>
                    <option value="Fakultas Hukum (FH)" <?= $this->input->get('f') == 'Fakultas Hukum (FH)' ? 'selected' : '' ?>>Fakultas Hukum (FH)</option>
                </select>
            </div>
            <button type="submit" class="btn-primary" style="padding: 0 35px; border-radius: 14px; background: var(--primary-dark); color: white; border: none; cursor: pointer; font-weight: 700;">TERAPKAN</button>
            <?php if($this->input->get('q') || $this->input->get('f')): ?>
                <a href="<?= base_url('index.php/mahasiswa') ?>" class="btn-danger" style="display: flex; align-items: center; justify-content: center; width: 50px; border-radius: 14px; padding: 0; text-decoration: none;"><i class="fa-solid fa-rotate-right"></i></a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Enhanced Table Container -->
    <div class="table-container" style="border-radius: 20px; overflow-x: auto; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
        <table style="min-width: 900px;">
            <thead style="background: #f8fafc;">
                <tr>
                    <th width="120" style="padding-left: 30px;">Identitas NIM</th>
                    <th>Mahasiswa & User Profil</th>
                    <th>Detail Akademik</th>
                    <th style="text-align: center;">Status Akun</th>
                    <th width="150" style="padding-right: 30px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($record->result() as $r) { 
                    $foto = isset($r->foto) ? $r->foto : '';
                    $foto_src = (strpos($foto, 'http') === 0) ? $foto : base_url('assets/img/profile/').($foto ? $foto : 'default.png');
                ?>
                <tr style="<?= $r->status == 'pending' ? 'background: #fffdf5;' : '' ?>">
                    <td style="padding-left: 30px;">
                        <span style="font-family: 'JetBrains Mono', monospace; font-weight: 810; color: #1e293b; background: var(--primary-light); padding: 8px 14px; border-radius: 10px; font-size: 13px; border: 1px solid #dbeafe; letter-spacing: -0.5px;">
                            <?= $r->nim ?>
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="position: relative;">
                                <img src="<?= $foto_src ?>" style="width: 55px; height: 55px; border-radius: 16px; object-fit: cover; border: 3px solid white; box-shadow: 0 10px 20px rgba(0,0,0,0.08);">
                                <?php if($r->status == 'active'): ?>
                                    <div style="position: absolute; bottom: -2px; right: -2px; width: 14px; height: 14px; background: #10b981; border-radius: 50%; border: 2px solid white;"></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div style="font-weight: 850; color: #1e293b; font-size: 16px; letter-spacing: -0.2px;"><?= $r->nama ?></div>
                                <div style="font-size: 12px; color: #64748b; font-weight: 700; display: flex; align-items: center; gap: 5px; margin-top: 2px;">
                                    <i class="fa-solid fa-at" style="font-size: 10px; opacity: 0.6;"></i> <?= $r->username ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <div style="font-weight: 800; color: #1e293b; font-size: 13px;"><?= $r->prodi ?></div>
                            <div style="font-size: 11px; color: var(--primary); font-weight: 800; display: flex; align-items: center; gap: 6px;">
                                 <i class="fa-solid fa-building-columns" style="opacity: 0.7;"></i> <?= $r->fakultas ?>
                            </div>
                            <div style="font-size: 10px; color: #94a3b8; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Angkatan <?= $r->angkatan ?></div>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <?php if($r->status == 'pending'): ?>
                            <span class="badge" style="background: #fffbeb; color: #92400e; padding: 8px 15px; border-radius: 10px; border: 1px solid #fde68a;">
                                <i class="fa-solid fa-clock-rotate-left"></i> PENDING
                            </span>
                        <?php elseif($r->status == 'active'): ?>
                            <span class="badge" style="background: #dcfce7; color: #15803d; padding: 8px 15px; border-radius: 10px; border: 1px solid #bbf7d0;">
                                <i class="fa-solid fa-circle-check"></i> AKTIF
                            </span>
                        <?php else: ?>
                            <span class="badge" style="background: #fff1f2; color: #e11d48; padding: 8px 15px; border-radius: 10px; border: 1px solid #ffe4e6;">
                                <i class="fa-solid fa-circle-xmark"></i> DIBLOKIR
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="padding-right: 30px; text-align: right;">
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <?php if($r->status == 'pending'): ?>
                                <a href="<?= base_url('index.php/mahasiswa/activate/'.$r->id_operator) ?>" class="btn-action" style="background: #ecfdf5; color: #059669; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #d1fae5;" title="Aktivasi Akun">
                                    <i class="fa-solid fa-user-check"></i>
                                </a>
                            <?php endif; ?>

                            <a href="<?= base_url('index.php/mahasiswa/edit/'.$r->nim) ?>" class="btn-action" style="background: #eff6ff; color: #2563eb; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #dbeafe;" title="Ubah Data">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                            <a href="<?= base_url('index.php/mahasiswa/hapus/'.$r->nim) ?>" class="btn-action btn-del" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini secara permanen?')" style="background: #fff1f2; color: #e11d48; width: 38px; height: 38px; border-radius: 12px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid #ffe4e6;" title="Hapus Data">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($record->num_rows() == 0): ?>
                    <tr><td colspan="5" style="text-align: center; padding: 100px; color: #94a3b8; font-weight: 700;">
                        <i class="fa-solid fa-user-slash" style="font-size: 50px; opacity: 0.15; display: block; margin-bottom: 20px;"></i>
                        Tidak ada data mahasiswa yang ditemukan.
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
    tr:hover td { background: #fafbfc; }
    .btn-primary:hover { opacity: 0.9; transform: translateY(-2px); }
</style>
