<!-- Floating Chat Widget Button -->
<div id="chat-widget-container" class="fixed bottom-6 right-6 z-50 font-sans">
    <!-- Bubble Toggle Button -->
    <button id="chat-widget-toggle" class="flex h-14 w-14 items-center justify-between rounded-full bg-[#1d3b2a] text-[#d8f36b] shadow-xl hover:bg-[#31583f] transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none">
        <span class="grid h-full w-full place-items-center">
            <!-- Chat Icon -->
            <svg id="chat-icon-open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <!-- Close Icon (Hidden by default) -->
            <svg id="chat-icon-close" class="hidden h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </span>
    </button>

    <!-- Chat Window Popup (Hidden by default) -->
    <div id="chat-window" class="hidden absolute bottom-16 right-0 w-80 sm:w-96 max-h-[80vh] flex flex-col overflow-hidden rounded-3xl border border-[#e5ebe0] bg-white shadow-2xl transition-all duration-300 transform scale-95 opacity-0 origin-bottom-right">
        <!-- Header -->
        <div class="flex items-center justify-between bg-[#1d3b2a] px-5 py-4 text-white">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-[#d8f36b] text-lg font-bold text-[#1d3b2a]">R</span>
                    <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-green-500 border-2 border-white"></span>
                </div>
                <div>
                    <h3 class="font-semibold text-sm leading-tight">EaseBot</h3>
                    <p class="text-[10px] text-[#8cb89c] font-medium">RoomEase AI Assistant • Online</p>
                </div>
            </div>
            <button id="chat-close" class="text-gray-300 hover:text-white transition focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Messages Container -->
        <div id="chat-messages" class="h-72 max-h-[45vh] overflow-y-auto bg-[#fbfbf9] p-4 space-y-3.5 text-sm scrollbar-thin">
            <!-- Welcome Message -->
            <div class="flex items-start gap-2.5">
                <div class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-[#e9efe5] text-xs font-bold text-[#1d3b2a]">🤖</div>
                <div class="rounded-2xl rounded-tl-none bg-[#e9efe5] px-4 py-2.5 text-[#2b3a30] leading-relaxed max-w-[80%]">
                    Halo! Selamat datang di **RoomEase AI Customer Service** 🤖🌿<br><br>Ada yang bisa saya bantu hari ini?
                </div>
            </div>
        </div>

        <!-- Quick Suggestions -->
        <div class="px-4 py-2.5 bg-[#f5f5f0] border-t border-[#e8ece3] flex flex-wrap gap-1.5 overflow-x-auto whitespace-nowrap scrollbar-none">
            <button onclick="sendQuickMessage('Halo')" class="rounded-full border border-[#d2dcd0] bg-white px-3 py-1 text-xs font-medium text-[#1d3b2a] hover:border-[#1d3b2a] hover:bg-[#e9efe5] transition duration-200">👋 Halo</button>
            <button onclick="sendQuickMessage('Kamar apa saja yang kosong?')" class="rounded-full border border-[#d2dcd0] bg-white px-3 py-1 text-xs font-medium text-[#1d3b2a] hover:border-[#1d3b2a] hover:bg-[#e9efe5] transition duration-200">🛏️ Kamar Ready</button>
            <button onclick="sendQuickMessage('Jam berapa check in?')" class="rounded-full border border-[#d2dcd0] bg-white px-3 py-1 text-xs font-medium text-[#1d3b2a] hover:border-[#1d3b2a] hover:bg-[#e9efe5] transition duration-200">⏰ Jam Check-in</button>
            <button onclick="sendQuickMessage('Fasilitas hotel apa aja?')" class="rounded-full border border-[#d2dcd0] bg-white px-3 py-1 text-xs font-medium text-[#1d3b2a] hover:border-[#1d3b2a] hover:bg-[#e9efe5] transition duration-200">☕ Fasilitas</button>
        </div>

        <!-- Form Input -->
        <form id="chat-form" class="border-t border-[#e8ece3] bg-white p-3 flex gap-2 items-center">
            @csrf
            <input type="text" id="chat-input" placeholder="Tulis pertanyaan kamu..." autocomplete="off" class="flex-1 rounded-full border border-[#dce5d5] bg-[#fbfbf9] px-4 py-2 text-sm text-[#18221d] focus:border-[#1d3b2a] focus:outline-none focus:ring-1 focus:ring-[#1d3b2a]">
            <button type="submit" class="flex h-9 w-9 shrink-0 place-items-center justify-between rounded-full bg-[#1d3b2a] text-[#d8f36b] hover:bg-[#31583f] transition duration-200 focus:outline-none">
                <span class="grid h-full w-full place-items-center">
                    <svg class="h-4.5 w-4.5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </span>
            </button>
        </form>
    </div>
</div>

<script>
    const chatToggle = document.getElementById('chat-widget-toggle');
    const chatWindow = document.getElementById('chat-window');
    const chatClose = document.getElementById('chat-close');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const iconOpen = document.getElementById('chat-icon-open');
    const iconClose = document.getElementById('chat-icon-close');

    // Helper function to format markdown-like text to html simple bolding
    function formatMessage(text) {
        // Replace **bold** with <strong>bold</strong>
        let html = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        // Replace _italic_ with <em>italic</em>
        html = html.replace(/_(.*?)_/g, '<em>$1</em>');
        // Replace `code` with <code class="bg-[#eaefe8] px-1 rounded font-mono text-xs font-semibold">$1</code>
        html = html.replace(/`(.*?)`/g, '<code class="bg-[#eaefe8] px-1 rounded font-mono text-[11px] font-semibold text-[#1d3b2a]">$1</code>');
        // Replace \n with <br>
        html = html.replaceAll('\n', '<br>');
        return html;
    }

    // Toggle Chat Window
    chatToggle.addEventListener('click', () => {
        const isHidden = chatWindow.classList.contains('hidden');
        if (isHidden) {
            chatWindow.classList.remove('hidden');
            // Mini delay for CSS transition
            setTimeout(() => {
                chatWindow.classList.remove('scale-95', 'opacity-0');
                chatWindow.classList.add('scale-100', 'opacity-100');
            }, 10);
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            chatInput.focus();
            scrollToBottom();
        } else {
            closeChat();
        }
    });

    chatClose.addEventListener('click', closeChat);

    function closeChat() {
        chatWindow.classList.remove('scale-100', 'opacity-100');
        chatWindow.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            chatWindow.classList.add('hidden');
        }, 300);
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Append Message to UI
    function appendMessage(sender, text) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start gap-2.5';
        
        if (sender === 'user') {
            messageDiv.className += ' justify-end';
            messageDiv.innerHTML = `
                <div class="rounded-2xl rounded-tr-none bg-[#1d3b2a] px-4 py-2.5 text-white leading-relaxed max-w-[80%]">
                    ${formatMessage(text)}
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-[#e9efe5] text-xs font-bold text-[#1d3b2a]">🤖</div>
                <div class="rounded-2xl rounded-tl-none bg-[#e9efe5] px-4 py-2.5 text-[#2b3a30] leading-relaxed max-w-[80%]">
                    ${formatMessage(text)}
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    // Append typing indicator
    let typingIndicator = null;
    function showTyping() {
        if (typingIndicator) return;
        typingIndicator = document.createElement('div');
        typingIndicator.className = 'flex items-start gap-2.5';
        typingIndicator.id = 'typing-indicator';
        typingIndicator.innerHTML = `
            <div class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-[#e9efe5] text-xs font-bold text-[#1d3b2a]">🤖</div>
            <div class="rounded-2xl rounded-tl-none bg-[#e9efe5] px-4 py-2.5 text-[#2b3a30] leading-relaxed max-w-[80%] flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-[#526057] rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                <span class="w-1.5 h-1.5 bg-[#526057] rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                <span class="w-1.5 h-1.5 bg-[#526057] rounded-full animate-bounce" style="animation-delay: 300ms"></span>
            </div>
        `;
        chatMessages.appendChild(typingIndicator);
        scrollToBottom();
    }

    function removeTyping() {
        if (typingIndicator) {
            typingIndicator.remove();
            typingIndicator = null;
        }
    }

    // Submit Chat Form
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const text = chatInput.value.trim();
        if (text === '') return;

        chatInput.value = '';
        appendMessage('user', text);
        
        await sendMessageToBackend(text);
    });

    // Quick replies helper
    async function sendQuickMessage(text) {
        appendMessage('user', text);
        await sendMessageToBackend(text);
    }

    // Call backend API
    async function sendMessageToBackend(messageText) {
        showTyping();
        try {
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ message: messageText })
            });

            const data = await response.json();
            removeTyping();
            
            if (data.reply) {
                appendMessage('bot', data.reply);
            } else {
                appendMessage('bot', 'Maaf bro, ada kendala koneksi di server AI.');
            }
        } catch (error) {
            removeTyping();
            appendMessage('bot', 'Maaf bro, ada kendala koneksi ke server.');
            console.error('Chat Error:', error);
        }
    }
</script>
