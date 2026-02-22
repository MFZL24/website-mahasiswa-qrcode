<div class="card-header" style="justify-content: space-between; align-items: flex-start; flex-direction: column; gap: 5px; margin-bottom: 30px;">
    <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b;"><i class="fa-solid fa-cart-plus" style="color: var(--primary);"></i> Ambil Mata Kuliah Baru</h3>
    <p style="color: #64748b; font-size: 14px;">Silakan pilih dari daftar kelas yang tersedia untuk Anda ikuti semester ini.</p>
</div>

<!-- Search & Filter Bar -->
<div style="background: white; padding: 20px; border-radius: 20px; border: 1px solid #f1f5f9; margin-bottom: 35px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; gap: 15px; align-items: center;">
    <div style="flex: 1; position: relative; display: flex; align-items: center;">
        <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 20px; color: #94a3b8;"></i>
        <input type="text" id="courseSearch" placeholder="Cari Mata Kuliah atau Nama Dosen..." style="width: 100%; padding: 14px 20px 14px 50px; border-radius: 14px; border: 1px solid #e2e8f0; outline: none; transition: border-color 0.3s;" onkeyup="searchCourses()">
    </div>
    <div style="background: #eff6ff; color: #3b82f6; padding: 12px 20px; border-radius: 14px; font-weight: 700; font-size: 13px; display: flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-filter"></i> SEMUA SEMESTER
    </div>
</div>

<!-- Grid Layout -->
<div id="courseContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px;">
    <?php 
    $images = [
        'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=500&q=80',
        'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500&q=80',
        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500&q=80',
        'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=500&q=80',
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=500&q=80',
        'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=500&q=80'
    ];
    $no=0; foreach($kelas_list->result() as $k): 
        $img_url = $images[$no % count($images)];
        $no++;
    ?>
    <div class="course-card" style="background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; transition: all 0.3s ease; display: flex; flex-direction: column;">
        
        <!-- Thumbnail -->
        <div style="height: 150px; position: relative;">
            <img src="<?= $img_url ?>" style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; top: 12px; left: 12px;">
                <span class="badge" style="background: rgba(255,255,255,0.9); color: #1e293b; backdrop-filter: blur(4px); font-weight: 700; font-size: 11px; padding: 5px 12px; border-radius: 10px;">
                    <?= $k->sks ?> SKS
                </span>
            </div>
            <div style="position: absolute; top: 12px; right: 12px;">
                <span class="badge" style="background: var(--primary); color: white; font-weight: 700; font-size: 11px; padding: 5px 12px; border-radius: 10px; box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);">
                    Kelas <?= $k->nama_kelas ?>
                </span>
            </div>
        </div>

        <div style="padding: 20px; flex-grow: 1;">
            <div style="font-size: 11px; color: var(--primary); font-weight: 800; letter-spacing: 1px; margin-bottom: 5px; text-transform: uppercase;">
                <?= $k->kode_mk ?>
            </div>
            <h3 class="course-title" style="margin: 0 0 15px; font-size: 18px; font-weight: 800; color: #1e293b; line-height: 1.4;"><?= $k->nama_mk ?></h3>
            
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <div style="width: 32px; height: 32px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 13px; border: 1px solid #e2e8f0;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div style="font-size: 13px; font-weight: 600; color: #475569;" class="instructor-name"><?= $k->nama_dosen ?></div>
            </div>

            <div style="background: #f8fafc; padding: 12px; border-radius: 14px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div style="font-size: 12px; color: #64748b;">
                    <i class="fa-regular fa-calendar-check" style="margin-right: 5px;"></i> <?= $k->hari ?>
                </div>
                <div style="font-size: 12px; color: #64748b; text-align: right;">
                    <i class="fa-regular fa-clock" style="margin-right: 5px;"></i> <?= substr($k->jam_mulai,0,5) ?> WIB
                </div>
            </div>
        </div>

        <div style="padding: 20px; border-top: 1px solid #f1f5f9;">
            <form action="<?= base_url('index.php/mhs_fitur/ambil') ?>" method="post">
                <input type="hidden" name="id_kelas" value="<?= $k->id_kelas ?>">
                <button type="submit" name="submit" class="btn btn-primary" style="width: 100%; height: 48px; justify-content: center; font-weight: 700; border-radius: 14px; gap: 10px;">
                    <i class="fa-solid fa-plus-circle"></i> AMBIL KELAS INI
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function searchCourses() {
    let input = document.getElementById('courseSearch').value.toLowerCase();
    let cards = document.getElementsByClassName('course-card');
    
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector('.course-title').innerText.toLowerCase();
        let instructor = cards[i].querySelector('.instructor-name').innerText.toLowerCase();
        
        if (title.includes(input) || instructor.includes(input)) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>

<style>
.course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    border-color: var(--primary-light);
}
</style>
