<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Welcome') | FitCommunity</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #0f172a;
                color: #f8fafc;
                margin: 0;
                overflow-x: hidden;
            }

            #auth-canvas {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                z-index: -1;
            }

            .glass-panel {
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            }

            .gradient-text {
                background: linear-gradient(135deg, #4CAF50, #2196F3);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
            }
        </style>
    </head>
    <body class="antialiased min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- 3D Background Canvas -->
        <canvas id="auth-canvas"></canvas>

        <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-8 glass-panel sm:rounded-2xl transition-all duration-500 hover:shadow-2xl hover:shadow-[#4CAF50]/20">
            <div class="flex justify-center mb-6">
                <a href="/" class="flex items-center gap-2 group">
                    <img src="{{ asset('logo.svg') }}" alt="FitCommunity Logo" class="w-14 h-14 shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <span class="text-3xl font-bold tracking-tight text-white group-hover:text-[#4CAF50] transition-colors">Fit<span class="text-[#4CAF50] group-hover:text-white transition-colors">Community</span></span>
                </a>
            </div>

            {!! $slot !!}
        </div>
        <!-- Global AI Chatbot Widget -->
        <x-chatbot />

        <!-- Three.js Script for 3D Background -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script>
            const canvas = document.getElementById('auth-canvas');
            const scene = new THREE.Scene();
            scene.fog = new THREE.FogExp2(0x0f172a, 0.002);

            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 20;

            const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(window.devicePixelRatio);

            // Create floating abstract geometric shapes
            const shapes = [];
            const geometries = [
                new THREE.IcosahedronGeometry(1.5, 0),
                new THREE.OctahedronGeometry(1.5, 0),
                new THREE.TetrahedronGeometry(1.5, 0),
                new THREE.TorusGeometry(1, 0.4, 16, 100)
            ];

            const colors = [0x4CAF50, 0x2196F3, 0x8BC34A, 0x03A9F4];

            for (let i = 0; i < 20; i++) {
                const geometry = geometries[Math.floor(Math.random() * geometries.length)];
                const material = new THREE.MeshBasicMaterial({
                    color: colors[Math.floor(Math.random() * colors.length)],
                    wireframe: true,
                    transparent: true,
                    opacity: 0.3
                });

                const mesh = new THREE.Mesh(geometry, material);
                
                mesh.position.x = (Math.random() - 0.5) * 40;
                mesh.position.y = (Math.random() - 0.5) * 40;
                mesh.position.z = (Math.random() - 0.5) * 20 - 10;
                
                mesh.rotation.x = Math.random() * Math.PI;
                mesh.rotation.y = Math.random() * Math.PI;

                mesh.userData = {
                    rx: (Math.random() - 0.5) * 0.02,
                    ry: (Math.random() - 0.5) * 0.02,
                    rz: (Math.random() - 0.5) * 0.02,
                    vy: (Math.random() - 0.5) * 0.05
                };

                scene.add(mesh);
                shapes.push(mesh);
            }

            // Particles
            const particlesGeometry = new THREE.BufferGeometry();
            const particlesCount = 500;
            const posArray = new Float32Array(particlesCount * 3);
            for(let i = 0; i < particlesCount * 3; i++) {
                posArray[i] = (Math.random() - 0.5) * 50;
            }
            particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
            const particlesMaterial = new THREE.PointsMaterial({
                size: 0.05,
                color: 0x4CAF50,
                transparent: true,
                opacity: 0.5,
                blending: THREE.AdditiveBlending
            });
            const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
            scene.add(particlesMesh);

            // Mouse Interaction
            let mouseX = 0;
            let mouseY = 0;
            let targetX = 0;
            let targetY = 0;
            const windowHalfX = window.innerWidth / 2;
            const windowHalfY = window.innerHeight / 2;

            document.addEventListener('mousemove', (event) => {
                mouseX = (event.clientX - windowHalfX);
                mouseY = (event.clientY - windowHalfY);
            });

            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });

            function animate() {
                requestAnimationFrame(animate);

                targetX = mouseX * 0.001;
                targetY = mouseY * 0.001;

                particlesMesh.rotation.y += 0.001;
                particlesMesh.rotation.x += 0.0005;

                shapes.forEach(shape => {
                    shape.rotation.x += shape.userData.rx;
                    shape.rotation.y += shape.userData.ry;
                    shape.rotation.z += shape.userData.rz;
                    
                    shape.position.y += shape.userData.vy;
                    if (shape.position.y > 20) shape.position.y = -20;
                    if (shape.position.y < -20) shape.position.y = 20;
                });

                camera.position.x += (mouseX * 0.01 - camera.position.x) * 0.05;
                camera.position.y += (-mouseY * 0.01 - camera.position.y) * 0.05;
                camera.lookAt(scene.position);

                renderer.render(scene, camera);
            }

            animate();
        </script>
    </body>
</html>
