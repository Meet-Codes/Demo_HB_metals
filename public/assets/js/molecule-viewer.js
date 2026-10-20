/**
 * HB Metals India - Interactive 3D Molecular Chemistry Viewer
 * Renders interactive 3D ball-and-stick atomic lattices for Magnesium and Tungsten compounds.
 */
function initMoleculeViewer() {
    if (typeof THREE === 'undefined') {
        // Retry shortly if Three.js script is still deferred
        setTimeout(initMoleculeViewer, 100);
        return;
    }

    const moleculeContainers = document.querySelectorAll('[data-3d-molecule]');
    if (moleculeContainers.length === 0) return;

    moleculeContainers.forEach((container) => {
        // Prevent duplicate initializations
        if (container.dataset.moleculeInitialized === 'true') return;
        container.dataset.moleculeInitialized = 'true';

        const formulaType = container.getAttribute('data-3d-molecule') || 'tungsten-oxide';
        let width = container.clientWidth || 320;
        let height = container.clientHeight || 280;

        container.style.touchAction = 'none';

        // Scene, Camera, Renderer for this specific container
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 100);
        camera.position.set(0, 0, 16);

        const renderer = new THREE.WebGLRenderer({
            alpha: true,
            antialias: true
        });
        renderer.setSize(width, height);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
        container.appendChild(renderer.domElement);

        function handleResize() {
            const newW = container.clientWidth || 320;
            const newH = container.clientHeight || 280;
            if (newW > 0 && newH > 0) {
                camera.aspect = newW / newH;
                camera.updateProjectionMatrix();
                renderer.setSize(newW, newH);
            }
        }
        window.addEventListener('resize', handleResize, { passive: true });
        window.addEventListener('orientationchange', () => setTimeout(handleResize, 150), { passive: true });

        // Lighting
        const amb = new THREE.AmbientLight(0xffffff, 1.2);
        scene.add(amb);

        const spot1 = new THREE.PointLight(0xb86d3c, 2.5, 40);
        spot1.position.set(10, 15, 15);
        scene.add(spot1);

        const spot2 = new THREE.PointLight(0x0284c7, 2, 40);
        spot2.position.set(-10, -10, 10);
        scene.add(spot2);

        // Group holding atoms and bonds
        const moleculeGroup = new THREE.Group();
        scene.add(moleculeGroup);

        // Standard materials for elements
        const matTungsten = new THREE.MeshStandardMaterial({
            color: 0x334155,
            metalness: 0.9,
            roughness: 0.1,
            emissive: 0x0f172a,
        });

        const matOxygen = new THREE.MeshStandardMaterial({
            color: 0xef4444,
            metalness: 0.4,
            roughness: 0.3,
        });

        const matMagnesium = new THREE.MeshStandardMaterial({
            color: 0xd97706,
            metalness: 0.85,
            roughness: 0.15,
        });

        const matSodium = new THREE.MeshStandardMaterial({
            color: 0x8b5cf6,
            metalness: 0.6,
            roughness: 0.25,
        });

        const matBond = new THREE.MeshStandardMaterial({
            color: 0x94a3b8,
            metalness: 0.5,
            roughness: 0.4,
        });

        function addAtom(x, y, z, radius, material) {
            const geo = new THREE.SphereGeometry(radius, 24, 24);
            const mesh = new THREE.Mesh(geo, material);
            mesh.position.set(x, y, z);
            moleculeGroup.add(mesh);
            return mesh;
        }

        function addBond(v1, v2, radius = 0.22) {
            const distance = v1.distanceTo(v2);
            const mid = v1.clone().add(v2).multiplyScalar(0.5);

            const cylinder = new THREE.CylinderGeometry(radius, radius, distance, 12);
            const mesh = new THREE.Mesh(cylinder, matBond);

            mesh.position.copy(mid);
            mesh.quaternion.setFromUnitVectors(new THREE.Vector3(0, 1, 0), v2.clone().sub(v1).normalize());
            moleculeGroup.add(mesh);
        }

        // Build specific molecular geometry based on compound
        if (formulaType.includes('magnesium')) {
            // Hexagonal Close-Packed (HCP) Unit Cell Model
            const topAtoms = [];
            const botAtoms = [];
            for (let i = 0; i < 6; i++) {
                const angle = (i * Math.PI) / 3;
                const tx = Math.cos(angle) * 3.8;
                const tz = Math.sin(angle) * 3.8;
                topAtoms.push(addAtom(tx, 3.2, tz, 1.1, matMagnesium));
                botAtoms.push(addAtom(tx, -3.2, tz, 1.1, matMagnesium));
            }
            // Center atoms
            const topCenter = addAtom(0, 3.2, 0, 1.25, matMagnesium);
            const botCenter = addAtom(0, -3.2, 0, 1.25, matMagnesium);
            // Mid plane 3 atoms
            const mid1 = addAtom(1.8, 0, 0, 1.15, matMagnesium);
            const mid2 = addAtom(-1.8, 0, 1.6, 1.15, matMagnesium);
            const mid3 = addAtom(-1.8, 0, -1.6, 1.15, matMagnesium);

            // Connect perimeter rings
            for (let i = 0; i < 6; i++) {
                addBond(topAtoms[i].position, topAtoms[(i + 1) % 6].position);
                addBond(topAtoms[i].position, topCenter.position);
                addBond(botAtoms[i].position, botAtoms[(i + 1) % 6].position);
                addBond(botAtoms[i].position, botCenter.position);
                addBond(topAtoms[i].position, botAtoms[i].position);
            }
        } else if (formulaType.includes('sodium-tungstate')) {
            // Tetrahedral Tungstate [WO4]2- with Na+ ions
            const wCenter = addAtom(0, 0, 0, 1.8, matTungsten);
            const o1 = addAtom(2.5, 2.5, 2.5, 1.05, matOxygen);
            const o2 = addAtom(-2.5, -2.5, 2.5, 1.05, matOxygen);
            const o3 = addAtom(-2.5, 2.5, -2.5, 1.05, matOxygen);
            const o4 = addAtom(2.5, -2.5, -2.5, 1.05, matOxygen);

            addBond(wCenter.position, o1.position, 0.3);
            addBond(wCenter.position, o2.position, 0.3);
            addBond(wCenter.position, o3.position, 0.3);
            addBond(wCenter.position, o4.position, 0.3);

            // Na+ counter ions
            addAtom(5.2, 0, 0, 1.0, matSodium);
            addAtom(-5.2, 0, 0, 1.0, matSodium);
        } else {
            // Tungsten Trioxide (WO3) Octahedral Unit Matrix
            const wCenter = addAtom(0, 0, 0, 1.9, matTungsten);
            const oxPos = [
                new THREE.Vector3(3.8, 0, 0),
                new THREE.Vector3(-3.8, 0, 0),
                new THREE.Vector3(0, 3.8, 0),
                new THREE.Vector3(0, -3.8, 0),
                new THREE.Vector3(0, 0, 3.8),
                new THREE.Vector3(0, 0, -3.8),
            ];

            oxPos.forEach((pos) => {
                const ox = addAtom(pos.x, pos.y, pos.z, 1.05, matOxygen);
                addBond(wCenter.position, ox.position, 0.28);
            });
        }

        // Interactive Click & Drag Orbit Rotation
        let isDragging = false;
        let previousMousePosition = { x: 0, y: 0 };

        container.style.cursor = 'grab';

        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            container.style.cursor = 'grabbing';
            previousMousePosition = { x: e.clientX, y: e.clientY };
        });

        window.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                container.style.cursor = 'grab';
            }
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            const deltaX = e.clientX - previousMousePosition.x;
            const deltaY = e.clientY - previousMousePosition.y;

            moleculeGroup.rotation.y += deltaX * 0.015;
            moleculeGroup.rotation.x += deltaY * 0.015;

            previousMousePosition = { x: e.clientX, y: e.clientY };
        });

        // Touch drag support
        container.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1) {
                isDragging = true;
                previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
            }
        });

        window.addEventListener('touchmove', (e) => {
            if (!isDragging || e.touches.length !== 1) return;
            const deltaX = e.touches[0].clientX - previousMousePosition.x;
            const deltaY = e.touches[0].clientY - previousMousePosition.y;

            moleculeGroup.rotation.y += deltaX * 0.015;
            moleculeGroup.rotation.x += deltaY * 0.015;

            previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
        });

        window.addEventListener('touchend', () => { isDragging = false; });

        // Animation Loop
        function animate() {
            if (!isDragging) {
                moleculeGroup.rotation.y += 0.008;
                moleculeGroup.rotation.x += 0.004;
            }

            renderer.render(scene, camera);
            requestAnimationFrame(animate);
        }

        animate();
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMoleculeViewer);
} else {
    initMoleculeViewer();
}
