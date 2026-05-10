<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-[#0b1121] min-h-[calc(100vh-160px)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full flex flex-col sm:flex-row gap-6 h-[70vh]">
            
            <!-- Chat List (Sidebar) -->
            <div class="w-full sm:w-1/3 bg-white dark:bg-[#161e2e] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#1e293b]">
                    <h3 class="font-bold text-gray-900 dark:text-white">Recent Chats</h3>
                </div>
                <div class="overflow-y-auto flex-1 p-2 space-y-1">
                    @forelse($users as $u)
                        <a href="{{ route('chat.index', $u->id) }}" class="flex items-center gap-3 p-3 rounded-xl transition hover:bg-gray-100 dark:hover:bg-gray-800 {{ $activeUser && $activeUser->id === $u->id ? 'bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800/50' : '' }}">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 shrink-0 relative">
                                <img src="{{ $u->avatar ? asset('storage/'.$u->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($u->name) }}" class="w-full h-full object-cover">
                                @if($u->is_active)
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                                @endif
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <div class="flex justify-between items-baseline">
                                    <h4 class="font-bold text-gray-900 dark:text-white text-sm truncate">{{ $u->name }}</h4>
                                </div>
                                <p class="text-xs text-gray-500 truncate">{{ $u->role }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-center text-gray-500 text-sm">No users found.</div>
                    @endforelse
                </div>
            </div>

            <!-- Chat Window -->
            <div class="w-full sm:w-2/3 bg-white dark:bg-[#161e2e] rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col overflow-hidden relative">
                @if($activeUser)
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-800 flex items-center gap-4 bg-white dark:bg-[#161e2e] z-10 shadow-sm">
                        <img src="{{ $activeUser->avatar ? asset('storage/'.$activeUser->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($activeUser->name) }}" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $activeUser->name }}</h3>
                            <p class="text-xs text-gray-500">{{ $activeUser->role }}</p>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-[#0f172a]">
                        @forelse($messages as $msg)
                            @if($msg->sender_id === Auth::id())
                                <!-- Sent Message -->
                                <div class="flex justify-end">
                                    <div class="bg-blue-500 text-white p-3 rounded-2xl rounded-tr-none max-w-[70%] shadow-sm text-sm">
                                        {{ $msg->content }}
                                        <div class="text-[10px] text-blue-200 mt-1 text-right">{{ $msg->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @else
                                <!-- Received Message -->
                                <div class="flex justify-start">
                                    <div class="bg-white dark:bg-[#1e293b] border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 p-3 rounded-2xl rounded-tl-none max-w-[70%] shadow-sm text-sm">
                                        {{ $msg->content }}
                                        <div class="text-[10px] text-gray-400 mt-1">{{ $msg->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="h-full flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                <p>No messages yet. Say hi!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Input Area -->
                    <div class="p-4 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-[#161e2e]">
                        <form id="chat-form" action="{{ route('chat.send') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $activeUser->id }}">
                            <input type="text" name="content" id="chat-input" class="flex-1 bg-gray-100 dark:bg-gray-800 border-none rounded-full px-6 py-3 text-sm focus:ring-2 focus:ring-blue-500 dark:text-white" placeholder="Type a message..." required autocomplete="off">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-full shadow-md transition shrink-0 flex items-center justify-center w-12 h-12">
                                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="h-full flex flex-col items-center justify-center text-gray-400 p-8 text-center">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Select a Conversation</h3>
                        <p class="text-sm">Choose a user from the sidebar to start chatting securely with WebSockets.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($activeUser)
    <script type="module">
        const messagesContainer = document.getElementById('messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        const authUserId = {{ Auth::id() }};
        const activeUserId = {{ $activeUser->id }};

        // Listen for new messages using Laravel Echo (Reverb/Pusher)
        Echo.private(`chat.${authUserId}`)
            .listen('MessageSent', (e) => {
                if (e.message.sender_id === activeUserId) {
                    // Append received message
                    const msgHTML = `
                        <div class="flex justify-start">
                            <div class="bg-white dark:bg-[#1e293b] border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 p-3 rounded-2xl rounded-tl-none max-w-[70%] shadow-sm text-sm">
                                ${e.message.content}
                                <div class="text-[10px] text-gray-400 mt-1">Just now</div>
                            </div>
                        </div>
                    `;
                    messagesContainer.insertAdjacentHTML('beforeend', msgHTML);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            });

        // AJAX Form Submit for smooth UX
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const content = chatInput.value.trim();
            if(!content) return;
            
            // Append sent message immediately for UX
            const msgHTML = `
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white p-3 rounded-2xl rounded-tr-none max-w-[70%] shadow-sm text-sm">
                        ${content}
                        <div class="text-[10px] text-blue-200 mt-1 text-right">Just now</div>
                    </div>
                </div>
            `;
            messagesContainer.insertAdjacentHTML('beforeend', msgHTML);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            chatInput.value = '';

            fetch(chatForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    receiver_id: activeUserId,
                    content: content
                })
            }).catch(err => console.error(err));
        });
    </script>
    @endif
</x-app-layout>
