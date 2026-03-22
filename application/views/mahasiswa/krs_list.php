<!-- Page Title & Header -->
<div class="card-header" style="padding: 0; margin-bottom: 40px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 26px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-file-invoice" style="color: var(--primary);"></i> Kartu Rencana Studi (KRS)
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0; font-weight: 500;">Monitor beban studi dan manajemen mata kuliah aktif semester ini.</p>
    </div>
    <a href="<?= base_url('index.php/mhs_fitur/ambil') ?>" class="btn-primary" style="background: var(--primary); color: white; padding: 15px 30px; border-radius: 18px; font-weight: 800; display: flex; align-items: center; gap: 12px; border: none; box-shadow: 0 10px 25px rgba(0, 104, 116, 0.2); text-decoration: none; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <i class="fa-solid fa-plus-circle" style="font-size: 20px;"></i> AMBIL MATAKULIAH
    </a>
</div>

<!-- Statistics Dashboard -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 45px;">
    <!-- GPA Box -->
    <div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <div style="width: 65px; height: 65px; background: #eff6ff; color: #3b82f6; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 26px; border: 1px solid #dbeafe;">
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 4px;">IPK Terakhir</span>
            <div style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;"><?= number_format($ipk, 2) ?></div>
        </div>
    </div>

    <!-- Credits Box -->
    <div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <div style="width: 65px; height: 65px; background: #ecfdf5; color: #10b981; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 26px; border: 1px solid #d1fae5;">
            <i class="fa-solid fa-bolt-lightning"></i>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 4px;">Beban Studi</span>
            <div style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;">
                <?= $total_sks ?> <span style="font-size: 14px; color: #94a3b8; font-weight: 700; opacity: 0.6;">/ <?= $max_sks ?> SKS</span>
            </div>
        </div>
    </div>

    <!-- Courses Count Box -->
    <div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <div style="width: 65px; height: 65px; background: #fff1f2; color: #e11d48; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 26px; border: 1px solid #ffe4e6;">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 4px;">Katalog MK</span>
            <div style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $record->num_rows() ?> <span style="font-size: 14px; color: #94a3b8; font-weight: 700; opacity: 0.6;">Matkul</span></div>
        </div>
    </div>
</div>

<!-- Flash Notifications -->
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success" style="margin-bottom: 35px; border-radius: 20px; padding: 20px 30px; border: none; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.12); display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-circle-check" style="font-size: 20px;"></i>
        <span style="font-weight: 600;"><?= $this->session->flashdata('success') ?></span>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger" style="margin-bottom: 35px; border-radius: 20px; padding: 20px 30px; border: none; box-shadow: 0 10px 25px rgba(225, 29, 72, 0.12); display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-circle-exclamation" style="font-size: 20px;"></i>
        <span style="font-weight: 600;"><?= $this->session->flashdata('error') ?></span>
    </div>
<?php endif; ?>

<!-- Approval Notification Banner -->
<?php 
    $approved_count = 0;
    foreach($record->result() as $r) { if($r->is_approved == 1) $approved_count++; }
    if($approved_count > 0):
?>
    <div style="background: linear-gradient(to right, #10b981, #059669); padding: 25px 35px; border-radius: 25px; margin-bottom: 35px; color: white; display: flex; align-items: center; gap: 25px; box-shadow: 0 15px 35px rgba(16, 185, 129, 0.2);">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid rgba(255,255,255,0.3);">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div style="flex: 1;">
            <h4 style="margin: 0; font-size: 18px; font-weight: 900; letter-spacing: -0.5px;">Administrasi Disetujui!</h4>
            <p style="margin: 3px 0 0; font-size: 13px; font-weight: 600; opacity: 0.9;">Terdapat <?= $approved_count ?> mata kuliah yang telah divalidasi oleh Admin. Anda sudah bisa melihat jadwal perkuliahan.</p>
        </div>
        <div style="background: rgba(0,0,0,0.1); padding: 8px 18px; border-radius: 50px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;">
            Verified By Admin
        </div>
    </div>
<?php endif; ?>

<!-- KRS Content - Modern Card Grid -->
<div id="krsGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px; margin-bottom: 50px;">
    <?php foreach($record->result() as $r): ?>
    <div style="background: white; border-radius: 35px; border: 1.5px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02); overflow: hidden; display: flex; flex-direction: column; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); <?= $r->is_approved == 1 ? 'border-color: #dcfce7;' : '' ?>" class="krs-card">
        
        <!-- Card Header Info -->
        <div style="padding: 30px; border-bottom: 1.5px solid #fafbfc; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <span style="background: var(--primary-light); color: var(--primary); padding: 7px 15px; border-radius: 12px; font-weight: 900; font-size: 11px; letter-spacing: 1px; border: 1.5px solid rgba(0, 104, 116, 0.1);">
                    <?= $r->kode_mk ?>
                </span>
                <span style="font-size: 13px; font-weight: 900; color: #94a3b8;">
                    <i class="fa-solid fa-star-half-stroke" style="color: #f59e0b; margin-right: 5px;"></i> <?= $r->sks ?> SKS
                </span>
            </div>
            <h4 style="font-size: 20px; font-weight: 900; color: #1e293b; line-height: 1.4; margin: 0; min-height: 56px;"><?= $r->nama_mk ?></h4>
        </div>

        <!-- Meta Info -->
        <div style="padding: 30px; display: flex; flex-direction: column; gap: 20px; flex-grow: 1;">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 45px; height: 45px; background: #f8fafc; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 18px; border: 1.5px solid #f1f5f9;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <div style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Dosen Pengampu</div>
                    <div style="font-size: 14px; font-weight: 750; color: #475569;"><?= $r->nama_dosen ?></div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div style="background: #f0fdf4; border: 1px solid #dcfce7; padding: 15px; border-radius: 20px; display: flex; flex-direction: column; gap: 5px;">
                    <span style="font-size: 9px; font-weight: 900; color: #16a34a; text-transform: uppercase;">Agenda</span>
                    <span style="font-size: 14px; font-weight: 900; color: #166534;"><?= $r->hari ?>, <?= substr($r->jam_mulai,0,5) ?></span>
                </div>
                <div style="background: #eff6ff; border: 1px solid #dbeafe; padding: 15px; border-radius: 20px; display: flex; flex-direction: column; gap: 5px;">
                    <span style="font-size: 9px; font-weight: 900; color: #3b82f6; text-transform: uppercase;">Ruang</span>
                    <span style="font-size: 14px; font-weight: 900; color: #1e40af;">KLS <?= $r->nama_kelas ?></span>
                </div>
            </div>
        </div>

        <!-- Action Footer -->
        <div style="padding: 20px 30px; background: #fafbfc; border-top: 1.5px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <?php if($r->is_approved == 1): ?>
                <div style="display: flex; align-items: center; gap: 8px; color: #10b981; font-size: 12px; font-weight: 850; background: #ecfdf5; padding: 6px 15px; border-radius: 10px;">
                    <i class="fa-solid fa-circle-check"></i> DISETUJUI ADMIN
                </div>
            <?php else: ?>
                <div style="display: flex; align-items: center; gap: 8px; color: #f59e0b; font-size: 12px; font-weight: 850; background: #fffbeb; padding: 6px 15px; border-radius: 10px;">
                    <i class="fa-solid fa-hourglass-half"></i> MENUNGGU PERSETUJUAN
                </div>
            <?php endif; ?>
            
            <a href="<?= base_url('index.php/mhs_fitur/hapus_krs/'.$r->id_krs) ?>" class="btn-cancel" onclick="return confirm('Batalkan pengambilan matakuliah ini?')" style="text-decoration: none; color: #e11d48; font-size: 12px; font-weight: 900; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-trash-can"></i> BATALKAN
            </a>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if($record->num_rows() == 0): ?>
    <div style="grid-column: 1/-1; text-align: center; padding: 120px 30px; background: white; border-radius: 40px; border: 2px dashed #f1f5f9;">
        <div style="background: #f8fafc; width: 100px; height: 100px; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
            <i class="fa-solid fa-book-medical" style="font-size: 45px; color: #cbd5e1;"></i>
        </div>
        <h4 style="font-size: 20px; font-weight: 850; color: #475569; margin-bottom: 8px;">KRS Masih Kosong</h4>
        <p style="color: #94a3b8; font-size: 14px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Anda belum mengalokasikan rencana studi untuk semester aktif ini.</p>
        <a href="<?= base_url('index.php/mhs_fitur/ambil') ?>" class="btn-primary" style="margin-top: 30px; background: var(--primary); color: white; padding: 15px 35px; border-radius: 16px; font-weight: 800; text-decoration: none; display: inline-block; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2);">MULAI AMBIL KRS</a>
    </div>
    <?php endif; ?>
</div>

<style>
    .krs-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.06); border-color: #dbeafe; }
    .btn-cancel:hover { color: #9f1239 !important; transform: scale(1.05); }
    .btn-primary:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0, 104, 116, 0.3); }
    
    @media (max-width: 768px) {
        .card-header { padding: 0 !important; margin-bottom: 30px !important; text-align: center; justify-content: center !important; }
        .btn-primary { width: 100%; justify-content: center; }
        #krsGrid { grid-template-columns: 1fr !important; gap: 20px !important; }
        .krs-card { border-radius: 25px !important; }
        .m-center { text-align: center !important; }
        .j-center { justify-content: center !important; }
        .m-hide { display: none; }
    }
</style>
