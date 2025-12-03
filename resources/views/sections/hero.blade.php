<section class="hero-section relative min-h-screen overflow-hidden">
  <!-- Gradient Background Layer -->
  <div class="hero-gradient absolute inset-0 z-0"></div>
  
  <!-- Particle Canvas Layer -->
  <canvas id="particle-canvas" class="absolute inset-0 z-10"></canvas>
  
  <!-- Hero Content -->
  <div class="hero-content relative z-20 flex flex-col items-center justify-center min-h-screen px-6">
    <!-- Company Name with Dots -->
    <div class="company-name relative inline-block text-white/80 text-h4 font-light tracking-wider mb-8">
      <span class="dot dot-left absolute top-1/2 left-[-20px] w-2 h-2 bg-white/60 rounded-full transform -translate-y-1/2"></span>
      {{ get_bloginfo('name', 'display') }}
      <span class="dot dot-right absolute top-1/2 right-[-20px] w-2 h-2 bg-white/60 rounded-full transform -translate-y-1/2"></span>
    </div>
    
    <!-- Main Heading -->
    <h1 class="main-heading text-white text-hero md:text-display lg:text-hero font-black mb-8 leading-tight text-center max-w-4xl font-display">
      {{ \App\get_hero_title() }}
    </h1>
    
    <!-- Hero Image -->
    <div class="hero-image mt-8 max-w-full animate-fade-in-up">
      <img src="{{ \App\get_hero_image_url() }}" alt="Technology Solutions" class="max-w-full h-auto rounded-lg" />
    </div>
  </div>
  
  <!-- Mouse Interaction Layer (invisible) -->
  <div id="mouse-interaction-layer" class="absolute inset-0 z-30"></div>
</section>

<style>
/* Hero Section with Particle Effects */
.hero-section {
  position: relative;
  overflow: hidden;
  contain: layout style paint;
  isolation: isolate;
}

/* Animated gradient background */
.hero-gradient {
  background: linear-gradient(135deg,
    oklch(30% .146 265.522) 0%,
    oklch(35% .146 265.522) 25%,
    oklch(37.9% .146 265.522) 50%,
    oklch(35% .146 265.522) 75%,
    oklch(30% .146 265.522) 100%
  );
  background-size: 400% 400%;
  animation: gradientShift 20s ease infinite;
}

@keyframes gradientShift {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

/* Secondary gradient overlay for depth */
.hero-gradient::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(
    circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
    rgba(254, 76, 28, 0.1) 0%,
    transparent 50%
  );
  pointer-events: none;
  transition: opacity 0.3s ease;
}

/* Canvas particle styles */
#particle-canvas {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 10;
  mix-blend-mode: screen;
  opacity: 0.8;
  transform: translateZ(0);
  will-change: transform, opacity;
  backface-visibility: hidden;
  perspective: 1000px;
}

/* Hero content positioning */
.hero-content {
  position: relative;
  z-index: 20;
  pointer-events: auto;
  will-change: transform;
  transform: translateZ(0);
}

/* Mouse interaction layer */
#mouse-interaction-layer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 30;
}

/* Company name styling for particle background */
.company-name {
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.company-name .dot {
  background: rgba(255, 255, 255, 0.8);
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* Main heading styling for particle background */
.main-heading {
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
  animation: breathe 4s ease-in-out infinite;
}

@keyframes breathe {
  0%, 100% {
    opacity: 0.9;
  }
  50% {
    opacity: 1;
  }
}

/* Hero image enhancements */
.hero-image img {
  transition: transform 0.3s ease;
}

.hero-image img:hover {
  transform: scale(1.02);
}

/* Responsive adjustments */
@media (max-width: 767px) {
  .hero-gradient {
    animation-duration: 15s;
  }
  
  .main-heading {
    font-size: 2.5rem;
  }
  
  .hero-content {
    padding: 0 1rem;
  }
}

/* Performance optimizations */
@media (prefers-reduced-motion: reduce) {
  .hero-gradient {
    animation: none;
  }
  
  .main-heading {
    animation: none;
  }
}

/* High DPI displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  #particle-canvas {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
  }
}
</style>

<script>
// Particle System for Hero Section
class Particle {
  constructor(canvas, type = 'circle') {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');
    this.type = type; // 'circle' or 'triangle'
    this.reset();
  }
  
  reset() {
    // Position
    this.x = Math.random() * this.canvas.width;
    this.y = Math.random() * this.canvas.height;
    
    // Size based on type
    const sizeRange = this.type === 'circle' ?
      [2, 4, 6, 8, 10, 12] : [3, 5, 7, 9, 11];
    this.size = sizeRange[Math.floor(Math.random() * sizeRange.length)];
    this.baseSize = this.size;
    
    // Movement
    this.vx = (Math.random() - 0.5) * 2;
    this.vy = (Math.random() - 0.5) * 2;
    this.angle = Math.random() * Math.PI * 2;
    this.rotationSpeed = (Math.random() - 0.5) * 0.02;
    
    // Appearance
    const colors = ['#810e13', '#570202', '#fe4c1c'];
    this.color = colors[Math.floor(Math.random() * colors.length)];
    this.opacity = 0.1 + Math.random() * 0.5;
    this.baseOpacity = this.opacity;
    
    // Interaction
    this.scale = 1;
    this.targetScale = 1;
  }
  
  update(mouse, config) {
    // Base movement
    this.x += this.vx;
    this.y += this.vy;
    this.angle += this.rotationSpeed;
    
    // Add floating effect
    this.vx += Math.sin(this.angle) * 0.01;
    this.vy += Math.cos(this.angle) * 0.01;
    
    // Apply friction
    this.vx *= 0.99;
    this.vy *= 0.99;
    
    // Mouse interaction
    if (mouse.isActive) {
      this.applyMouseForce(mouse, config);
    }
    
    // Smooth scale transition
    this.scale += (this.targetScale - this.scale) * 0.1;
    
    // Boundary wrapping
    if (this.x < 0) this.x = this.canvas.width;
    if (this.x > this.canvas.width) this.x = 0;
    if (this.y < 0) this.y = this.canvas.height;
    if (this.y > this.canvas.height) this.y = 0;
  }
  
  applyMouseForce(mouse, config) {
    const dx = mouse.x - this.x;
    const dy = mouse.y - this.y;
    const distance = Math.sqrt(dx * dx + dy * dy);
    
    // Hover effect
    if (distance < config.interactionRadius) {
      const influence = 1 - (distance / config.interactionRadius);
      this.targetScale = 1 + (influence * 0.5);
      this.opacity = this.baseOpacity + (influence * 0.3);
    } else {
      this.targetScale = 1;
      this.opacity = this.baseOpacity;
    }
    
    // Attraction force
    if (distance < config.interactionRadius * 2 && distance > 0) {
      const force = (1 - distance / (config.interactionRadius * 2)) * config.mouseForce;
      this.vx += (dx / distance) * force;
      this.vy += (dy / distance) * force;
    }
  }
  
  draw() {
    this.ctx.save();
    this.ctx.globalAlpha = this.opacity;
    this.ctx.fillStyle = this.color;
    this.ctx.strokeStyle = this.color;
    
    this.ctx.translate(this.x, this.y);
    this.ctx.rotate(this.angle);
    this.ctx.scale(this.scale, this.scale);
    
    if (this.type === 'circle') {
      this.drawCircle();
    } else {
      this.drawTriangle();
    }
    
    this.ctx.restore();
  }
  
  drawCircle() {
    this.ctx.beginPath();
    this.ctx.arc(0, 0, this.size, 0, Math.PI * 2);
    this.ctx.fill();
    
    // Add glow effect
    this.ctx.shadowBlur = 10;
    this.ctx.shadowColor = this.color;
    this.ctx.fill();
    this.ctx.shadowBlur = 0;
  }
  
  drawTriangle() {
    this.ctx.beginPath();
    this.ctx.moveTo(0, -this.size);
    this.ctx.lineTo(-this.size, this.size);
    this.ctx.lineTo(this.size, this.size);
    this.ctx.closePath();
    this.ctx.fill();
  }
}

class ParticleSystem {
  constructor(canvasId) {
    this.canvas = document.getElementById(canvasId);
    this.ctx = this.canvas.getContext('2d');
    this.particles = [];
    this.mouse = { x: 0, y: 0, isActive: false };
    this.config = this.getConfig();
    this.animationId = null;
    this.isPaused = false;
    
    this.init();
  }
  
  init() {
    this.setupCanvas();
    this.createParticles();
    this.setupEventListeners();
    this.setupVisibilityHandling();
    this.animate();
  }
  
  setupCanvas() {
    this.resizeCanvas();
    window.addEventListener('resize', () => {
      clearTimeout(this.resizeTimeout);
      this.resizeTimeout = setTimeout(() => this.resizeCanvas(), 250);
    });
  }
  
  resizeCanvas() {
    const rect = this.canvas.getBoundingClientRect();
    const dpr = window.devicePixelRatio || 1;
    
    this.canvas.width = rect.width * dpr;
    this.canvas.height = rect.height * dpr;
    this.ctx.scale(dpr, dpr);
    
    // Update config on resize
    const newConfig = this.getConfig();
    if (newConfig.particleCount !== this.config.particleCount) {
      this.adjustParticleCount(newConfig.particleCount);
    }
    this.config = newConfig;
  }
  
  getConfig() {
    const width = window.innerWidth;
    
    if (width >= 1024) {
      return {
        particleCount: 45,
        maxParticleSize: 14,
        interactionRadius: 100,
        mouseForce: 0.05,
        performanceMode: 'high'
      };
    } else if (width >= 768) {
      return {
        particleCount: 30,
        maxParticleSize: 12,
        interactionRadius: 80,
        mouseForce: 0.04,
        performanceMode: 'medium'
      };
    } else {
      return {
        particleCount: 18,
        maxParticleSize: 10,
        interactionRadius: 60,
        mouseForce: 0.03,
        performanceMode: 'low'
      };
    }
  }
  
  createParticles() {
    this.particles = [];
    const circleCount = Math.floor(this.config.particleCount * 0.6);
    const triangleCount = this.config.particleCount - circleCount;
    
    for (let i = 0; i < circleCount; i++) {
      this.particles.push(new Particle(this.canvas, 'circle'));
    }
    
    for (let i = 0; i < triangleCount; i++) {
      this.particles.push(new Particle(this.canvas, 'triangle'));
    }
  }
  
  adjustParticleCount(newCount) {
    if (newCount > this.particles.length) {
      const toAdd = newCount - this.particles.length;
      for (let i = 0; i < toAdd; i++) {
        const type = Math.random() > 0.4 ? 'circle' : 'triangle';
        this.particles.push(new Particle(this.canvas, type));
      }
    } else {
      this.particles = this.particles.slice(0, newCount);
    }
  }
  
  setupEventListeners() {
    // Mouse tracking
    document.addEventListener('mousemove', (e) => {
      this.mouse.x = e.clientX;
      this.mouse.y = e.clientY;
      this.mouse.isActive = true;
      
      // Update CSS custom properties for gradient
      document.documentElement.style.setProperty('--mouse-x', `${e.clientX}px`);
      document.documentElement.style.setProperty('--mouse-y', `${e.clientY}px`);
    });
    
    document.addEventListener('mouseleave', () => {
      this.mouse.isActive = false;
    });
    
    document.addEventListener('mouseenter', () => {
      this.mouse.isActive = true;
    });
    
    // Click interaction
    this.canvas.addEventListener('click', (e) => {
      this.createExplosion(e.clientX, e.clientY);
    });
    
    // Touch support
    this.canvas.addEventListener('touchmove', (e) => {
      if (e.touches.length > 0) {
        this.mouse.x = e.touches[0].clientX;
        this.mouse.y = e.touches[0].clientY;
        this.mouse.isActive = true;
        
        document.documentElement.style.setProperty('--mouse-x', `${e.touches[0].clientX}px`);
        document.documentElement.style.setProperty('--mouse-y', `${e.touches[0].clientY}px`);
      }
    });
  }
  
  createExplosion(x, y) {
    this.particles.forEach(particle => {
      const dx = particle.x - x;
      const dy = particle.y - y;
      const distance = Math.sqrt(dx * dx + dy * dy);
      
      if (distance < 200 && distance > 0) {
        const force = (1 - distance / 200) * 10;
        particle.vx += (dx / distance) * force;
        particle.vy += (dy / distance) * force;
      }
    });
  }
  
  setupVisibilityHandling() {
    // Pause animation when tab is not visible
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        this.pause();
      } else {
        this.resume();
      }
    });
  }
  
  pause() {
    if (this.animationId) {
      cancelAnimationFrame(this.animationId);
      this.animationId = null;
      this.isPaused = true;
    }
  }
  
  resume() {
    if (!this.animationId && !this.isPaused) {
      this.animate();
      this.isPaused = false;
    }
  }
  
  animate() {
    if (this.isPaused) return;
    
    // Clear canvas
    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    
    // Update and draw particles
    this.particles.forEach(particle => {
      particle.update(this.mouse, this.config);
      particle.draw();
    });
    
    // Continue animation
    this.animationId = requestAnimationFrame(() => this.animate());
  }
  
  destroy() {
    if (this.animationId) {
      cancelAnimationFrame(this.animationId);
    }
  }
}

// Initialize particle system when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  const canvas = document.getElementById('particle-canvas');
  if (canvas) {
    const particleSystem = new ParticleSystem('particle-canvas');
  }
});
</script>
