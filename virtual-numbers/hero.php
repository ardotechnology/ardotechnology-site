<style>
    /* Premium Hero Styles */
    .hero-premium {
        position: relative;
        min-height: 700px;
        display: flex;
        align-items: center;
        background: url('https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg') no-repeat center center;
        background-size: cover;
        padding-top: 100px;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(14, 165, 233, 0.8) 100%);
        z-index: 1;
    }

    .hero-container {
        position: relative;
        z-index: 2;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 60px;
    }

    .hero-text {
        flex: 1;
        color: white;
    }

    .hero-text h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 25px;
        letter-spacing: -0.02em;
    }

    .hero-text p {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 35px;
        line-height: 1.6;
    }

    .hero-badges {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .badge-premium {
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 99px;
        font-size: 0.9rem;
        font-weight: 600;
        color: white;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .hero-actions {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .hero-visual {
        flex: 1;
        display: flex;
        justify-content: flex-end;
    }

    /* Glass Card for Visual */
    .glass-card-visual {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        color: white;
        text-align: center;
    }

    .flag-icon-large {
        font-size: 3rem;
        margin-bottom: 20px;
        display: block;
    }

    .number-preview {
        background: rgba(0, 0, 0, 0.3);
        padding: 15px 25px;
        border-radius: 12px;
        font-family: 'Courier New', monospace;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 20px 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: inline-block;
    }

    .lada {
        color: #38bdf8;
    }

    .number {
        color: #ffffff;
    }

    @media (max-width: 968px) {
        .hero-container {
            flex-direction: column;
            text-align: center;
            padding-bottom: 60px;
            gap: 40px;
        }

        .hero-badges,
        .hero-actions {
            justify-content: center;
        }

        .hero-text h1 {
            font-size: 2.5rem;
        }

        .hero-visual {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<section class="hero-premium">
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <div class="hero-text">
            <div class="hero-badges">
                <span class="badge-premium"><i class="fa-solid fa-flag"></i> Mexico Local Numbers</span>
                <span class="badge-premium"><i class="fa-brands fa-whatsapp"></i> WhatsApp Ready</span>
                <span class="badge-premium"><i class="fa-solid fa-bolt"></i> Instant Activation</span>
            </div>

            <h1>Get a <span style="color: #38bdf8;">Mexico Virtual Number</span> & Grow Business</h1>

            <p>Establish a <strong>local presence in Mexico</strong> from the US without physical offices.
                Connect with Mexican customers using local phone numbers from Mexico City, Monterrey, Guadalajara, and
                50+ cities.</p>

            <div class="hero-actions">
                <a href="https://wa.me/524429803200" class="btn btn-primary btn-large"
                    style="padding: 16px 32px; border-radius: 50px; font-weight: 700; background-color: #25D366; border-color: #25D366;">
                    <i class="fa-brands fa-whatsapp" style="margin-right: 8px;"></i> Get Your Mexico Number
                </a>
                <a href="tel:+524429803200" class="btn btn-outline-white" style="color: white; font-weight: 600;">
                    <i class="fa-solid fa-phone"></i> +52 442 980 3200
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="glass-card-visual">
                <div class="flag-icon-large">🇺🇸 ➜ 🇲🇽</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 15px; font-weight: 700;">Cross-Border Made Easy</h3>
                <p style="opacity: 0.9; margin-bottom: 20px;">Connect your <strong>US headquarters</strong> with
                    <strong>Mexican customers</strong> seamlessly.
                </p>

                <div class="number-preview">
                    <span class="lada">+52 55</span> <span class="number">1234-5678</span>
                </div>

                <p style="font-size: 0.9rem; opacity: 0.7; margin-top: 15px;">
                    <i class="fa-solid fa-check-circle" style="color: #4ade80;"></i> Available Immediately
                </p>
            </div>
        </div>
    </div>
</section>