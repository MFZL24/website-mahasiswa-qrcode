<div class="card-header" style="justify-content: space-between;">
    <h3 class="card-title"><i class="fa-solid fa-graduation-cap"></i> Detail KRS Mahasiswa</h3>
    <a href="<?= base_url('index.php/krs') ?>" class="btn btn-sm btn-edit" style="color: #64748b; background: #f1f5f9; border: none;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Monitoring
    </a>
</div>

<div style="padding: 20px;">
    <!-- Profil Singkat -->
    <div style="background: white; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 30px; display: flex; align-items: center; gap: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="width: 80px; height: 80px; background: #eff6ff; color: #3b82f6; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 35px;">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <h2 style="margin: 0; color: #1e293b; font-weight: 800;"><?= $mhs->nama ?></h2>
            <p style="margin: 5px 0 0; color: #64748b; font-size: 15px;">NIM: <b style="color: #3b82f6;"><?= $mhs->nim ?></b> | Program Studi: <b><?= $mhs->prodi ?></b></p>
        </div>
    </div>

    <div class="card-header" style="background: transparent; padding: 0; margin-bottom: 20px;">
        <h4 class="card-title" style="font-size: 16px;"><i class="fa-solid fa-book-open"></i> Daftar Mata Kuliah yang Diambil</h4>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th width="80" style="text-align: center;">SKS</th>
                    <th>Dosen Pengampu</th>
                    <th>Jadwal & Kelas</th>
                    <th width="80">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_sks = 0; $no=1; foreach($record->result() as $r): $total_sks += $r->sks; ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="font-family: monospace; font-weight: 700; color: #64748b;"><?= $r->kode_mk ?></td>
                    <td style="font-weight: 700; color: var(--primary);"><?= $r->nama_mk ?></td>
                    <td style="text-align: center;"><span class="badge" style="background: #f1f5f9; color: #475569;"><?= $r->sks ?> SKS</span></td>
                    <td><div style="font-weight: 600;"><?= $r->nama_dosen ?></div></td>
                    <td>
                        <div style="font-weight: 700; color: #1e293b;"><?= $r->hari ?>, <?= substr($r->jam_mulai,0,5) ?></div>
                        <div style="font-size: 11px; color: #94a3b8;">Kelas <?= $r->nama_kelas ?></div>
                    </td>
                    <td>
                        <a href="<?= base_url('index.php/krs/hapus/'.$r->id_krs) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pengambilan mata kuliah ini untuk mahasiswa?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if($record->num_rows() > 0): ?>
                <tr style="background: #f8fafc; border-top: 2px solid #e2e8f0;">
                    <td colspan="3" style="text-align: right; font-weight: 800; padding: 20px; color: #1e293b;">TOTAL BEBAN STUDI</td>
                    <td style="text-align: center; font-weight: 800; font-size: 16px; color: #3b82f6;"><?= $total_sks ?> SKS</td>
                    <td colspan="3"></td>
                </tr>
                <?php endif; ?>

                <?php if($record->num_rows() == 0): ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 60px; color: var(--text-muted);">
                        <i class="fa-solid fa-book-medical" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                        Mahasiswa ini belum mengambil mata kuliah apapun semester ini.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
