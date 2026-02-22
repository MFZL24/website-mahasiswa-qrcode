<div class="card-header">
    <h3 class="card-title"><i class="fa-solid fa-calendar-days"></i> Jadwal Perkuliahan Mingguan</h3>
</div>

<div style="margin: 20px 0;">
    <p style="color: var(--text-muted); font-size: 14px;">Berikut adalah jadwal kuliah Anda berdasarkan Mata Kuliah (KRS) yang telah diambil.</p>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th width="120">Hari</th>
                <th width="150">Waktu</th>
                <th>Mata Kuliah / Kode</th>
                <th>Dosen Pengampu</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $hari_order = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $found = false;
            
            // Urutkan jadwal berdasarkan hari
            $sorted_jadwal = [];
            foreach($jadwal->result() as $r) {
                $sorted_jadwal[$r->hari][] = $r;
            }

            foreach($hari_order as $h): 
                if(isset($sorted_jadwal[$h])):
                    foreach($sorted_jadwal[$h] as $r):
                        $found = true;
            ?>
            <tr>
                <td><span class="badge badge-primary" style="width: 80px; text-align: center;"><?= $h ?></span></td>
                <td>
                    <div style="font-weight: 700; color: #1e293b;"><?= substr($r->jam_mulai,0,5) ?> - <?= substr($r->jam_selesai,0,5) ?></div>
                </td>
                <td>
                    <div style="font-weight: 700; color: var(--primary);"><?= $r->nama_mk ?></div>
                    <div style="font-size: 11px; color: var(--text-muted);"><?= $r->kode_mk ?></div>
                </td>
                <td style="font-size: 14px;"><?= $r->nama_dosen ?></td>
                <td><span class="badge badge-secondary">Kelas <?= $r->nama_kelas ?></span></td>
            </tr>
            <?php 
                    endforeach;
                endif;
            endforeach; 
            ?>

            <?php if(!$found): ?>
            <tr>
                <td colspan="5" style="text-align: center; padding: 60px; color: var(--text-muted);">
                    <i class="fa-solid fa-calendar-xmark" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.3;"></i>
                    Belum ada jadwal kuliah. Silakan ambil Mata Kuliah (KRS) terlebih dahulu.
                    <br>
                    <a href="<?= base_url('index.php/mhs_fitur/ambil') ?>" class="btn btn-primary" style="margin-top: 15px;">Ambil Mata Kuliah Sekarang</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
