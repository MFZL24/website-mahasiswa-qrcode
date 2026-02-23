<div style="background: #0f172a; min-height: 100vh; margin: -20px; padding: 40px; display: flex; flex-direction: row; align-items: center; justify-content: center; color: white; font-family: 'Inter', sans-serif; gap: 50px;">
    
    <!-- LEFT SIDE: QR CODE -->
    <div style="display: flex; flex-direction: column; align-items: center;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="font-size: 32px; font-weight: 900; letter-spacing: -1px; margin-bottom: 10px; background: linear-gradient(to right, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">SESI ABSENSI AKTIF</h1>
            <p style="color: #94a3b8; font-size: 18px;">Silakan scan QR Code di bawah ini</p>
        </div>

        <div style="background: white; padding: 30px; border-radius: 40px; box-shadow: 0 0 100px rgba(79, 70, 229, 0.2); position: relative; border: 8px solid #1e293b;">
            <div style="position: absolute; top: -10px; left: -10px; width: 60px; height: 60px; border-top: 10px solid #6366f1; border-left: 10px solid #6366f1; border-radius: 20px 0 0 0;"></div>
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; border-top: 10px solid #6366f1; border-right: 10px solid #6366f1; border-radius: 0 20px 0 0;"></div>
            <div style="position: absolute; bottom: -10px; left: -10px; width: 60px; height: 60px; border-bottom: 10px solid #6366f1; border-left: 10px solid #6366f1; border-radius: 0 0 0 20px;"></div>
            <div style="position: absolute; bottom: -10px; right: -10px; width: 60px; height: 60px; border-bottom: 10px solid #6366f1; border-right: 10px solid #6366f1; border-radius: 0 0 20px 0;"></div>

            <div style="width: 280px; height: 280px; background: white; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <img src="<?= $qr_image ?>" alt="QR Code Absensi" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        </div>

        <div style="margin-top: 40px; text-align: center; width: 100%; max-width: 400px;">
            <div style="background: rgba(255,255,255,0.05); padding: 15px 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); position: relative; overflow: hidden;">
                <span style="display: block; font-size: 11px; font-weight: 800; color: #6366f1; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px;">KODE TOKEN MANUAL</span>
                <div id="token-display" style="font-size: 36px; font-weight: 900; font-family: 'JetBrains Mono', monospace; letter-spacing: 12px; color: white;">
                    <?= $token ?>
                </div>
                <!-- Progress Bar Token -->
                <div style="position: absolute; bottom: 0; left: 0; height: 3px; background: #6366f1; width: 100%; transition: width 1s linear;" id="token-progress"></div>
            </div>
            <p style="font-size: 12px; color: #475569; margin-top: 10px; font-weight: 600;">
                <i class="fa-solid fa-sync fa-spin"></i> Token berganti otomatis dalam <span id="sync-timer">120</span> detik
            </p>
        </div>

        <div style="margin-top: 30px; display: flex; flex-direction: column; align-items: center; gap: 15px;">
            <div style="display: flex; align-items: center; gap: 12px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); padding: 10px 20px; border-radius: 15px;">
                <div style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; box-shadow: 0 0 10px #ef4444; animation: pulse 2s infinite;"></div>
                <span style="font-weight: 700; color: #f87171; font-size: 14px;">SCAN SEDANG BERJALAN</span>
            </div>
            
            <a href="<?= base_url('index.php/dosen_fitur/rekap_absensi/'.$id_pertemuan) ?>" style="color: #94a3b8; font-weight: 600; text-decoration: none; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#94a3b8'">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Rekap
            </a>
        </div>
    </div>

    <!-- RIGHT SIDE: LIVE FEED -->
    <div style="width: 350px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 30px; padding: 25px; height: 600px; display: flex; flex-direction: column; backdrop-filter: blur(20px);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div style="font-size: 14px; font-weight: 800; color: #6366f1; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-users"></i> HADIR (<span id="count-display"><?= $recent_scans->num_rows() ?></span>)
            </div>
            <div style="font-size: 12px; color: #4ade80; font-weight: 700;">Live Feed</div>
        </div>

        <div id="live-feed-container" style="flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 12px; padding-right: 5px;" class="scan-list">
                <?php foreach($recent_scans->result() as $rs): 
                    $color = '#6366f1'; 
                    $bg = 'rgba(99, 102, 241, 0.2)';
                    if($rs->status == 'Izin') { $color = '#3b82f6'; $bg = 'rgba(59, 130, 246, 0.2)'; }
                    elseif($rs->status == 'Sakit') { $color = '#f59e0b'; $bg = 'rgba(245, 158, 11, 0.2)'; }
                ?>
                    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.05); padding: 15px; border-radius: 18px; display: flex; align-items: center; gap: 15px; animation: slideInX 0.4s ease-out; opacity: 0.85; position: relative; overflow: hidden;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1, #c084fc); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 14px;">
                            <?= substr($rs->nama, 0, 1) ?>
                        </div>
                        <div style="overflow: hidden; flex: 1;">
                            <div style="font-size: 14px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $rs->nama ?></div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 3px;">
                                <div style="font-size: 10px; color: #94a3b8; font-family: monospace;"><?= $rs->nim ?></div>
                                <span style="font-size: 9px; font-weight: 800; padding: 2px 8px; border-radius: 6px; background: <?= $bg ?>; color: <?= $color ?>; text-transform: uppercase;"><?= $rs->status ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php if($recent_scans->num_rows() == 0): ?>
                <div id="empty-state" style="text-align: center; margin-top: 100px; color: #475569;">
                    <i class="fa-solid fa-qrcode" style="font-size: 40px; margin-bottom: 15px; opacity: 0.2;"></i>
                    <p style="font-size: 13px; font-weight: 600;">Menunggu mahasiswa pertama...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
@keyframes slideInX {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 0.85; transform: translateX(0); }
}
.scan-list::-webkit-scrollbar { width: 4px; }
.scan-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
</style>

<script>
    let timeLeft = 120; // 2 Menit
    const progressBar = document.getElementById('token-progress');
    const timerDisplay = document.getElementById('sync-timer');
    const qrImage = document.querySelector('img[alt="QR Code Absensi"]');
    const tokenDisplay = document.getElementById('token-display');
    const countDisplay = document.getElementById('count-display');

    function updateSync() {
        timeLeft--;
        timerDisplay.textContent = timeLeft;
        
        let percentage = (timeLeft / 120) * 100;
        progressBar.style.width = percentage + '%';

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
                // Update QR Image and Token with smooth transition
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
        } catch (error) {
            console.error('Failed to sync QR:', error);
        }
    }

    // Jalankan timer
    setInterval(updateSync, 1000);
    
    // Auto refresh feed nama mahasiswa tetap pakai refresh halaman setiap 15 detik 
    // agar sinkron dengan database secara penuh tanpa ribet API feed
    setTimeout(() => location.reload(), 15000);
</script>

<style>
@keyframes pulse {
    0% { transform: scale(0.95); opacity: 0.5; }
    50% { transform: scale(1); opacity: 1; }
    100% { transform: scale(0.95); opacity: 0.5; }
}
/* Hide default layout parts when this view is active */
.sidebar, .top-navbar, .main-wrapper { 
    background: #0f172a !important; 
}
.card {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
}
</style>
