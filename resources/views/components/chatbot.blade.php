<!-- Floating Chatbot Toggle Button -->
<div class="fixed bottom-6 right-6 z-[100]" x-data="chatbotWidget()">
    <button @click="toggleChat()" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 hover:scale-105 relative">
        <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <svg x-show="isOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white dark:border-gray-900 animate-pulse" x-show="!isOpen"></span>
    </button>

    <!-- Chatbot Window (Glassmorphism) -->
    <div x-show="isOpen" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         class="absolute bottom-20 right-0 w-80 sm:w-96 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl overflow-hidden flex flex-col h-[500px] max-h-[80vh]">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 text-white flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm">FitBot AI</h3>
                    <p class="text-[10px] text-indigo-100 flex items-center gap-1"><span class="w-2 h-2 bg-green-400 rounded-full inline-block"></span> Online</p>
                </div>
            </div>
            <button @click="toggleChat()" class="text-white/70 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4" id="chatbox">
            <!-- Initial Greeting -->
            <div class="flex gap-3 max-w-[85%]">
                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex-shrink-0 flex items-center justify-center text-white mt-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 text-sm py-2 px-3 rounded-2xl rounded-tl-sm shadow-sm">
                    Hi! I'm FitBot. I can help you with your health goals, diet plans, or platform navigation. You can type, send a voice note, or take a picture! How can I help you today?
                </div>
            </div>
            
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="{'flex gap-3 max-w-[85%] ml-auto justify-end': msg.sender === 'user', 'flex gap-3 max-w-[85%]': msg.sender === 'bot'}">
                    
                    <!-- Bot Avatar -->
                    <template x-if="msg.sender === 'bot'">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex-shrink-0 flex items-center justify-center text-white mt-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </template>

                    <!-- Message Bubble -->
                    <div :class="{
                        'bg-indigo-500 text-white text-sm py-2 px-3 rounded-2xl rounded-tr-sm shadow-sm': msg.sender === 'user' && !msg.isMedia,
                        'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 text-sm py-2 px-3 rounded-2xl rounded-tl-sm shadow-sm': msg.sender === 'bot' && !msg.isMedia,
                        'bg-transparent': msg.isMedia
                    }">
                        <!-- Text -->
                        <template x-if="!msg.isMedia">
                            <span x-html="msg.text"></span>
                        </template>
                        
                        <!-- Image -->
                        <template x-if="msg.isMedia && msg.type === 'image'">
                            <img :src="msg.url" class="max-w-full rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" alt="Captured Image">
                        </template>

                        <!-- Audio -->
                        <template x-if="msg.isMedia && msg.type === 'audio'">
                            <audio :src="msg.url" controls class="max-w-[200px] h-10 rounded-full"></audio>
                        </template>
                    </div>

                    <!-- User Avatar -->
                    <template x-if="msg.sender === 'user'">
                        <div class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-600 flex-shrink-0 flex items-center justify-center text-gray-600 dark:text-white mt-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                    </template>
                </div>
            </template>
            
            <!-- Loading Indicator -->
            <div x-show="isTyping" style="display: none;" class="flex gap-3 max-w-[85%]">
                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex-shrink-0 flex items-center justify-center text-white mt-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 py-3 px-4 rounded-2xl rounded-tl-sm shadow-sm flex gap-1 items-center">
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></div>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            </div>
        </div>

        <!-- Camera Preview Overlay -->
        <div x-show="showCamera" style="display: none;" class="absolute inset-0 bg-black/90 z-10 flex flex-col items-center justify-center">
            <video id="cameraPreview" class="w-full max-h-[70%] object-cover" autoplay playsinline></video>
            <div class="flex gap-4 mt-6">
                <button @click="stopCamera()" class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-red-600 transition">Cancel</button>
                <button @click="takePhoto()" class="bg-white text-black px-6 py-2 rounded-full text-sm font-bold hover:bg-gray-200 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Capture
                </button>
            </div>
        </div>

        <!-- Audio Recording Overlay -->
        <div x-show="isRecording" style="display: none;" class="absolute inset-0 bg-indigo-900/95 z-10 flex flex-col items-center justify-center text-white">
            <div class="w-20 h-20 bg-red-500 rounded-full flex items-center justify-center animate-pulse mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
            </div>
            <p class="font-medium animate-pulse">Recording Audio...</p>
            <p class="text-sm text-indigo-200 mt-1" x-text="recordingTime + 's'"></p>
            
            <div class="flex gap-4 mt-8">
                <button @click="stopRecording(false)" class="bg-gray-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-500 transition">Cancel</button>
                <button @click="stopRecording(true)" class="bg-green-500 text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-green-400 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Send
                </button>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <form @submit.prevent="sendMessage()" class="flex items-center gap-2">
                <!-- Media Buttons -->
                <button type="button" @click="startCamera()" class="p-2 text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-full transition" title="Send Photo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>
                <button type="button" @click="startRecording()" class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-full transition" title="Record Audio">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                </button>

                <!-- Text Input -->
                <input x-model="inputText" type="text" placeholder="Type a message..." class="flex-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-sm rounded-full px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition">
                
                <button type="submit" :disabled="!inputText.trim()" class="bg-indigo-500 hover:bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed text-white p-2 rounded-full transition flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatbotWidget', () => ({
            isOpen: false,
            inputText: '',
            messages: [],
            isTyping: false,
            
            // Media States
            showCamera: false,
            cameraStream: null,
            
            isRecording: false,
            mediaRecorder: null,
            audioChunks: [],
            recordingTime: 0,
            recordingInterval: null,

            toggleChat() {
                this.isOpen = !this.isOpen;
                if(this.isOpen) {
                    setTimeout(() => this.scrollToBottom(), 100);
                } else {
                    if (this.showCamera) this.stopCamera();
                    if (this.isRecording) this.stopRecording(false);
                }
            },

            scrollToBottom() {
                const box = document.getElementById('chatbox');
                if (box) {
                    box.scrollTop = box.scrollHeight;
                }
            },

            async sendMessage(text = null, mediaType = null, mediaUrl = null, file = null) {
                const sendText = text || this.inputText.trim();
                
                if (!sendText && !mediaType) return;

                // Add User Message
                if (mediaType) {
                    this.messages.push({ sender: 'user', isMedia: true, type: mediaType, url: mediaUrl });
                } else {
                    this.messages.push({ sender: 'user', text: sendText, isMedia: false });
                }
                
                if (!text) this.inputText = '';
                this.scrollToBottom();

                this.isTyping = true;
                this.scrollToBottom();

                // Prepare FormData for Backend
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                if (sendText) formData.append('message', sendText);
                if (file) {
                    formData.append('media', file);
                    formData.append('mediaType', mediaType);
                }

                try {
                    const response = await fetch('{{ route('chatbot.message') }}', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    this.isTyping = false;
                    this.messages.push({ sender: 'bot', text: data.reply, isMedia: false });
                    this.scrollToBottom();
                } catch (error) {
                    this.isTyping = false;
                    this.messages.push({ sender: 'bot', text: "Sorry, I'm having trouble connecting right now.", isMedia: false });
                    this.scrollToBottom();
                }
            },

            // --- CAMERA LOGIC ---
            async startCamera() {
                try {
                    this.cameraStream = await navigator.mediaDevices.getUserMedia({ video: true });
                    this.showCamera = true;
                    setTimeout(() => {
                        const video = document.getElementById('cameraPreview');
                        if(video) video.srcObject = this.cameraStream;
                    }, 100);
                } catch (err) {
                    alert('Camera access denied or not available.');
                }
            },

            stopCamera() {
                if (this.cameraStream) {
                    this.cameraStream.getTracks().forEach(track => track.stop());
                }
                this.showCamera = false;
                this.cameraStream = null;
            },

            takePhoto() {
                const video = document.getElementById('cameraPreview');
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                
                canvas.toBlob((blob) => {
                    const file = new File([blob], "photo.jpg", { type: "image/jpeg" });
                    const url = URL.createObjectURL(blob);
                    
                    this.stopCamera();
                    this.sendMessage(null, 'image', url, file);
                }, 'image/jpeg');
            },

            // --- AUDIO LOGIC ---
            async startRecording() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    this.mediaRecorder = new MediaRecorder(stream);
                    this.audioChunks = [];
                    
                    this.mediaRecorder.ondataavailable = e => {
                        if (e.data.size > 0) this.audioChunks.push(e.data);
                    };

                    this.isRecording = true;
                    this.recordingTime = 0;
                    this.recordingInterval = setInterval(() => this.recordingTime++, 1000);
                    
                    this.mediaRecorder.start();
                } catch (err) {
                    alert('Microphone access denied or not available.');
                }
            },

            stopRecording(send) {
                if(!this.mediaRecorder) return;
                
                this.mediaRecorder.onstop = () => {
                    if (send && this.audioChunks.length > 0) {
                        const audioBlob = new Blob(this.audioChunks, { type: 'audio/webm' });
                        const file = new File([audioBlob], "voice_note.webm", { type: "audio/webm" });
                        const url = URL.createObjectURL(audioBlob);
                        
                        this.sendMessage(null, 'audio', url, file);
                    }
                    
                    // Cleanup
                    this.mediaRecorder.stream.getTracks().forEach(track => track.stop());
                    this.mediaRecorder = null;
                    this.audioChunks = [];
                };
                
                this.mediaRecorder.stop();
                clearInterval(this.recordingInterval);
                this.isRecording = false;
            }
        }));
    });
</script>
