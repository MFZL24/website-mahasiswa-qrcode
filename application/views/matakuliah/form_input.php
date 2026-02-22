<div class="form-container-card">
    <div class="form-section-title">
        <i class="fa-solid fa-book-open"></i> <?= isset($row) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah Baru' ?>
    </div>

    <form action="<?= isset($row) ? base_url('index.php/matakuliah/edit') : base_url('index.php/matakuliah/tambah') ?>" method="post">
        <?php if(isset($row)): ?>
            <input type="hidden" name="id" value="<?= $row['id_mk'] ?>">
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            <div class="input-wrapper">
                <label>Kode Mata Kuliah</label>
                <div class="input-field-container">
                    <input type="text" name="kode_mk" class="form-control" placeholder="Contoh: MK-101" required value="<?= isset($row) ? $row['kode_mk'] : '' ?>">
                    <i class="fa-solid fa-barcode"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Bobot SKS</label>
                <div class="input-field-container">
                    <select name="sks" class="form-control select-pure" required>
                        <?php for($i=1; $i<=6; $i++): ?>
                            <option value="<?= $i ?>" <?= isset($row) && $row['sks'] == $i ? 'selected' : ($i==3 ? 'selected' : '') ?>><?= $i ?> SKS</option>
                        <?php endfor; ?>
                    </select>
                    <i class="fa-solid fa-list-numeric"></i>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            <div class="input-wrapper">
                <label>Nama Mata Kuliah</label>
                <div class="input-field-container">
                    <input type="text" name="nama_mk" class="form-control" placeholder="Contoh: Pemrograman Web" required value="<?= isset($row) ? $row['nama_mk'] : '' ?>">
                    <i class="fa-solid fa-font"></i>
                </div>
            </div>
            <div class="input-wrapper">
                <label>Semester</label>
                <div class="input-field-container">
                    <select name="semester" class="form-control select-pure" required>
                        <?php for($i=1; $i<=14; $i++): ?>
                            <option value="<?= $i ?>" <?= isset($row) && $row['semester'] == $i ? 'selected' : '' ?>>Semester <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; display: flex; gap: 15px; justify-content: flex-end;">
            <button type="reset" class="btn btn-danger" style="background: white; color: #64748b; border: 2px solid #e2e8f0; width: 140px; justify-content: center; height: 55px; border-radius: 16px;">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </button>
            <button type="submit" name="submit" class="btn btn-primary" style="padding: 0 45px; height: 55px; border-radius: 16px; font-size: 16px; font-weight: 700; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                <?= isset($row) ? 'UPDATE DATA' : 'SIMPAN DATA' ?>
            </button>
        </div>
    </form>
</div>
