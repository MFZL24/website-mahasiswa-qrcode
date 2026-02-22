<div class="card-header" style="justify-content: space-between; align-items: flex-start; flex-direction: column; gap: 10px;">
    <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
        <h3 class="card-title"><i class="fa-solid fa-book-bookmark"></i> Kartu Rencana Studi (KRS)</h3>
        <a href="<?= base_url('index.php/mhs_fitur/ambil') ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus-circle"></i> Ambil Mata Kuliah
        </a>
    </div>
    
    <!-- Info Ringkasan KRS -->
    <div style="display: flex; gap: 20px; width: 100%; margin-top: 10px;">
        <div style="background: #f8fafc; padding: 15px 25px; border-radius: 15px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 15px; flex: 1;">
            <div style="width: 45px; height: 45px; background: #eff6ff; color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">IPK Terakhir</span>
                <div style="font-size: 18px; font-weight: 800; color: #1e293b;"><?= number_format($ipk, 2) ?></div>
            </div>
        </div>

        <div style="background: #f8fafc; padding: 15px 25px; border-radius: 15px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 15px; flex: 1;">
            <div style="width: 45px; height: 45px; background: #ecfdf5; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <div>
                <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Beban SKS</span>
                <div style="font-size: 18px; font-weight: 800; color: #1e293b;"><?= $total_sks ?> / <?= $max_sks ?> <small style="font-size: 11px; font-weight: 400; color: #94a3b8;">SKS</small></div>
            </div>
        </div>

        <div style="background: #fdf2f8; padding: 15px 25px; border-radius: 15px; border: 1px solid #fce7f3; display: flex; align-items: center; gap: 15px; flex: 1;">
            <div style="width: 45px; height: 45px; background: #fce7f3; color: #be185d; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Jumlah MK</span>
                <div style="font-size: 18px; font-weight: 800; color: #1e293b;"><?= $record->num_rows() ?> <small style="font-size: 11px; font-weight: 400; color: #94a3b8;">Matkul</small></div>
            </div>
        </div>
    </div>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success" style="margin: 20px;"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" style="margin: 20px;"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mata Kuliah / Kode</th>
                <th width="80" style="text-align: center;">SKS</th>
                <th>Dosen Pengampu</th>
                <th>Jadwal Kuliah</th>
                <th width="100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($record->result() as $r): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <div style="font-weight: 700; color: var(--primary);"><?= $r->nama_mk ?></div>
                    <div style="font-size: 11px; color: var(--text-muted);"><?= $r->kode_mk ?></div>
                </td>
                <td style="text-align: center;"><span class="badge" style="background: #f1f5f9; color: #475569;"><?= $r->sks ?> SKS</span></td>
                <td>
                    <div style="font-weight: 600;"><?= $r->nama_dosen ?></div>
                </td>
                <td>
                    <div style="font-weight: 700; color: #1e293b;"><i class="fa-regular fa-calendar-check" style="margin-right: 5px;"></i> <?= $r->hari ?></div>
                    <div style="font-size: 12px;"><i class="fa-regular fa-clock" style="margin-right: 5px;"></i> <?= substr($r->jam_mulai,0,5) ?> - <?= substr($r->jam_selesai,0,5) ?> (Kelas <?= $r->nama_kelas ?>)</div>
                </td>
                <td>
                    <a href="<?= base_url('index.php/mhs_fitur/hapus_krs/'.$r->id_krs) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pengambilan mata kuliah ini?')">
                        <i class="fa-solid fa-circle-xmark"></i> Batal
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if($record->num_rows() == 0): ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 50px; color: var(--text-muted);">
                    <i class="fa-solid fa-calendar-plus" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                    Anda belum mengambil mata kuliah apapun semester ini.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
