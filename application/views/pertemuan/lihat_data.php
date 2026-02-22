<div class="card-header">
    <h3 class="card-title">Jadwal Pertemuan Kuliah</h3>
    <a href="<?= base_url('index.php/pertemuan/tambah') ?>" class="btn btn-primary">
        <i class="fa-solid fa-calendar-plus"></i> Buat Pertemuan
    </a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Pertemuan Ke</th>
                <th>Tanggal</th>
                <th>Mulai</th>
                <th width="100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($record->result() as $r) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td style="font-weight: 600;"><?= $r->nama_mk ?></td>
                <td><span class="badge badge-primary"><?= $r->nama_kelas ?></span></td>
                <td style="text-align: center;"><?= $r->pertemuan_ke ?></td>
                <td><?= date('d M Y', strtotime($r->tanggal)) ?></td>
                <td><?= substr($r->jam_mulai, 0, 5) ?> WIB</td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="<?= base_url('index.php/pertemuan/rekap/'.$r->id_pertemuan) ?>" class="btn btn-sm btn-edit" title="Lihat Kehadiran">
                            <i class="fa-solid fa-users"></i>
                        </a>
                        <a href="<?= base_url('index.php/pertemuan/hapus/'.$r->id_pertemuan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pertemuan ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
