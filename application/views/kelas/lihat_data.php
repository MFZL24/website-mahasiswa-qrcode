<div style="margin-bottom: 50px;">
    <div style="background: white; padding: 40px; border-radius: 40px; border: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.02);">
        <div>
            <h3 style="font-size: 32px; font-weight: 950; color: #1e293b; display: flex; align-items: center; gap: 15px; letter-spacing: -1.5px;">
                <span style="background: #f43f5e; color: white; width: 55px; height: 55px; border-radius: 18px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px rgba(244, 63, 94, 0.2);">
                    <i class="fa-solid fa-calendar-check"></i>
                </span>
                Jadwal Perkuliahan
            </h3>
            <p style="color: #64748b; font-size: 16px; margin-top: 5px; font-weight: 500;">Sinkronisasi ruang dan waktu untuk efisiensi akademik.</p>
        </div>
        <a href="<?= base_url('index.php/kelas/tambah') ?>" class="btn-primary" style="padding: 18px 35px; border-radius: 20px; font-weight: 900; background: var(--primary); color: white; border: none; box-shadow: 0 15px 35px rgba(0, 104, 116, 0.25); transition: all 0.3s; display: flex; align-items: center; gap: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">
            <i class="fa-solid fa-clock-rotate-left" style="font-size: 20px;"></i> PLOT JADWAL BARU
        </a>
    </div>
        <!-- Integrated Search & Filter -->
        <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 2; position: relative; min-width: 350px;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 25px; top: 22px; color: #94a3b8; font-size: 20px;"></i>
                <input type="text" id="schedSearch" placeholder="Cari Mata Kuliah, Dosen, atau Kode..." 
                       style="width: 100%; padding: 22px 30px 22px 65px; border-radius: 22px; border: 2px solid #f1f5f9; background: #f8fafc; font-weight: 700; font-size: 16px; outline: none; transition: all 0.3s;"
                       onfocus="this.style.borderColor='var(--primary)'; this.style.background='white'; this.style.boxShadow='0 0 0 10px rgba(0, 104, 116, 0.05)'">
            </div>
            <div style="flex: 1; min-width: 250px;">
                <?php 
                    $available_prodi = [];
                    foreach($record->result() as $r) if(!empty($r->prodi)) $available_prodi[$r->prodi] = true;
                ?>
                <select id="prodiFilter" style="width: 100%; padding: 22px 30px; border-radius: 22px; border: 2px solid #f1f5f9; background: #f8fafc; font-weight: 800; font-size: 14px; outline: none; transition: all 0.3s; color: #1e293b; cursor: pointer;"
                        onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 10px rgba(0, 104, 116, 0.05)'">
                    <option value="all">SEMUA PROGRAM STUDI</option>
                    <?php foreach(array_keys($available_prodi) as $p): ?>
                        <option value="<?= $p ?>"><?= $p ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<?php 
$grouped_kelas = [];
foreach ($record->result() as $r) {
    $grouped_kelas[$r->hari][] = $r;
}

$day_configs = [
    'Senin'  => ['color' => '#2563eb', 'bg' => '#eff6ff', 'icon' => 'fa-moon', 'pattern' => 'background: linear-gradient(45deg, #eff6ff 25%, transparent 25%, transparent 50%, #eff6ff 50%, #eff6ff 75%, transparent 75%, transparent); background-size: 20px 20px;'],
    'Selasa' => ['color' => '#059669', 'bg' => '#ecfdf5', 'icon' => 'fa-fire', 'pattern' => 'background: radial-gradient(#059669 0.5px, transparent 0.5px); background-size: 10px 10px;'],
    'Rabu'   => ['color' => '#d97706', 'bg' => '#fffbeb', 'icon' => 'fa-water', 'pattern' => 'background: linear-gradient(to right, #fffbeb, #fef3c7);'],
    'Kamis'  => ['color' => '#db2777', 'bg' => '#fdf2f8', 'icon' => 'fa-tree', 'pattern' => 'background-image: repeating-linear-gradient(45deg, #fdf2f8, #fdf2f8 10px, white 10px, white 20px);'],
    'Jumat'  => ['color' => '#7c3aed', 'bg' => '#f5f3ff', 'icon' => 'fa-mosque', 'pattern' => 'background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);'],
    'Sabtu'  => ['color' => '#4b5563', 'bg' => '#f9fafb', 'icon' => 'fa-mug-hot', 'pattern' => 'background: white;'],
    'Minggu' => ['color' => '#dc2626', 'bg' => '#fef2f2', 'icon' => 'fa-sun', 'pattern' => 'background: linear-gradient(to bottom, #fef2f2, white);'],
];

$order = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
?>

<?php foreach ($order as $day): 
    if (!isset($grouped_kelas[$day])) continue;
    $d = isset($day_configs[$day]) ? $day_configs[$day] : $day_configs['Sabtu'];
?>
    <div class="schedule-day-row" style="margin-bottom: 60px;">
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px; padding-left: 10px;">
            <div style="background: <?= $d['color'] ?>; color: white; width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 10px 20px <?= $d['color'] ?>33;">
                <i class="fa-solid <?= $d['icon'] ?>"></i>
            </div>
            <h4 style="font-size: 26px; font-weight: 950; color: #1e293b; letter-spacing: -1px;"><?= $day ?></h4>
            <div style="flex: 1; height: 3px; background: <?= $d['bg'] ?>; border-radius: 10px;"></div>
            <span style="font-size: 14px; font-weight: 800; color: #94a3b8; text-transform: uppercase;"><?= count($grouped_kelas[$day]) ?> Sesi Aktif</span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px;">
            <?php foreach ($grouped_kelas[$day] as $r): ?>
            <div class="modern-sched-card" 
                 data-prodi="<?= $r->prodi ?>" 
                 data-search="<?= strtolower($r->nama_mk . ' ' . $r->nama_dosen . ' ' . $r->kode_mk) ?>" 
                 style="background: white; border-radius: 35px; border: 2.5px solid #f1f5f9; overflow: hidden; display: flex; flex-direction: column; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                
                <!-- Card Header with Pattern -->
                <div style="padding: 30px; <?= $d['pattern'] ?>; border-bottom: 1.5px solid #f1f5f9; position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                        <span style="background: white; color: <?= $d['color'] ?>; padding: 6px 14px; border-radius: 12px; font-size: 11px; font-weight: 900; border: 1.5px solid <?= $d['color'] ?>33; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
                            KLS <?= $r->nama_kelas ?>
                        </span>
                        <div style="display: flex; gap: 10px;">
                            <a href="<?= base_url('index.php/kelas/edit/'.$r->id_kelas) ?>" style="width: 38px; height: 38px; background: white; color: #4b5563; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; text-decoration: none; transition: 0.3s;">
                                <i class="fa-solid fa-sliders"></i>
                            </a>
                        </div>
                    </div>
                    <div style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;"><?= $r->kode_mk ?></div>
                    <h5 style="font-size: 19px; font-weight: 900; color: #0f172a; line-height: 1.4; margin: 0; min-height: 52px;"><?= $r->nama_mk ?></h5>
                    
                    <div style="position: absolute; right: -15px; bottom: -15px; opacity: 0.05; font-size: 80px; transform: rotate(-15deg); color: <?= $d['color'] ?>;">
                        <i class="fa-solid <?= $d['icon'] ?>"></i>
                    </div>
                </div>

                <!-- Card Body -->
                <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column; gap: 20px; background: white;">
                    <div style="display: flex; gap: 15px;">
                        <div style="flex: 1; background: #f8fafc; padding: 15px; border-radius: 20px; display: flex; align-items: center; gap: 12px; border: 1px solid #f1f5f9;">
                            <div style="width: 35px; height: 35px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: <?= $d['color'] ?>; box-shadow: 0 4px 8px rgba(0,0,0,0.02);">
                                <i class="fa-solid fa-clock-three"></i>
                            </div>
                            <div>
                                <div style="font-size: 14px; font-weight: 900; color: #1e293b;"><?= substr($r->jam_mulai,0,5) ?></div>
                                <div style="font-size: 9px; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Mulai</div>
                            </div>
                        </div>
                        <div style="flex: 1; background: #f8fafc; padding: 15px; border-radius: 20px; display: flex; align-items: center; gap: 12px; border: 1px solid #f1f5f9;">
                            <div style="width: 35px; height: 35px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: <?= $d['color'] ?>; box-shadow: 0 4px 8px rgba(0,0,0,0.02);">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <div style="font-size: 14px; font-weight: 900; color: #1e293b;">R. <?= $r->nama_kelas ?></div>
                                <div style="font-size: 9px; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Ruangan</div>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #1e293b; border-radius: 20px; color: white;">
                        <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div style="overflow: hidden;">
                            <div style="font-size: 13px; font-weight: 800; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $r->nama_dosen ?></div>
                            <div style="font-size: 9px; color: rgba(255,255,255,0.5); font-weight: 700; text-transform: uppercase;">Dosen Pengampu Utama</div>
                        </div>
                        <div style="margin-left: auto;">
                            <a href="<?= base_url('index.php/kelas/hapus/'.$r->id_kelas) ?>" onclick="return confirm('Hapus Sesi?')" style="color: #fca5a5; font-size: 16px; transition: 0.3s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#fca5a5'">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<style>
    .modern-sched-card:hover { transform: translateY(-12px); box-shadow: 0 30px 60px -20px rgba(0,0,0,0.12); border-color: var(--primary); }
    .schedule-day-row { animation: fadeInRight 0.6s ease-out forwards; }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(-30px); } to { opacity: 1; transform: translateX(0); } }
</style>
<div id="noSchedResults" style="display: none; text-align: center; padding: 100px 50px; background: white; border-radius: 50px; border: 3px dashed #f1f5f9;">
    <div style="width: 100px; height: 100px; background: #f8fafc; border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px;">
        <i class="fa-solid fa-calendar-xmark" style="font-size: 45px; color: #cbd5e1; opacity: 0.5;"></i>
    </div>
    <h3 style="font-size: 24px; font-weight: 900; color: #475569; margin-bottom: 10px;">Jadwal Tidak Ditemukan</h3>
    <p style="color: #94a3b8; font-size: 16px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Tidak ada agenda perkuliahan yang cocok dengan kriteria filter Anda.</p>
</div>

<script>
    function filterSchedule() {
        const query = document.getElementById('schedSearch').value.toLowerCase();
        const selectedProdi = document.getElementById('prodiFilter').value;
        let anyVisible = false;

        document.querySelectorAll('.schedule-day-row').forEach(dayRow => {
            let dayVisible = false;
            dayRow.querySelectorAll('.modern-sched-card').forEach(card => {
                const prodi = card.getAttribute('data-prodi');
                const search = card.getAttribute('data-search');
                
                const matchesProdi = (selectedProdi === 'all' || selectedProdi === prodi);
                const matchesSearch = search.includes(query);

                if (matchesProdi && matchesSearch) {
                    card.style.display = 'flex';
                    dayVisible = true;
                    anyVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });
            dayRow.style.display = dayVisible ? 'block' : 'none';
        });

        document.getElementById('noSchedResults').style.display = anyVisible ? 'none' : 'block';
    }

    document.getElementById('schedSearch').addEventListener('input', filterSchedule);
    document.getElementById('prodiFilter').addEventListener('change', filterSchedule);
</script>
