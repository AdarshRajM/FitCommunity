<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Write Blog Article') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#161e2e] shadow-sm rounded-2xl p-8 border border-gray-200 dark:border-gray-800">
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="blogForm">
                    @csrf
                    <div>
                        <x-input-label for="title" :value="__('Article Title')" />
                        <x-text-input id="title" class="mt-1 block w-full text-lg font-bold" type="text" name="title" required autofocus />
                    </div>
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Nutrition">Nutrition</option>
                            <option value="Workout">Workout</option>
                            <option value="Mental Health">Mental Health</option>
                        </select>
                    </div>
                    
                    <!-- WebRTC Video Recording Section -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-gray-50 dark:bg-gray-900/50">
                        <x-input-label :value="__('Add Video (Upload or Record)')" class="mb-4 text-lg" />
                        
                        <div class="flex gap-4 mb-4">
                            <button type="button" id="startCameraBtn" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Open Camera
                            </button>
                            <button type="button" id="startRecordingBtn" class="hidden bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2 transition">
                                <span class="w-3 h-3 bg-white rounded-full animate-pulse"></span> Record
                            </button>
                            <button type="button" id="stopRecordingBtn" class="hidden bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 flex items-center gap-2 transition">
                                Stop
                            </button>
                        </div>

                        <div id="videoContainer" class="hidden relative aspect-video bg-black rounded-lg overflow-hidden mb-4 border border-gray-700">
                            <video id="liveVideo" class="w-full h-full object-cover" autoplay muted></video>
                            <video id="playbackVideo" class="hidden w-full h-full object-cover" controls></video>
                        </div>

                        <div class="mt-4 border-t border-gray-300 dark:border-gray-700 pt-4">
                            <x-input-label for="video" :value="__('Or upload a file directly:')" class="mb-2" />
                            <input type="file" name="video" id="video" accept="video/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/30 dark:file:text-indigo-400" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea id="content" name="content" rows="15" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button id="submitBtn">Publish Article</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- WebRTC Recording Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startCameraBtn = document.getElementById('startCameraBtn');
            const startRecordingBtn = document.getElementById('startRecordingBtn');
            const stopRecordingBtn = document.getElementById('stopRecordingBtn');
            const liveVideo = document.getElementById('liveVideo');
            const playbackVideo = document.getElementById('playbackVideo');
            const videoContainer = document.getElementById('videoContainer');
            const videoInput = document.getElementById('video');
            const form = document.getElementById('blogForm');
            
            let stream = null;
            let mediaRecorder = null;
            let recordedChunks = [];
            let recordedBlob = null;

            startCameraBtn.addEventListener('click', async () => {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                    liveVideo.srcObject = stream;
                    videoContainer.classList.remove('hidden');
                    liveVideo.classList.remove('hidden');
                    playbackVideo.classList.add('hidden');
                    
                    startCameraBtn.classList.add('hidden');
                    startRecordingBtn.classList.remove('hidden');
                } catch (err) {
                    console.error("Error accessing camera: ", err);
                    alert("Could not access camera. Please ensure you have granted permission.");
                }
            });

            startRecordingBtn.addEventListener('click', () => {
                recordedChunks = [];
                mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm' });
                
                mediaRecorder.ondataavailable = (e) => {
                    if (e.data.size > 0) {
                        recordedChunks.push(e.data);
                    }
                };
                
                mediaRecorder.onstop = () => {
                    recordedBlob = new Blob(recordedChunks, { type: 'video/webm' });
                    const videoURL = URL.createObjectURL(recordedBlob);
                    
                    liveVideo.classList.add('hidden');
                    playbackVideo.src = videoURL;
                    playbackVideo.classList.remove('hidden');
                    
                    // Stop all tracks
                    stream.getTracks().forEach(track => track.stop());
                    
                    // Create a File object and attach it to the file input
                    const file = new File([recordedBlob], "recorded_blog_video.webm", { type: 'video/webm' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    videoInput.files = dataTransfer.files;
                };

                mediaRecorder.start();
                startRecordingBtn.classList.add('hidden');
                stopRecordingBtn.classList.remove('hidden');
            });

            stopRecordingBtn.addEventListener('click', () => {
                if(mediaRecorder && mediaRecorder.state !== 'inactive') {
                    mediaRecorder.stop();
                }
                stopRecordingBtn.classList.add('hidden');
                startCameraBtn.textContent = 'Retake Video';
                startCameraBtn.classList.remove('hidden');
            });
        });
    </script>
</x-app-layout>
