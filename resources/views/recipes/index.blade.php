<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Recipes & Diet Plans') }}
        </h2>
    </x-slot>

    <!-- External Assets -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        
        <!-- 3D Header Banner -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-8 relative overflow-hidden flex flex-col md:flex-row items-center justify-between shadow-xl">
                <div class="relative z-10 w-full md:w-1/2 text-white">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-semibold tracking-wider mb-4 inline-block">NUTRITION HUB</span>
                    <h3 class="text-4xl font-extrabold mb-4 leading-tight">Fuel Your Body. <br/>Achieve Your Goals.</h3>
                    <p class="text-emerald-50 mb-6 text-lg">Discover macro-friendly recipes shared by the FitCommunity. Filter by diet type and calories to find your perfect meal.</p>
                    <a href="{{ url('/community') }}" class="inline-block bg-white text-green-600 px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                        Share a Recipe
                    </a>
                </div>
                <!-- 3D Canvas Container -->
                <div id="food-3d-canvas" class="w-full md:w-1/2 h-64 relative z-10 mt-8 md:mt-0"></div>
                
                <!-- Abstract Background Shapes -->
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-40 -bottom-20 w-64 h-64 bg-green-900/20 rounded-full blur-2xl"></div>
            </div>
        </div>

        <!-- Recipe Grid -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Expert Diet Plans</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Plan 1 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center text-green-600 dark:text-green-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Balanced Meal Plan</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">Breakfast:</span> Veggie omelette with whole grain toast.</li>
                        <li><span class="font-bold">Lunch:</span> Quinoa salad with grilled chicken & avocado.</li>
                        <li><span class="font-bold">Snack:</span> Greek yogurt with berries.</li>
                        <li><span class="font-bold">Dinner:</span> Baked fish with roasted vegetables.</li>
                    </ul>
                </div>
                <!-- Plan 2 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center text-red-600 dark:text-red-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">High Protein Plan</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">Breakfast:</span> Protein smoothie (banana & spinach).</li>
                        <li><span class="font-bold">Lunch:</span> Turkey wrap with hummus and greens.</li>
                        <li><span class="font-bold">Snack:</span> Cottage cheese with almonds.</li>
                        <li><span class="font-bold">Dinner:</span> Grilled steak/tofu with sweet potato.</li>
                    </ul>
                </div>
                <!-- Plan 3 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Plant-Based Plan</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">Breakfast:</span> Oatmeal topped with fruit and nuts.</li>
                        <li><span class="font-bold">Lunch:</span> Lentil and vegetable bowl.</li>
                        <li><span class="font-bold">Snack:</span> Apple slices with almond butter.</li>
                        <li><span class="font-bold">Dinner:</span> Chickpea curry with brown rice.</li>
                    </ul>
                </div>
                <!-- Plan 4 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Keto Diet Plan</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">Breakfast:</span> Scrambled eggs in butter with avocado.</li>
                        <li><span class="font-bold">Lunch:</span> Chicken salad with olive oil dressing.</li>
                        <li><span class="font-bold">Snack:</span> Macadamia nuts & string cheese.</li>
                        <li><span class="font-bold">Dinner:</span> Salmon baked in butter with asparagus.</li>
                    </ul>
                </div>
                <!-- Plan 5 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Intermittent Fasting (16:8)</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">8 AM:</span> Black coffee or green tea (Fasting).</li>
                        <li><span class="font-bold">12 PM:</span> First Meal - High protein, complex carbs.</li>
                        <li><span class="font-bold">4 PM:</span> Mid-day snack - Nuts or fruit.</li>
                        <li><span class="font-bold">8 PM:</span> Last Meal - High protein, low carb dinner.</li>
                    </ul>
                </div>
                <!-- Plan 6 -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center text-orange-600 dark:text-orange-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Mediterranean Diet</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">Breakfast:</span> Greek yogurt with honey and walnuts.</li>
                        <li><span class="font-bold">Lunch:</span> Whole grain pita with falafel and tzatziki.</li>
                        <li><span class="font-bold">Snack:</span> Fresh tomatoes and mozzarella.</li>
                        <li><span class="font-bold">Dinner:</span> Grilled white fish, quinoa, & olive oil.</li>
                    </ul>
                </div>
                <!-- Plan 7: Nutrition for Mental Health -->
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-sm hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-xl flex items-center justify-center text-pink-600 dark:text-pink-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Nutrition for Mental Health</h4>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 text-sm">
                        <li><span class="font-bold">Focus:</span> Omega-3s, Antioxidants, & Gut Health.</li>
                        <li><span class="font-bold">Breakfast:</span> Chia seed pudding with walnuts & dark chocolate.</li>
                        <li><span class="font-bold">Lunch:</span> Spinach salad with salmon, avocado, & olive oil.</li>
                        <li><span class="font-bold">Dinner:</span> Fermented foods (kimchi) with lean protein.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Community Hydration Goal -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-3xl p-8 border border-blue-100 dark:border-blue-800 flex flex-col md:flex-row items-center justify-between shadow-sm">
                <div class="w-full md:w-2/3 mb-6 md:mb-0 pr-8">
                    <h3 class="text-2xl font-bold text-blue-900 dark:text-blue-400 mb-2">💧 Community Hydration Challenge</h3>
                    <p class="text-blue-700 dark:text-blue-300 mb-4">Staying hydrated is crucial for mental clarity and physical performance. Together, the FitCommunity aims to drink 10,000 Liters of water today!</p>
                    <div class="w-full bg-blue-200 dark:bg-blue-900 rounded-full h-4 mb-2 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-400 to-cyan-400 h-4 rounded-full w-3/4" style="width: 68%;"></div>
                    </div>
                    <p class="text-sm text-blue-600 dark:text-blue-400 font-bold">6,800 / 10,000 Liters consumed today</p>
                </div>
                <div class="w-full md:w-1/3 text-center">
                    <button onclick="alert('Great job! 0.25L of water has been logged to your daily intake. Keep hydrating!'); window.dispatchEvent(new CustomEvent('open-ai-chat', { detail: 'I just drank a glass of water, log 0.25L for me.' }))" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg transition transform hover:scale-105">
                        Log My Glass (+0.25L)
                    </button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Trending Recipes</h3>
                <div class="flex gap-2">
                    <select class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5">
                        <option>All Diets</option>
                        <option>Keto</option>
                        <option>Vegan</option>
                        <option>High Protein</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse($recipes as $recipe)
                <div class="bg-white dark:bg-[#161e2e] border border-gray-200 dark:border-gray-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all transform hover:-translate-y-2 group">
                    <div class="h-48 overflow-hidden relative bg-black">
                        @if($recipe->video_path)
                            <video src="{{ asset('storage/recipes/videos/' . $recipe->video_path) }}" controls class="w-full h-full object-cover"></video>
                        @else
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @endif
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-green-500 transition">{{ $recipe->title }}</h4>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-2">{{ $recipe->description }}</p>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-center gap-2">
                                <img src="{{ $recipe->user->avatar ? asset('storage/'.$recipe->user->avatar) : 'https://i.pravatar.cc/100?img=' . ($recipe->id % 70) }}" class="w-8 h-8 rounded-full" alt="{{ $recipe->user->name }}">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $recipe->user->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No recipes shared yet. Be the first!</p>
                </div>
                @endforelse

            </div>
        </div>
    </div>

    <!-- 3D Header Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('food-3d-canvas');
            if(!container) return;

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 100);
            camera.position.z = 5;

            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setPixelRatio(window.devicePixelRatio);
            container.appendChild(renderer.domElement);

            // Lights
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
            scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(5, 5, 5);
            scene.add(directionalLight);

            // Abstract 3D shape representing health/food (Apple-like sphere with torus leaf)
            const group = new THREE.Group();

            // Apple body
            const bodyGeo = new THREE.SphereGeometry(1.2, 32, 32);
            bodyGeo.scale(1, 0.9, 1); // squish slightly
            const bodyMat = new THREE.MeshPhongMaterial({ 
                color: 0xa7f3d0, // Emerald-200
                shininess: 80,
                transparent: true,
                opacity: 0.9
            });
            const body = new THREE.Mesh(bodyGeo, bodyMat);
            group.add(body);

            // Leaf
            const leafGeo = new THREE.ConeGeometry(0.3, 1, 16);
            leafGeo.translate(0, 0.5, 0);
            leafGeo.rotateZ(Math.PI / 4);
            const leafMat = new THREE.MeshPhongMaterial({ color: 0x10b981 }); // Emerald-500
            const leaf = new THREE.Mesh(leafGeo, leafMat);
            leaf.position.set(0, 1, 0);
            group.add(leaf);

            // Stem
            const stemGeo = new THREE.CylinderGeometry(0.05, 0.05, 0.5);
            const stemMat = new THREE.MeshPhongMaterial({ color: 0x064e3b }); // Emerald-900
            const stem = new THREE.Mesh(stemGeo, stemMat);
            stem.position.set(0, 1.2, 0);
            group.add(stem);

            // Float animation properties
            let time = 0;

            scene.add(group);

            // Mouse interaction
            let targetRotationX = 0;
            let targetRotationY = 0;
            
            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / container.clientWidth) * 2 - 1;
                const y = -((e.clientY - rect.top) / container.clientHeight) * 2 + 1;
                
                targetRotationY = x * 0.5;
                targetRotationX = -y * 0.5;
            });

            function animate() {
                requestAnimationFrame(animate);
                
                time += 0.02;
                
                // Smooth follow mouse
                group.rotation.y += (targetRotationY - group.rotation.y) * 0.1;
                group.rotation.x += (targetRotationX - group.rotation.x) * 0.1;
                
                // Idle rotation and floating
                group.rotation.y += 0.005;
                group.position.y = Math.sin(time) * 0.1;

                renderer.render(scene, camera);
            }
            
            animate();

            window.addEventListener('resize', () => {
                if(!container) return;
                camera.aspect = container.clientWidth / container.clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.clientWidth, container.clientHeight);
            });
        });
    </script>
</x-app-layout>
