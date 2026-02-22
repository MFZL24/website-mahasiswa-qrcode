<div class="card-header" style="justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b;"><i class="fa-solid fa-chalkboard-user" style="color: var(--primary);"></i> Manajemen Kelas</h3>
        <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Kelola jadwal perkuliahan dan plotting dosen pengampu.</p>
    </div>
    <a href="<?= base_url('index.php/kelas/tambah') ?>" class="btn btn-primary" style="padding: 12px 25px; border-radius: 14px; font-weight: 700; gap: 10px; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
        <i class="fa-solid fa-plus-circle"></i> Buka Kelas Baru
    </a>
</div>

<!-- Grid Layout -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; padding: 10px;">
    <?php 
    $images = [
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=500&q=80',
        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500&q=80',
        'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500&q=80',
        'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=500&q=80',
        'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=500&q=80',
        'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=500&q=80'
    ];
    $no=0; foreach ($record->result() as $r): 
        $img_url = $images[$no % count($images)];
        $no++;
    ?>
    <div class="class-card" style="background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; transition: all 0.3s ease; display: flex; flex-direction: column;">
        
        <!-- Image Header -->
        <div style="height: 160px; position: relative; overflow: hidden;">
            <img src="<?= $img_url ?>" alt="Course" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
            <div style="position: absolute; top: 15px; right: 15px;">
                <span class="badge" style="background: rgba(255,255,255,0.9); color: var(--primary); backdrop-filter: blur(5px); font-weight: 800; padding: 6px 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    Semester <?= $r->semester ?>
                </span>
            </div>
            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 20px 15px 10px;">
                <span style="color: white; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;"><?= $r->kode_mk ?></span>
            </div>
        </div>

        <!-- content -->
        <div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #1e293b; line-height: 1.3; flex: 1;"><?= $r->nama_mk ?></h3>
                <span class="badge badge-primary" style="margin-left: 10px; font-size: 11px;">Kls <?= $r->nama_kelas ?></span>
            </div>

            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px; background: #f8fafc; padding: 10px; border-radius: 12px;">
                <div style="width: 35px; height: 35px; background: white; color: #64748b; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; border: 1px solid #e2e8f0;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <div style="font-size: 13px; font-weight: 700; color: #334155;"><?= $r->nama_dosen ?></div>
                    <div style="font-size: 11px; color: #94a3b8;">NIDN: <?= $r->nidn ?></div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: auto; padding-top: 10px;">
                <div style="display: flex; align-items: center; gap: 8px; color: #64748b; font-size: 13px;">
                    <i class="fa-regular fa-calendar-check" style="color: var(--primary);"></i>
                    <span style="font-weight: 600;"><?= $r->hari ?></span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px; color: #64748b; font-size: 13px;">
                    <i class="fa-regular fa-clock" style="color: var(--primary);"></i>
                    <span style="font-weight: 600;"><?= substr($r->jam_mulai,0,5) ?></span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div style="padding: 15px 20px; background: #fafafa; border-top: 1px solid #f1f5f9; display: flex; gap: 10px;">
            <a href="<?= base_url('index.php/kelas/edit/'.$r->id_kelas) ?>" class="btn btn-sm" style="flex: 1; background: white; color: #475569; border: 1px solid #e2e8f0; justify-content: center; font-weight: 700; border-radius: 10px;">
                <i class="fa-solid fa-pen-to-square"></i> EDIT
            </a>
            <a href="<?= base_url('index.php/kelas/hapus/'.$r->id_kelas) ?>" class="btn btn-sm" onclick="return confirm('Hapus kelas ini?')" style="flex: 1; background: #fff1f2; color: #e11d48; border: none; justify-content: center; font-weight: 700; border-radius: 10px;">
                <i class="fa-solid fa-trash"></i> HAPUS
            </a>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if($record->num_rows() == 0): ?>
    <div style="grid-column: 1/-1; text-align: center; padding: 100px 20px; background: #f8fafc; border-radius: 30px; border: 2px dashed #e2e8f0;">
        <i class="fa-solid fa-school-flag" style="font-size: 60px; color: #cbd5e1; margin-bottom: 20px; display: block;"></i>
        <h3 style="color: #64748b;">Belum ada kelas yang dibuka.</h3>
        <p style="color: #94a3b8; font-size: 14px;">Silakan klik tombol "Buka Kelas Baru" untuk memulai.</p>
    </div>
    <?php endif; ?>
</div>

<style>
.class-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: var(--primary-light);
}
.class-card:hover img {
    transform: scale(1.1);
}
</style>
