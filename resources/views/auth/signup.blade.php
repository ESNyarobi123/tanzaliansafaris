<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Tanzalian Safari's</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #d4a373;
            --secondary-color: #2c5530;
            --dark-color: #1a1a1a;
            --light-color: #f8f5f0;
            --accent-color: #ff6b35;
            --text-dark: #333;
            --text-light: #666;
        }
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg,#0b1f16,#2c5530);
            min-height:100vh;
            display:flex;align-items:center;justify-content:center;
            padding:20px;
        }
        .auth-wrapper{
            max-width:950px;width:100%;
            background:#fff;
            border-radius:24px;
            box-shadow:0 20px 60px rgba(0,0,0,0.35);
            display:grid;grid-template-columns:1.1fr 1fr;
            overflow:hidden;
        }
        .auth-hero{
            background:linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.85)),
                url('https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-12_16_42-am.png') center/cover;
            color:#fff;padding:40px 40px 50px;
            display:flex;flex-direction:column;justify-content:space-between;
        }
        .brand{display:flex;align-items:center;gap:10px;}
        .brand-icon{
            width:46px;height:46px;border-radius:50%;
            background:rgba(212,163,115,0.2);
            display:flex;align-items:center;justify-content:center;
            font-size:22px;color:var(--primary-color);
        }
        .brand-text{display:flex;flex-direction:column;}
        .brand-text span:first-child{
            font-family:'Playfair Display',serif;
            font-weight:900;font-size:20px;
        }
        .brand-text span:last-child{font-size:12px;opacity:0.8;}

        .auth-hero-main{margin-top:40px;}
        .auth-hero-main h1{
            font-family:'Playfair Display',serif;
            font-size:30px;margin-bottom:12px;
        }
        .auth-hero-main p{font-size:14px;color:#e5e7eb;line-height:1.7;}

        .hero-pills{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px;}
        .hero-pill{
            font-size:11px;padding:6px 11px;border-radius:999px;
            border:1px solid rgba(212,163,115,0.6);color:#fbbf77;
        }
        .auth-hero-footer{font-size:12px;opacity:0.8;}

        .auth-form-side{
            padding:38px 36px 28px;
            background:#fdfaf6;
            display:flex;flex-direction:column;
            justify-content:flex-start;
            max-height:90vh;
            overflow-y:auto;
        }

        /* Chatbot Styles */
        .chatbot-container{
            width:100%;
            display:none;
        }
        .chatbot-container.active{
            display:block;
        }
        .chatbot-messages{
            max-height:450px;
            overflow-y:auto;
            padding:15px 0;
            margin-bottom:20px;
        }
        .chatbot-message{
            margin-bottom:20px;
            display:flex;
            gap:10px;
            animation:fadeInUp 0.4s ease;
        }
        @keyframes fadeInUp{
            from{opacity:0;transform:translateY(10px);}
            to{opacity:1;transform:translateY(0);}
        }
        .chatbot-avatar{
            width:36px;height:36px;
            border-radius:50%;
            background:var(--primary-color);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-size:16px;
            flex-shrink:0;
        }
        .message-content{
            flex:1;
        }
        .message-bubble{
            background:#fff;
            padding:12px 16px;
            border-radius:18px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
            font-size:14px;
            line-height:1.6;
            color:var(--text-dark);
            border:1px solid #e5e7eb;
        }
        .message-bubble.bot{
            background:linear-gradient(135deg,#fff,#f9f9f9);
        }
        .message-bubble.user{
            background:var(--primary-color);
            color:#fff;
            border-color:var(--primary-color);
            margin-left:auto;
            max-width:80%;
        }
        .chatbot-input-container{
            display:flex;
            gap:10px;
            margin-top:15px;
        }
        .chatbot-input{
            flex:1;
            padding:12px 16px;
            border-radius:25px;
            border:2px solid #e5e7eb;
            font-size:14px;
            outline:none;
            transition:all .3s;
        }
        .chatbot-input:focus{
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(212,163,115,0.1);
        }
        .chatbot-send-btn{
            width:45px;height:45px;
            border-radius:50%;
            border:none;
            background:var(--secondary-color);
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
            transition:all .3s;
            font-size:18px;
        }
        .chatbot-send-btn:hover{
            transform:scale(1.1);
            background:var(--accent-color);
        }
        .chatbot-progress{
            height:4px;
            background:#e5e7eb;
            border-radius:2px;
            margin-bottom:15px;
            overflow:hidden;
        }
        .chatbot-progress-bar{
            height:100%;
            background:linear-gradient(90deg,var(--primary-color),var(--accent-color));
            border-radius:2px;
            transition:width .5s ease;
            width:0%;
        }

        /* Registration Form Styles */
        .registration-form{
            display:none;
        }
        .registration-form.active{
            display:block;
        }
        .auth-header{
            margin-bottom:22px;
            text-align:center;
        }
        .auth-header h2{
            font-size:24px;color:var(--secondary-color);
            font-family:'Playfair Display',serif;margin-bottom:4px;
        }
        .auth-header p{font-size:13px;color:var(--text-light);}
        .form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:14px;}
        label{font-size:13px;color:var(--text-dark);font-weight:500;}
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"]{
            padding:10px 12px;border-radius:10px;border:1px solid #e5e7eb;
            font-size:14px;outline:none;transition:all .2s;background:#fff;
        }
        input:focus{
            border-color:var(--primary-color);
            box-shadow:0 0 0 1px rgba(212,163,115,0.4);
        }
        .alert{
            padding:10px 12px;border-radius:10px;font-size:13px;margin-bottom:12px;
        }
        .alert-error{
            background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;
        }
        .alert ul{margin-left:18px;margin-top:6px;}
        button[type="submit"]{
            margin-top:16px;width:100%;border:none;border-radius:999px;
            padding:11px 16px;background:var(--secondary-color);
            color:#fff;font-weight:600;font-size:15px;
            display:inline-flex;align-items:center;justify-content:center;
            gap:8px;cursor:pointer;
            box-shadow:0 13px 30px rgba(15,23,42,0.35);
            transition:all .25s;
        }
        button[type="submit"]:hover{
            transform:translateY(-1px);
            box-shadow:0 16px 36px rgba(15,23,42,0.45);
        }
        .auth-footer-text{
            margin-top:16px;font-size:11px;color:var(--text-light);text-align:center;
        }
        .auth-footer-text a{color:var(--accent-color);text-decoration:none;font-weight:500;}
        .back-home{
            margin-top:20px;text-align:center;
        }
        .back-home a{font-size:12px;color:var(--secondary-color);text-decoration:none;}
        .back-home a i{margin-right:5px;}

        .start-chat-btn{
            width:100%;
            padding:14px 20px;
            border:none;
            border-radius:999px;
            background:var(--secondary-color);
            color:#fff;
            font-weight:600;
            font-size:15px;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            transition:all .3s;
            box-shadow:0 8px 20px rgba(44,85,48,0.3);
        }
        .start-chat-btn:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 30px rgba(44,85,48,0.4);
            background:var(--accent-color);
        }

        @media(max-width:900px){
            .auth-wrapper{grid-template-columns:1fr;max-width:480px;}
            .auth-hero{display:none;}
            body{background:#f3f4f6;}
        }
        @media(max-width:480px){
            .auth-form-side{padding:26px 18px 20px;}
            .auth-header h2 { font-size: 20px; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-hero">
        <div>
            <div class="brand">
                <div class="brand-icon"><i class="fas fa-mountain-sun"></i></div>
                <div class="brand-text">
                    <span>Tanzalian Safari's</span>
                    <span>Create Your Account</span>
                </div>
            </div>
            <div class="auth-hero-main">
                <h1>Sign up to manage your trips</h1>
                <p>Create an account to save favorite packages and manage your bookings.</p>
                <div class="hero-pills">
                    <div class="hero-pill">Manage bookings</div>
                    <div class="hero-pill">Save favourite packages</div>
                    <div class="hero-pill">Faster checkout</div>
                    <div class="hero-pill">Local support</div>
                </div>
            </div>
        </div>
        <p class="auth-hero-footer">
            Need help? Contact us at <strong>info@tanzaliansafaris.com</strong>.
        </p>
    </div>

    <div class="auth-form-side">
        <!-- Initial Welcome -->
        <div id="welcomeScreen">
            <div class="auth-header">
                <h2>Welcome! 👋</h2>
                <p>Let's register your account step by step</p>
            </div>
            <p style="font-size:14px;color:var(--text-light);line-height:1.7;margin-bottom:25px;text-align:center;">
                We'll ask you a few simple questions to set up your account. You'll be automatically registered and logged in after answering all questions!
            </p>
            <button type="button" class="start-chat-btn" onclick="startChatbot()">
                <i class="fas fa-user-plus"></i> Start Register
            </button>
            <div class="back-home">
                <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to Homepage</a>
            </div>
        </div>

        <!-- Chatbot Container -->
        <div class="chatbot-container" id="chatbotContainer">
            <div class="chatbot-progress">
                <div class="chatbot-progress-bar" id="progressBar"></div>
            </div>
            <div class="chatbot-messages" id="chatMessages">
                <!-- Messages will be inserted here -->
            </div>
            <div class="chatbot-input-container">
                <input type="text" class="chatbot-input" id="chatInput" placeholder="Type your answer..." onkeypress="handleChatKeyPress(event)" autocomplete="off">
                <button class="chatbot-send-btn" onclick="sendChatMessage()" id="sendBtn" type="button">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="registration-form" id="registrationForm">
            <div class="auth-header">
                <h2>Complete Your Registration</h2>
                <p>Please review and confirm your information</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Signup failed:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('signup') }}" method="post" novalidate id="signupForm">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone (optional)</label>
                    <input type="tel" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>

                <p class="auth-footer-text">
                    Already have an account?
                    <a href="{{ route('signin') }}">Sign in instead</a>
                </p>
            </form>

            <div class="back-home">
                <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to Homepage</a>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 0;
    let userData = {};
    const questions = [
        {
            question: "Hi! 👋 What's your full name?",
            field: "name",
            placeholder: "e.g., John Smith"
        },
        {
            question: "Nice to meet you, {name}! 😊 What's your email address?",
            field: "email",
            placeholder: "e.g., john@example.com",
            validation: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) || "Please enter a valid email address"
        },
        {
            question: "Great! 📧 What's your phone number? (Optional - leave empty and press Enter to skip)",
            field: "phone",
            placeholder: "e.g., +255691111111 (or press Enter to skip)",
            optional: true
        },
        {
            question: "Perfect! 🔒 Now, please create a strong password (at least 8 characters)",
            field: "password",
            placeholder: "Enter a secure password",
            validation: (value) => {
                if(value.length < 8) {
                    return "Password must be at least 8 characters long. Please try again.";
                }
                return true;
            },
            isPassword: true
        },
        {
            question: "Almost done! ✅ Please confirm your password to complete registration",
            field: "password_confirmation",
            placeholder: "Re-enter your password",
            isPassword: true,
            validation: (value) => {
                if(!value) {
                    return "Please confirm your password.";
                }
                if(value !== userData.password) {
                    return "Passwords don't match. Please try again.";
                }
                return true;
            }
        }
    ];

    // Check if there are errors on page load (from failed auto-submit)
    window.addEventListener('DOMContentLoaded', function() {
        const errors = @json($errors->any() ?? false);
        if(errors) {
            // Show registration form with errors
            document.getElementById('welcomeScreen').style.display = 'none';
            document.getElementById('chatbotContainer').classList.remove('active');
            document.getElementById('registrationForm').classList.add('active');
            
            // Pre-fill form with old values
            @if(old('name'))
                document.getElementById('name').value = '{{ old("name") }}';
            @endif
            @if(old('email'))
                document.getElementById('email').value = '{{ old("email") }}';
            @endif
            @if(old('phone'))
                document.getElementById('phone').value = '{{ old("phone") }}';
            @endif
        }
    });

    function startChatbot() {
        document.getElementById('welcomeScreen').style.display = 'none';
        document.getElementById('chatbotContainer').classList.add('active');
        askNextQuestion();
    }

    function askNextQuestion() {
        if(currentStep >= questions.length) {
            autoSubmitRegistration();
            return;
        }

        const question = questions[currentStep];
        let questionText = question.question;
        
        // Replace placeholders in question text
        if(question.field === 'email' && userData.name) {
            questionText = questionText.replace('{name}', userData.name.split(' ')[0]);
        }

        // Change input type for passwords
        const chatInput = document.getElementById('chatInput');
        if(question.isPassword) {
            chatInput.type = 'password';
        } else {
            chatInput.type = 'text';
        }

        addBotMessage(questionText);
        updateProgress((currentStep + 1) / questions.length * 100);
        
        // Focus input
        setTimeout(() => {
            chatInput.focus();
        }, 300);
    }

    function handleChatKeyPress(event) {
        if(event.key === 'Enter') {
            sendChatMessage();
        }
    }

    function sendChatMessage() {
        const input = document.getElementById('chatInput');
        const answer = input.value.trim();

        // Check if field is required and answer is empty
        if(!answer && !questions[currentStep].optional) {
            addBotMessage("Please provide an answer to continue.");
            return;
        }

        // Show user's answer (except passwords)
        if(answer) {
            if(!questions[currentStep].isPassword) {
                addUserMessage(answer);
            } else {
                addUserMessage('••••••••');
            }
        } else if(questions[currentStep].optional) {
            // User skipped optional field
            addUserMessage('(Skipped)');
        }

        // Validate answer if provided
        const question = questions[currentStep];
        if(question.validation && answer) {
            const validationResult = question.validation(answer);
            if(validationResult !== true) {
                addBotMessage(validationResult);
                input.value = '';
                return;
            }
        }

        // Store answer (or empty string for optional fields)
        if(!answer && question.optional) {
            userData[question.field] = '';
        } else {
            userData[question.field] = answer;
        }

        input.value = '';
        input.type = 'text'; // Reset to text for next question
        currentStep++;

        // Add a small delay before next question or auto-submit
        setTimeout(() => {
            if(currentStep < questions.length) {
                askNextQuestion();
            } else {
                // All questions answered - auto submit
                autoSubmitRegistration();
            }
        }, 800);
    }

    function addBotMessage(text) {
        const messagesContainer = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chatbot-message';
        messageDiv.innerHTML = `
            <div class="chatbot-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="message-content">
                <div class="message-bubble bot">${text}</div>
            </div>
        `;
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function addUserMessage(text) {
        const messagesContainer = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chatbot-message';
        messageDiv.style.flexDirection = 'row-reverse';
        messageDiv.innerHTML = `
            <div class="chatbot-avatar" style="background: var(--primary-color);">
                <i class="fas fa-user"></i>
            </div>
            <div class="message-content">
                <div class="message-bubble user">${text}</div>
            </div>
        `;
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function updateProgress(percentage) {
        document.getElementById('progressBar').style.width = percentage + '%';
    }

    function autoSubmitRegistration() {
        // Show success message
        addBotMessage("Perfect! 🎉 Creating your account now...");
        
        // Disable input
        const input = document.getElementById('chatInput');
        input.disabled = true;
        input.placeholder = "Creating account...";
        input.style.display = 'none';
        
        // Hide send button and show loading
        const sendBtn = document.getElementById('sendBtn');
        sendBtn.disabled = true;
        sendBtn.style.display = 'none';
        
        // Show loading spinner
        const inputContainer = document.querySelector('.chatbot-input-container');
        const loadingDiv = document.createElement('div');
        loadingDiv.style.textAlign = 'center';
        loadingDiv.style.padding = '20px';
        loadingDiv.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 24px; color: var(--primary-color);"></i><p style="margin-top: 10px; color: var(--text-light); font-size: 14px;">Creating your account...</p>';
        inputContainer.appendChild(loadingDiv);
        
        // Create hidden form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("signup") }}';
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Add required fields
        const requiredFields = [
            { name: 'name', type: 'text', value: userData.name || '' },
            { name: 'email', type: 'email', value: userData.email || '' },
            { name: 'password', type: 'password', value: userData.password || '' }
        ];
        
        requiredFields.forEach(field => {
            const input = document.createElement('input');
            input.type = field.type;
            input.name = field.name;
            input.value = field.value;
            form.appendChild(input);
        });
        
        // Add optional phone field only if provided
        if(userData.phone && userData.phone.trim() !== '') {
            const phoneInput = document.createElement('input');
            phoneInput.type = 'tel';
            phoneInput.name = 'phone';
            phoneInput.value = userData.phone.trim();
            form.appendChild(phoneInput);
        }
        
        // Add password confirmation
        const passwordConfirm = document.createElement('input');
        passwordConfirm.type = 'password';
        passwordConfirm.name = 'password_confirmation';
        passwordConfirm.value = userData.password || '';
        form.appendChild(passwordConfirm);
        
        // Append to body
        document.body.appendChild(form);
        
        // Show loading message
        setTimeout(() => {
            addBotMessage("Almost there... Setting up your account! ⏳");
        }, 800);
        
        // Submit form after short delay
        setTimeout(() => {
            form.submit();
        }, 1500);
    }
</script>
</body>
</html>
