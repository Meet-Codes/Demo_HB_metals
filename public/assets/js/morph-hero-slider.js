/**
 * HB Metals India - WebGL Noise-Morph Hero Gallery Slider
 * Port of MorphGallery shader pass:
 * - Full-screen WebGL pass over two textures
 * - 5-octave fbm noise field threshold sweep
 * - Incoming frame luminance bias
 * - Parallax drift
 * - Quintic in-out easing
 * - Automatic canvas resizing
 * - Automatic timer with pause on hover/tab blur
 * - Synchronization with right-hand facility cards
 */

(function () {
    'use strict';

    const VERT_SRC = `
attribute vec2 a_position;
varying vec2 v_uv;
void main() {
    v_uv = a_position * 0.5 + 0.5;
    gl_Position = vec4(a_position, 0.0, 1.0);
}
`;

    const FRAG_SRC = `
precision highp float;

uniform sampler2D u_from;
uniform sampler2D u_to;
uniform float u_progress;
uniform vec2 u_resolution;
uniform float u_fromAspect;
uniform float u_toAspect;
uniform float u_scale;
uniform float u_direction;
uniform float u_edge;
uniform float u_drift;

varying vec2 v_uv;

vec3 permute(vec3 x) {
    return mod(((x * 34.0) + 1.0) * x, 289.0);
}

float snoise(vec2 v) {
    const vec4 C = vec4(
        0.211324865405187,
        0.366025403784439,
       -0.577350269189626,
        0.024390243902439
    );
    vec2 i  = floor(v + dot(v, C.yy));
    vec2 x0 = v - i + dot(i, C.xx);
    vec2 i1 = (x0.x > x0.y) ? vec2(1.0, 0.0) : vec2(0.0, 1.0);
    vec4 x12 = x0.xyxy + C.xxzz;
    x12.xy -= i1;
    i = mod(i, 289.0);
    vec3 p = permute(
        permute(i.y + vec3(0.0, i1.y, 1.0)) + i.x + vec3(0.0, i1.x, 1.0)
    );
    vec3 m = max(0.5 - vec3(dot(x0, x0), dot(x12.xy, x12.xy), dot(x12.zw, x12.zw)), 0.0);
    m = m * m;
    m = m * m;
    vec3 x  = 2.0 * fract(p * C.www) - 1.0;
    vec3 h  = abs(x) - 0.5;
    vec3 ox = floor(x + 0.5);
    vec3 a0 = x - ox;
    m *= 1.79284291400159 - 0.85373472095314 * (a0 * a0 + h * h);
    vec3 g;
    g.x  = a0.x  * x0.x  + h.x  * x0.y;
    g.yz = a0.yz * x12.xz + h.yz * x12.yw;
    return 130.0 * dot(m, g);
}

float fbm(vec2 v) {
    float value = 0.0;
    float amplitude = 0.5;
    for (int i = 0; i < 5; i++) {
        value += amplitude * snoise(v);
        v *= 2.0;
        amplitude *= 0.5;
    }
    return value;
}

vec2 mirror(vec2 uv) {
    return 1.0 - abs(1.0 - mod(uv, 2.0));
}

vec2 coverUV(vec2 uv, float imgAspect) {
    float canvasAspect = u_resolution.x / u_resolution.y;
    vec2 scale = (canvasAspect > imgAspect)
        ? vec2(1.0, imgAspect / canvasAspect)
        : vec2(canvasAspect / imgAspect, 1.0);
    return mirror((uv - 0.5) * scale + 0.5);
}

void main() {
    float adjusted = u_progress * (1.0 + 2.0 * u_edge) - u_edge;
    float noise = fbm(v_uv * u_scale + vec2(0.0, u_progress * u_direction)) * 0.5 + 0.5;
    noise = smoothstep(
        0.0,
        2.0,
        length(texture2D(u_to, coverUV(v_uv, u_toAspect)).rgb) + noise
    );

    float mixFactor = 1.0 - smoothstep(adjusted - u_edge, adjusted + u_edge, noise);

    vec2 fromUV = coverUV(
        v_uv + vec2(0.0, noise * u_progress * u_drift * u_direction),
        u_fromAspect
    );
    vec2 toUV = coverUV(
        v_uv + vec2(0.0, noise * (1.0 - u_progress) * -0.5 * u_drift * u_direction),
        u_toAspect
    );

    gl_FragColor = mix(texture2D(u_from, fromUV), texture2D(u_to, toUV), mixFactor);
}
`;

    function easeInOutQuint(t) {
        const x = Math.min(Math.max(t, 0), 1);
        return x < 0.5 ? 16 * x ** 5 : 1 - (-2 * x + 2) ** 5 / 2;
    }

    function compileShader(gl, type, src) {
        const shader = gl.createShader(type);
        if (!shader) throw new Error("Could not create shader");
        gl.shaderSource(shader, src);
        gl.compileShader(shader);
        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            const err = gl.getShaderInfoLog(shader);
            gl.deleteShader(shader);
            throw new Error("Shader compile failed: " + err);
        }
        return shader;
    }

    function createProgram(gl, vertSrc, fragSrc) {
        const vert = compileShader(gl, gl.VERTEX_SHADER, vertSrc);
        const frag = compileShader(gl, gl.FRAGMENT_SHADER, fragSrc);
        const program = gl.createProgram();
        gl.attachShader(program, vert);
        gl.attachShader(program, frag);
        gl.linkProgram(program);
        gl.deleteShader(vert);
        gl.deleteShader(frag);
        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
            const err = gl.getProgramInfoLog(program);
            gl.deleteProgram(program);
            throw new Error("Program link failed: " + err);
        }
        return program;
    }

    function loadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.decoding = 'async';
            img.onload = () => resolve(img);
            img.onerror = () => reject(new Error('Failed to load image: ' + src));
            img.src = src;
        });
    }

    function initHeroSlider() {
        const container = document.getElementById('hero-morph-gallery');
        if (!container) return;

        const slidesDataEl = container.querySelector('[data-slides-json]');
        let items = [];
        if (slidesDataEl) {
            try {
                items = JSON.parse(slidesDataEl.textContent || '[]');
            } catch (e) {
                console.error("Invalid slides json", e);
            }
        }

        if (!items || items.length < 2) return;

        const canvas = container.querySelector('canvas');
        if (!canvas) return;

        const cardItems = document.querySelectorAll('.hero-feature-item');
        const dots = container.querySelectorAll('.hero-morph-dot');
        const prevBtn = container.querySelector('.hero-morph-arrow.is-prev');
        const nextBtn = container.querySelector('.hero-morph-arrow.is-next');

        let gl = canvas.getContext('webgl', { alpha: false, antialias: false }) ||
                 canvas.getContext('experimental-webgl');

        let active = 0;
        let from = 0;
        let to = 0;
        let progress = 1;
        let startedAt = 0;
        let direction = 1;
        const duration = 1400;
        const noiseScale = 3.5;
        const edge = 0.15;
        const drift = 0.5;
        const autoplayDelay = 5000;
        let isPaused = false;
        let textures = items.map(() => null);
        let aspects = items.map(() => 1);
        let program = null;
        let uniforms = {};
        let rafId = null;
        let autoplayTimer = null;

        function updateCardIndicators(index) {
            cardItems.forEach((card, idx) => {
                if (idx === index) {
                    card.classList.add('is-active');
                    card.setAttribute('aria-selected', 'true');
                } else {
                    card.classList.remove('is-active');
                    card.setAttribute('aria-selected', 'false');
                }
            });

            dots.forEach((dot, idx) => {
                if (idx === index) {
                    dot.classList.add('is-active');
                    dot.setAttribute('aria-current', 'true');
                } else {
                    dot.classList.remove('is-active');
                    dot.removeAttribute('aria-current');
                }
            });
        }

        function resize() {
            if (!canvas) return;
            const dpr = Math.min(window.devicePixelRatio || 1, 2);
            const w = Math.round(canvas.clientWidth * dpr);
            const h = Math.round(canvas.clientHeight * dpr);
            if (w === 0 || h === 0 || (canvas.width === w && canvas.height === h)) return;
            canvas.width = w;
            canvas.height = h;
            if (gl) gl.viewport(0, 0, w, h);
        }

        function goTo(nextIndex, explicitDir) {
            const count = items.length;
            nextIndex = ((nextIndex % count) + count) % count;
            if (nextIndex === active && progress >= 1) return;

            from = active;
            to = nextIndex;
            active = nextIndex;
            progress = 0;
            startedAt = performance.now();

            if (explicitDir !== undefined) {
                direction = explicitDir;
            } else {
                direction = ((to - from + count) % count) * 2 <= count ? 1 : -1;
            }

            updateCardIndicators(active);
        }

        // Attach click listeners to cards
        cardItems.forEach((card) => {
            card.addEventListener('click', () => {
                const idx = parseInt(card.getAttribute('data-slide-index') || '0', 10);
                goTo(idx);
                resetAutoplay();
            });
        });

        // Attach click listeners to dots
        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const idx = parseInt(dot.getAttribute('data-index') || '0', 10);
                goTo(idx);
                resetAutoplay();
            });
        });

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                goTo(active - 1, -1);
                resetAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                goTo(active + 1, 1);
                resetAutoplay();
            });
        }

        function resetAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
            if (autoplayDelay > 0) {
                autoplayTimer = setInterval(() => {
                    if (!isPaused && !document.hidden) {
                        goTo(active + 1, 1);
                    }
                }, autoplayDelay);
            }
        }

        container.addEventListener('mouseenter', () => { isPaused = true; });
        container.addEventListener('mouseleave', () => { isPaused = false; });
        document.addEventListener('visibilitychange', () => { isPaused = document.hidden; });

        if (!gl) {
            // Fallback: CSS cross-fade for browsers without WebGL
            container.classList.add('is-fallback');
            resetAutoplay();
            return;
        }

        try {
            program = createProgram(gl, VERT_SRC, FRAG_SRC);
            gl.useProgram(program);

            const buffer = gl.createBuffer();
            gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
            gl.bufferData(
                gl.ARRAY_BUFFER,
                new Float32Array([-1, -1, 1, -1, -1, 1, 1, 1]),
                gl.STATIC_DRAW
            );
            const loc = gl.getAttribLocation(program, 'a_position');
            gl.enableVertexAttribArray(loc);
            gl.vertexAttribPointer(loc, 2, gl.FLOAT, false, 0, 0);

            const uniformNames = [
                'from', 'to', 'progress', 'resolution',
                'fromAspect', 'toAspect', 'scale', 'direction', 'edge', 'drift'
            ];
            uniformNames.forEach((name) => {
                uniforms[name] = gl.getUniformLocation(program, 'u_' + name);
            });

            gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, true);

            window.addEventListener('resize', resize);
            resize();

            function draw() {
                if (progress < 1) {
                    const elapsed = performance.now() - startedAt;
                    progress = easeInOutQuint(Math.min(elapsed / duration, 1));
                }

                const fromTex = textures[from] || textures[0];
                const toTex = textures[to] || textures[0];
                if (!fromTex || !toTex) return;

                gl.activeTexture(gl.TEXTURE0);
                gl.bindTexture(gl.TEXTURE_2D, fromTex);
                gl.uniform1i(uniforms.from, 0);

                gl.activeTexture(gl.TEXTURE1);
                gl.bindTexture(gl.TEXTURE_2D, toTex);
                gl.uniform1i(uniforms.to, 1);

                gl.uniform1f(uniforms.progress, progress);
                gl.uniform2f(uniforms.resolution, canvas.width, canvas.height);
                gl.uniform1f(uniforms.fromAspect, aspects[from] || 1.77);
                gl.uniform1f(uniforms.toAspect, aspects[to] || 1.77);
                gl.uniform1f(uniforms.scale, noiseScale);
                gl.uniform1f(uniforms.direction, direction);
                gl.uniform1f(uniforms.edge, Math.max(edge, 0.001));
                gl.uniform1f(uniforms.drift, drift);

                gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
            }

            function frame() {
                draw();
                rafId = requestAnimationFrame(frame);
            }

            let loadedCount = 0;
            items.forEach((item, index) => {
                loadImage(item.src).then((img) => {
                    const tex = gl.createTexture();
                    gl.bindTexture(gl.TEXTURE_2D, tex);
                    gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, img);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
                    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);

                    textures[index] = tex;
                    aspects[index] = img.naturalWidth / Math.max(img.naturalHeight, 1);

                    loadedCount++;
                    if (loadedCount === 1) {
                        resize();
                        canvas.style.opacity = '1';
                        rafId = requestAnimationFrame(frame);
                    }
                }).catch((err) => {
                    console.warn("Could not load slide texture:", err);
                });
            });

            resetAutoplay();
            updateCardIndicators(0);

        } catch (e) {
            console.warn("WebGL Shader setup fallback:", e);
            container.classList.add('is-fallback');
            resetAutoplay();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroSlider);
    } else {
        initHeroSlider();
    }
})();
