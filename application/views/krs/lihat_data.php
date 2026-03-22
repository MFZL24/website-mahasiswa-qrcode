<div class="card" style="border: none; border-radius: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); padding: 40px;">
    <div class="card-header" style="padding:0; justify-content: space-between; align-items: center; margin-bottom: 40px; border: none; background: transparent;">
        <div>
            <h3 class="card-title" style="font-size: 26px; font-weight: 850; color: #1e293b; display: flex; align-items: center; gap: 15px;">
                <i class="fa-solid fa-users-viewfinder" style="color: var(--primary);"></i> Monitoring Rencana Studi
            </h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 6px; font-weight: 500;">Rekapitulasi beban SKS dan intensitas mata kuliah mahasiswa semester berjalan.</p>
        </div>
        <a href="<?= base_url('index.php/krs/tambah') ?>" class="btn-primary" style="padding: 18px 32px; border-radius: 20px; font-weight: 850; background: var(--primary); color: white; display: flex; align-items: center; gap: 12px; border: none; box-shadow: 0 12px 25px rgba(0, 104, 116, 0.2); text-decoration: none; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <i class="fa-solid fa-file-signature" style="font-size: 20px;"></i> INPUT MANUAL KRS
        </a>
    </div>

    <!-- Info Banner - Neo Modern -->
    <div style="background: var(--primary-light); border: 1px solid rgba(0, 104, 116, 0.1); border-radius: 25px; padding: 25px 35px; margin-bottom: 45px; display: flex; gap: 22px; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 24px; border: 1px solid rgba(0, 104, 116, 0.1); box-shadow: 0 6px 12px rgba(0,0,0,0.02);">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <p style="font-size: 15px; color: #004f58; font-weight: 700; margin: 0; line-height: 1.6;">
            Sistem memonitor beban akademik secara real-time. Pastikan mahasiswa melakukan konfirmasi KRS tepat waktu untuk mengaktifkan fitur absensi QR-Code di portal mereka.
        </p>
    </div>

    <!-- Enhanced Table Container -->
    <div class="table-container" style="border-radius: 30px; overflow: hidden; border: 1px solid #f1f5f9; box-shadow: 0 15px 40px rgba(0,0,0,0.02);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #fafbfc;">
                    <th width="80" style="padding-left: 35px; text-align: center;">#</th>
                    <th>Identitas Mahasiswa</th>
                    <th>Program Studi</th>
                    <th style="text-align: center;">Kuantitas MK</th>
                    <th style="text-align: center;">Total SKS</th>
                    <th width="140" style="padding-right: 35px; text-align: right;">Opsi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $grouped_mhs = [];
                foreach($record->result() as $r) {
                    $grouped_mhs[$r->prodi][] = $r;
                }
                ksort($grouped_mhs);
            ?>

            <?php foreach($grouped_mhs as $prodi => $mhs_list): ?>
                <tr style="background: #f8fafc; border-top: 2px solid #f1f5f9;">
                    <td colspan="6" style="padding: 15px 35px; border: none;">
                        <div style="display: flex; align-items: center; gap: 12px; color: #1e293b; font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fa-solid fa-graduation-cap" style="color: var(--primary);"></i> PROGRAM STUDI: <?= $prodi ?>
                            <span style="background: white; color: #94a3b8; padding: 4px 12px; border-radius: 8px; font-size: 10px; border: 1px solid #f1f5f9; margin-left: 10px;">
                                <?= count($mhs_list) ?> Mahasiswa
                            </span>
                        </div>
                    </td>
                </tr>
                <?php $no=1; foreach ($mhs_list as $r): ?>
                <tr>
                    <td style="padding-left: 35px; text-align: center; font-weight: 850; color: #cbd5e1;"><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td>
                        <div style="font-weight: 850; color: #1e293b; font-size: 16px; letter-spacing: -0.3px;"><?= $r->nama ?></div>
                        <div style="font-size: 12px; color: #94a3b8; font-family: 'JetBrains Mono', monospace; font-weight: 800; margin-top: 2px;">NIM: <?= $r->nim ?></div>
                    </td>
                    <td>
                        <div style="font-size: 13px; font-weight: 700; color: #475569; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-code-branch" style="opacity: 0.3;"></i> Bidang Studi Terkait
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span style="background: #ecfdf5; color: #059669; padding: 8px 18px; border-radius: 14px; font-size: 13px; font-weight: 900; border: 1px solid #d1fae5;">
                            <i class="fa-solid fa-book-open" style="font-size: 11px; margin-right: 8px; opacity: 0.7;"></i> <?= $r->total_mk ?> <span style="font-size: 10px; opacity: 0.6; font-weight: 800;">MK</span>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <?php 
                            $is_warn = ($r->total_sks > 22);
                            $sks_color = $is_warn ? '#e11d48' : 'var(--primary)';
                            $sks_bg = $is_warn ? '#fff1f2' : 'var(--primary-light)';
                            $sks_border = $is_warn ? '#ffe4e6' : 'rgba(0, 104, 116, 0.1)';
                        ?>
                        <span style="background: <?= $sks_bg ?>; color: <?= $sks_color ?>; padding: 8px 20px; border-radius: 14px; font-size: 13px; font-weight: 950; border: 1px solid <?= $sks_border ?>; display: inline-flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-bolt" style="font-size: 11px; opacity: 0.8;"></i> <?= $r->total_sks ?: 0 ?> <span style="font-size: 10px; opacity: 0.6; font-weight: 800;">SKS</span>
                        </span>
                    </td>
                    <td style="padding-right: 35px; text-align: right;">
                        <a href="<?= base_url('index.php/krs/detail/'.$r->nim) ?>" class="btn-action" style="background: #f8fafc; color: #475569; width: 46px; height: 46px; border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border: 2px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);" title="Lihat Detail KRS">
                            <i class="fa-solid fa-chevron-right" style="font-size: 18px;"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            
            <?php if(empty($grouped_mhs)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 120px 30px;">
                        <div style="width: 110px; height: 110px; background: #f8fafc; border-radius: 40px; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px;">
                            <i class="fa-solid fa-magnifying-glass-chart" style="font-size: 50px; color: #cbd5e1;"></i>
                        </div>
                        <h4 style="font-size: 20px; font-weight: 900; color: #475569; margin-bottom: 10px;">Monitor Hub Kosong</h4>
                        <p style="color: #94a3b8; font-size: 15px; max-width: 450px; margin: 0 auto; line-height: 1.6;">Belum ada aktivitas kartu rencana studi yang terdeteksi di server untuk periode akademik ini.</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-action:hover { transform: translateX(5px); border-color: var(--primary); color: var(--primary); background: var(--primary-light); }
    .btn-primary:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0, 104, 116, 0.3); opacity: 0.95; }
    tr:hover td { background: #fafbfc; }
</style>
