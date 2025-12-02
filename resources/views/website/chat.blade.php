<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel Chatbot</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .chat-container {
            width: 400px;
            margin: 40px auto;
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .messages {
            height: auto;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .msg {
            margin-bottom: 8px;
            clear: both;
        }

        .msg.user {
            text-align: right;
        }

        .msg.user span {
            background: #007bff;
            color: #fff;
            padding: 6px 10px;
            border-radius: 15px 0 15px 15px;
            display: inline-block;
        }

        .msg.bot span {
            background: #e4e6eb;
            padding: 6px 10px;
            border-radius: 0 15px 15px 15px;
            display: inline-block;
        }

        .input-area {
            display: flex;
            gap: 5px;
        }

        .input-area input {
            flex: 1;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .input-area button {
            padding: 8px 15px;
            border-radius: 4px;
            border: none;
            background: #28a745;
            color: white;
            cursor: pointer;
        }

        .input-area button:disabled {
            opacity: .6;
            cursor: default;
        }

        /* Quick questions */
        .quick-questions {
            margin-bottom: 10px;
        }

        .quick-questions p {
            font-size: 13px;
            margin-bottom: 6px;
            color: #555;
        }

        .quick-btn {
            padding: 5px 10px;
            margin: 3px 3px 3px 0;
            border-radius: 20px;
            border: 1px solid #ccc;
            background: #f0f2f5;
            font-size: 12px;
            cursor: pointer;
        }

        .quick-btn:hover {
            background: #e4e6eb;
        }

        /* Support / contact */
        .support-box {
            margin-top: 10px;
            padding: 10px;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 6px;
            font-size: 13px;
        }

        .support-box button {
            margin-top: 5px;
            padding: 6px 10px;
            border-radius: 4px;
            border: none;
            background: #ffc107;
            cursor: pointer;
        }

        .support-form {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .support-form input,
        .support-form textarea {
            width: 100%;
            padding: 6px;
            margin-bottom: 6px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 13px;
        }

        .support-form button {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            background: #28a745;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <h3>Laravel Chatbot</h3>
        <div class="messages" id="messages">
            <div class="quick-questions">
                <p>Common প্রশ্নগুলো থেকে একটা সিলেক্ট করুন:</p>
                <button class="quick-btn" data-text="আপনাদের ডেলিভারি চার্জ কত?">
                    ডেলিভারি চার্জ কত?
                </button>
                <button class="quick-btn" data-text="ডেলিভারি টাইম কতদিন লাগে?">
                    ডেলিভারি টাইম কত?
                </button>
                <button class="quick-btn" data-text="আপনারা কোন কোন জায়গায় ডেলিভারি দেন?">
                    ডেলিভারি এরিয়া
                </button>
                <button class="quick-btn" data-text="রিটার্ন/রিপ্লেসমেন্ট পলিসি কী?">
                    রিটার্ন পলিসি
                </button>
            </div>


        </div>

        <div class="support-box">
                <p>আরো ডিটেইল জানতে চান? আমাদের টিমের সাথে কথা বলতে পারেন।</p>
                <button id="liveSupportBtn">লাইভ সাপোর্টে কথা বলুন</button>
            </div>

            <div class="support-form" id="supportForm" style="display:none;">
                <h4>সাপোর্ট রিকোয়েস্ট ফর্ম</h4>
                <form id="supportRequestForm">
                    <input type="text" name="name" placeholder="আপনার নাম" required>
                    <input type="text" name="phone" placeholder="মোবাইল নাম্বার" required>
                    <textarea name="message" placeholder="কি বিষয়ে জানতে চান?" rows="3" required></textarea>
                    <button type="submit">রিকোয়েস্ট পাঠান</button>
                </form>
                <p id="supportSuccessMsg" style="display:none; font-size:13px; margin-top:5px;"></p>
            </div>

            <div class="msg bot">
                <span>Hi! 😊 আমি আপনার virtual assistant। লিখে দেখুন…</span>
            </div>

        <div class="input-area">
            <input type="text" id="messageInput" placeholder="Type your message..." autocomplete="off">
            <button id="sendBtn">Send</button>
        </div>
    </div>

    <script>
        const sendBtn = document.getElementById('sendBtn');
        const messageInput = document.getElementById('messageInput');
        const messagesDiv = document.getElementById('messages');

        // 🔹 Quick question গুলোর fixed reply
        const quickReplies = {
            "আপনাদের ডেলিভারি চার্জ কত?": "আমাদের ডেলিভারি চার্জ ঢাকার ভিতরে ৬০ টাকা এবং ঢাকার বাইরে ১২০ টাকা।",
            "ডেলিভারি টাইম কতদিন লাগে?": "সাধারণত ঢাকার ভিতরে ১-২ কর্মদিবস এবং ঢাকার বাইরে ২-৪ কর্মদিবস লাগে।",
            "আপনারা কোন কোন জায়গায় ডেলিভারি দেন?": "আমরা সারা বাংলাদেশে কুরিয়ারের মাধ্যমে ডেলিভারি দিয়ে থাকি।",
            "রিটার্ন/রিপ্লেসমেন্ট পলিসি কী?": "যদি ভুল/ডিফেক্টিভ প্রোডাক্ট পান, ৪৮ ঘণ্টার মধ্যে আমাদের সাথে যোগাযোগ করলে রিপ্লেসমেন্ট ব্যবস্থা করা হবে।"
        };

        function appendMessage(text, sender = 'user') {
            const div = document.createElement('div');
            div.classList.add('msg', sender);
            div.innerHTML = `<span>${text}</span>`;
            messagesDiv.appendChild(div);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        // সার্ভারে মেসেজ পাঠানোর common ফাংশন (টাইপ করা মেসেজের জন্য)
        async function sendToServer(text) {
            sendBtn.disabled = true;

            try {
                const res = await fetch("{{ route('chatbot.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message: text })
                });

                const data = await res.json();
                appendMessage(data.reply, 'bot');
            } catch (e) {
                appendMessage('Error হয়েছে! পরে আবার চেষ্টা করুন।', 'bot');
            } finally {
                sendBtn.disabled = false;
                messageInput.focus();
            }
        }

        // ইউজার ইনপুট থেকে পাঠানো (টাইপ করা মেসেজ)
        async function sendMessage() {
            const text = messageInput.value.trim();
            if (!text) return;

            appendMessage(text, 'user');
            messageInput.value = '';

            await sendToServer(text);
        }

        // প্রিমেড প্রশ্ন পাঠানোর জন্য (এখন শুধু fixed reply দেখাবে)
        async function sendQuickQuestion(text) {
            // User message দেখাবে
            appendMessage(text, 'user');

            // Predefined reply বের করা
            const reply = quickReplies[text] ?? "দুঃখিত, এই প্রশ্নের জন্য প্রি-সেট উত্তর নেই।";

            // ছোট্ট delay দিয়ে bot message append করা
            setTimeout(() => {
                appendMessage(reply, 'bot');
            }, 400);
        }

        // ইভেন্ট লিসেনার (টাইপ করা মেসেজ)
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // সব quick-btn এ ক্লিক ইভেন্ট (এখন সার্ভারে যাবে না, শুধু fixed reply)
        document.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const text = this.getAttribute('data-text');
                sendQuickQuestion(text);
            });
        });

        // লাইভ সাপোর্ট বাটনে ক্লিক করলে form দেখাও
        const liveSupportBtn = document.getElementById('liveSupportBtn');
        const supportFormDiv = document.getElementById('supportForm');
        const supportRequestForm = document.getElementById('supportRequestForm');
        const supportSuccessMsg = document.getElementById('supportSuccessMsg');

        liveSupportBtn.addEventListener('click', function () {
            supportFormDiv.style.display = 'block';
        });

        supportRequestForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(supportRequestForm);

            try {
                const res = await fetch("{{ route('support.request') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                });

                const data = await res.json();

                if (data.success) {
                    supportSuccessMsg.textContent = 'ধন্যবাদ! খুব দ্রুতই আমাদের টিম আপনার সাথে যোগাযোগ করবে।';
                    supportSuccessMsg.style.display = 'block';
                    supportRequestForm.reset();
                } else {
                    supportSuccessMsg.textContent = 'কিছু ভুল হয়েছে, পরে আবার চেষ্টা করুন।';
                    supportSuccessMsg.style.display = 'block';
                }
            } catch (e) {
                supportSuccessMsg.textContent = 'Error হয়েছে, পরে আবার চেষ্টা করুন।';
                supportSuccessMsg.style.display = 'block';
            }
        });
    </script>
</body>

</html>
