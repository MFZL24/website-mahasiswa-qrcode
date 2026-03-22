<!-- Page Title & Header -->
<div style="max-width: 650px; margin: 0 auto; padding: 20px 20px 60px;">
    <div style="text-align: center; margin-bottom: 45px;">
        <div style="width: 90px; height: 90px; background: var(--primary-light); color: var(--primary); border-radius: 30px; display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 25px; box-shadow: 0 15px 30px rgba(0, 104, 116, 0.12); transform: rotate(-5deg);">
            <i class="fa-solid fa-qrcode"></i>
        </div>
        <h2 style="font-weight: 950; color: #1e293b; margin-bottom: 12px; font-size: 32px; letter-spacing: -1px; line-height: 1;">Presensi Kehadiran</h2>
        <p style="color: #64748b; font-size: 16px; font-weight: 500; max-width: 400px; margin: 0 auto; line-height: 1.5;">Pastikan posisi QR-Code berada tepat di tengah bingkai kamera pemindaian.</p>
    </div>
    
    <div style="background: white; padding: 40px; border-radius: 40px; box-shadow: 0 40px 80px rgba(0,0,0,0.07); border: 1px solid #f1f5f9; position: relative;">
        
        <!-- Scanner Frame Visualization -->
        <div style="position: relative; padding: 12px; background: #fafbfc; border-radius: 30px; border: 2px dashed #e2e8f0; margin-bottom: 35px; overflow: hidden;">
            <div id="reader" style="width: 100%; border-radius: 22px; overflow: hidden; background: #000; box-shadow: inset 0 0 50px rgba(0,0,0,0.5);">
                <!-- HTML5 QrCode Scanner Content -->
            </div>
            
            <!-- Scanning Animation Line -->
            <div style="position: absolute; top: 12px; left: 12px; right: 12px; height: 3px; background: var(--primary); opacity: 0.6; z-index: 5; animation: scanLineMove 2.5s infinite ease-in-out; border-radius: 50px; box-shadow: 0 0 15px var(--primary);" id="scan-indicator"></div>
        </div>

        <!-- Success Feedback Layer -->
        <div id="scan-result-success" style="display: none; text-align: center; padding: 30px; background: #ecfdf5; border-radius: 25px; margin-bottom: 35px; border: 1px solid #d1fae5; animation: bounceIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="width: 60px; height: 60px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; font-size: 24px; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.25);">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <h4 style="color: #065f46; font-weight: 900; margin-bottom: 8px; font-size: 18px;">Pemindaian Berhasil!</h4>
            <p style="color: #059669; font-size: 14px; font-weight: 700; margin: 0; opacity: 0.8;">Sinkronisasi data kehadiran ke pusat...</p>
        </div>

        <!-- Manual Input Alternative -->
        <div style="text-align: center;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
                <div style="flex: 1; height: 2px; background: #f1f5f9;"></div>
                <span style="font-size: 12px; font-weight: 900; color: #cbd5e1; text-transform: uppercase; letter-spacing: 2px;">Opsi Kode Manual</span>
                <div style="flex: 1; height: 2px; background: #f1f5f9;"></div>
            </div>
            
            <form action="<?= base_url('index.php/mhs_fitur/scan') ?>" method="post" id="form-scan">
                <div style="margin-bottom: 30px;">
                    <div style="position: relative;">
                        <input type="text" name="token" id="token-input" placeholder="MASUKKAN KODE TOKEN" required 
                               style="height: 80px; width: 100%; text-align: center; font-size: 32px; font-weight: 950; letter-spacing: 6px; border-radius: 25px; border: 3px solid #f1f5f9; background: #fafbfc; text-transform: uppercase; color: var(--primary); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); outline: none; box-shadow: inset 0 4px 10px rgba(0,0,0,0.01);">
                    </div>
                </div>

                <?php if($this->session->flashdata('error')): ?>
                    <div style="background: #fff1f2; color: #e11d48; padding: 18px; border-radius: 20px; font-size: 14px; font-weight: 800; margin-bottom: 30px; text-align: center; border: 1px solid #ffe4e6; animation: horizontalShake 0.5s ease; box-shadow: 0 8px 20px rgba(225, 29, 72, 0.08);">
                        <i class="fa-solid fa-triangle-exclamation" style="margin-right: 10px; font-size: 16px;"></i> <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>

                <button type="submit" name="submit" class="btn-submit-presensi" style="width: 100%; height: 75px; background: var(--primary); color: white; border: none; font-size: 18px; font-weight: 950; border-radius: 25px; box-shadow: 0 20px 45px rgba(0, 104, 116, 0.3); display: flex; align-items: center; justify-content: center; gap: 15px; cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); letter-spacing: 1px;">
                    <i class="fa-solid fa-paper-plane" style="font-size: 20px;"></i> KIRIM PRESENSI
                </button>
            </form>
        </div>
    </div>

    <!-- Navigation Footer -->
    <div style="margin-top: 45px; text-align: center;">
        <a href="<?= base_url('index.php/dashboard') ?>" style="color: #94a3b8; font-size: 15px; font-weight: 850; text-decoration: none; display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s; background: white; padding: 12px 25px; border-radius: 50px; border: 1px solid #f1f5f9;" onmouseover="this.style.color='var(--primary)'; this.style.borderColor='var(--primary-light)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='#94a3b8'; this.style.borderColor='#f1f5f9'; this.style.transform='translateX(0)'">
            <i class="fa-solid fa-arrow-left-long"></i> Dashboard Utama
        </a>
    </div>
</div>

<!-- Library Scan QR Code -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    function onScanSuccess(decodedText) {
        html5QrcodeScanner.clear();
        const input = document.getElementById('token-input');
        input.value = decodedText;
        document.getElementById('scan-result-success').style.display = 'block';
        document.getElementById('scan-indicator').style.display = 'none';
        
        input.style.borderColor = '#10b981';
        input.style.background = '#ecfdf5';
        input.style.boxShadow = '0 0 0 8px rgba(16, 185, 129, 0.08)';
        
        setTimeout(() => {
            document.getElementById('form-scan').submit();
        }, 1200);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", 
        { 
            fps: 25, 
            qrbox: {width: 280, height: 280},
            rememberLastUsedCamera: true
        }
    );
    html5QrcodeScanner.render(onScanSuccess);
</script>

<style>
    @keyframes scanLineMove {
        0% { top: 12px; }
        50% { top: calc(100% - 15px); }
        100% { top: 12px; }
    }
    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.3); }
        50% { opacity: 0.9; transform: scale(1.1); }
        80% { opacity: 1; transform: scale(0.89); }
        100% { opacity: 1; transform: scale(1); }
    }
    @keyframes horizontalShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    
    #reader { border: none !important; }
    #reader__dashboard_section_csr button {
        background: #f8fafc !important;
        color: #475569 !important;
        border: 2px solid #e2e8f0 !important;
        padding: 12px 25px !important;
        border-radius: 15px !important;
        font-weight: 900 !important;
        font-size: 14px !important;
        cursor: pointer !important;
        transition: all 0.3s !important;
        margin: 10px 0 !important;
    }
    #reader__dashboard_section_csr button:hover {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
    }
    #reader__scan_region video {
        border-radius: 20px !important;
        object-fit: cover !important;
    }
    
    .btn-submit-presensi:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(0, 104, 116, 0.4);
        filter: brightness(1.1);
    }
    #token-input:focus {
        border-color: var(--primary) !important;
        background: white !important;
        box-shadow: 0 0 0 8px rgba(0, 104, 116, 0.05);
    }
</style>
