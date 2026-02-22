<div class="form-container-card">
    <div class="form-section-title">
        <i class="fa-solid fa-school"></i> <?= isset($row) ? 'Edit Kelas Perkuliahan' : 'Buka Kelas Perkuliahan' ?>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/kelas/edit') : base_url('index.php/kelas/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="id" value="<?= $row['id_kelas'] ?>">
        <?php endif; ?>

        <div class="input-wrapper">
            <label>Mata Kuliah</label>
            <div class="input-field-container">
                <select name="id_mk" class="form-control select-pure" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    <?php foreach($mk->result() as $m): ?>
                        <option value="<?= $m->id_mk ?>" <?= isset($row) && $row['id_mk'] == $m->id_mk ? 'selected' : '' ?>>[<?= $m->kode_mk ?>] <?= $m->nama_mk ?></option>
                    <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-book"></i>
            </div>
        </div>

        <div class="input-wrapper">
            <label>Dosen Pengampu</label>
            <div class="input-field-container">
                <select name="nidn" class="form-control select-pure" required>
                    <option value="">-- Pilih Dosen Pengampu --</option>
                    <?php foreach($dosen->result() as $d): ?>
                        <option value="<?= $d->nidn ?>" <?= isset($row) && $row['nidn'] == $d->nidn ? 'selected' : '' ?>><?= $d->nama_dosen ?> (<?= $d->nidn ?>)</option>
                    <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-user-tie"></i>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="input-wrapper">
                <label>Nama Kelas</label>
                <div class="input-field-container">
                    <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: IF-A" required value="<?= isset($row) ? $row['nama_kelas'] : '' ?>">
                    <i class="fa-solid fa-door-open"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Semester Akademik</label>
                <div class="input-field-container">
                    <select name="semester" class="form-control select-pure" required>
                        <optgroup label="Semester Ganjil">
                            <option value="Ganjil 1" <?= isset($row) && $row['semester'] == 'Ganjil 1' ? 'selected' : '' ?>>Ganjil - 1</option>
                            <option value="Ganjil 3" <?= isset($row) && $row['semester'] == 'Ganjil 3' ? 'selected' : '' ?>>Ganjil - 3</option>
                            <option value="Ganjil 5" <?= isset($row) && $row['semester'] == 'Ganjil 5' ? 'selected' : '' ?>>Ganjil - 5</option>
                            <option value="Ganjil 7" <?= isset($row) && $row['semester'] == 'Ganjil 7' ? 'selected' : '' ?>>Ganjil - 7</option>
                            <option value="Ganjil 9" <?= isset($row) && $row['semester'] == 'Ganjil 9' ? 'selected' : '' ?>>Ganjil - 9</option>
                            <option value="Ganjil 11" <?= isset($row) && $row['semester'] == 'Ganjil 11' ? 'selected' : '' ?>>Ganjil - 11</option>
                            <option value="Ganjil 13" <?= isset($row) && $row['semester'] == 'Ganjil 13' ? 'selected' : '' ?>>Ganjil - 13</option>
                        </optgroup>
                        <optgroup label="Semester Genap">
                            <option value="Genap 2" <?= isset($row) && $row['semester'] == 'Genap 2' ? 'selected' : '' ?>>Genap - 2</option>
                            <option value="Genap 4" <?= isset($row) && $row['semester'] == 'Genap 4' ? 'selected' : '' ?>>Genap - 4</option>
                            <option value="Genap 6" <?= isset($row) && $row['semester'] == 'Genap 6' ? 'selected' : '' ?>>Genap - 6</option>
                            <option value="Genap 8" <?= isset($row) && $row['semester'] == 'Genap 8' ? 'selected' : '' ?>>Genap - 8</option>
                            <option value="Genap 10" <?= isset($row) && $row['semester'] == 'Genap 10' ? 'selected' : '' ?>>Genap - 10</option>
                            <option value="Genap 12" <?= isset($row) && $row['semester'] == 'Genap 12' ? 'selected' : '' ?>>Genap - 12</option>
                            <option value="Genap 14" <?= isset($row) && $row['semester'] == 'Genap 14' ? 'selected' : '' ?>>Genap - 14</option>
                        </optgroup>
                    </select>
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
        </div>

        <div style="background: #f8fafc; padding: 30px; border-radius: 20px; border: 1px solid #e2e8f0; margin-top: 10px;">
            <div class="form-section-title" style="font-size: 16px; margin-bottom: 25px;">
                <i class="fa-solid fa-calendar-day" style="width: 35px; height: 35px; font-size: 14px;"></i> Jadwal Mingguan Perkuliahan
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Hari</label>
                    <div class="input-field-container">
                        <select name="hari" class="form-control select-pure" required>
                            <?php $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; 
                            foreach($hari as $h): ?>
                                <option value="<?= $h ?>" <?= isset($row) && $row['hari'] == $h ? 'selected' : '' ?>><?= $h ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Jam Mulai</label>
                    <div class="input-field-container">
                        <input type="time" name="jam_mulai" class="form-control" required value="<?= isset($row) ? $row['jam_mulai'] : '08:00' ?>">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="input-wrapper" style="margin-bottom: 0;">
                    <label>Jam Selesai</label>
                    <div class="input-field-container">
                        <input type="time" name="jam_selesai" class="form-control" required value="<?= isset($row) ? $row['jam_selesai'] : '10:00' ?>">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: flex-end;">
            <button type="reset" class="btn btn-danger" style="background: white; color: #ef4444; border: 2px solid #fecaca; width: 140px; justify-content: center; height: 55px; border-radius: 16px;">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </button>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 0 45px; height: 55px; border-radius: 16px; font-size: 16px; font-weight: 700; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                <?= isset($row) ? 'UPDATE KELAS' : 'BUKA KELAS SEKARANG' ?>
            </button>
        </div>
    </form>
</div>
