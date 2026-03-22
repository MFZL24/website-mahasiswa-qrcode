<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>Pendaftaran Akun | UNIKI - Universitas Kebangsaan Indonesia</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/kampus/logo.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --primary-light: #f0f7f8;
            --secondary: #f6b553;
            --white: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; -webkit-tap-highlight-color: transparent; }
        
        a { text-decoration: none; color: inherit; }

        body {
            min-height: 100vh;
            background: #00363d url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .reg-card {
            width: 100%;
            max-width: 650px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            border-radius: 36px;
            box-shadow: 0 50px 100px rgba(0,0,0,0.3);
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.3);
        }

        @media (max-width: 768px) {
            body { padding: 0; }
            .reg-card { border-radius: 0; height: 100%; min-height: 100vh; }
            .reg-header { padding: 35px 25px !important; text-align: center; }
            .reg-logo { justify-content: center; }
            .reg-header h1 { font-size: 24px !important; }
            .reg-body { padding: 30px 20px !important; }
            .role-grid { grid-template-columns: 1fr !important; gap: 10px !important; }
            .input-grid { grid-template-columns: 1fr !important; gap: 10px !important; }
            .role-label { padding: 15px !important; flex-direction: row !important; gap: 20px !important; justify-content: flex-start !important; }
            .role-label i { font-size: 24px !important; }
            .btn-register { padding: 18px !important; font-size: 15px !important; }
            .footer-reg { margin-top: 20px !important; margin-bottom: 20px; }
        }

        .reg-header {
            background: var(--primary);
            padding: 45px 50px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .reg-header::before {
            content: ''; position: absolute; right: -50px; top: -50px;
            width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;
        }
        
        .header-content { position: relative; z-index: 2; }
        .reg-logo { display: flex; align-items: center; gap: 15px; font-size: 24px; font-weight: 800; margin-bottom: 20px; }
        .reg-logo img { width: 100%; height: 100%; object-fit: contain; }
        .reg-header h1 { font-size: 32px; font-weight: 900; margin-bottom: 8px; letter-spacing: -0.5px; }
        .reg-header p { font-size: 15px; opacity: 0.85; font-weight: 500; }

        .reg-body { padding: 50px; }

        .form-section-title {
            font-size: 12px; font-weight: 800; color: #475569;
            text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px;
            display: flex; align-items: center; gap: 10px;
        }
        .form-section-title::after { content:''; flex:1; height:1px; background: #e2e8f0; }

        /* Role Selector */
        .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px; }
        .role-opt { position: relative; }
        .role-opt input { position: absolute; opacity: 0; pointer-events: none; }
        .role-label {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 12px; padding: 25px 15px; border: 2.5px solid #f1f5f9; border-radius: 20px;
            cursor: pointer; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f8fafc;
        }
        .role-label i { font-size: 32px; color: #94a3b8; transition: all 0.3s; }
        .role-label span { font-size: 15px; font-weight: 800; color: #64748b; transition: all 0.3s; }
        
        .role-opt input:checked + .role-label {
            border-color: var(--primary); background: var(--primary-light);
            transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,104,116,0.1);
        }
        .role-opt input:checked + .role-label i { color: var(--primary); transform: scale(1.1); }
        .role-opt input:checked + .role-label span { color: var(--primary); }

        .alert-msg {
            padding: 16px 20px; border-radius: 16px; font-size: 14px;
            font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 12px;
        }
        .alert-error { background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; }

        .input-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .input-group { margin-bottom: 22px; }
        .input-group.full { grid-column: 1 / -1; }
        .input-group label {
            display: block; font-size: 13px; font-weight: 800;
            color: #475569; letter-spacing: 0.5px; margin-bottom: 8px;
        }
        .input-field { position: relative; }
        .input-field i {
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 18px; transition: all 0.3s;
        }
        .input-field input, .input-field select {
            width: 100%; padding: 16px 16px 16px 54px;
            border: 2px solid #f1f5f9; background: #f8fafc;
            border-radius: 18px; font-size: 15px; font-weight: 600;
            transition: all 0.3s; color: var(--text-main); outline: none;
            appearance: none;
        }
        .input-field select { cursor: pointer; }
        .input-field input:focus, .input-field select:focus {
            border-color: var(--primary); background: white;
            box-shadow: 0 0 0 5px rgba(0,104,116,0.08);
        }
        .input-field input:focus + i, .input-field select:focus + i { color: var(--primary); }

        .btn-reg {
            width: 100%; padding: 20px; margin-top: 15px;
            background: var(--primary); color: white; border: none;
            border-radius: 20px; font-size: 18px; font-weight: 800; cursor: pointer;
            box-shadow: 0 15px 35px rgba(0,104,116,0.25); transition: all 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 12px;
            letter-spacing: 0.5px;
        }
        .btn-reg:hover { background: var(--primary-dark); transform: translateY(-4px); box-shadow: 0 20px 45px rgba(0,104,116,0.35); }

        /* Animation for section switching */
        .input-group { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .hidden-field { display: none; opacity: 0; transform: translateY(10px); }
        .visible-field { display: block; opacity: 1; transform: translateY(0); }

        .reg-footer {
            text-align: center; margin-top: 35px; font-size: 15px; color: #64748b; font-weight: 600;
        }
        .reg-footer a { color: var(--primary); text-decoration: none; font-weight: 800; }
        .reg-footer .back-home { margin-top: 25px; }
        .reg-footer .back-home a { font-size: 13px; color: #94a3b8; font-weight: 700; }

        @media (max-width: 768px) {
            .input-grid { grid-template-columns: 1fr; }
            .reg-header { padding: 35px 30px; }
            .reg-body { padding: 35px 30px; }
        }
    </style>
</head>
<body>

<div class="reg-card">
    <div class="reg-header">
        <div class="header-content">
            <div class="reg-logo">
                <div style="background: white; padding: 10px; border-radius: 15px; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                   <img src="<?= base_url('assets/kampus/logo.png') ?>" alt="UNIKI Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <span>UNIKI ABSENSI</span>
            </div>
            <h1>Buat Akun Absensi</h1>
            <p>Daftarkan diri Anda untuk mulai menggunakan sistem absensi digital UNIKI.</p>
        </div>
    </div>

    <div class="reg-body">
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert-msg alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/proses_register') ?>" method="post">
            <div class="form-section-title">Pilih Peran</div>
            <div class="role-grid">
                <div class="role-opt">
                    <input type="radio" name="role" value="mahasiswa" id="r-mhs" checked>
                    <label for="r-mhs" class="role-label">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Mahasiswa</span>
                    </label>
                </div>
                <div class="role-opt">
                    <input type="radio" name="role" value="dosen" id="r-dosen">
                    <label for="r-dosen" class="role-label">
                        <i class="fa-solid fa-user-tie"></i>
                        <span>Dosen</span>
                    </label>
                </div>
            </div>

            <div class="form-section-title">Informasi Identitas</div>
            <div class="input-grid">
                <div class="input-group">
                    <label id="identity-label">Nomor Induk Mahasiswa (NIM)</label>
                    <div class="input-field">
                        <i id="identity-icon" class="fa-solid fa-id-card-clip"></i>
                        <input type="text" name="identity" placeholder="Contoh: 21.01.0001" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Nama Lengkap (Sesuai Ijazah)</label>
                    <div class="input-field">
                        <i class="fa-solid fa-user-pen"></i>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div class="input-group" id="fakultas-group">
                    <label>Fakultas</label>
                    <div class="input-field">
                        <i class="fa-solid fa-building-columns"></i>
                        <select name="fakultas" id="sel-fakultas">
                            <option value="" disabled selected>Pilih Fakultas</option>
                            <option value="Fakultas Ilmu Komputer (FIK)">Fakultas Ilmu Komputer (FIK)</option>
                            <option value="Fakultas Teknik (FT)">Fakultas Teknik (FT)</option>
                            <option value="Fakultas Ekonomi & Bisnis (FEB)">Fakultas Ekonomi & Bisnis (FEB)</option>
                            <option value="Fakultas Hukum (FH)">Fakultas Hukum (FH)</option>
                            <option value="Fakultas Pertanian (FP)">Fakultas Pertanian (FP)</option>
                        </select>
                        <i class="fa-solid fa-chevron-down" style="left: auto; right: 20px; font-size: 14px; pointer-events: none;"></i>
                    </div>
                </div>

                <div class="input-group" id="prodi-group">
                    <label>Program Studi</label>
                    <div class="input-field">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <select name="prodi" id="sel-prodi">
                            <option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>
                        </select>
                        <i class="fa-solid fa-chevron-down" style="left: auto; right: 20px; font-size: 14px; pointer-events: none;"></i>
                    </div>
                </div>

                <div class="input-group" id="angkatan-group">
                    <label>Tahun Angkatan</label>
                    <div class="input-field">
                        <i class="fa-solid fa-calendar-check"></i>
                        <select name="angkatan" id="sel-angkatan">
                            <?php 
                                $current_year = date('Y');
                                for($i = $current_year; $i >= $current_year - 7; $i--): 
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <i class="fa-solid fa-chevron-down" style="left: auto; right: 20px; font-size: 14px; pointer-events: none;"></i>
                    </div>
                </div>

                <div class="input-group" id="semester-group">
                    <label>Semester Saat Ini</label>
                    <div class="input-field">
                        <i class="fa-solid fa-layer-group"></i>
                        <select name="semester_aktif" id="sel-semester">
                            <?php for($i = 1; $i <= 8; $i++): ?>
                                <option value="<?= $i ?>">Semester <?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <i class="fa-solid fa-chevron-down" style="left: auto; right: 20px; font-size: 14px; pointer-events: none;"></i>
                    </div>
                </div>

                <div class="input-group" id="ipk-group" style="display: none;">
                    <label>IPK Terakhir</label>
                    <div class="input-field">
                        <i class="fa-solid fa-chart-line"></i>
                        <input type="number" step="0.01" min="0" max="4.00" name="ipk_terakhir" id="input-ipk" placeholder="Contoh: 3.50">
                    </div>
                    <small style="color: #64748b; font-size: 11px; margin-top: 5px; display: block;">* Wajib diisi untuk Semester 2 ke atas</small>
                </div>
            </div>

            <div class="form-section-title">Keamanan Akun</div>
            <div class="input-grid">
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-field">
                        <i class="fa-solid fa-user-astronaut"></i>
                        <input type="text" name="username" placeholder="Buat username" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Min. 8 karakter" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-reg">
                <i class="fa-solid fa-user-plus"></i> DAFTARKAN AKUN SAYA
            </button>
        </form>

        <div class="reg-footer">
            Sudah memiliki akun? <a href="<?= base_url('index.php/auth/login') ?>">Login di sini</a>
            
            <div class="back-home">
                <a href="<?= base_url() ?>">
                    <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Beranda Utama
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const prodiData = {
        "Fakultas Ilmu Komputer (FIK)": [
            "S1 - Informatika",
            "S1 - Sistem Informasi"
        ],
        "Fakultas Teknik (FT)": [
            "S1 - Teknik Elektro",
            "S1 - Teknik Sipil",
            "S1 - Teknik Mesin"
        ],
        "Fakultas Ekonomi & Bisnis (FEB)": [
            "S1 - Manajemen",
            "S1 - Akuntansi"
        ],
        "Fakultas Hukum (FH)": [
            "S1 - Ilmu Hukum"
        ],
        "Fakultas Pertanian (FP)": [
            "S1 - Agribisnis",
            "S1 - Agroteknologi"
        ]
    };

    const selFakultas = document.getElementById('sel-fakultas');
    const selProdi = document.getElementById('sel-prodi');

    selFakultas.addEventListener('change', function() {
        const selectedFakultas = this.value;
        const prodis = prodiData[selectedFakultas] || [];
        
        // Reset prodi dropdown
        selProdi.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';
        
        // Populate prodi dropdown
        prodis.forEach(prodi => {
            const option = document.createElement('option');
            option.value = prodi;
            option.textContent = prodi;
            selProdi.appendChild(option);
        });
    });

    const selSemester = document.getElementById('sel-semester');
    const ipkGroup = document.getElementById('ipk-group');
    const inputIpk = document.getElementById('input-ipk');
    const semesterGroup = document.getElementById('semester-group');

    selSemester.addEventListener('change', function() {
        if (parseInt(this.value) > 1) {
            ipkGroup.style.display = 'block';
            inputIpk.required = true;
        } else {
            ipkGroup.style.display = 'none';
            inputIpk.required = false;
            inputIpk.value = '';
        }
    });

    document.querySelectorAll('input[name="role"]').forEach(el => {
        el.addEventListener('change', function() {
            const label = document.getElementById('identity-label');
            const prodiGroup = document.getElementById('prodi-group');
            const fakultasGroup = document.getElementById('fakultas-group');
            const angkatanGroup = document.getElementById('angkatan-group');
            const identityIcon = document.getElementById('identity-icon');
            
            if (this.value === 'mahasiswa') {
                label.textContent = 'Nomor Induk Mahasiswa (NIM)';
                identityIcon.className = 'fa-solid fa-id-card-clip';
                prodiGroup.style.display = 'block';
                fakultasGroup.style.display = 'block';
                angkatanGroup.style.display = 'block';
                semesterGroup.style.display = 'block';
                // Trigger visibility for IPK based on initial semester 1 value
                selSemester.dispatchEvent(new Event('change'));
                
                selFakultas.required = true;
                selProdi.required = true;
                setTimeout(() => {
                    prodiGroup.classList.remove('hidden-field');
                    fakultasGroup.classList.remove('hidden-field');
                    angkatanGroup.classList.remove('hidden-field');
                }, 10);
            } else {
                label.textContent = 'Nomor Induk Dosen Nasional (NIDN)';
                identityIcon.className = 'fa-solid fa-badge';
                prodiGroup.classList.add('hidden-field');
                fakultasGroup.classList.add('hidden-field');
                angkatanGroup.classList.add('hidden-field');
                semesterGroup.style.display = 'none';
                ipkGroup.style.display = 'none';
                
                selFakultas.required = false;
                selProdi.required = false;
                setTimeout(() => {
                    prodiGroup.style.display = 'none';
                    fakultasGroup.style.display = 'none';
                    angkatanGroup.style.display = 'none';
                }, 400);
            }
        });
    });
</script>

</body>
</html>
