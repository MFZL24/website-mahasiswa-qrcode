<div class="card-header" style="justify-content: space-between;">
    <h3 class="card-title"><i class="fa-solid fa-users"></i> Daftar Mahasiswa Peserta Kelas</h3>
    <a href="<?= base_url('index.php/dosen_fitur/jadwal') ?>" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: none; border-radius: 12px; padding: 10px 20px;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Jadwal
    </a>
</div>

<div style="padding: 20px;">
    <!-- Info Kelas -->
    <div style="background: white; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; margin-bottom: 30px; display: flex; align-items: center; gap: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="width: 70px; height: 70px; background: #eff6ff; color: #3b82f6; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 30px;">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <h2 style="margin: 0; color: #1e293b; font-weight: 800;"><?= $kelas->nama_mk ?></h2>
            <p style="margin: 5px 0 0; color: #64748b; font-size: 15px;">Kelas: <b style="color: #3b82f6;"><?= $kelas->nama_kelas ?></b> | Total Peserta: <b><?= $mahasiswa->num_rows() ?> Mahasiswa</b></p>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($mahasiswa->result() as $m): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="font-family: monospace; font-weight: 700; color: #64748b;"><?= $m->nim ?></td>
                    <td style="font-weight: 700; color: #1e293b;"><?= $m->nama ?></td>
                    <td><span class="badge" style="background: #f1f5f9; color: #475569;"><?= $m->prodi ?></span></td>
                </tr>
                <?php endforeach; ?>
                
                <?php if($mahasiswa->num_rows() == 0): ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 60px; color: var(--text-muted);">
                        <i class="fa-solid fa-user-slash" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                        Belum ada mahasiswa yang mengambil kelas ini di KRS mereka.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
