<div style="max-width: 500px; margin: 0 auto; padding: 20px;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; color: #1e293b; margin-bottom: 10px;">Scan Presensi Kehadiran</h2>
        <p style="color: #64748b;">Arahkan kamera ke QR Code yang ditampilkan oleh Dosen.</p>
    </div>
    
    <div style="background: white; padding: 30px; border-radius: 30px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; position: relative;">
        
        <!-- QR Reader Container -->
        <div id="reader" style="width: 100%; border-radius: 20px; overflow: hidden; border: 2px solid #e2e8f0; background: #f8fafc; position: relative;">
            <!-- Custom scanning overlay will be injected by script -->
        </div>

        <div id="scan-result-success" style="display: none; text-align: center; padding: 20px; background: #f0fdf4; border-radius: 15px; margin-top: 20px; border: 1px solid #dcfce7;">
            <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 30px;"></i>
            <p style="color: #166534; font-weight: 700; margin-top: 10px;">Mendapat Token! Mengirim data...</p>
        </div>

        <div style="margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 30px;">
            <p style="text-align: center; font-size: 12px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">Atau Input Token Manual</p>
            
            <form action="<?= base_url('index.php/mhs_fitur/scan') ?>" method="post" id="form-scan">
                <div style="margin-bottom: 20px;">
                    <div style="position: relative;">
                        <input type="text" name="token" id="token-input" class="form-control" placeholder="ABC-123***" required 
                               style="height: 60px; text-align: center; font-size: 24px; font-weight: 800; letter-spacing: 5px; border-radius: 18px; border: 2px solid #e2e8f0; background: #fdfdfd; text-transform: uppercase; color: var(--primary);">
                    </div>
                </div>

                <?php if($this->session->flashdata('error')): ?>
                    <div style="background: #fff1f2; color: #e11d48; padding: 12px; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 20px; text-align: center; border: 1px solid #ffe4e6;">
                        <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>

                <button type="submit" name="submit" class="btn btn-primary" style="width: 100%; height: 55px; justify-content: center; font-size: 16px; font-weight: 700; border-radius: 15px; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                    <i class="fa-solid fa-fingerprint"></i> KIRIM PRESENSI
                </button>
            </form>
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="<?= base_url('index.php/dashboard') ?>" style="color: #64748b; font-size: 14px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<!-- Library Scan QR Code -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Hentikan scanner jika sukses
        html5QrcodeScanner.clear();
        
        // Tampilkan result
        document.getElementById('token-input').value = decodedText;
        document.getElementById('scan-result-success').style.display = 'block';
        
        // Submit otomatis
        setTimeout(() => {
            document.getElementById('form-scan').submit();
        }, 1000);
    }

    function onScanFailure(error) {
        // Jangan terlalu banyak log error scanner
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", 
        { 
            fps: 15, 
            qrbox: {width: 250, height: 250} ,
            rememberLastUsedCamera: true
        },
        /* verbose= */ false
    );
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

<style>
/* Revamp CSS html5-qrcode agar lebih estetik */
#reader {
    border: none !important;
}
#reader__dashboard_section_csr button {
    background: var(--primary) !important;
    color: white !important;
    border: none !important;
    padding: 10px 20px !important;
    border-radius: 10px !important;
    font-weight: 700 !important;
    margin-top: 10px !important;
    cursor: pointer !important;
}
#reader__scan_region video {
    border-radius: 20px !important;
    object-fit: cover !important;
}
#reader__status_span {
    display: none !important;
}
</style>
