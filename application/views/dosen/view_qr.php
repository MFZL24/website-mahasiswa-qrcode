<div style="background: #0f172a; min-height: 100vh; margin: -20px; padding: 40px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; font-family: 'Inter', sans-serif;">
    
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 32px; font-weight: 900; letter-spacing: -1px; margin-bottom: 10px; background: linear-gradient(to right, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">SESI ABSENSI AKTIF</h1>
        <p style="color: #94a3b8; font-size: 18px;">Silakan buka aplikasi dan scan QR Code di bawah ini</p>
    </div>

    <div style="background: white; padding: 50px; border-radius: 40px; box-shadow: 0 0 100px rgba(79, 70, 229, 0.3); position: relative; border: 8px solid #1e293b;">
        <!-- Animated Corner Accents for Scanner Feel -->
        <div style="position: absolute; top: -10px; left: -10px; width: 60px; height: 60px; border-top: 10px solid #6366f1; border-left: 10px solid #6366f1; border-radius: 20px 0 0 0;"></div>
        <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; border-top: 10px solid #6366f1; border-right: 10px solid #6366f1; border-radius: 0 20px 0 0;"></div>
        <div style="position: absolute; bottom: -10px; left: -10px; width: 60px; height: 60px; border-bottom: 10px solid #6366f1; border-left: 10px solid #6366f1; border-radius: 0 0 0 20px;"></div>
        <div style="position: absolute; bottom: -10px; right: -10px; width: 60px; height: 60px; border-bottom: 10px solid #6366f1; border-right: 10px solid #6366f1; border-radius: 0 0 20px 0;"></div>

        <div style="width: 350px; height: 350px; background: white; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img src="<?= $qr_image ?>" alt="QR Code Absensi" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
    </div>

    <!-- Token Manual Display -->
    <div style="margin-top: 50px; text-align: center;">
        <div style="background: rgba(255,255,255,0.05); padding: 20px 40px; border-radius: 24px; border: 1px solid rgba(255,255,255,0.1); display: inline-block;">
            <span style="display: block; font-size: 12px; font-weight: 800; color: #6366f1; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;">KODE TOKEN MANUAL</span>
            <div style="font-size: 48px; font-weight: 900; font-family: 'JetBrains Mono', monospace; letter-spacing: 15px; color: white;">
                <?= $token ?>
            </div>
        </div>
    </div>

    <!-- Countdown / Info Footer -->
    <div style="margin-top: 60px; display: flex; gap: 30px; align-items: center;">
        <div style="display: flex; align-items: center; gap: 15px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); padding: 12px 25px; border-radius: 15px;">
            <div style="width: 12px; height: 12px; background: #ef4444; border-radius: 50%; box-shadow: 0 0 10px #ef4444; animation: pulse 2s infinite;"></div>
            <span style="font-weight: 700; color: #f87171;">SESI BERAKHIR: <?= date('H:i', strtotime('+30 minutes')) ?> WIB</span>
        </div>
        
        <a href="<?= base_url('index.php/dashboard') ?>" style="color: #94a3b8; font-weight: 600; text-decoration: none; border-bottom: 2px solid transparent; transition: all 0.3s;" onmouseover="this.style.color='white'; this.style.borderColor='#6366f1'" onmouseout="this.style.color='#94a3b8'; this.style.borderColor='transparent'">
            <i class="fa-solid fa-circle-xmark"></i> TUTUP PANEL ABSENSI
        </a>
    </div>
</div>

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
