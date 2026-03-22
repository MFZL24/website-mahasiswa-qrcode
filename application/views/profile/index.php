<!-- Page Title & Header -->
<div class="card-header" style="padding: 0; margin-bottom: 50px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px;">
    <div>
        <h3 class="card-title" style="font-size: 30px; font-weight: 950; color: #0f172a; display: flex; align-items: center; gap: 18px; letter-spacing: -1.5px; margin: 0;">
            <span style="background: var(--primary); color: white; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(0, 104, 116, 0.2);">
                <i class="fa-solid fa-user-gear"></i>
            </span>
            Konfigurasi Profil
        </h3>
        <p style="color: #64748b; font-size: 16px; margin: 10px 0 0 78px; font-weight: 500;">Personalisasi identitas digital, foto profil, dan manajemen keamanan akun Anda.</p>
    </div>
    <div style="font-size: 13px; color: #059669; font-weight: 850; text-transform: uppercase; letter-spacing: 1.5px; background: #dcfce7; padding: 12px 25px; border-radius: 50px; border: 1.5px solid #bbf7d0; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-shield-check" style="font-size: 18px;"></i> STATUS: AKUN TERVERIFIKASI
    </div>
</div>

<?php 
// Fallback if data is missing
if (!$user) {
    echo "<div class='alert alert-danger'>Data profil tidak ditemukan atau sesi telah berakhir.</div>";
    return;
}
$foto = (!empty($user['foto'])) ? $user['foto'] : 'default.png';
$foto_path = base_url('assets/img/profile/').$foto;
?>

<div style="display: grid; grid-template-columns: 400px 1fr; gap: 40px; align-items: start;">
    
    <!-- Left Column: Quick Stats & Avatar -->
    <div style="display: flex; flex-direction: column; gap: 40px;">
        
        <!-- Premium Avatar Card -->
        <div class="profile-card-glass" style="background: white; border-radius: 45px; padding: 50px 30px; border: 1.5px solid #f1f5f9; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.03); text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 120px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); opacity: 0.1; z-index: 0;"></div>
            
            <div style="position: relative; z-index: 1;">
                <div style="position: relative; display: inline-block; margin-bottom: 30px;">
                    <img src="<?= $foto_path ?>" id="preview-foto" style="width: 200px; height: 200px; border-radius: 60px; object-fit: cover; border: 8px solid white; box-shadow: 0 20px 40px rgba(0,0,0,0.12); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <label for="foto-input" style="position: absolute; bottom: 10px; right: 10px; background: #0f172a; color: white; width: 55px; height: 55px; border-radius: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 5px solid white; box-shadow: 0 10px 20px rgba(0,0,0,0.15); transition: 0.3s;" class="cam-btn">
                        <i class="fa-solid fa-camera-retro" style="font-size: 20px;"></i>
                    </label>
                </div>
                
                <h4 style="margin: 0 0 10px; font-size: 24px; font-weight: 950; color: #1e293b; letter-spacing: -1px;"><?= $user['nama'] ?></h4>
                
                <div style="display: flex; flex-direction: column; gap: 12px; align-items: center; margin-top: 20px;">
                    <span style="font-size: 11px; font-weight: 900; color: white; text-transform: uppercase; letter-spacing: 2px; background: var(--primary); padding: 8px 25px; border-radius: 50px; display: inline-block;">
                        <?= $user['role'] ?>
                    </span>
                    <span style="font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 800; color: #64748b; background: #f8fafc; padding: 6px 15px; border-radius: 12px; border: 1.5px solid #f1f5f9;">
                        ID: <?= $user['identity'] ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Security Card -->
        <div class="auth-card" style="background: #0f172a; border-radius: 40px; padding: 40px; color: white; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
                <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-fingerprint" style="color: #38bdf8;"></i>
                </div>
                <h5 style="font-size: 18px; font-weight: 850; margin: 0; letter-spacing: -0.5px;">Ganti Password</h5>
            </div>

            <form action="<?= base_url('index.php/profile/update_password') ?>" method="post">
                <div style="margin-bottom: 25px;">
                    <label style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">PASSWORD BARU</label>
                    <div style="position: relative;">
                        <input type="password" name="password_baru" id="p_baru" placeholder="Minimal 6 karakter" required minlength="6" 
                               style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.1); padding: 18px 20px; border-radius: 16px; color: white; font-weight: 600; outline: none; transition: 0.3s;"
                               onfocus="this.style.borderColor='#38bdf8'; this.style.background='rgba(56, 189, 248, 0.05)'"
                               onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)'">
                        <i class="fa-solid fa-eye" id="toggle-p_baru" style="position: absolute; right: 20px; top: 20px; color: #64748b; cursor: pointer;" onclick="togglePassword('p_baru')"></i>
                    </div>
                </div>

                <div style="margin-bottom: 35px;">
                    <label style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">KONFIRMASI PASSWORD</label>
                    <input type="password" name="konfirmasi_password" placeholder="Ulangi password baru" required 
                           style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.1); padding: 18px 20px; border-radius: 16px; color: white; font-weight: 600; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='#38bdf8'; this.style.background='rgba(56, 189, 248, 0.05)'"
                           onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.05)'">
                </div>

                <button type="submit" style="width: 100%; background: #38bdf8; color: #0f172a; padding: 18px; border-radius: 18px; font-weight: 900; border: none; cursor: pointer; transition: 0.3s; text-transform: uppercase; letter-spacing: 1px;">
                    UPDATE KEAMANAN <i class="fa-solid fa-shield-bolt" style="margin-left: 10px;"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Right Column: Form Data -->
    <div style="background: white; border-radius: 50px; padding: 60px; border: 1.5px solid #f1f5f9; box-shadow: 0 20px 60px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 45px; font-size: 22px; font-weight: 950; color: #1e293b; display: flex; align-items: center; gap: 18px; letter-spacing: -0.5px;">
            <i class="fa-solid fa-circle-user" style="color: var(--primary);"></i> Informasi Biodata Utama
        </h3>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success" style="margin-bottom: 40px; border-radius: 20px; padding: 22px 30px; border: none; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.1); display: flex; align-items: center; gap: 15px;">
                <i class="fa-solid fa-octagon-check" style="font-size: 20px;"></i> 
                <span style="font-weight: 800;"><?= $this->session->flashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="margin-bottom: 40px; border-radius: 20px; padding: 22px 30px; border: none; box-shadow: 0 10px 30px rgba(244, 63, 94, 0.1); display: flex; align-items: center; gap: 15px;">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 20px;"></i> 
                <span style="font-weight: 800;"><?= $this->session->flashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/profile/update') ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="foto" id="foto-input" style="display: none;" onchange="previewImage(this)">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 35px; margin-bottom: 40px;">
                <div class="input-group-custom">
                    <label style="font-weight: 850; color: #64748b; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">USERNAME AKSES</label>
                    <div style="position: relative;">
                        <input type="text" value="<?= $user['username'] ?>" readonly 
                               style="width: 100%; padding: 20px 20px 20px 55px; border-radius: 20px; border: 2px solid #f8fafc; background: #f8fafc; color: #94a3b8; font-weight: 700; cursor: not-allowed;">
                        <i class="fa-solid fa-at" style="position: absolute; left: 22px; top: 22px; color: #cbd5e1;"></i>
                    </div>
                </div>
                <div class="input-group-custom">
                    <label style="font-weight: 850; color: #64748b; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">ALAMAT SUREL (EMAIL)</label>
                    <div style="position: relative;">
                        <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="nama@email.com" 
                               style="width: 100%; padding: 20px 20px 20px 55px; border-radius: 20px; border: 2px solid #f1f5f9; background: #fafbfc; color: #1e293b; font-weight: 700; outline: none; transition: 0.3s;"
                               onfocus="this.style.borderColor='var(--primary)'; this.style.background='white'">
                        <i class="fa-solid fa-envelope" style="position: absolute; left: 22px; top: 22px; color: #cbd5e1;"></i>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 40px;">
                <label style="font-weight: 850; color: #64748b; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">NAMA LENGKAP & GELAR PENGGUNA</label>
                <div style="position: relative;">
                    <input type="text" name="nama" value="<?= $user['nama'] ?>" required 
                           style="width: 100%; padding: 20px 20px 20px 55px; border-radius: 20px; border: 2px solid #f1f5f9; background: #fafbfc; color: #1e293b; font-weight: 800; font-size: 16px; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='var(--primary)'; this.style.background='white'">
                    <i class="fa-solid fa-id-card" style="position: absolute; left: 22px; top: 22px; color: #cbd5e1; font-size: 20px;"></i>
                </div>
            </div>

            <div style="margin-bottom: 40px;">
                <label style="font-weight: 850; color: #64748b; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">NOMOR KONTAK AKTIF (WA)</label>
                <div style="position: relative;">
                    <input type="text" name="telepon" value="<?= $user['telepon'] ?>" placeholder="+62 8..." 
                           style="width: 100%; padding: 20px 20px 20px 55px; border-radius: 20px; border: 2px solid #f1f5f9; background: #fafbfc; color: #1e293b; font-weight: 700; outline: none; transition: 0.3s;"
                           onfocus="this.style.borderColor='var(--primary)'; this.style.background='white'">
                    <i class="fa-solid fa-phone-flip" style="position: absolute; left: 22px; top: 22px; color: #cbd5e1;"></i>
                </div>
            </div>

            <div style="margin-bottom: 50px;">
                <label style="font-weight: 850; color: #64748b; margin-bottom: 12px; display: block; font-size: 13px; text-transform: uppercase;">ALAMAT DOMISILI LENGKAP</label>
                <div style="position: relative;">
                    <textarea name="alamat" style="width: 100%; height: 140px; padding: 25px 25px 25px 55px; border-radius: 25px; border: 2px solid #f1f5f9; background: #fafbfc; color: #1e293b; font-weight: 700; outline: none; transition: 0.3s; resize: none; line-height: 1.6;"><?= $user['alamat'] ?></textarea>
                    <i class="fa-solid fa-location-arrow" style="position: absolute; left: 22px; top: 28px; color: #cbd5e1; font-size: 20px;"></i>
                </div>
            </div>

            <div style="border-top: 1.5px solid #f8fafc; padding-top: 45px; text-align: right;">
                <button type="submit" class="btn-profile-save" style="background: var(--primary); color: white; padding: 22px 60px; border-radius: 22px; font-weight: 950; font-size: 16px; border: none; cursor: pointer; transition: 0.4s; box-shadow: 0 15px 40px rgba(0, 104, 116, 0.25); display: inline-flex; align-items: center; gap: 15px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 20px;"></i> SIMPAN PERUBAHAN PROFILE
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = document.getElementById('toggle-' + id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
    
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('preview-foto');
                img.src = e.target.result;
                img.style.transform = 'scale(1.05)';
                setTimeout(() => img.style.transform = 'scale(1)', 300);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .btn-profile-save:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 104, 116, 0.4);
        filter: brightness(1.1);
    }
    .auth-card:hover { transform: translateY(-5px); box-shadow: 0 30px 60px rgba(15, 23, 42, 0.3); }
    .cam-btn:hover { transform: scale(1.1); transform: rotate(10deg); }
    #preview-foto:hover { transform: scale(1.02); }
    @media (max-width: 1100px) {
        div[style*="grid-template-columns: 400px 1fr"] { grid-template-columns: 1fr !important; }
    }
</style>
