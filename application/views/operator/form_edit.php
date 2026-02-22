<div class="card-header">
    <h3 class="card-title">Edit Data Operator</h3>
</div>

<form action="<?= base_url('index.php/operator/edit') ?>" method="post" style="max-width: 500px;">
    <input type="hidden" name="id_operator" value="<?= $record['id_operator'] ?>">
    
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $record['username'] ?>" required>
    </div>
    
    <div class="form-group">
        <label>Password Baru (Opsional)</label>
        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
    </div>
    
    <div class="form-group">
        <label>Role Hak Akses</label>
        <select name="role" class="form-control" required style="appearance: auto;">
            <option value="admin" <?= $record['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="dosen" <?= $record['role'] == 'dosen' ? 'selected' : '' ?>>Dosen</option>
            <option value="mahasiswa" <?= $record['role'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
        </select>
    </div>

    <div style="margin-top: 30px; display: flex; gap: 10px;">
        <button type="submit" name="submit" class="btn btn-primary">
            <i class="fa-solid fa-cloud-arrow-up"></i> Perbarui Data
        </button>
        <a href="<?= base_url('index.php/operator') ?>" class="btn btn-danger">
            Batal
        </a>
    </div>
</form>
