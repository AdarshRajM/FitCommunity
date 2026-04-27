<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitCommunity | Elevate Your Health</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f172a; /* Dark background */
            color: #f8fafc;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        
        p, span, a, div {
            font-family: 'Inter', sans-serif;
        }

        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            pointer-events: auto;
        }

        .glass-panel {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #4CAF50, #2196F3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #2b9d50);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.6);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #4CAF50; }
    </style>
</head>
<body class="antialiased">

    <!-- 3D Background Canvas -->
    <canvas id="bg-canvas"></canvas>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-panel py-4 px-6 md:px-12 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2" data-aos="fade-right">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center font-bold text-xl">
                    F
                </div>
                <span class="text-2xl font-bold tracking-tight">Fit<span class="text-[#4CAF50]">Community</span></span>
            </div>
            
            <div class="hidden md:flex gap-8 items-center font-medium text-sm text-slate-300" data-aos="fade-down" data-aos-delay="100">
                <a href="#features" class="hover:text-white transition-colors">Features</a>
                <a href="#community" class="hover:text-white transition-colors">Community</a>
                <a href="#testimonials" class="hover:text-white transition-colors">Testimonials</a>
            </div>

            <div class="flex gap-4 items-center" data-aos="fade-left">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary px-6 py-2 rounded-full font-medium text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-300 hover:text-white font-medium text-sm transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary px-6 py-2 rounded-full font-medium text-sm hidden md:inline-block">Join Now</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pt-20 px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center z-10">
            <div class="text-left" data-aos="fade-up" data-aos-duration="1000">
                <div class="inline-block px-4 py-1 rounded-full glass-panel text-sm font-medium text-[#4CAF50] mb-6 border border-[#4CAF50]/30">
                    🚀 The Next-Gen Health Platform
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6">
                    Redefine Your <br/>
                    <span class="gradient-text">Fitness Journey</span>
                </h1>
                <p class="text-slate-400 text-lg md:text-xl mb-8 max-w-lg font-light leading-relaxed">
                    Join the ultimate community-driven health ecosystem. Track daily metrics, consult top doctors, and achieve goals together.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-full font-semibold text-lg flex items-center gap-2">
                        Get Started Free
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="#features" class="btn-secondary px-8 py-3 rounded-full font-semibold text-lg">
                        Explore Features
                    </a>
                </div>
                
                <div class="mt-12 flex items-center gap-6 text-slate-400 text-sm">
                    <div class="flex -space-x-4">
                        <img class="w-10 h-10 rounded-full border-2 border-[#0f172a]" src="https://i.pravatar.cc/100?img=1" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-[#0f172a]" src="https://i.pravatar.cc/100?img=2" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-[#0f172a]" src="https://i.pravatar.cc/100?img=3" alt="User">
                        <div class="w-10 h-10 rounded-full border-2 border-[#0f172a] bg-slate-800 flex items-center justify-center text-xs font-bold text-white">+2k</div>
                    </div>
                    <p>Active members joined <br/> this week.</p>
                </div>
            </div>
            
            <!-- Spacer for 3D element focus on desktop -->
            <div class="hidden md:block h-full"></div>
        </div>
        
        <!-- Gradient Overlay for bottom blending -->
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-[#0f172a] to-transparent pointer-events-none"></div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative z-10 bg-[#0f172a]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Powerful <span class="gradient-text">Ecosystem</span></h2>
                <p class="text-slate-400 max-w-2xl mx-auto text-lg">Everything you need to manage your health, fitness, and lifestyle in one advanced platform.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="glass-panel p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 rounded-2xl bg-[#4CAF50]/20 flex items-center justify-center mb-6 text-[#4CAF50]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Advanced Tracking</h3>
                    <p class="text-slate-400 leading-relaxed">Log daily metrics like weight, steps, calories, sleep, and mood. Visualize progress with beautiful interactive charts.</p>
                </div>

                <!-- Card 2 -->
                <div class="glass-panel p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-[#2196F3]/20 rounded-full blur-2xl"></div>
                    <div class="w-14 h-14 rounded-2xl bg-[#2196F3]/20 flex items-center justify-center mb-6 text-[#2196F3] relative z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3 relative z-10">Real-Time Community</h3>
                    <p class="text-slate-400 leading-relaxed relative z-10">Connect via forums, real-time chat, share media, and participate in challenges to stay motivated.</p>
                </div>

                <!-- Card 3 -->
                <div class="glass-panel p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 rounded-2xl bg-[#ff9800]/20 flex items-center justify-center mb-6 text-[#ff9800]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-3">Smart Booking</h3>
                    <p class="text-slate-400 leading-relaxed">Book appointments with certified trainers and doctors. Manage your schedule seamlessly from your dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0b1121] py-12 relative z-10 border-t border-slate-800/50">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center font-bold text-white text-sm">F</div>
                    <span class="text-xl font-bold">FitCommunity</span>
                </div>
                <p class="text-slate-400 text-sm max-w-sm">Empowering millions to lead healthier, happier lives through technology and community support.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Platform</h4>
                <ul class="space-y-2 text-slate-400 text-sm">
                    <li><a href="#" class="hover:text-[#4CAF50] transition-colors">Features</a></li>
                    <li><a href="#" class="hover:text-[#4CAF50] transition-colors">Pricing</a></li>
                    <li><a href="#" class="hover:text-[#4CAF50] transition-colors">Doctors</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-slate-400 text-sm">
                    <li><a href="#" class="hover:text-[#4CAF50] transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-[#4CAF50] transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-[#4CAF50] transition-colors">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-slate-800 text-center text-slate-500 text-sm">
            &copy; {{ date('Y') }} FitCommunity. Developed with Laravel & Three.js.
        </div>
    </footer>

    <!-- Three.js & Animation Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 50,
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg', 'bg-[#0f172a]/80');
            } else {
                nav.classList.remove('shadow-lg', 'bg-[#0f172a]/80');
            }
        });

        // ==========================================
        // Advanced Three.js 3D Background Animation
        // ==========================================
        const canvas = document.getElementById('bg-canvas');
        const scene = new THREE.Scene();
        
        // Add a subtle fog to blend particles into the background
        scene.fog = new THREE.FogExp2(0x0f172a, 0.001);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 30;

        const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);

        // Particle System representing "Connections" and "Health Data"
        const particleCount = 1500;
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const colors = new Float32Array(particleCount * 3);

        const color1 = new THREE.Color(0x4CAF50); // Green
        const color2 = new THREE.Color(0x2196F3); // Blue

        for (let i = 0; i < particleCount * 3; i += 3) {
            // Distribute particles in a large sphere
            const r = 50 * Math.cbrt(Math.random());
            const theta = Math.random() * 2 * Math.PI;
            const phi = Math.acos(2 * Math.random() - 1);
            
            const x = r * Math.sin(phi) * Math.cos(theta);
            const y = r * Math.sin(phi) * Math.sin(theta);
            const z = r * Math.cos(phi);

            positions[i] = x;
            positions[i + 1] = y;
            positions[i + 2] = z;

            // Mix colors
            const mixRatio = Math.random();
            const mixedColor = color1.clone().lerp(color2, mixRatio);
            colors[i] = mixedColor.r;
            colors[i + 1] = mixedColor.g;
            colors[i + 2] = mixedColor.b;
        }

        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        // Create a custom material that creates glowing dots
        const material = new THREE.PointsMaterial({
            size: 0.4,
            vertexColors: true,
            transparent: true,
            opacity: 0.8,
            blending: THREE.AdditiveBlending
        });

        const particles = new THREE.Points(geometry, material);
        
        // Position particles to the right for desktop, center for mobile
        if(window.innerWidth > 768) {
            particles.position.x = 20;
            particles.position.y = 5;
        }

        scene.add(particles);

        // Core central abstract shape (Representing Core/Fitness)
        const icosahedronGeometry = new THREE.IcosahedronGeometry(8, 1);
        const icosahedronMaterial = new THREE.MeshBasicMaterial({
            color: 0x2196F3,
            wireframe: true,
            transparent: true,
            opacity: 0.15
        });
        const coreShape = new THREE.Mesh(icosahedronGeometry, icosahedronMaterial);
        
        if(window.innerWidth > 768) {
            coreShape.position.x = 20;
            coreShape.position.y = 5;
        }
        scene.add(coreShape);

        // Mouse Interactivity
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;
        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX - windowHalfX) * 0.001;
            mouseY = (event.clientY - windowHalfY) * 0.001;
        });

        // Resize handler
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
            
            if(window.innerWidth > 768) {
                particles.position.x = 20;
                coreShape.position.x = 20;
            } else {
                particles.position.x = 0;
                coreShape.position.x = 0;
            }
        });

        // Animation Loop
        const clock = new THREE.Clock();

        function animate() {
            requestAnimationFrame(animate);
            const elapsedTime = clock.getElapsedTime();

            // Smooth mouse follow
            targetX = mouseX * 0.5;
            targetY = mouseY * 0.5;
            
            particles.rotation.y += 0.002;
            particles.rotation.x += 0.001;
            
            coreShape.rotation.y -= 0.005;
            coreShape.rotation.x -= 0.003;

            // Mouse parallax effect
            camera.position.x += (mouseX * 10 - camera.position.x) * 0.05;
            camera.position.y += (-mouseY * 10 - camera.position.y) * 0.05;
            camera.lookAt(scene.position);

            // Make particles breathe
            const positions = particles.geometry.attributes.position.array;
            for(let i = 0; i < particleCount; i++) {
                const i3 = i * 3;
                const x = geometry.attributes.position.array[i3];
                // Apply subtle wave to y axis based on time
                positions[i3 + 1] += Math.sin(elapsedTime + x) * 0.01;
            }
            particles.geometry.attributes.position.needsUpdate = true;

            renderer.render(scene, camera);
        }

        animate();
    </script>
</body>
</html>
