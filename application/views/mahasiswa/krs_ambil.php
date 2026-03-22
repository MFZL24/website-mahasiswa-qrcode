<!-- Page Title & Header -->
<div class="card-header" style="padding: 0; margin-bottom: 40px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 26px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin-bottom: 5px;">
            <i class="fa-solid fa-cart-arrow-down" style="color: var(--primary);"></i> Katalog Pengambilan Matakuliah
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0; font-weight: 500;">Pendaftaran mata kuliah aktif ke dalam Kartu Rencana Studi (KRS) periode semester berjalan.</p>
    </div>
    <div style="font-size: 12px; color: #94a3b8; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; background: white; padding: 10px 20px; border-radius: 50px; border: 1px solid #f1f5f9;">
        <i class="fa-solid fa-clock-rotate-left"></i> Masa Berlangsung: AKTIF
    </div>
</div>

<!-- Search & Filtering Box - Neo Modern -->
<div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; margin-bottom: 45px; box-shadow: 0 15px 40px rgba(0,0,0,0.03); display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
    <div style="flex: 1; position: relative; display: flex; align-items: center; min-width: 300px;">
        <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 24px; color: #3b82f6; font-size: 18px; opacity: 0.7;"></i>
        <input type="text" id="courseSearch" placeholder="Cari nama mata kuliah atau dosen pengampu..." 
               style="width: 100%; padding: 18px 25px 18px 65px; border-radius: 20px; border: 2px solid #f1f5f9; outline: none; transition: all 0.3s; font-size: 15px; font-weight: 600; color: #1e293b;" 
               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 5px rgba(59, 130, 246, 0.05)';"
               onblur="this.style.borderColor='#f1f5f9'; this.style.boxShadow='none';"
               onkeyup="searchCourses()">
    </div>
    <div style="background: #f0f7ff; color: #3b82f6; padding: 18px 30px; border-radius: 20px; font-weight: 900; font-size: 13px; display: flex; align-items: center; gap: 12px; border: 1px solid #dbeafe; letter-spacing: 0.5px; cursor: default;">
        <i class="fa-solid fa-filter"></i> SEMUA PROGRAM STUDI
    </div>
</div>

<!-- Course Selection Grid -->
<div id="courseContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 35px;">
    <?php 
    $gradients = [
        'linear-gradient(135deg, #006874 0%, #004f58 100%)',
        'linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%)',
        'linear-gradient(135deg, #064e3b 0%, #065f46 100%)',
        'linear-gradient(135deg, #7c2d12 0%, #9a3412 100%)',
        'linear-gradient(135deg, #4c1d95 0%, #5b21b6 100%)'
    ];
    $no=0; foreach($kelas_list->result() as $k): 
        $grad = $gradients[$no % count($gradients)];
        $no++;
    ?>
    <div class="course-card" style="background: white; border-radius: 35px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; flex-direction: column; position: relative;">
        
        <!-- Premium Stylish Header -->
        <div style="background: <?= $grad ?>; padding: 35px; position: relative; overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 2;">
                <span style="background: rgba(255,255,255,0.15); color: white; backdrop-filter: blur(10px); font-weight: 900; font-size: 11px; padding: 6px 16px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-graduation-cap"></i> SEMESTER <?= $k->semester ?>
                </span>
                <span style="background: white; color: <?= substr($grad, 21, 7) ?>; font-weight: 950; font-size: 11px; padding: 7px 15px; border-radius: 12px; box-shadow: 0 8px 15px rgba(0,0,0,0.1);">
                    <?= $k->sks ?> SKS
                </span>
            </div>
            
            <div style="margin-top: 25px; position: relative; z-index: 2;">
                <div style="font-size: 10px; color: rgba(255,255,255,0.6); font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 6px; font-family: 'JetBrains Mono', monospace;">
                    IDENTITAS: <?= $k->kode_mk ?>
                </div>
                <h3 class="course-title" style="margin: 0; font-size: 20px; font-weight: 900; color: white; line-height: 1.4; min-height: 55px;"><?= $k->nama_mk ?></h3>
            </div>
            
            <!-- Abstract Decor -->
            <i class="fa-solid fa-bookmark" style="position: absolute; right: -25px; bottom: -25px; font-size: 120px; color: rgba(255,255,255,0.04); z-index: 1; transform: rotate(-15deg);"></i>
        </div>

        <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column; gap: 25px;">
            <!-- Instructor Block -->
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 48px; height: 48px; background: #f8fafc; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 18px; border: 1px solid #f1f5f9; flex-shrink: 0;">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div style="overflow: hidden;">
                    <div style="font-size: 10px; color: #94a3b8; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Penanggung Jawab</div>
                    <div style="font-size: 15px; font-weight: 850; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="instructor-name"><?= $k->nama_dosen ?></div>
                </div>
            </div>

            <!-- Schedule & Space -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div style="background: #f0fdf4; border: 1px solid #dcfce7; padding: 14px; border-radius: 18px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-calendar-day" style="color: #10b981; font-size: 15px;"></i>
                    <span style="font-size: 14px; font-weight: 850; color: #065f46;"><?= $k->hari ?></span>
                </div>
                <div style="background: #fffbe4; border: 1px solid #fef3c7; padding: 14px; border-radius: 18px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-clock" style="color: #f59e0b; font-size: 15px;"></i>
                    <span style="font-size: 14px; font-weight: 850; color: #92400e;"><?= substr($k->jam_mulai,0,5) ?> <span style="font-size: 10px; opacity: 0.6;">WIB</span></span>
                </div>
            </div>

            <!-- Enhanced Action Enrollment -->
            <form action="<?= base_url('index.php/mhs_fitur/ambil') ?>" method="post" style="margin-top: auto;">
                <input type="hidden" name="id_kelas" value="<?= $k->id_kelas ?>">
                <button type="submit" name="submit" class="btn-enroll" style="width: 100%; background: #f8fafc; color: #475569; border: 2px solid #f1f5f9; padding: 18px; border-radius: 20px; font-weight: 900; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 12px; cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <i class="fa-solid fa-circle-plus" style="font-size: 18px; color: var(--primary);"></i> KONFIRMASI AMBIL KRS
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    
    <!-- Empty Search State -->
    <div id="noResults" style="display: none; grid-column: 1/-1; text-align: center; padding: 120px 30px; background: white; border-radius: 40px; border: 2px dashed #f1f5f9;">
        <i class="fa-solid fa-magnifying-glass-chart" style="font-size: 60px; color: #cbd5e1; margin-bottom: 25px; display: block;"></i>
        <h4 style="font-size: 20px; font-weight: 850; color: #475569; margin-bottom: 10px;">Hasil Tidak Ditemukan</h4>
        <p style="color: #94a3b8; font-size: 15px; max-width: 400px; margin: 0 auto;">Maaf, kata kunci pencarian Anda tidak cocok dengan mata kuliah atau dosen manapun di katalog kami.</p>
    </div>
</div>

<script>
function searchCourses() {
    let input = document.getElementById('courseSearch').value.toLowerCase();
    let cards = document.getElementsByClassName('course-card');
    let noResults = document.getElementById('noResults');
    let visibleCount = 0;
    
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector('.course-title').innerText.toLowerCase();
        let instructor = cards[i].querySelector('.instructor-name').innerText.toLowerCase();
        
        if (title.includes(input) || instructor.includes(input)) {
            cards[i].style.display = "flex";
            visibleCount++;
        } else {
            cards[i].style.display = "none";
        }
    }
    
    noResults.style.display = (visibleCount === 0) ? "block" : "none";
}
</script>

<style>
    .course-card:hover { 
        transform: translateY(-15px); 
        box-shadow: 0 30px 60px rgba(0,0,0,0.08); 
        border-color: #ddd6fe;
    }
    .btn-enroll:hover {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
        box-shadow: 0 15px 30px rgba(0, 104, 116, 0.3);
    }
    .btn-enroll:hover i { color: white !important; }
</style>
