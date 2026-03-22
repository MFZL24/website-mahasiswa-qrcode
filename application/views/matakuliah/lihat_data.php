<?php 
// Group data by Prodi then Semester
$grouped_prodi = [];
foreach($record->result() as $r) {
    $prodi_name = !empty($r->prodi) ? $r->prodi : 'PROGRAM STUDI UMUM';
    $grouped_prodi[$prodi_name][$r->semester][] = $r;
}
ksort($grouped_prodi);
?>

<!-- HEADER SECTION -->
<div style="margin-bottom: 40px;">
    <div style="background: white; padding: 40px; border-radius: 35px; border: 1px solid #f1f5f9; box-shadow: 0 15px 45px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #0f172a; color: white; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h2 style="font-size: 28px; font-weight: 900; color: #0f172a; letter-spacing: -1px; margin: 0;">Kurikulum Perkuliahan</h2>
                    <p style="color: #64748b; font-size: 14px; font-weight: 500; margin-top: 2px;">Manajemen struktur mata kuliah lintas program studi.</p>
                </div>
            </div>
            <a href="<?= base_url('index.php/matakuliah/tambah') ?>" style="padding: 16px 32px; border-radius: 18px; font-weight: 800; background: var(--primary); color: white; border: none; box-shadow: 0 10px 25px rgba(0, 104, 116, 0.2); transition: all 0.3s; display: flex; align-items: center; gap: 10px; text-decoration: none; font-size: 14px;">
                <i class="fa-solid fa-plus-circle"></i> TAMBAH MATAKULIAH
            </a>
        </div>

        <!-- SEARCH BOX -->
        <div style="position: relative;">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 22px; top: 19px; color: #94a3b8; font-size: 18px;"></i>
            <input type="text" id="searchInput" placeholder="Cari Kode atau Nama Mata Kuliah..." 
                   style="width: 100%; padding: 18px 25px 18px 55px; border-radius: 18px; border: 2px solid #f1f5f9; background: #f8fafc; font-weight: 600; font-size: 15px; outline: none; transition: all 0.3s;">
        </div>
    </div>
</div>

<!-- CONTENT SECTION -->
<?php foreach($grouped_prodi as $prodi => $semesters): ?>
<div class="prodi-section" style="margin-bottom: 50px;">
    <!-- Prodi Brand Header -->
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding-left: 10px;">
        <div style="height: 24px; width: 6px; background: var(--primary); border-radius: 10px;"></div>
        <h3 style="font-size: 20px; font-weight: 900; color: #1e293b; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;"><?= $prodi ?></h3>
    </div>

    <div class="table-container" style="background: white; border-radius: 30px; border: 1px solid #f1f5f9; overflow-x: auto; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
        <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 22px 30px; font-weight: 800; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; width: 140px;">KODE MK</th>
                    <th style="padding: 22px 30px; font-weight: 800; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">NAMA MATAKULIAH</th>
                    <th style="padding: 22px 30px; font-weight: 800; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-align: center; width: 100px;">SKS</th>
                    <th style="padding: 22px 30px; font-weight: 800; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-align: center; width: 120px;">SEMESTER</th>
                    <th style="padding: 22px 30px; font-weight: 800; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-align: center; width: 140px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php ksort($semesters); foreach($semesters as $sem => $items): ?>
                    <!-- Semester Sub-Header Inner Table -->
                    <tr class="semester-divider-row" style="background: #fffdf5;">
                        <td colspan="5" style="padding: 12px 30px; border-bottom: 1px solid #fdf2f8;">
                            <span style="font-size: 11px; font-weight: 900; color: #d97706; background: #fef3c7; padding: 4px 12px; border-radius: 8px;">
                                <i class="fa-solid fa-bookmark" style="margin-right: 5px;"></i> PAKET SEMESTER <?= $sem ?>
                            </span>
                        </td>
                    </tr>

                    <?php foreach($items as $r): ?>
                    <tr class="table-row-hover" style="border-bottom: 1px solid #f8fafc; transition: all 0.2s;">
                        <td style="padding: 20px 30px;">
                            <span style="font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 800; color: var(--primary); background: rgba(0, 104, 116, 0.05); padding: 5px 10px; border-radius: 8px;">
                                <?= $r->kode_mk ?>
                            </span>
                        </td>
                        <td style="padding: 20px 30px;">
                            <div style="font-weight: 750; color: #1e293b; font-size: 15px;"><?= $r->nama_mk ?></div>
                        </td>
                        <td style="padding: 20px 30px; text-align: center;">
                            <div style="font-weight: 800; color: #475569; font-size: 16px;">
                                <?= $r->sks ?> <span style="font-size: 10px; font-weight: 600; color: #94a3b8;">SKS</span>
                            </div>
                        </td>
                        <td style="padding: 20px 30px; text-align: center;">
                            <div style="width: 32px; height: 32px; background: #f1f5f9; color: #475569; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-weight: 900; font-size: 13px;">
                                <?= $sem ?>
                            </div>
                        </td>
                        <td style="padding: 20px 30px; text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="<?= base_url('index.php/matakuliah/edit/'.$r->id_mk) ?>" style="width: 36px; height: 36px; background: #eff6ff; color: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url('index.php/matakuliah/hapus/'.$r->id_mk) ?>" onclick="return confirm('Hapus Mata Kuliah?')" style="width: 36px; height: 36px; background: #fff1f2; color: #f43f5e; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s;" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endforeach; ?>

<?php if(empty($grouped_prodi)): ?>
    <div style="text-align: center; padding: 100px 50px; background: white; border-radius: 40px; border: 2px dashed #f1f5f9;">
         <h3 style="font-size: 20px; font-weight: 800; color: #64748b;">Belum ada data matakuliah.</h3>
         <a href="<?= base_url('index.php/matakuliah/tambah') ?>" style="color: var(--primary); font-weight: 700; text-decoration: none; display: block; margin-top: 15px;">Tambah data sekarang →</a>
    </div>
<?php endif; ?>

<style>
    .table-row-hover:hover {
        background-color: #f8fafc !important;
    }
    .table-row-hover:hover td {
        color: var(--primary);
    }
    #searchInput:focus {
        border-color: var(--primary) !important;
        background: white !important;
        box-shadow: 0 0 0 10px rgba(0, 104, 116, 0.05);
    }
</style>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        
        document.querySelectorAll('.prodi-section').forEach(section => {
            let sectionVisible = false;
            
            // Handle rows matching search
            section.querySelectorAll('.table-row-hover').forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                    sectionVisible = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Adjust semester divider visibility
            section.querySelectorAll('tbody').forEach(tbody => {
                let lastDivider = null;
                let dividerNeeded = false;
                
                Array.from(tbody.children).forEach(child => {
                    if (child.classList.contains('semester-divider-row')) {
                        if (lastDivider && !dividerNeeded) lastDivider.style.display = 'none';
                        lastDivider = child;
                        dividerNeeded = false;
                    } else if (child.style.display !== 'none') {
                        dividerNeeded = true;
                    }
                });
                if (lastDivider) lastDivider.style.display = dividerNeeded ? '' : 'none';
            });

            section.style.display = sectionVisible ? '' : 'none';
        });
    });
</script>
