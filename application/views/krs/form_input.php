<div style="max-width: 800px; margin: 0 auto;">
    <div class="card-header" style="margin-bottom: 30px; text-align: center;">
        <h3 class="card-title"><i class="fa-solid fa-id-card-clip" style="color: var(--primary);"></i> Plotting KRS Mahasiswa</h3>
        <p style="font-size: 14px; color: var(--text-muted); margin-top: 5px;">Dafrtarkan Mahasiswa ke dalam Kelas tertentu agar dapat melakukan absensi.</p>
    </div>

    <form action="<?= base_url('index.php/krs/tambah') ?>" method="post">
        <div style="background: #ffffff; padding: 40px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);">
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label>1. Pilih Mahasiswa</label>
                <select name="nim" class="form-control" required style="appearance: auto; padding: 12px 15px;">
                    <option value="">-- Pilih Mahasiswa --</option>
                    <?php foreach($mhs->result() as $m): ?>
                        <option value="<?= $m->nim ?>"><?= $m->nim ?> - <?= $m->nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label>2. Masukkan ke Kelas</label>
                <select name="id_kelas" class="form-control" required style="appearance: auto; padding: 12px 15px;">
                    <option value="">-- Pilih Kelas Aktif --</option>
                    <?php foreach($kelas->result() as $k): ?>
                        <option value="<?= $k->id_kelas ?>">Kelas <?= $k->nama_kelas ?> - <?= $k->nama_mk ?> (<?= $k->nama_dosen ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>3. Pilih Kategori Semester</label>
                <select name="semester" class="form-control" required style="appearance: auto;">
                    <optgroup label="Semester Ganjil">
                        <option value="Ganjil 1">Ganjil - 1</option>
                        <option value="Ganjil 3">Ganjil - 3</option>
                        <option value="Ganjil 5">Ganjil - 5</option>
                        <option value="Ganjil 7">Ganjil - 7</option>
                        <option value="Ganjil 9">Ganjil - 9</option>
                        <option value="Ganjil 11">Ganjil - 11</option>
                        <option value="Ganjil 13">Ganjil - 13</option>
                    </optgroup>
                    <optgroup label="Semester Genap">
                        <option value="Genap 2">Genap - 2</option>
                        <option value="Genap 4">Genap - 4</option>
                        <option value="Genap 6">Genap - 6</option>
                        <option value="Genap 8">Genap - 8</option>
                        <option value="Genap 10">Genap - 10</option>
                        <option value="Genap 12">Genap - 12</option>
                        <option value="Genap 14">Genap - 14</option>
                    </optgroup>
                </select>
            </div>
            
            <div style="margin-top: 25px; background: #fffbeb; border: 1px solid #fde68a; padding: 15px; border-radius: 12px;">
                <p style="font-size: 12px; color: #92400e;">
                    <b>Catatan:</b> Mahasiswa hanya bisa melakukan absensi pada kelas yang Anda plot di sini. Pastikan data sudah benar sebelum menyimpan.
                </p>
            </div>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 15px; justify-content: center;">
            <a href="<?= base_url('index.php/krs') ?>" class="btn btn-danger" style="background: transparent; color: #ef4444; border: 1px solid #fecaca; width: 140px; justify-content: center;">
                <i class="fa-solid fa-xmark"></i> Batal
            </a>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 12px 50px;">
                <i class="fa-solid fa-link"></i> Simpan Plotting KRS
            </button>
        </div>
    </form>
</div>
