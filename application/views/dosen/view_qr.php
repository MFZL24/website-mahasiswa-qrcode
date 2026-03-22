<div style="background: #021a24; min-height: 100vh; margin: -50px -50px; padding: 50px; display: flex; flex-direction: row; align-items: center; justify-content: center; color: white; gap: 80px; position: relative; overflow: hidden;">
    
    <!-- Heavy Background Ambience -->
    <div style="position: absolute; width: 800px; height: 800px; background: radial-gradient(circle, rgba(0, 104, 116, 0.25) 0%, transparent 70%); top: -300px; left: -300px; pointer-events: none;"></div>
    <div style="position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%); bottom: -200px; right: -200px; pointer-events: none;"></div>

    <!-- LEFT SIDE: SCAN ENGINE -->
    <div style="display: flex; flex-direction: column; z-index: 10; flex: 1; max-width: 650px;">
        <div style="margin-bottom: 50px;">
            <div style="display: inline-flex; align-items: center; gap: 12px; background: rgba(16, 185, 129, 0.1); padding: 10px 22px; border-radius: 50px; border: 1.5px solid rgba(16, 185, 129, 0.2); margin-bottom: 25px;">
                <div style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; box-shadow: 0 0 15px #10b981; animation: pulse-green 2s infinite;"></div>
                <span style="font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #10b981;">Sesi Presensi Digital Aktif</span>
            </div>
            <h1 style="font-size: 56px; font-weight: 950; letter-spacing: -2px; line-height: 1; margin-bottom: 15px; color: white;">Scan & Absensi</h1>
            <p style="color: #64748b; font-size: 20px; font-weight: 500;">Silakan pindai QR Code di bawah atau masukkan token manual melalui portal mahasiswa.</p>
        </div>

        <div style="display: flex; gap: 50px; align-items: center;">
            <div style="background: white; padding: 45px; border-radius: 50px; box-shadow: 0 40px 100px rgba(0,0,0,0.6); position: relative; border: 12px solid #032b38;" id="qr-frame">
                <!-- Glowing Corners -->
                <div style="position: absolute; top: -15px; left: -15px; width: 80px; height: 80px; border-top: 15px solid var(--primary); border-left: 15px solid var(--primary); border-radius: 30px 0 0 0; filter: drop-shadow(0 0 10px var(--primary));"></div>
                <div style="position: absolute; top: -15px; right: -15px; width: 80px; height: 80px; border-top: 15px solid var(--primary); border-right: 15px solid var(--primary); border-radius: 0 30px 0 0; filter: drop-shadow(0 0 10px var(--primary));"></div>
                <div style="position: absolute; bottom: -15px; left: -15px; width: 80px; height: 80px; border-bottom: 15px solid var(--primary); border-left: 15px solid var(--primary); border-radius: 0 0 0 30px; filter: drop-shadow(0 0 10px var(--primary));"></div>
                <div style="position: absolute; bottom: -15px; right: -15px; width: 80px; height: 80px; border-bottom: 15px solid var(--primary); border-right: 15px solid var(--primary); border-radius: 0 0 30px 0; filter: drop-shadow(0 0 10px var(--primary));"></div>

                <div style="width: 320px; height: 320px; background: white; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="<?= $qr_image ?>" alt="QR Code Absensi" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
            </div>

            <!-- Stats/Context in the Engine -->
            <div style="flex: 1; display: flex; flex-direction: column; gap: 20px;">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 25px; border-radius: 30px; backdrop-filter: blur(10px);">
                    <span style="font-size: 10px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">TOKEN MANUAL</span>
                    <div id="token-display" style="font-size: 48px; font-weight: 950; font-family: 'JetBrains Mono', monospace; color: white; letter-spacing: 12px; line-height: 1;"><?= $token ?></div>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 25px; border-radius: 30px; backdrop-filter: blur(10px);">
                    <span style="font-size: 10px; font-weight: 850; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">WAKTU TERSISA</span>
                    <div id="sync-timer-large" style="font-size: 36px; font-weight: 950; color: #38bdf8; line-height: 1;">120s</div>
                </div>
                <div style="margin-top: 20px;">
                    <a href="<?= base_url('index.php/dosen_fitur/rekap_absensi/'.$id_pertemuan) ?>" style="display: flex; align-items: center; justify-content: center; gap: 12px; background: #e11d48; color: white; padding: 18px; border-radius: 20px; font-weight: 900; text-decoration: none; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(225, 29, 72, 0.25); transition: 0.3s;">
                        STOP & REKAP <i class="fa-solid fa-circle-stop"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE: LIVE ATTENDANCE FEED -->
    <div style="width: 450px; background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 45px; padding: 40px; height: 750px; display: flex; flex-direction: column; backdrop-filter: blur(40px); z-index: 10; box-shadow: 20px 40px 80px rgba(0,0,0,0.4);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
            <div>
                <h4 style="font-size: 11px; font-weight: 900; color: #10b981; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px;">Hadir Real-time</h4>
                <div style="font-size: 36px; font-weight: 950; color: white; display: flex; align-items: center; gap: 15px;">
                    <span id="count-display" style="text-shadow: 0 0 20px rgba(16, 185, 129, 0.3);"><?= $recent_scans->num_rows() ?></span>
                    <span style="font-size: 12px; color: #64748b; font-weight: 850; text-transform: uppercase; letter-spacing: 1px;">Mahasiswa Terdata</span>
                </div>
            </div>
            <div style="background: rgba(16, 185, 129, 0.15); color: #10b981; padding: 8px 18px; border-radius: 12px; font-size: 11px; font-weight: 900; border: 1.5px solid rgba(16, 185, 129, 0.2);">
                <i class="fa-solid fa-satellite-dish" style="margin-right: 8px; animation: bounce 1s infinite;"></i> LIVE
            </div>
        </div>

        <div id="live-feed-container" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 18px; padding-right: 15px;" class="scan-list">
                <?php foreach($recent_scans->result() as $rs): 
                    $color = '#006874'; 
                    $bg = 'rgba(0, 104, 116, 0.2)';
                    $icon = 'fa-circle-check';
                    if($rs->status == 'Izin') { $color = '#3b82f6'; $bg = 'rgba(59, 130, 246, 0.2)'; $icon = 'fa-circle-info'; }
                    elseif($rs->status == 'Sakit') { $color = '#f59e0b'; $bg = 'rgba(245, 158, 11, 0.2)'; $icon = 'fa-circle-exclamation'; }
                ?>
                    <div style="background: rgba(255, 255, 255, 0.04); border: 1.5px solid rgba(255, 255, 255, 0.05); padding: 22px; border-radius: 25px; display: flex; align-items: center; gap: 20px; animation: slideInFeed 0.5s cubic-bezier(0.19, 1, 0.22, 1); transition: 0.3s; position: relative; overflow: hidden;" class="feed-item">
                        <div style="width: 55px; height: 55px; min-width: 55px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-weight: 950; font-size: 22px; box-shadow: 0 10px 20px rgba(0,0,0,0.3); border: 2px solid rgba(255,255,255,0.1);">
                            <?= strtoupper(substr($rs->nama, 0, 1)) ?>
                        </div>
                        <div style="overflow: hidden; flex: 1;">
                            <div style="font-size: 16px; font-weight: 900; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.3px;"><?= $rs->nama ?></div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px;">
                                <div style="font-size: 12px; color: #4b5563; font-weight: 800; font-family: 'JetBrains Mono', monospace;"><?= $rs->nim ?></div>
                                <span style="font-size: 10px; font-weight: 900; padding: 4px 12px; border-radius: 10px; background: <?= $bg ?>; color: <?= $color ?>; border: 1.5px solid rgba(255,255,255,0.05); display: flex; align-items: center; gap: 6px; text-transform: uppercase;">
                                    <?= $rs->status ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php if($recent_scans->num_rows() == 0): ?>
                <div id="empty-state" style="text-align: center; margin-top: 150px; color: #334155; padding: 0 40px;">
                    <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.02); border-radius: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; border: 2px dashed rgba(255,255,255,0.08);">
                        <i class="fa-solid fa-qrcode" style="font-size: 40px; opacity: 0.15;"></i>
                    </div>
                    <h5 style="font-size: 18px; font-weight: 850; margin-bottom: 12px; color: #475569; letter-spacing: -0.5px;">Menunggu Presensi...</h5>
                    <p style="font-size: 14px; line-height: 1.6; color: #334155;">Monitor feed ini secara real-time saat mahasiswa memindai kode.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
@keyframes slideInFeed {
    from { opacity: 0; transform: translateX(40px) scale(0.95); }
    to { opacity: 1; transform: translateX(0) scale(1); }
}
@keyframes pulse-green {
    0% { transform: scale(0.95); opacity: 0.5; box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
    70% { transform: scale(1); opacity: 1; box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); opacity: 0.5; box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
@keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-3px); } }

.scan-list::-webkit-scrollbar { width: 6px; }
.scan-list::-webkit-scrollbar-track { background: transparent; }
.scan-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 10px; }

.feed-item:hover { background: rgba(255,255,255,0.07) !important; transform: translateX(-5px); border-color: rgba(255,255,255,0.1) !important; }

/* Dashboard Mode Override */
.sidebar, .top-navbar { display: none !important; }
.main-wrapper { margin-left: 0 !important; }
.content-body { padding: 0 !important; background: #021a24 !important; }
.card { background: transparent !important; border: none !important; box-shadow: none !important; }
</style>

<script>
    let timeLeft = 120;
    const timerDisplay = document.getElementById('sync-timer-large');
    const qrImage = document.querySelector('img[alt="QR Code Absensi"]');
    const tokenDisplay = document.getElementById('token-display');
    const countDisplay = document.getElementById('count-display');

    function updateSync() {
        timeLeft--;
        timerDisplay.textContent = timeLeft + 's';

        if (timeLeft <= 0) {
            refreshQR();
            timeLeft = 120;
        }
    }

    async function refreshQR() {
        try {
            const response = await fetch('<?= base_url('index.php/dosen_fitur/refresh_qr/'.$id_pertemuan) ?>');
            const data = await response.json();
            if (data.status === 'success') {
                qrImage.style.opacity = '0';
                setTimeout(() => {
                    qrImage.src = data.qr_image;
                    qrImage.style.opacity = '1';
                }, 300);
                tokenDisplay.textContent = data.token;
                countDisplay.textContent = data.total_hadir;
            } else if (data.status === 'expired') {
                window.location.href = '<?= base_url('index.php/dosen_fitur/rekap_absensi/'.$id_pertemuan) ?>';
            }
        } catch (error) { console.error('Failed to sync:', error); }
    }

    setInterval(updateSync, 1000);
    // Auto-refresh feed view (optional, since refreshQR handles count)
    setTimeout(() => location.reload(), 30000); // Changed to 30s as refreshQR now handles most data
</script>
