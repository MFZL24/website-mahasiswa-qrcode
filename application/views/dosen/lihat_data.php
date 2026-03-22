<?php
    $total_dosen = $record->num_rows();
    $active_dosen = 0;
    $pending_dosen = 0;
    foreach($record->result() as $r) {
        if($r->status == 'active') $active_dosen++;
        elseif($r->status == 'pending') $pending_dosen++;
    }
?>

<!-- Statistics Overview -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-bottom: 50px;">
    <div style="background: white; padding: 40px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 10px 40px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 25px;">
        <div style="width: 70px; height: 70px; background: #eff6ff; color: #3b82f6; border-radius: 25px; display: flex; align-items: center; justify-content: center; font-size: 30px;">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 5px;">Total Dosen</span>
            <h2 style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $total_dosen ?></h2>
        </div>
    </div>
    <div style="background: white; padding: 40px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 10px 40px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 25px;">
        <div style="width: 70px; height: 70px; background: #ecfdf5; color: #10b981; border-radius: 25px; display: flex; align-items: center; justify-content: center; font-size: 30px;">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 5px;">Akun Aktif</span>
            <h2 style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $active_dosen ?></h2>
        </div>
    </div>
    <?php if($pending_dosen > 0): ?>
    <div style="background: white; padding: 40px; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 10px 40px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 25px;">
        <div style="width: 70px; height: 70px; background: #fffbeb; color: #f59e0b; border-radius: 25px; display: flex; align-items: center; justify-content: center; font-size: 30px; animation: pulse-warn 2s infinite;">
            <i class="fa-solid fa-user-clock"></i>
        </div>
        <div>
            <span style="font-size: 11px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 5px;">Menunggu Aktivasi</span>
            <h2 style="font-size: 32px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $pending_dosen ?></h2>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="card" style="padding: 50px; border-radius: 50px;">
    <div class="card-header" style="justify-content: space-between; align-items: center; margin-bottom: 40px; flex-wrap: wrap; gap: 30px; padding: 0;">
        <div style="display: flex; align-items: center; gap: 25px;">
            <div style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 26px; box-shadow: 0 15px 30px rgba(0, 104, 116, 0.2);">
                <i class="fa-solid fa-address-book"></i>
            </div>
            <div>
                <h3 style="font-size: 32px; font-weight: 950; color: #1e293b; margin: 0; letter-spacing: -1.5px;">Direktori Tenaga Pengajar</h3>
                <p style="color: #64748b; font-size: 16px; margin-top: 5px; font-weight: 500;">Administrasi database dosen dan kontrol akses sistem.</p>
            </div>
        </div>
        <a href="<?= base_url('index.php/dosen/tambah') ?>" class="btn-primary" style="padding: 20px 35px; border-radius: 22px; font-weight: 900; background: #0f172a; color: white; border: none; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.2); transition: all 0.4s; display: flex; align-items: center; gap: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;">
            <i class="fa-solid fa-user-plus" style="font-size: 20px;"></i> Tambah Dosen
        </a>
    </div>

    <!-- Search & Filter Bar -->
    <div style="background: #f8fafc; padding: 30px; border-radius: 35px; border: 1.5px solid #f1f5f9; margin-bottom: 50px;">
        <form action="<?= base_url('index.php/dosen') ?>" method="get" style="display: flex; gap: 15px; flex-wrap: wrap;">
            <div style="flex: 1; position: relative; min-width: 350px;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 25px; top: 22px; color: #cbd5e1; font-size: 18px;"></i>
                <input type="text" name="q" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Cari nama dosen, NIDN, atau username..." 
                       style="width: 100%; padding: 20px 30px 20px 60px; border-radius: 20px; border: 2px solid white; outline: none; background: white; font-weight: 700; color: #1e293b; font-size: 15px; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.01);"
                       onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 8px rgba(0, 104, 116, 0.05)';">
            </div>
            <button type="submit" class="btn-primary" style="padding: 0 40px; border-radius: 20px; background: var(--primary); color: white; border: none; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;">Cari Data</button>
            <?php if(isset($keyword) && $keyword != ''): ?>
                <a href="<?= base_url('index.php/dosen') ?>" style="display: flex; align-items: center; justify-content: center; width: 62px; height: 62px; background: #fff1f2; color: #e11d48; border-radius: 20px; transition: all 0.3s; border: 2px solid #ffe4e6;" onmouseover="this.style.background='#e11d48'; this.style.color='white'"><i class="fa-solid fa-rotate-right"></i></a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
        <?php foreach ($record->result() as $r) { 
            $foto = isset($r->foto) ? $r->foto : '';
            $foto_src = (strpos($foto, 'http') === 0) ? $foto : base_url('assets/img/profile/').($foto ? $foto : 'default.png');
            $status_config = [
                'active'  => ['color' => '#10b981', 'bg' => '#ecfdf5', 'label' => 'AKTIF', 'icon' => 'fa-circle-check'],
                'pending' => ['color' => '#f59e0b', 'bg' => '#fffbeb', 'label' => 'PENDING', 'icon' => 'fa-clock-rotate-left'],
                'blocked' => ['color' => '#e11d48', 'bg' => '#fff1f2', 'label' => 'DIBLOKIR', 'icon' => 'fa-circle-xmark']
            ];
            $cfg = $status_config[$r->status] ?? $status_config['blocked'];
        ?>
        <div class="dosen-card" style="background: white; border-radius: 40px; border: 2.5px solid #f1f5f9; padding: 35px; display: flex; flex-direction: column; align-items: center; text-align: center; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative; overflow: hidden;">
            
            <?php if($r->status == 'pending'): ?>
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: #f59e0b;"></div>
            <?php endif; ?>

            <div style="position: relative; margin-bottom: 20px;">
                <div style="width: 110px; height: 110px; border-radius: 35px; border: 4px solid white; box-shadow: 0 15px 35px rgba(0,0,0,0.1); overflow: hidden; background: #f8fafc;">
                    <img src="<?= $foto_src ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                </div>
                <div style="position: absolute; bottom: 5px; right: 5px; background: <?= $cfg['bg'] ?>; color: <?= $cfg['color'] ?>; width: 30px; height: 30px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 14px; border: 2px solid white; box-shadow: 0 5px 10px rgba(0,0,0,0.05);">
                    <i class="fa-solid <?= $cfg['icon'] ?>"></i>
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <span style="font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 850; color: var(--primary); background: var(--primary-light); padding: 5px 12px; border-radius: 8px; letter-spacing: 1px; display: block; width: fit-content; margin: 0 auto 10px;">
                    <?= $r->nidn ?>
                </span>
                <h4 style="font-size: 20px; font-weight: 950; color: #1e293b; margin-bottom: 5px; line-height: 1.2;"><?= $r->nama_dosen ?></h4>
                <p style="font-size: 13px; color: #94a3b8; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fa-solid fa-envelope" style="font-size: 11px; opacity: 0.5;"></i> <?= $r->email ? $r->email : 'N/A' ?>
                </p>
            </div>

            <div style="width: 100%; background: #f8fafc; border-radius: 25px; padding: 20px; display: flex; justify-content: space-around; margin-bottom: 30px; border: 1.5px solid #f1f5f9;">
                <div>
                    <div style="font-size: 9px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Username</div>
                    <div style="font-size: 13px; font-weight: 900; color: #475569;"><?= $r->username ?></div>
                </div>
                <div style="width: 1px; background: #e2e8f0; height: 30px; align-self: center;"></div>
                <div>
                    <div style="font-size: 9px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Status</div>
                    <div style="font-size: 11px; font-weight: 950; color: <?= $cfg['color'] ?>;"><?= $cfg['label'] ?></div>
                </div>
            </div>

            <div style="display: flex; gap: 12px; width: 100%; margin-top: auto;">
                <?php if($r->status == 'pending'): ?>
                    <a href="<?= base_url('index.php/dosen/activate/'.$r->id_operator) ?>" class="btn-card-action" style="flex: 1; background: #ecfdf5; color: #059669; padding: 14px; border-radius: 18px; text-decoration: none; font-size: 13px; font-weight: 900; border: 1.5px solid #d1fae5; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fa-solid fa-user-check"></i> AKTIVASI
                    </a>
                <?php endif; ?>
                
                <a href="<?= base_url('index.php/dosen/edit/'.$r->nidn) ?>" class="btn-card-action" style="width: 55px; height: 55px; background: #eff6ff; color: #2563eb; border-radius: 18px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1.5px solid #dbeafe;" title="Ubah Profil">
                    <i class="fa-solid fa-user-pen"></i>
                </a>
                <a href="<?= base_url('index.php/dosen/hapus/'.$r->nidn) ?>" class="btn-card-action btn-del-card" onclick="return confirm('Hapus permanen data dosen ini?')" style="width: 55px; height: 55px; background: #fff1f2; color: #e11d48; border-radius: 18px; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1.5px solid #ffe4e6;" title="Hapus Dosen">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if($record->num_rows() == 0): ?>
        <div style="text-align: center; padding: 150px 50px; background: #f8fafc; border-radius: 40px; border: 3px dashed #f1f5f9; margin-top: 30px;">
            <div style="width: 120px; height: 120px; background: white; border-radius: 40px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02);">
                <i class="fa-solid fa-user-slash" style="font-size: 50px; color: #cbd5e1;"></i>
            </div>
            <h4 style="font-size: 24px; font-weight: 950; color: #475569; margin-bottom: 10px;">Data Tidak Ditemukan</h4>
            <p style="color: #94a3b8; font-size: 16px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Gunakan kata kunci pencarian yang berbeda atau pastikan data dosen sudah terdaftar di sistem.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .dosen-card:hover { 
        transform: translateY(-15px); 
        box-shadow: 0 30px 60px -20px rgba(0,0,0,0.12); 
        border-color: var(--primary); 
    }
    .dosen-card:hover img { transform: scale(1.1); }
    .btn-card-action { transition: all 0.3s; }
    .btn-card-action:hover { filter: brightness(0.9); transform: scale(1.05); }
    .btn-del-card:hover { background: #e11d48 !important; color: white !important; border-color: #e11d48 !important; }
    
    @keyframes pulse-warn {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
        70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(245, 158, 11, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
    }
    
    .dosen-card { animation: fadeInUp 0.5s ease-out forwards; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
