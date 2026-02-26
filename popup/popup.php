<?php
$popupConfig = include __DIR__ . '/config.php';

if (!$popupConfig['enabled']) {
    return;
}
?>

<!-- ARDO Technology Modular Popup -->
<div id="ardo-popup-overlay" class="ardo-popup-overlay" style="display: none;">
    <div class="ardo-popup-content ardo-split-layout">
        <button id="ardo-popup-close" class="ardo-popup-close" aria-label="Cerrar">&times;</button>
        
        <?php if (!empty($popupConfig['content']['image_url'])): ?>
        <div class="ardo-popup-side ardo-popup-image" style="background-image: url('<?php echo $popupConfig['content']['image_url']; ?>');">
            <div class="ardo-image-overlay">
                <img src="images/badge_gold.png" alt="ARDO Badge" class="ardo-popup-badge">
            </div>
        </div>
        <?php endif; ?>
        
        <div class="ardo-popup-inner">
            <div class="ardo-popup-header-mobile">
                <img src="images/logo-white.webp" alt="ARDO Logo" class="ardo-popup-logo">
            </div>
            
            <div class="ardo-popup-body">
                <span class="ardo-popup-tag">PROGRAMA DE PARTNERS</span>
                <h3><?php echo htmlspecialchars($popupConfig['content']['title']); ?></h3>
                <p><?php echo htmlspecialchars($popupConfig['content']['description']); ?></p>
                
                <form id="ardo-popup-form" class="ardo-popup-form">
                    <div class="ardo-form-grid">
                        <?php foreach ($popupConfig['form']['fields'] as $key => $field): ?>
                            <div class="ardo-form-group">
                                <label for="popup-<?php echo $key; ?>"><?php echo $field['label']; ?></label>
                                <input type="<?php echo $key === 'email' ? 'email' : ($key === 'phone' ? 'tel' : 'text'); ?>" 
                                       id="popup-<?php echo $key; ?>" 
                                       name="<?php echo $key; ?>" 
                                       placeholder="<?php echo $field['placeholder']; ?>" 
                                       <?php echo $field['required'] ? 'required' : ''; ?>>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button type="submit" class="ardo-popup-btn">
                        <span><?php echo htmlspecialchars($popupConfig['form']['submit_text']); ?></span>
                        <i class="lni lni-whatsapp"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* ARDO Popup Styles - Scoped */
.ardo-popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(3, 38, 66, 0.4);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.ardo-popup-overlay.active {
    opacity: 1;
}

.ardo-popup-content {
    background: #ffffff;
    width: 90%;
    max-width: 900px;
    border-radius: 20px;
    position: relative;
    box-shadow: 0 25px 50px -12px rgba(3, 38, 66, 0.25);
    overflow: hidden;
    transform: translateY(30px);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
}

.ardo-popup-side {
    flex: 1;
    min-height: 100%;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ardo-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(3, 38, 66, 0.8) 0%, rgba(3, 38, 66, 0.4) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
}

.ardo-popup-inner {
    flex: 1.2;
    padding: 0;
    display: flex;
    flex-direction: column;
}

.ardo-popup-overlay.active .ardo-popup-content {
    transform: translateY(0);
}

.ardo-popup-close {
    position: absolute;
    top: 15px;
    right: 20px;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(4px);
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    font-size: 24px;
    color: #032642;
    cursor: pointer;
    line-height: 36px;
    z-index: 10;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ardo-popup-close:hover {
    background: #032642;
    color: #fff;
}

.ardo-popup-header-mobile {
    display: none;
    background: #032642;
    padding: 20px;
    text-align: center;
}

.ardo-popup-logo {
    height: 40px;
    display: block;
}

.ardo-popup-badge {
    height: 120px;
    display: block;
    filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
}

.ardo-popup-tag {
    display: inline-block;
    padding: 4px 12px;
    background: #f0f4f8;
    color: #032642;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

.ardo-popup-body {
    padding: 45px 50px;
}

.ardo-popup-body h3 {
    font-size: 30px;
    color: #032642;
    margin-bottom: 15px;
    line-height: 1.2;
    font-weight: 800;
}

.ardo-popup-body p {
    font-size: 17px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 25px;
}

.ardo-popup-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.ardo-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.ardo-form-group label {
    font-size: 13px;
    font-weight: 700;
    color: #032642;
}

.ardo-form-group input {
    padding: 12px 15px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    width: 100%;
    background: #f9fafb;
}

.ardo-form-group input:focus {
    outline: none;
    border-color: #032642;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(3, 38, 66, 0.05);
}

.ardo-popup-btn {
    margin-top: 15px;
    background: #25d366;
    color: #fff;
    border: none;
    padding: 16px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 800;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

.ardo-popup-btn:hover {
    transform: translateY(-2px);
    background: #128c7e;
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
}

@media (max-width: 900px) {
    .ardo-popup-content {
        max-width: 500px;
        flex-direction: column;
    }
    .ardo-popup-side {
        display: none;
    }
    .ardo-popup-header-mobile {
        display: block;
    }
    .ardo-popup-body {
        padding: 30px;
    }
    .ardo-popup-close {
        background: rgba(255,255,255,0.2);
        color: #fff;
    }
}
@media (max-width: 600px) {
    .ardo-popup-body h3 {
        font-size: 20px;
    }
    .ardo-popup-body {
        padding: 25px 20px;
    }
}
</style>

<script src="popup/popup.js"></script>
