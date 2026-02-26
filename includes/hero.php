<!-- Hero Redesign: Ardo Next Gen -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<section class="hero-redesign" style="padding: 100px 0; overflow: hidden; position: relative; background: #ffffff;">

    <!-- Dynamic Mesh Gradient Canvas (Full Background) -->
    <canvas id="hero-gradient-canvas"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></canvas>

    <div class="container"
        style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; position: relative; z-index: 2;">

        <div class="hero-text-content">
            <div class="status-indicator"
                style="margin-bottom: 2rem; background: #f3f4f6; padding: 5px 15px; border-radius: 20px; display: inline-flex; align-items: center; gap: 8px;">
                <span class="dot pulse"
                    style="background: #00D09C; width: 8px; height: 8px; border-radius: 50%;"></span>
                <span
                    style="color: var(--ardo-text-muted); font-size: 0.8rem; font-weight: 700; font-family: var(--font-mono); text-transform: uppercase; letter-spacing: 0.5px;">Infraestructura
                    Activa</span>
            </div>

            <h1 class="text-huge" style="margin-bottom: 1.5rem; color: var(--ardo-midnight);">
                comunicación <span class="text-cyan">Crítica</span> <br> Para Empresas.
            </h1>

            <p
                style="font-size: 1.25rem; color: var(--ardo-text-muted); margin-bottom: 3rem; max-width: 500px; line-height: 1.6;">
                Modernice la comunicación de su organización con telefonía VoIP de alta fidelidad, Cloud PBX y
                conectividad robusta diseñada para operar sin interrupciones.
            </p>

            <div class="hero-actions" style="display: flex; gap: 1.5rem; align-items: center;">
                <a href="#contacto" class="btn-primary">Solicitar Consultoría</a>
                <a href="<?php echo $basePath; ?>casos-de-estudio/" class="btn-dark"
                    style="padding: 0.75rem 1.5rem; font-size: 11px; background: var(--ardo-midnight); color: #fff;">Ver
                    Implementaciones</a>
            </div>
        </div>

        <div class="hero-visual"
            style="position: relative; height: 400px; display: flex; align-items: center; justify-content: flex-end;">
            <!-- Floating Decorative Element (Lottie Animation) -->
            <div class="lottie-container"
                style="width: 100%; max-width: none; transform: scale(2.5); transform-origin: right center; margin-right: -200px; z-index: 20;">
                <lottie-player src="<?php echo $basePath; ?>images/Technology_Network.json" background="transparent"
                    speed=".2" style="width: 100%; height: 100%;" loop autoplay></lottie-player>
            </div>
        </div>

    </div>
</section>

<style>
    @media (max-width: 1024px) {
        .hero-redesign .container {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .hero-text-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-actions {
            justify-content: center;
        }

        .hero-visual {
            display: none !important;
        }
    }
</style>

<!-- Hero Network Animation Script -->
<script>
    (function () {
        const canvas = document.getElementById('hero-gradient-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width, height;

        // Configuration
        const particleCount = 85; // Increased density
        const connectionDistance = 180; // Increased reach
        const particles = [];

        // Colors
        const bgColor = [255, 255, 255]; // White Background
        const nodeColor = 'rgba(10, 25, 47, 0.15)'; // Midnight Blue Nodes (Subtle)
        const lineColor = 'rgba(10, 25, 47, '; // Midnight Blue Lines (alpha dynamic)

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 0.6; // Slower velocity
                this.vy = (Math.random() - 0.5) * 0.6;
                this.size = Math.random() * 2 + 1;
                this.hasNeighbour = false;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                // Bounce off edges
                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = nodeColor;
                ctx.fill();
            }
        }

        function init() {
            resize();
            particles.length = 0;
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }

        function resize() {
            // Limit internal resolution for performance on high-DPI screens
            const maxRes = 2000;
            const dpr = Math.min(window.devicePixelRatio || 1, 1.5); // Cap DPR at 1.5

            // Display size
            const displayWidth = canvas.offsetWidth;
            const displayHeight = canvas.offsetHeight;

            // Internal memory size (clamped)
            width = canvas.width = Math.min(displayWidth * dpr, maxRes);
            height = canvas.height = Math.min(displayHeight * dpr, maxRes * (displayHeight / displayWidth));

            // Normalize coordinate system if needed, but since we use random placement 
            // based on 'width' and 'height' vars, it self-adjusts.
        }

        let animationId;
        let isVisible = true;

        function loop() {
            if (!isVisible) return;

            // Clear and fill background
            ctx.fillStyle = `rgb(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]})`;
            ctx.fillRect(0, 0, width, height);

            // Reset neighbor state
            particles.forEach(p => p.hasNeighbour = false);

            // Update positions first
            particles.forEach(p => p.update());

            // Draw connections and mark active nodes
            // Optimization: limit connection checks if particle count is high
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;

                    // Quick check for bounding box to avoid sqrt if possible (pre-optimization)
                    if (Math.abs(dx) > connectionDistance || Math.abs(dy) > connectionDistance) continue;

                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < connectionDistance) {
                        particles[i].hasNeighbour = true;
                        particles[j].hasNeighbour = true;

                        ctx.beginPath();
                        ctx.strokeStyle = lineColor + (1 - dist / connectionDistance) * 0.15 + ')';
                        ctx.lineWidth = 1;
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }

            // Draw only nodes that are connected to the network
            particles.forEach(p => {
                if (p.hasNeighbour) {
                    p.draw();
                }
            });

            animationId = requestAnimationFrame(loop);
        }

        // Performance: Intersection Observer to pause animation when off-screen
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    isVisible = true;
                    if (!animationId) loop(); // Restart if stopped
                } else {
                    isVisible = false;
                    if (animationId) {
                        cancelAnimationFrame(animationId);
                        animationId = null;
                    }
                }
            });
        }, { threshold: 0.1 });

        observer.observe(canvas);

        // Resize Handling with simple debounce to prevent thrashing
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                resize();
                init();
            }, 200);
        });

        init();
        loop();
    })();
</script>