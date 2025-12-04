<script src="{{ asset('frontend/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/js/menu.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/pricing-toggle.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact-form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/lunar.js') }}"></script>
<script src="{{ asset('frontend/js/wow.js') }}"></script>

<!-- Custom Script -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>

<script src="{{ asset('frontend/js/changer.js') }}"></script>
<script defer src="{{ asset('frontend/js/styleswitch.js') }}"></script>

<!-- JS LOGIC -->
<script>
    // UI elements
    const chatHeaderToggle = document.getElementById('chatHeaderToggle');
    const chatToggle = document.getElementById('chat-toggle');
    const chatWindow = document.getElementById('chat-window');
    const messagesDiv = document.getElementById('messages');
    const sendBtn = document.getElementById('sendBtn');
    const messageInput = document.getElementById('messageInput');

    // 🔹 Live support elements
    const liveSupportBtn = document.getElementById('liveSupportBtn');
    const supportFormDiv = document.getElementById('supportForm');
    const supportRequestForm = document.getElementById('supportRequestForm');
    const supportSuccessMsg = document.getElementById('supportSuccessMsg');

    // Toggle Chat Open/Close
    chatToggle.addEventListener('click', () => {
        chatWindow.classList.toggle('hidden');
    });

    // Header arrow click → hide chat
    if (chatHeaderToggle) {
        chatHeaderToggle.addEventListener('click', () => {
            chatWindow.classList.add('hidden'); // শুধু hide করবে
            // চাইলে toggle করতে পারো:
            // chatWindow.classList.toggle('hidden');
        });
    }

    // Append message
    function appendMessage(text, sender = 'user') {
        const div = document.createElement('div');
        div.classList.add('msg', sender);
        // নিউ লাইন থাকলে সুন্দর করে ব্রেকে কনভার্ট
        const safeText = text.replace(/\n/g, '<br>');
        div.innerHTML = `<span>${safeText}</span>`;
        messagesDiv.appendChild(div);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    // Send to Laravel server (chatbot.send)
    async function sendToServer(text) {
        try {
            const response = await fetch('{{ route('chatbot.send') }}', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message: text
                })
            });

            const data = await response.json();
            appendMessage(data.reply, 'bot');

        } catch (err) {
            appendMessage("Server error. Try again later.", "bot");
        }
    }

    // User Send Message
    async function sendMessage() {
        const text = messageInput.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        messageInput.value = "";

        sendToServer(text);
    }

    // Buttons
    sendBtn.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', e => {
        if (e.key === "Enter") sendMessage();
    });

    // Quick Question Buttons
    document.querySelectorAll(".quick-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const text = btn.getAttribute("data-text");
            appendMessage(text, "user");
            sendToServer(text);
        });
    });

    // 🔹 Live Support button click → form show
    if (liveSupportBtn) {
        liveSupportBtn.addEventListener('click', () => {
            supportFormDiv.style.display = 'block';
            supportSuccessMsg.style.display = 'none';
        });
    }

    // 🔹 Live Support form submit → support.request route
    if (supportRequestForm) {
        supportRequestForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(supportRequestForm);

            try {
                const response = await fetch('{{ route('support.request') }}', {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        // Content-Type দিবো না, FormData নিজে ঠিক করে দিবে
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    supportSuccessMsg.textContent =
                        'ধন্যবাদ! খুব দ্রুতই আমাদের টিম আপনার সাথে যোগাযোগ করবে।';
                    supportSuccessMsg.style.display = 'block';
                    supportRequestForm.reset();
                } else {
                    supportSuccessMsg.textContent = 'কিছু ভুল হয়েছে, পরে আবার চেষ্টা করুন।';
                    supportSuccessMsg.style.display = 'block';
                }
            } catch (error) {
                supportSuccessMsg.textContent = 'Server error হয়েছে, পরে আবার চেষ্টা করুন।';
                supportSuccessMsg.style.display = 'block';
            }
        });
    }
</script>

<script>
    const backToTopBtn = document.getElementById("backToTop");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add("show");
        } else {
            backToTopBtn.classList.remove("show");
        }
    });

    backToTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: "smooth"
        });
    });
</script>


@stack('scripts')
