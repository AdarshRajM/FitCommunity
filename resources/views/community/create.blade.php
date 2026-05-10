<x-app-layout>
    <div class="min-h-screen bg-[#f8fafc] text-slate-800 font-sans pb-12">
        <div class="bg-white border-b border-slate-200 sticky top-0 z-40">
            <div class="max-w-3xl mx-auto px-6 py-4 flex items-center gap-4">
                <a href="{{ route('community.index') }}" class="text-slate-500 hover:text-green-600 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-medium">Back to Pulse</span>
                </a>
            </div>
        </div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Create New Post</h2>
                <p class="text-slate-500">Share your journey, ask for advice, or post a routine.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
                        <ul class="list-disc pl-5 text-sm font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-bold text-slate-700 mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block p-3 transition shadow-inner" 
                            placeholder="What's on your mind?">
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-bold text-slate-700 mb-2">Content</label>
                        <textarea name="content" id="content" rows="6" required
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block p-3 transition shadow-inner" 
                            placeholder="Write your experience here...">{{ old('content') }}</textarea>
                    </div>
                    
                    <!-- Hashtags -->
                    <div>
                        <label for="hashtags" class="block text-sm font-bold text-slate-700 mb-2">Hashtags <span class="font-normal text-slate-500">(comma separated)</span></label>
                        <input type="text" name="hashtags" id="hashtags" value="{{ old('hashtags') }}"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block p-3 transition shadow-inner" 
                            placeholder="fitness, workout, health">
                    </div>

                    <!-- Media Upload & Camera -->
                    <div class="pt-6 border-t border-slate-100">
                        <label class="block text-sm font-bold text-slate-700 mb-4">Add Media</label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- File Upload -->
                            <label for="image" class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-200 border-dashed rounded-xl cursor-pointer hover:bg-green-50 hover:border-green-400 transition group">
                                <svg class="w-6 h-6 text-slate-400 group-hover:text-green-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-semibold text-slate-500 group-hover:text-green-600 transition-colors">Upload Image</span>
                                <input id="image" name="image" type="file" accept="image/*" class="hidden" />
                            </label>
                            
                            <label for="video" class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-200 border-dashed rounded-xl cursor-pointer hover:bg-blue-50 hover:border-blue-400 transition group">
                                <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-semibold text-slate-500 group-hover:text-blue-600 transition-colors">Upload Video</span>
                                <input id="video" name="video" type="file" accept="video/*" class="hidden" />
                            </label>

                            <!-- Camera Button -->
                            <button type="button" id="start-camera-btn" class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-200 border-dashed rounded-xl cursor-pointer hover:bg-purple-50 hover:border-purple-400 transition group">
                                <svg class="w-6 h-6 text-slate-400 group-hover:text-purple-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-xs font-semibold text-slate-500 group-hover:text-purple-600 transition-colors">Take Photo</span>
                            </button>
                        </div>

                        <!-- Camera Interface (Hidden by default) -->
                        <div id="camera-interface" class="hidden mt-4 bg-slate-100 p-4 rounded-2xl">
                            <div class="relative w-full aspect-video bg-black rounded-xl overflow-hidden mb-4">
                                <video id="camera-stream" class="w-full h-full object-cover" autoplay playsinline></video>
                                <img id="captured-photo" class="absolute inset-0 w-full h-full object-cover hidden" alt="Captured" />
                            </div>
                            
                            <div class="flex gap-2 justify-center">
                                <button type="button" id="capture-btn" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-full font-medium shadow-md transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Capture
                                </button>
                                <button type="button" id="retake-btn" class="hidden bg-slate-500 hover:bg-slate-600 text-white px-6 py-2 rounded-full font-medium shadow-md transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    Retake
                                </button>
                                <button type="button" id="close-camera-btn" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-full font-medium shadow-md transition-colors">
                                    Close Camera
                                </button>
                            </div>
                            <!-- Hidden input to store base64 image data -->
                            <input type="hidden" name="camera_image" id="camera_image" />
                            <canvas id="camera-canvas" class="hidden"></canvas>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="bg-[#17b890] hover:bg-[#129976] text-white px-8 py-3 rounded-full font-bold shadow-lg shadow-green-500/30 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Post to Community
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Camera Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startCameraBtn = document.getElementById('start-camera-btn');
            const closeCameraBtn = document.getElementById('close-camera-btn');
            const captureBtn = document.getElementById('capture-btn');
            const retakeBtn = document.getElementById('retake-btn');
            
            const cameraInterface = document.getElementById('camera-interface');
            const videoElement = document.getElementById('camera-stream');
            const canvasElement = document.getElementById('camera-canvas');
            const capturedPhoto = document.getElementById('captured-photo');
            const cameraImageInput = document.getElementById('camera_image');
            
            let stream = null;

            async function startCamera() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
                    videoElement.srcObject = stream;
                    cameraInterface.classList.remove('hidden');
                    capturedPhoto.classList.add('hidden');
                    videoElement.classList.remove('hidden');
                    captureBtn.classList.remove('hidden');
                    retakeBtn.classList.add('hidden');
                } catch (err) {
                    alert('Error accessing the camera. Please make sure you have given permission.');
                    console.error(err);
                }
            }

            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
                cameraInterface.classList.add('hidden');
            }

            startCameraBtn.addEventListener('click', startCamera);
            closeCameraBtn.addEventListener('click', stopCamera);

            captureBtn.addEventListener('click', function() {
                canvasElement.width = videoElement.videoWidth;
                canvasElement.height = videoElement.videoHeight;
                canvasElement.getContext('2d').drawImage(videoElement, 0, 0);
                
                // Convert to base64
                const dataUrl = canvasElement.toDataURL('image/png');
                capturedPhoto.src = dataUrl;
                cameraImageInput.value = dataUrl;

                // UI updates
                videoElement.classList.add('hidden');
                capturedPhoto.classList.remove('hidden');
                captureBtn.classList.add('hidden');
                retakeBtn.classList.remove('hidden');
            });

            retakeBtn.addEventListener('click', function() {
                videoElement.classList.remove('hidden');
                capturedPhoto.classList.add('hidden');
                captureBtn.classList.remove('hidden');
                retakeBtn.classList.add('hidden');
                cameraImageInput.value = ''; // clear hidden input
            });
        });
    </script>
</x-app-layout>
