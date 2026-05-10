<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mental Health & Meditation') }}
        </h2>
    </x-slot>

    <!-- External Assets -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <div class="py-12 bg-[#0b1121] min-h-screen relative overflow-hidden">
        <!-- 3D Background specifically for meditation -->
        <div id="meditation-canvas" class="absolute inset-0 z-0"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="text-center space-y-8 mt-10">
                
                <h1 class="text-5xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 mb-4 tracking-tight">
                    Breathe. Relax. Focus.
                </h1>
                
                <p class="text-xl text-gray-300 max-w-2xl mx-auto font-light leading-relaxed">
                    Take a moment for yourself. Follow the rhythm of the sphere to guide your breathing and center your mind.
                </p>

                <div class="py-12">
                    <div class="glass-panel mx-auto inline-block p-8 rounded-3xl backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl">
                        <div id="instruction-text" class="text-3xl font-bold text-white mb-2 transition-all duration-1000">
                            Ready?
                        </div>
                        <p id="timer-text" class="text-cyan-400 text-lg font-medium">Click start to begin session</p>
                    </div>
                </div>

                <div class="flex justify-center gap-6">
                    <button id="start-btn" class="bg-cyan-500 hover:bg-cyan-400 text-white px-10 py-4 rounded-full font-bold shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] transition-all transform hover:-translate-y-1 text-lg">
                        Start Breathing Exercise
                    </button>
                    <button id="stop-btn" class="bg-white/10 hover:bg-white/20 text-white px-10 py-4 rounded-full font-bold border border-white/20 transition-all text-lg hidden">
                        Stop
                    </button>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mt-20 text-left">
                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10">
                        <div class="w-12 h-12 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Stress Relief</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Just 5 minutes of focused breathing can significantly lower cortisol levels and reduce anxiety.</p>
                    </div>
                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10">
                        <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Better Recovery</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Proper oxygen flow helps muscles recover faster after an intense workout in the community.</p>
                    </div>
                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10">
                        <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Improved Focus</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">Clear your mind before tackling your daily fitness goals and dietary plans.</p>
                    </div>
                </div>

                <!-- Community Zen Groups -->
                <div class="mt-24 text-left">
                    <h2 class="text-3xl font-bold text-white mb-2">Community Zen Groups</h2>
                    <p class="text-gray-400 mb-8">Meditate together. Join a live guided session hosted by community wellness leaders.</p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-r from-blue-900/40 to-cyan-900/40 border border-blue-500/30 p-6 rounded-2xl flex items-center justify-between group hover:border-cyan-400/50 transition">
                            <div>
                                <h4 class="text-xl font-bold text-white mb-1">Morning Mindfulness</h4>
                                <p class="text-sm text-cyan-300 mb-2">Starts in 10 mins • 45 Members Waiting</p>
                                <div class="flex -space-x-2">
                                    <img class="w-8 h-8 rounded-full border border-[#0b1121]" src="https://i.pravatar.cc/100?img=12" alt="Avatar">
                                    <img class="w-8 h-8 rounded-full border border-[#0b1121]" src="https://i.pravatar.cc/100?img=13" alt="Avatar">
                                    <img class="w-8 h-8 rounded-full border border-[#0b1121]" src="https://i.pravatar.cc/100?img=14" alt="Avatar">
                                </div>
                            </div>
                            <button class="bg-cyan-500/20 hover:bg-cyan-500 text-cyan-300 hover:text-white px-6 py-3 rounded-xl font-medium transition">
                                Join Room
                            </button>
                        </div>

                        <div class="bg-gradient-to-r from-purple-900/40 to-pink-900/40 border border-purple-500/30 p-6 rounded-2xl flex items-center justify-between group hover:border-pink-400/50 transition">
                            <div>
                                <h4 class="text-xl font-bold text-white mb-1">Sleep Preparation</h4>
                                <p class="text-sm text-purple-300 mb-2">Starts at 10:00 PM • 120 Members Registered</p>
                                <div class="flex -space-x-2">
                                    <img class="w-8 h-8 rounded-full border border-[#0b1121]" src="https://i.pravatar.cc/100?img=22" alt="Avatar">
                                    <img class="w-8 h-8 rounded-full border border-[#0b1121]" src="https://i.pravatar.cc/100?img=23" alt="Avatar">
                                </div>
                            </div>
                            <button class="bg-purple-500/20 hover:bg-purple-500 text-purple-300 hover:text-white px-6 py-3 rounded-xl font-medium transition">
                                RSVP
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Meditation 3D Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scene Setup
            const container = document.getElementById('meditation-canvas');
            const scene = new THREE.Scene();
            
            // Camera
            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 15;
            
            // Renderer
            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(window.devicePixelRatio);
            container.appendChild(renderer.domElement);
            
            // The Breathing Sphere (Made of Particles)
            const particleCount = 2000;
            const geometry = new THREE.BufferGeometry();
            const positions = new Float32Array(particleCount * 3);
            const basePositions = new Float32Array(particleCount * 3); // Store original positions
            
            const radius = 4;
            
            for(let i = 0; i < particleCount * 3; i += 3) {
                const u = Math.random();
                const v = Math.random();
                const theta = u * 2.0 * Math.PI;
                const phi = Math.acos(2.0 * v - 1.0);
                const r = Math.cbrt(Math.random()) * radius;
                
                const x = r * Math.sin(phi) * Math.cos(theta);
                const y = r * Math.sin(phi) * Math.sin(theta);
                const z = r * Math.cos(phi);
                
                positions[i] = x;
                positions[i+1] = y;
                positions[i+2] = z;
                
                basePositions[i] = x;
                basePositions[i+1] = y;
                basePositions[i+2] = z;
            }
            
            geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            
            // Create a custom shader material for glowing cyan effect
            const material = new THREE.PointsMaterial({
                color: 0x06b6d4, // Cyan-400
                size: 0.15,
                transparent: true,
                opacity: 0.6,
                blending: THREE.AdditiveBlending
            });
            
            const sphere = new THREE.Points(geometry, material);
            scene.add(sphere);

            // Inner solid glowing sphere
            const innerGeo = new THREE.IcosahedronGeometry(2, 2);
            const innerMat = new THREE.MeshBasicMaterial({
                color: 0x3b82f6, // Blue-500
                wireframe: true,
                transparent: true,
                opacity: 0.1
            });
            const innerSphere = new THREE.Mesh(innerGeo, innerMat);
            scene.add(innerSphere);

            // Animation logic variables
            let isBreathing = false;
            let cycleTime = 8000; // 4s in, 4s out
            let startTime = 0;
            
            // UI Elements
            const startBtn = document.getElementById('start-btn');
            const stopBtn = document.getElementById('stop-btn');
            const instructionText = document.getElementById('instruction-text');
            const timerText = document.getElementById('timer-text');

            startBtn.addEventListener('click', () => {
                isBreathing = true;
                startTime = Date.now();
                startBtn.classList.add('hidden');
                stopBtn.classList.remove('hidden');
            });

            stopBtn.addEventListener('click', () => {
                isBreathing = false;
                stopBtn.classList.add('hidden');
                startBtn.classList.remove('hidden');
                instructionText.innerText = "Session Ended";
                timerText.innerText = "Great job focusing on your breath.";
            });

            // Render Loop
            function animate() {
                requestAnimationFrame(animate);
                
                // Base rotation
                sphere.rotation.y += 0.002;
                sphere.rotation.x += 0.001;
                innerSphere.rotation.y -= 0.003;
                
                if(isBreathing) {
                    const elapsed = Date.now() - startTime;
                    const progress = (elapsed % cycleTime) / cycleTime; // 0 to 1
                    
                    let scale = 1;
                    
                    // Inhale: 0 to 0.5 (Expand)
                    if(progress < 0.5) {
                        const inhaleProgress = progress * 2; // 0 to 1
                        // Ease out sine
                        scale = 1 + Math.sin(inhaleProgress * Math.PI / 2) * 1.5;
                        instructionText.innerText = "Breathe In...";
                        instructionText.style.transform = "scale(1.1)";
                        instructionText.style.color = "#22d3ee"; // cyan-400
                        timerText.innerText = Math.ceil(4 - (inhaleProgress * 4)) + "s";
                    } 
                    // Exhale: 0.5 to 1.0 (Contract)
                    else {
                        const exhaleProgress = (progress - 0.5) * 2; // 0 to 1
                        // Ease in sine
                        scale = 2.5 - Math.sin(exhaleProgress * Math.PI / 2) * 1.5;
                        instructionText.innerText = "Breathe Out...";
                        instructionText.style.transform = "scale(1)";
                        instructionText.style.color = "#3b82f6"; // blue-500
                        timerText.innerText = Math.ceil(4 - (exhaleProgress * 4)) + "s";
                    }
                    
                    // Apply scale to particles
                    const currentPositions = geometry.attributes.position.array;
                    for(let i = 0; i < particleCount * 3; i++) {
                        currentPositions[i] = basePositions[i] * scale;
                    }
                    geometry.attributes.position.needsUpdate = true;
                    
                    innerSphere.scale.set(scale, scale, scale);
                } else {
                    // Reset smoothly
                    const currentPositions = geometry.attributes.position.array;
                    for(let i = 0; i < particleCount * 3; i++) {
                        currentPositions[i] += (basePositions[i] - currentPositions[i]) * 0.05;
                    }
                    geometry.attributes.position.needsUpdate = true;
                    
                    innerSphere.scale.lerp(new THREE.Vector3(1,1,1), 0.05);
                }

                renderer.render(scene, camera);
            }
            
            animate();

            // Resize handling
            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        });
    </script>
</x-app-layout>
