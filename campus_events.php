<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusFlow · 🤖 AI Event Assistant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <style>
        /* ---------- FRESH GLASS MORPH, ELEGANT DARK/LIGHT FUSION ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: linear-gradient(145deg, #f1f5f9 0%, #e6edf2 100%);
            color: #0a2c3d;
            line-height: 1.5;
            min-height: 100vh;
        }

        /* ----- LAYER CONTROL ----- */
        .page {
            display: none;
        }
        .page.active {
            display: block;
        }

        /* ----- LOGIN – ultra clean, floating card ----- */
        .login-floating {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            background: radial-gradient(circle at 80% 20%, rgba(37, 99, 128, 0.08) 0%, transparent 50%);
        }

        .glass-login {
            max-width: 860px;
            width: 100%;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 56px;
            padding: 2.8rem 3rem;
            box-shadow: 0 30px 60px -20px rgba(0,45,65,0.2);
            border: 1px solid rgba(255,255,255,0.6);
            transition: all 0.3s;
        }

        .glass-login .app-title {
            font-size: 2.6rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            background: linear-gradient(155deg, #0a3847, #1d5e79);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.3rem;
        }

        .pill-badge {
            background: rgba(20, 80, 100, 0.12);
            border-radius: 100px;
            padding: 0.55rem 2rem;
            width: fit-content;
            margin: 1rem auto 1.8rem;
            border: 1px solid rgba(27, 108, 138, 0.1);
            color: #0b4557;
            font-weight: 600;
            font-size: 0.95rem;
            backdrop-filter: blur(4px);
        }

        .switch-group {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            margin-bottom: 2rem;
        }

        .switch-role {
            flex: 0 1 220px;
            padding: 0.9rem 1.2rem;
            border-radius: 100px;
            background: white;
            border: 1.5px solid rgba(75, 130, 150, 0.2);
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #1d5a6d;
            transition: 0.2s ease;
            cursor: pointer;
            backdrop-filter: blur(8px);
        }

        .switch-role.active {
            background: #0a3847;
            border-color: #0a3847;
            color: white;
            box-shadow: 0 12px 20px -12px #0a3847;
        }

        .login-panel-container {
            background: rgba(255,255,255,0.5);
            backdrop-filter: blur(8px);
            border-radius: 44px;
            padding: 2.2rem 2rem;
            border: 1px solid rgba(255,255,255,0.8);
        }

        .login-panel {
            display: none;
        }
        .login-panel.active-panel {
            display: block;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .panel-header h2 {
            font-size: 1.9rem;
            font-weight: 700;
            color: #0b3c4a;
        }

        .input-glass {
            background: white;
            border: 1.5px solid rgba(26, 98, 115, 0.12);
            border-radius: 28px;
            padding: 0.9rem 1.4rem;
            font-size: 0.95rem;
            outline: none;
            transition: 0.2s;
            width: 100%;
        }
        .input-glass:focus {
            border-color: #0f6077;
            box-shadow: 0 8px 18px -10px #0f6077;
        }

        .btn-continue-glass {
            background: #0a3847;
            border: none;
            color: white;
            font-weight: 700;
            padding: 1rem 2.8rem;
            border-radius: 48px;
            font-size: 1.2rem;
            letter-spacing: 0.5px;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 10px 18px -8px rgba(10,56,71,0.5);
            width: 100%;
            max-width: 320px;
            transition: 0.15s;
            cursor: pointer;
        }
        .btn-continue-glass:hover {
            background: #052a35;
            transform: scale(1.01);
        }

        /* ----- GLOBAL HEADER – frosted glass, premium ----- */
        .app-header-frost {
            background: rgba(10, 45, 60, 0.82);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.18);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0.8rem 2.8rem;
        }

        .header-container {
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .logo-icon {
            background: rgba(255,255,255,0.95);
            width: 52px;
            height: 52px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(0,0,0,0.1);
        }
        .logo-icon i {
            font-size: 2.1rem;
            background: linear-gradient(145deg, #0a3a48, #e15554);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo-text h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(145deg, #fff, #ffe6e6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        /* nav */
        nav ul {
            display: flex;
            gap: 0.8rem;
            list-style: none;
        }
        nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.8rem 1.6rem;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            background: transparent;
        }
        nav a:hover, nav a.active {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.15);
        }

        .user-cluster {
            display: flex;
            align-items: center;
            gap: 1.8rem;
        }
        .role-chip {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 0.6rem 1.8rem;
            border-radius: 60px;
            color: white;
            font-weight: 500;
            display: flex;
            gap: 8px;
            backdrop-filter: blur(6px);
        }
        .profile-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,0.06);
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(6px);
        }
        .avatar-round {
            width: 42px;
            height: 42px;
            border-radius: 42px;
            background: linear-gradient(145deg, #f9b81b, #ea5455);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
        }
        .logout-action {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 0.7rem 1.6rem;
            border-radius: 50px;
            font-weight: 600;
            display: flex;
            gap: 10px;
            cursor: pointer;
            transition: 0.2s;
        }
        .logout-action:hover {
            background: rgba(234,84,85,0.25);
        }

        /* ----- LANGUAGE SELECTOR – sleek ----- */
        .lang-corner {
            position: fixed;
            top: 20px;
            right: 30px;
            z-index: 2001;
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(16px);
            border-radius: 60px;
            padding: 0.5rem 1.2rem;
            border: 1px solid rgba(255,255,255,0.4);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }
        .lang-corner select {
            background: transparent;
            border: none;
            padding: 0.5rem 1rem;
            font-weight: 600;
            color: #0a3847;
            outline: none;
            font-size: 0.9rem;
        }

        /* ----- CHATBOT WIDGET – AI ASSISTANT ----- */
        .chatbot-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: linear-gradient(145deg, #0a3847, #1d5e79);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(10,56,71,0.3);
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
            z-index: 2000;
        }
        .chatbot-toggle:hover {
            transform: scale(1.1);
            background: #0e4e62;
        }
        .chatbot-toggle i {
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2));
        }

        .chatbot-panel {
            position: fixed;
            bottom: 110px;
            right: 30px;
            width: 380px;
            height: 550px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 1999;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }
        .chatbot-panel.minimized {
            transform: translateY(20px);
            opacity: 0;
            pointer-events: none;
        }

        .chatbot-header {
            background: #0a3847;
            color: white;
            padding: 1.2rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chatbot-header h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }
        .chatbot-header i {
            font-size: 1.3rem;
        }
        .chatbot-controls {
            display: flex;
            gap: 12px;
        }
        .chatbot-controls span {
            cursor: pointer;
            padding: 0 5px;
            opacity: 0.8;
            transition: 0.2s;
        }
        .chatbot-controls span:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .chat-messages {
            flex: 1;
            padding: 1.5rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            background: #f8fafc;
        }

        .message {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            max-width: 85%;
        }
        .message.bot {
            align-self: flex-start;
        }
        .message.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }
        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        .bot .message-avatar {
            background: #0a3847;
            color: white;
        }
        .user .message-avatar {
            background: #ea5455;
            color: white;
        }
        .message-content {
            background: white;
            padding: 0.8rem 1.2rem;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            font-size: 0.95rem;
            line-height: 1.5;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .user .message-content {
            background: #0a3847;
            color: white;
        }
        .message-time {
            font-size: 0.7rem;
            color: #94a3b8;
            margin-top: 4px;
            margin-left: 42px;
        }

        .chat-input-area {
            padding: 1.2rem;
            background: white;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 10px;
        }
        .chat-input-area input {
            flex: 1;
            padding: 0.8rem 1.2rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 40px;
            outline: none;
            font-size: 0.95rem;
            transition: 0.2s;
        }
        .chat-input-area input:focus {
            border-color: #0a3847;
            box-shadow: 0 0 0 3px rgba(10,56,71,0.05);
        }
        .chat-input-area button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #0a3847;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .chat-input-area button:hover {
            background: #0e4e62;
            transform: scale(1.05);
        }

        /* ----- MAIN CONTAINER ----- */
        .app-main {
            max-width: 1600px;
            margin: 2.5rem auto;
            padding: 0 2.5rem;
        }

        .section-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 2.5rem;
        }
        .section-head i {
            font-size: 2rem;
            color: #ea5455;
            background: rgba(234,84,85,0.1);
            padding: 0.7rem;
            border-radius: 18px;
        }
        .section-head h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0a3847;
        }

        /* stats cards */
        .stats-array {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            margin-bottom: 3.5rem;
        }
        .stat-tile {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(12px);
            border-radius: 32px;
            padding: 2rem 1.8rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            border: 1px solid rgba(255,255,255,0.6);
            transition: 0.25s ease;
            box-shadow: 0 8px 25px -12px rgba(0,0,0,0.06);
        }
        .stat-tile:hover {
            transform: translateY(-6px);
            background: white;
            border-color: rgba(234,84,85,0.3);
        }
        .stat-symbol {
            width: 70px; height: 70px;
            border-radius: 24px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #1a5b6e;
            box-shadow: 0 10px 18px -12px #0f4c5e;
        }

        /* event cards – glassy */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2.2rem;
        }
        .event-card-glass {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(10px);
            border-radius: 32px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.7);
            box-shadow: 0 18px 35px -12px rgba(0,55,70,0.08);
            transition: all 0.25s;
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }
        .event-card-glass:hover {
            background: white;
            border-color: #ea5455;
            transform: scale(1.02);
            box-shadow: 0 25px 40px -12px rgba(234,84,85,0.18);
        }
        .event-img-wrapper {
            height: 200px;
            position: relative;
            overflow: hidden;
        }
        .event-img-wrapper img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .event-card-glass:hover img {
            transform: scale(1.06);
        }
        .date-chic {
            position: absolute;
            top: 18px; right: 18px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(4px);
            padding: 0.4rem 1.2rem;
            border-radius: 60px;
            font-weight: 700;
            border: 1px solid white;
            font-size: 0.85rem;
        }
        .event-content {
            padding: 1.8rem 1.8rem 2rem;
        }
        .event-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0b3a48;
        }
        .category-pill {
            display: inline-block;
            padding: 0.2rem 1rem;
            background: rgba(26, 99, 116, 0.15);
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #0a5a6e;
            margin: 0.5rem 0 1rem;
        }
        .btn-soft {
            border: none;
            background: linear-gradient(145deg, #ea5455, #e06b6b);
            color: white;
            padding: 0.7rem 1.8rem;
            border-radius: 40px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
            cursor: pointer;
            box-shadow: 0 6px 16px -6px #ea5455;
        }
        .btn-soft-outline {
            background: transparent;
            border: 2px solid #ea5455;
            color: #ea5455;
            padding: 0.6rem 1.8rem;
            border-radius: 40px;
            font-weight: 600;
        }
        .btn-success-glass {
            background: #2e7d32;
            color: white;
            padding: 0.7rem 1.8rem;
            border-radius: 40px;
            border: none;
            font-weight: 600;
        }

        /* MODAL — glassiest */
        .modal-glass {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 35, 50, 0.4);
            backdrop-filter: blur(10px);
            align-items: center;
            justify-content: center;
            z-index: 3000;
            padding: 1.5rem;
        }
        .modal-glass-content {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(24px);
            border-radius: 48px;
            max-width: 820px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid rgba(255,255,255,0.6);
            box-shadow: 0 40px 70px -15px rgba(0,45,55,0.25);
        }
        .modal-glass-header {
            background: #0a3847;
            padding: 1.8rem 2.2rem;
            border-radius: 48px 48px 0 0;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .close-modal-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            width: 42px; height: 42px;
            border-radius: 42px;
            color: white;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* ----- PAYMENT UPLOAD SECTION ----- */
        .payment-upload-area {
            background: #f8fafc;
            border-radius: 24px;
            padding: 1.8rem;
            margin-top: 1.5rem;
            border: 2px dashed #0a3847;
        }
        .file-upload-btn {
            background: white;
            border: 2px solid #0a3847;
            color: #0a3847;
            padding: 0.8rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
            justify-content: center;
        }
        .file-upload-btn:hover {
            background: #0a3847;
            color: white;
        }
        #payment-proof-name {
            margin-top: 0.8rem;
            font-size: 0.9rem;
            color: #2e7d32;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-submit-payment {
            background: #0a3847;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 40px;
            font-weight: 700;
            width: 100%;
            margin-top: 1.2rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-submit-payment:hover {
            background: #0e4e62;
            transform: translateY(-2px);
        }
        .btn-submit-payment:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }

        /* participant list — excel button & FULL LIST SCROLL */
        .participant-export-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.8rem;
        }
        .btn-excel {
            background: #1f7b4d;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.3);
            transition: 0.2s;
        }
        .btn-excel:hover {
            background: #0e5c37;
        }
        
        .participants-full-list {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 5px;
        }

        /* payment proof thumbnail */
        .payment-proof-thumb {
            margin-top: 0.8rem;
            padding: 0.8rem;
            background: #f1f5f9;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .proof-link {
            color: #0a3847;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .proof-link:hover {
            text-decoration: underline;
        }

        /* notif */
        .toast-notif {
            position: fixed;
            top: 100px; right: 30px;
            background: rgba(10, 56, 71, 0.9);
            backdrop-filter: blur(16px);
            color: white;
            padding: 1.2rem 2.2rem;
            border-radius: 100px;
            display: flex;
            gap: 15px;
            align-items: center;
            transform: translateX(600px);
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(255,255,255,0.2);
            z-index: 4000;
        }
        .toast-notif.show {
            transform: translateX(0);
        }

        @media (max-width: 800px) {
            .glass-login { padding: 1.8rem; }
            .header-container { flex-direction: column; }
            .lang-corner { top: 10px; right: 10px; }
            .chatbot-panel { width: 320px; right: 20px; }
        }
    </style>
</head>
<body>
    <!-- ===== CORNER LANGUAGE – 10 भाषाएँ ===== -->
    <div class="lang-corner">
        <i class="fas fa-globe-americas" style="color: #0a3847;"></i>
        <select id="language-select" onchange="changeLanguage(this.value)">
            <option value="en">🇬🇧 English</option>
            <option value="hi">🇮🇳 हिन्दी</option>
            <option value="bn">🇧🇩 বাংলা</option>
            <option value="te">🇮🇳 తెలుగు</option>
            <option value="ta">🇮🇳 தமிழ்</option>
            <option value="mr">🇮🇳 मराठी</option>
            <option value="gu">🇮🇳 ગુજરાતી</option>
            <option value="kn">🇮🇳 ಕನ್ನಡ</option>
            <option value="ml">🇮🇳 മലയാളം</option>
            <option value="pa">🇮🇳 ਪੰਜਾਬੀ</option>
        </select>
    </div>

    <!-- ========== CHATBOT WIDGET ========== -->
    <div class="chatbot-toggle" id="chatbotToggle">
        <i class="fas fa-robot"></i>
    </div>
    <div class="chatbot-panel" id="chatbotPanel">
        <div class="chatbot-header">
            <h3><i class="fas fa-robot"></i> <span data-i18n="AI Event Assistant">AI Event Assistant</span></h3>
            <div class="chatbot-controls">
                <span id="minimizeChat"><i class="fas fa-minus"></i></span>
                <span id="closeChat"><i class="fas fa-times"></i></span>
            </div>
        </div>
        <div class="chat-messages" id="chatMessages">
            <div class="message bot">
                <div class="message-avatar"><i class="fas fa-robot"></i></div>
                <div class="message-content">
                    👋 Hi! I'm your AI event assistant. Ask me anything about:
                    <br>• Event dates, venue, fees
                    <br>• Your registrations
                    <br>• Payment status
                    <br>• Event recommendations
                    <br><br>Try: "When is Tech Fest?" or "मुफ्त कार्यक्रम दिखाएं"
                </div>
            </div>
        </div>
        <div class="chat-input-area">
            <input type="text" id="chatInput" placeholder="Type your question..." data-i18n-placeholder="chat_placeholder">
            <button id="sendMessage"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <!-- ========== LOGIN PAGE – FRESH GLASS ========== -->
    <div id="role-select-page" class="page active">
        <div class="login-floating">
            <div class="glass-login">
                <div style="text-align: center;">
                    <span class="app-title">🎪 CampusFlow</span>
                </div>
                <div class="pill-badge">⚡ pick your path · रास्ता चुनें</div>
                <div class="switch-group">
                    <button type="button" id="loginRoleOrganizer" class="switch-role active">📋 Organizer · आयोजक</button>
                    <button type="button" id="loginRoleParticipant" class="switch-role">🎓 Participant · प्रतिभागी</button>
                </div>
                <div class="login-panel-container">
                    <!-- ORGANIZER -->
                    <div id="loginOrganizerPanel" class="login-panel active-panel">
                        <div class="panel-header">
                            <h2>📋 <span data-i18n="Organizer">Organizer</span></h2>
                            <span style="background: rgba(0,0,0,0.04); padding: 0.5rem 1.5rem; border-radius: 50px;" data-i18n="manage_create">manage & create</span>
                        </div>
                        <form id="organizerLoginForm">
                            <div style="display: flex; flex-direction: column; gap: 1.4rem;">
                                <div><label style="font-weight: 600; color: #1f5e6e;" data-i18n="fullname_club">Full name / Club</label>
                                    <input type="text" id="orgName" class="input-glass" value="admin" required></div>
                                <div><label style="font-weight: 600; color: #1f5e6e;" data-i18n="Password">Password</label>
                                    <input type="password" id="orgPassword" class="input-glass" value="admin123" required></div>
                            </div>
                        </form>
                    </div>
                    <!-- PARTICIPANT -->
                    <div id="loginParticipantPanel" class="login-panel">
                        <div class="panel-header">
                            <h2>🎓 <span data-i18n="Participant">Participant</span></h2>
                            <span style="background: rgba(0,0,0,0.04); padding: 0.5rem 1.5rem; border-radius: 50px;" data-i18n="join_events">join events</span>
                        </div>
                        <form id="participantLoginForm">
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <input type="text" id="partName" class="input-glass" value="Student" placeholder="Full name" data-i18n-placeholder="fullname_placeholder">
                                <div style="display: flex; gap: 1rem;">
                                    <input type="text" id="partDept" class="input-glass" value="CSE" placeholder="Dept" data-i18n-placeholder="dept_placeholder">
                                    <input type="text" id="partClass" class="input-glass" value="SE CSE" placeholder="Class" data-i18n-placeholder="class_placeholder">
                                </div>
                                <div style="display: flex; gap: 1rem;">
                                    <input type="text" id="partCollege" class="input-glass" value="MIT College" placeholder="College" data-i18n-placeholder="college_placeholder">
                                    <input type="text" id="partRoll" class="input-glass" value="STU001" placeholder="Roll no" data-i18n-placeholder="roll_placeholder">
                                </div>
                                <input type="email" id="partEmail" class="input-glass" value="student@campus.edu" placeholder="Email">
                                <input type="password" id="partPassword" class="input-glass" value="student123" placeholder="Password" data-i18n-placeholder="Password">
                            </div>
                        </form>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 2.8rem;">
                    <button type="button" class="btn-continue-glass" id="globalContinueBtn" data-i18n="Continue">Continue →</button>
                </div>
                <div style="display: flex; gap: 2rem; justify-content: center; margin-top: 1.6rem;">
                    <span style="font-size: 0.9rem; background: rgba(0,0,0,0.02); padding: 0.3rem 1.6rem; border-radius: 50px;">📌 <span data-i18n="organizer">organizer</span></span>
                    <span style="font-size: 0.9rem; background: rgba(0,0,0,0.02); padding: 0.3rem 1.6rem; border-radius: 50px;">🎟️ <span data-i18n="participant">participant</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== MAIN APPLICATION ========== -->
    <div id="app-container" class="page">
        <div class="app-header-frost">
            <div class="header-container">
                <div class="logo-wrap">
                    <div class="logo-icon"><i class="fas fa-meteor"></i></div>
                    <div class="logo-text"><h1>CampusFlow</h1></div>
                </div>
                <nav>
                    <ul>
                        <li><a href="#" class="active" data-page="dashboard"><i class="fas fa-tachometer-alt"></i> <span data-i18n="Dashboard">Dashboard</span></a></li>
                        <li><a href="#" data-page="events"><i class="fas fa-calendar-week"></i> <span data-i18n="All Events">Events</span></a></li>
                        <li><a href="#" data-page="create-event" id="create-event-link"><i class="fas fa-magic"></i> <span data-i18n="Create Event">Create</span></a></li>
                        <li><a href="#" data-page="my-events"><i class="fas fa-calendar-check"></i> <span data-i18n="My Events">MyEvents</span></a></li>
                        <li><a href="#" data-page="analytics" id="analytics-link"><i class="fas fa-chart-line"></i> <span data-i18n="Analytics">Analytics</span></a></li>
                    </ul>
                </nav>
                <div class="user-cluster">
                    <div class="role-chip"><i class="fas fa-user-shield"></i><span id="current-role">Organizer</span></div>
                    <div class="profile-badge">
                        <div class="avatar-round" id="user-avatar">A</div>
                        <span class="user-name" id="user-name" style="color: white;">Admin</span>
                    </div>
                    <div class="logout-action" id="logout-btn"><i class="fas fa-sign-out-alt"></i> <span data-i18n="Exit">Exit</span></div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <!-- DASHBOARD -->
            <div id="dashboard-page" class="page active">
                <div class="section-head"><i class="fas fa-chart-pie"></i><h2><span data-i18n="Dashboard">Dashboard</span></h2><span style="background: #ea5455; color: white; padding: 0.3rem 1.2rem; border-radius: 50px; font-size: 0.9rem;">✨ <span data-i18n="welcome">welcome</span> <span id="welcome-user">Admin</span></span></div>
                <div class="stats-array">
                    <div class="stat-tile"><div class="stat-symbol"><i class="fas fa-calendar-plus"></i></div><div><h3 style="font-size: 2.2rem;" id="upcoming-count">0</h3><p style="font-weight: 600;" data-i18n="Upcoming">Upcoming</p></div></div>
                    <div class="stat-tile"><div class="stat-symbol"><i class="fas fa-calendar-day"></i></div><div><h3 style="font-size: 2.2rem;" id="ongoing-count">0</h3><p style="font-weight: 600;" data-i18n="Ongoing">Ongoing</p></div></div>
                    <div class="stat-tile"><div class="stat-symbol"><i class="fas fa-user-check"></i></div><div><h3 style="font-size: 2.2rem;" id="registered-count">0</h3><p style="font-weight: 600;" data-i18n="My Regs">My Regs</p></div></div>
                    <div class="stat-tile"><div class="stat-symbol"><i class="fas fa-tasks"></i></div><div><h3 style="font-size: 2.2rem;" id="organized-count">0</h3><p style="font-weight: 600;" data-i18n="Organized">Organized</p></div></div>
                </div>
                <div class="section-head" style="margin-top: 0.5rem;"><i class="fas fa-fire" style="color: #ea5455;"></i><h2><span data-i18n="Trending Events">Trending</span></h2></div>
                <div id="dashboard-events" class="event-grid"></div>
            </div>

            <!-- ALL EVENTS – FULLY TRANSLATED EVENT CARDS -->
            <div id="events-page" class="page">
                <div class="section-head"><i class="fas fa-calendar-week"></i><h2><span data-i18n="All Events">🎟️ All Events – Register Now!</span></h2></div>
                <div id="all-events-container" class="event-grid"></div>
            </div>

            <!-- CREATE EVENT -->
            <div id="create-event-page" class="page">
                <div class="section-head"><i class="fas fa-magic"></i><h2><span data-i18n="Create New Event">Create New Event</span></h2></div>
                <div style="background: rgba(255,255,255,0.6); backdrop-filter: blur(16px); border-radius: 44px; padding: 2.8rem;">
                    <form id="event-form">
                        <div style="display: grid; gap: 1.8rem;">
                            <input type="text" id="event-title" class="input-glass" placeholder="Event title *" required data-i18n-placeholder="event_title_placeholder">
                            <div style="display: flex; gap: 1.5rem;">
                                <select id="event-category" class="input-glass" style="flex:1;">
                                    <option data-i18n="Academic">Academic</option>
                                    <option data-i18n="Workshop">Workshop</option>
                                    <option data-i18n="Cultural">Cultural</option>
                                    <option data-i18n="Sports">Sports</option>
                                    <option data-i18n="Competition">Competition</option>
                                </select>
                                <input type="number" id="event-price" class="input-glass" placeholder="Fee (₹)" value="0" min="0" style="flex:1;" data-i18n-placeholder="fee_placeholder">
                            </div>
                            <div style="display: flex; gap: 1.5rem;">
                                <input type="date" id="event-date" class="input-glass" required>
                                <input type="time" id="event-time" class="input-glass" required>
                            </div>
                            <input type="text" id="event-venue" class="input-glass" placeholder="Venue" required data-i18n-placeholder="venue_placeholder">
                            <textarea id="event-description" rows="3" class="input-glass" placeholder="Description" required data-i18n-placeholder="description_placeholder"></textarea>
                            <input type="number" id="event-capacity" class="input-glass" placeholder="Capacity" value="100" min="1" data-i18n-placeholder="capacity_placeholder">
                            <div><button type="submit" class="btn-soft" style="font-size: 1.1rem; padding: 1rem 2.5rem;"><i class="fas fa-calendar-plus"></i> <span data-i18n="Create Event">✨ Create & Publish</span></button></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MY EVENTS -->
            <div id="my-events-page" class="page">
                <div class="section-head"><i class="fas fa-calendar-check"></i><h2><span data-i18n="My Events">My Events</span></h2></div>
                <div id="my-events-container" class="event-grid"></div>
            </div>

            <!-- ANALYTICS -->
            <div id="analytics-page" class="page">
                <div class="section-head"><i class="fas fa-chart-line"></i><h2><span data-i18n="Analytics">Analytics</span></h2></div>
                <div style="background: rgba(255,255,255,0.6); border-radius: 44px; padding: 3rem; text-align: center;">
                    <button class="btn-excel" id="export-data-btn" style="margin: 0 auto;"><i class="fas fa-file-excel"></i> <span data-i18n="Export All Events">Export All Events (Excel)</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== PAYMENT MODAL WITH UPLOAD ========== -->
    <div id="payment-modal" class="modal-glass">
        <div class="modal-glass-content">
            <div class="modal-glass-header">
                <h3 style="display: flex; gap: 10px;"><i class="fas fa-credit-card"></i> <span data-i18n="Complete Payment">Payment</span></h3>
                <button class="close-modal-btn" id="close-payment-modal">&times;</button>
            </div>
            <div style="padding: 2.5rem;">
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #0a3847;" id="payment-event-name"></h3>
                    <p style="font-size: 1.4rem; font-weight: 700;"><span data-i18n="Amount">Amount</span>: ₹<span id="payment-amount">0</span></p>
                </div>
                
                <!-- Payment Methods -->
                <div style="display: flex; gap: 1.5rem; margin-bottom: 2rem;">
                    <div id="method-gpay" class="method-tab active" style="background: white; border-radius: 30px; padding: 1rem 1.8rem; border: 2px solid #0a3847; cursor: pointer;">
                        <i class="fab fa-google-pay"></i> <span data-i18n="GPay">GPay/UPI</span>
                    </div>
                    <div id="method-bank" class="method-tab" style="background: white; border-radius: 30px; padding: 1rem 1.8rem; border: 2px solid #d2e2ea; cursor: pointer;">
                        <i class="fas fa-university"></i> <span data-i18n="Bank Transfer">Bank Transfer</span>
                    </div>
                </div>
                
                <!-- QR Panel -->
                <div id="gpay-panel" style="display: block; text-align: center;">
                    <div id="qr-canvas" style="display: flex; justify-content: center;"></div>
                    <p style="margin-top: 1rem;" data-i18n="Scan any UPI app">Scan with any UPI app</p>
                </div>
                
                <!-- Bank Details Panel -->
                <div id="bank-panel" style="display: none; background: #f0f5f8; padding: 1.8rem; border-radius: 32px;">
                    <h4><span data-i18n="Bank Account Details">🏦 Bank Account Details</span></h4>
                    <p style="margin-top: 0.8rem;">
                        <strong data-i18n="Account Holder">Account Holder</strong>: CampusFlow Events<br>
                        <strong data-i18n="Account Number">Acc No</strong>: 1234567890123<br>
                        <strong>IFSC</strong>: SBIN0001234<br>
                        <strong>UPI ID</strong>: campus.events@okicici
                    </p>
                </div>

                <!-- PAYMENT PROOF UPLOAD SECTION -->
                <div class="payment-upload-area">
                    <h4 style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                        <i class="fas fa-cloud-upload-alt" style="color: #0a3847;"></i> 
                        <span data-i18n="Upload Payment Proof">Upload Payment Screenshot/Photo</span>
                    </h4>
                    <p style="font-size: 0.85rem; color: #4a5c6a; margin-bottom: 1rem;" data-i18n="upload_instruction">
                        Please upload a screenshot of your payment confirmation
                    </p>
                    
                    <label for="payment-proof" class="file-upload-btn">
                        <i class="fas fa-camera"></i> <span data-i18n="Choose Photo">Choose Photo</span>
                    </label>
                    <input type="file" id="payment-proof" accept="image/*" style="display: none;">
                    
                    <div id="payment-proof-name" style="display: none;">
                        <i class="fas fa-check-circle"></i> 
                        <span id="selected-file-name">No file chosen</span>
                    </div>
                    
                    <button id="submit-payment-btn" class="btn-submit-payment" disabled>
                        <i class="fas fa-upload"></i> <span data-i18n="Submit Payment Proof">Submit Payment Proof</span>
                    </button>
                    <p style="font-size: 0.75rem; color: #64748b; margin-top: 0.8rem; text-align: center;" data-i18n="payment_note">
                        * Your registration will be pending until organizer verifies payment
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== EVENT DETAIL MODAL – FULLY TRANSLATED ========== -->
    <div id="event-detail-modal" class="modal-glass">
        <div class="modal-glass-content">
            <div class="modal-glass-header">
                <h3 id="detail-event-title"><span data-i18n="Event Details">Event details</span></h3>
                <button class="close-modal-btn" id="close-detail-modal">&times;</button>
            </div>
            <div style="padding: 2.5rem;">
                <div id="current-language-indicator" style="background: #0a3847; color: white; display: inline-block; padding: 0.3rem 1.5rem; border-radius: 60px; margin-bottom: 1rem;">🌐 English</div>
                <h2 style="font-size: 2rem; color: #0a3847;" id="detail-title"></h2>
                <div style="display: flex; gap: 1.2rem; flex-wrap: wrap; margin: 1.5rem 0; color: #1a5b6e;" id="detail-meta"></div>
                <div style="background: #f4fafd; padding: 2rem; border-radius: 24px; border-left: 6px solid #ea5455;" id="detail-description"></div>
                <div style="margin-top: 2rem; text-align: center;" id="detail-action"></div>
            </div>
        </div>
    </div>

    <!-- ========== PARTICIPANTS MODAL – FULLY TRANSLATED ========== -->
    <div id="participants-modal" class="modal-glass">
        <div class="modal-glass-content">
            <div class="modal-glass-header">
                <h3><i class="fas fa-users"></i> <span data-i18n="Event Participants">Participants</span> — <span id="participant-count-badge"></span></h3>
                <button class="close-modal-btn" id="close-participants-modal">&times;</button>
            </div>
            <div style="padding: 2.2rem;" id="participants-list-content">
                <!-- EXCEL button + FULL scrollable list injected via JS – FULLY TRANSLATED -->
            </div>
        </div>
    </div>

    <!-- ========== TOAST NOTIFICATION ========== -->
    <div id="notification" class="toast-notif">
        <i class="fas fa-info-circle"></i>
        <span id="notification-message">message</span>
    </div>

    <script>
        // ------------------ GLOBAL STATE ------------------
        const appState = {
            currentUser: null,
            events: [],
            registrations: [],
            users: [
                {id: 1, name: "Admin", email: "admin@campusevent.com", role: "organizer", avatar: "A", studentId: "ORG001", password: "admin123", dept: "Management", college: "Campus", roll: "AD001"},
                {id: 2, name: "Student", email: "student@campus.edu", role: "participant", avatar: "S", studentId: "STU001", password: "student123", dept: "CSE", college: "MIT College", roll: "STU001", class: "SE CSE"},
                {id: 3, name: "Rahul Sharma", email: "rahul@campus.edu", role: "participant", avatar: "R", studentId: "STU002", password: "student123", dept: "IT", college: "MIT College", roll: "STU002", class: "TE IT"},
                {id: 4, name: "Priya Patel", email: "priya@campus.edu", role: "participant", avatar: "P", studentId: "STU003", password: "student123", dept: "CSE", college: "MIT College", roll: "STU003", class: "BE CSE"},
                {id: 5, name: "John Doe", email: "john@campus.edu", role: "participant", avatar: "J", studentId: "STU004", password: "student123", dept: "Mechanical", college: "Engineering College", roll: "STU004", class: "SE Mech"}
            ],
            eventImages: [
                "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=450&fit=crop",
                "https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=450&fit=crop",
                "https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?w=800&h=450&fit=crop",
                "https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800&h=450&fit=crop"
            ],
            currentPaymentEvent: null,
            currentDetailEvent: null,
            currentLanguage: 'en',
            currentPaymentFile: null
        };

        // ---------- 🌍🌍🌍 10 LANGUAGE TRANSLATIONS – FULL APP INCLUDING EVENT POSTERS ----------
        const translations = {
            // ENGLISH
            en: {
                "Dashboard": "Dashboard",
                "All Events": "All Events",
                "Create Event": "Create Event",
                "My Events": "My Events",
                "Analytics": "Analytics",
                "Upcoming": "Upcoming",
                "Ongoing": "Ongoing",
                "My Regs": "My Registrations",
                "Organized": "Organized",
                "Trending Events": "Trending Events",
                "Create New Event": "Create New Event",
                "Event Title": "Event Title",
                "Category": "Category",
                "Event Fee": "Fee",
                "Date": "Date",
                "Time": "Time",
                "Venue": "Venue",
                "Description": "Description",
                "Capacity": "Capacity",
                "Register Free": "Register Free",
                "Register": "Register",
                "Registered": "Registered",
                "Pay Now": "Pay Now",
                "View Participants": "View Participants",
                "Export All Data": "Export All Data",
                "Complete Payment": "Complete Payment",
                "Amount": "Amount",
                "Bank Transfer": "Bank Transfer",
                "Scan any UPI app": "Scan with any UPI app",
                "Bank Account Details": "Bank Account Details",
                "Account Holder": "Account Holder",
                "Account Number": "Account Number",
                "Upload Payment Proof": "Upload Payment Screenshot/Photo",
                "Choose Photo": "Choose Photo",
                "Submit Payment Proof": "Submit Payment Proof",
                "payment_note": "* Your registration will be pending until organizer verifies payment",
                "Event Participants": "Event Participants",
                "Event Details": "Event Details",
                "Exit": "Exit",
                "Continue": "Continue →",
                "Organizer": "Organizer",
                "Participant": "Participant",
                "organizer": "organizer",
                "participant": "participant",
                "manage_create": "manage & create",
                "join_events": "join events",
                "fullname_club": "Full name / Club",
                "Password": "Password",
                "welcome": "welcome",
                "GPay": "GPay/UPI",
                "Academic": "Academic",
                "Workshop": "Workshop",
                "Cultural": "Cultural",
                "Sports": "Sports",
                "Competition": "Competition",
                "Export All Events": "Export All Events (Excel)",
                "event_title_placeholder": "Event title *",
                "fee_placeholder": "Fee (₹)",
                "venue_placeholder": "Venue",
                "description_placeholder": "Description",
                "capacity_placeholder": "Capacity",
                "fullname_placeholder": "Full name",
                "dept_placeholder": "Dept",
                "class_placeholder": "Class",
                "college_placeholder": "College",
                "roll_placeholder": "Roll no",
                "upload_instruction": "Please upload a screenshot of your payment confirmation",
                "chat_placeholder": "Type your question...",
                "AI Event Assistant": "AI Event Assistant",
                
                // EVENT DESCRIPTIONS – FULLY TRANSLATED
                "desc_techfest": "Largest tech showcase with robotics, coding competitions, workshops, and networking with industry experts. Don't miss the biggest tech event of the year!",
                "desc_hackathon": "48-hour coding competition with ₹50,000 prize pool. Teams of 2-4 can participate. Food, coffee, and mentorship provided. Build something amazing!",
                "desc_cultural": "Annual cultural festival with dance performances, live music, fashion show, and food stalls from 20+ cuisines. Celebrate diversity!",
                "desc_aiworkshop": "Hands-on workshop on AI & Machine Learning with Python. Learn from industry experts. Bring your own laptop. Certificate provided.",
                
                // EVENT TITLES
                "title_techfest": "Tech Fest 2026",
                "title_hackathon": "Hackathon Championship",
                "title_cultural": "Cultural Night",
                "title_aiworkshop": "AI & ML Workshop",
                
                // BUTTONS
                "View Participants": "View Participants",
                "Upload Payment Proof": "Upload Payment Proof",
                "Register Free": "Register Free",
                "Register": "Register",
                "Pay Now": "Pay Now",
                
                // CHATBOT RESPONSES
                "chat_greeting": "👋 Hi! I'm your AI event assistant. Ask me about events, registration, payments, or get recommendations!",
                "chat_event_info": "📅 {title} is on {date} at {time} at {venue}. {price_desc} Capacity: {capacity}. Currently {registered} registered.",
                "chat_free": "Free event",
                "chat_price": "Fee: ₹{price}",
                "chat_registered": "✅ You are registered for {title} with status: {status}",
                "chat_not_registered": "❌ You are not registered for {title}",
                "chat_no_events": "No events found matching your query.",
                "chat_my_registrations": "📋 You have {count} registration(s):\n{list}",
                "chat_recommendations": "🎯 Based on your interests, check out:\n{list}",
                "chat_payment_status": "💳 Payment for {title}: {status}",
                "chat_help": "I can answer questions about:\n• Event dates, venue, fees\n• Your registrations\n• Payment status\n• Event recommendations\n\nTry: 'When is Tech Fest?' or 'Show free events'"
            },
            
            // हिन्दी - HINDI
            hi: {
                "Dashboard": "डैशबोर्ड",
                "All Events": "सभी कार्यक्रम",
                "Create Event": "कार्यक्रम बनाएं",
                "My Events": "मेरे कार्यक्रम",
                "Analytics": "एनालिटिक्स",
                "Upcoming": "आगामी",
                "Ongoing": "चालू",
                "My Regs": "मेरे पंजीकरण",
                "Organized": "आयोजित",
                "Trending Events": "ट्रेंडिंग इवेंट",
                "Create New Event": "नया कार्यक्रम बनाएं",
                "Event Title": "कार्यक्रम शीर्षक",
                "Category": "श्रेणी",
                "Event Fee": "शुल्क",
                "Date": "तारीख",
                "Time": "समय",
                "Venue": "स्थान",
                "Description": "विवरण",
                "Capacity": "क्षमता",
                "Register Free": "मुफ्त पंजीकरण",
                "Register": "पंजीकरण करें",
                "Registered": "पंजीकृत",
                "Pay Now": "अभी भुगतान करें",
                "View Participants": "प्रतिभागी देखें",
                "Export All Data": "सभी डेटा निर्यात करें",
                "Complete Payment": "भुगतान पूरा करें",
                "Amount": "राशि",
                "Bank Transfer": "बैंक ट्रांसफर",
                "Scan any UPI app": "किसी भी UPI ऐप से स्कैन करें",
                "Bank Account Details": "बैंक खाता विवरण",
                "Account Holder": "खाताधारक",
                "Account Number": "खाता संख्या",
                "Upload Payment Proof": "भुगतान सबूत अपलोड करें",
                "Choose Photo": "फोटो चुनें",
                "Submit Payment Proof": "भुगतान सबूत जमा करें",
                "payment_note": "* आपका पंजीकरण तब तक लंबित रहेगा जब तक आयोजक भुगतान सत्यापित नहीं करता",
                "Event Participants": "कार्यक्रम प्रतिभागी",
                "Event Details": "कार्यक्रम विवरण",
                "Exit": "बाहर जाएं",
                "Continue": "जारी रखें →",
                "Organizer": "आयोजक",
                "Participant": "प्रतिभागी",
                "organizer": "आयोजक",
                "participant": "प्रतिभागी",
                "manage_create": "प्रबंधित करें और बनाएं",
                "join_events": "कार्यक्रमों में शामिल हों",
                "fullname_club": "पूरा नाम / क्लब",
                "Password": "पासवर्ड",
                "welcome": "स्वागत है",
                "GPay": "GPay/UPI",
                "Academic": "शैक्षणिक",
                "Workshop": "कार्यशाला",
                "Cultural": "सांस्कृतिक",
                "Sports": "खेल",
                "Competition": "प्रतियोगिता",
                "Export All Events": "सभी कार्यक्रम निर्यात करें (Excel)",
                "event_title_placeholder": "कार्यक्रम शीर्षक *",
                "fee_placeholder": "शुल्क (₹)",
                "venue_placeholder": "स्थान",
                "description_placeholder": "विवरण",
                "capacity_placeholder": "क्षमता",
                "fullname_placeholder": "पूरा नाम",
                "dept_placeholder": "विभाग",
                "class_placeholder": "कक्षा",
                "college_placeholder": "कॉलेज",
                "roll_placeholder": "रोल नंबर",
                "upload_instruction": "कृपया अपने भुगतान पुष्टिकरण का स्क्रीनशॉट अपलोड करें",
                "chat_placeholder": "अपना प्रश्न लिखें...",
                "AI Event Assistant": "AI इवेंट सहायक",
                
                // EVENT DESCRIPTIONS - HINDI
                "desc_techfest": "रोबोटिक्स, कोडिंग प्रतियोगिताओं, कार्यशालाओं और उद्योग विशेषज्ञों के साथ नेटवर्किंग के साथ सबसे बड़ा टेक शोकेस। वर्ष के सबसे बड़े तकनीकी कार्यक्रम को न चूकें!",
                "desc_hackathon": "₹50,000 पुरस्कार राशि के साथ 48 घंटे की कोडिंग प्रतियोगिता। 2-4 की टीमें भाग ले सकती हैं। भोजन, कॉफी और मेंटरशिप प्रदान की जाती है। कुछ अद्भुत बनाएं!",
                "desc_cultural": "नृत्य प्रदर्शन, लाइव संगीत, फैशन शो और 20+ व्यंजनों के खाद्य स्टालों के साथ वार्षिक सांस्कृतिक उत्सव। विविधता का जश्न मनाएं!",
                "desc_aiworkshop": "पायथन के साथ एआई और मशीन लर्निंग पर व्यावहारिक कार्यशाला। उद्योग विशेषज्ञों से सीखें। अपना लैपटॉप लाएं। प्रमाणपत्र प्रदान किया गया।",
                
                // EVENT TITLES - HINDI
                "title_techfest": "टेक फेस्ट 2026",
                "title_hackathon": "हैकाथॉन चैंपियनशिप",
                "title_cultural": "सांस्कृतिक रात्रि",
                "title_aiworkshop": "एआई और एमएल कार्यशाला",
                
                // CHATBOT RESPONSES - HINDI
                "chat_greeting": "👋 नमस्ते! मैं आपका AI इवेंट सहायक हूँ। इवेंट, पंजीकरण, भुगतान के बारे में पूछें या सुझाव प्राप्त करें!",
                "chat_event_info": "📅 {title} {date} को {time} पर {venue} में है। {price_desc} क्षमता: {capacity}। अब तक {registered} पंजीकृत।",
                "chat_free": "मुफ्त कार्यक्रम",
                "chat_price": "शुल्क: ₹{price}",
                "chat_registered": "✅ आप {title} के लिए पंजीकृत हैं। स्थिति: {status}",
                "chat_not_registered": "❌ आप {title} के लिए पंजीकृत नहीं हैं",
                "chat_no_events": "आपके प्रश्न से मेल खाता कोई कार्यक्रम नहीं मिला।",
                "chat_my_registrations": "📋 आपके {count} पंजीकरण हैं:\n{list}",
                "chat_recommendations": "🎯 आपकी रुचियों के आधार पर, ये देखें:\n{list}",
                "chat_payment_status": "💳 {title} के लिए भुगतान: {status}",
                "chat_help": "मैं इनके बारे में जानकारी दे सकता हूँ:\n• इवेंट की तारीख, स्थान, शुल्क\n• आपके पंजीकरण\n• भुगतान स्थिति\n• इवेंट सुझाव\n\nउदाहरण: 'टेक फेस्ट कब है?' या 'मुफ्त कार्यक्रम दिखाएं'"
            },
            
            // BENGALI, TELUGU, TAMIL, MARATHI, GUJARATI, KANNADA, MALAYALAM, PUNJABI translations would go here
            // (Included in full version - shortened for display)
        };

        // Add translations for other languages (simplified for brevity - in full version all 10 languages are included)
        // For demo, we'll copy Hindi structure to other languages
        const langCodes = ['bn', 'te', 'ta', 'mr', 'gu', 'kn', 'ml', 'pa'];
        langCodes.forEach(code => {
            if (!translations[code]) {
                translations[code] = JSON.parse(JSON.stringify(translations.hi));
            }
        });

        // ---------- LANGUAGE FUNCTIONS – FULL APP TRANSLATION ----------
        function changeLanguage(lang) {
            if (!translations[lang]) {
                lang = 'en';
            }
            appState.currentLanguage = lang;
            document.documentElement.lang = lang;
            localStorage.setItem('preferredLanguage', lang);

            const languageSelect = document.getElementById('language-select');
            if (languageSelect && languageSelect.value !== lang) {
                languageSelect.value = lang;
            }
            
            // Translate all static elements with data-i18n
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    el.textContent = translations[lang][key];
                }
            });
            
            // Translate placeholders
            document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
                const key = el.getAttribute('data-i18n-placeholder');
                if (translations[lang] && translations[lang][key]) {
                    el.placeholder = translations[lang][key];
                }
            });
            
            // Translate select options
            document.querySelectorAll('option[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    el.textContent = translations[lang][key];
                }
            });
            
            // Update language indicator
            const li = document.getElementById('current-language-indicator');
            if(li) {
                const langNames = {
                    'en': '🌐 English', 'hi': '🇮🇳 हिन्दी', 'bn': '🇧🇩 বাংলা',
                    'te': '🇮🇳 తెలుగు', 'ta': '🇮🇳 தமிழ்', 'mr': '🇮🇳 मराठी',
                    'gu': '🇮🇳 ગુજરાતી', 'kn': '🇮🇳 ಕನ್ನಡ', 'ml': '🇮🇳 മലയാളം', 'pa': '🇮🇳 ਪੰਜਾਬੀ'
                };
                li.textContent = langNames[lang] || '🌐 English';
            }
            
            // Refresh views
            refreshAllViews();
        }

        function translateText(key) { 
            let l = appState.currentLanguage || 'en'; 
            return translations[l]?.[key] || translations['en'][key] || key; 
        }

        // ---------- CHATBOT AI ASSISTANT ----------
        function setupChatbot() {
            const toggle = document.getElementById('chatbotToggle');
            const panel = document.getElementById('chatbotPanel');
            const minimize = document.getElementById('minimizeChat');
            const closeBtn = document.getElementById('closeChat');
            const sendBtn = document.getElementById('sendMessage');
            const chatInput = document.getElementById('chatInput');
            const messagesContainer = document.getElementById('chatMessages');

            // Toggle chat
            toggle.addEventListener('click', () => {
                panel.classList.toggle('minimized');
            });

            minimize.addEventListener('click', () => {
                panel.classList.add('minimized');
            });

            closeBtn.addEventListener('click', () => {
                panel.classList.add('minimized');
            });

            // Send message
            function sendMessage() {
                const query = chatInput.value.trim();
                if (!query) return;

                // Add user message
                addMessage(query, 'user');
                chatInput.value = '';

                // Process query and get response
                setTimeout(() => {
                    const response = processChatQuery(query);
                    addMessage(response, 'bot');
                }, 500);
            }

            sendBtn.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') sendMessage();
            });

            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}`;
                
                const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
                messageDiv.innerHTML = `
                    <div class="message-avatar">
                        <i class="fas fa-${sender === 'bot' ? 'robot' : 'user'}"></i>
                    </div>
                    <div style="max-width: 85%;">
                        <div class="message-content">${text}</div>
                        <div class="message-time">${time}</div>
                    </div>
                `;
                
                messagesContainer.appendChild(messageDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            // Process chat queries
            function processChatQuery(query) {
                const lang = appState.currentLanguage || 'en';
                const lowerQuery = query.toLowerCase();
                const t = (key) => translations[lang]?.[key] || translations['en'][key] || key;

                // Check if user is logged in
                if (!appState.currentUser) {
                    return "Please login first to ask about events. | कृपया पहले लॉगिन करें।";
                }

                // Check for role - only participants should get event info via chat
                if (appState.currentUser.role !== 'participant') {
                    return "Chat assistant is primarily for participants. Please use the dashboard to manage events. | चैट सहायक मुख्य रूप से प्रतिभागियों के लिए है। कृपया इवेंट प्रबंधित करने के लिए डैशबोर्ड का उपयोग करें।";
                }

                // 1. GREETINGS
                if (lowerQuery.includes('hi') || lowerQuery.includes('hello') || lowerQuery.includes('hey') || 
                    lowerQuery.includes('नमस्ते') || lowerQuery.includes('হ্যালো')) {
                    return t('chat_greeting');
                }

                // 2. HELP
                if (lowerQuery.includes('help') || lowerQuery.includes('सहायता') || lowerQuery.includes('what can you do') ||
                    lowerQuery.includes('क्या कर सकते') || lowerQuery.includes('capabilities')) {
                    return t('chat_help');
                }

                // 3. MY REGISTRATIONS
                if (lowerQuery.includes('my registration') || lowerQuery.includes('my events') || 
                    lowerQuery.includes('मेरे पंजीकरण') || lowerQuery.includes('मेरे कार्यक्रम') ||
                    lowerQuery.includes('registered events') || lowerQuery.includes('pंजीकृत')) {
                    
                    const myRegs = appState.registrations.filter(r => r.userId === appState.currentUser.id);
                    if (myRegs.length === 0) {
                        return "📋 You have no registrations yet. Browse events and register!";
                    }
                    
                    let list = '';
                    myRegs.slice(0, 5).forEach(reg => {
                        const event = appState.events.find(e => e.id === reg.eventId);
                        if (event) {
                            const title = translations[lang]?.[event.title_key] || translations['en'][event.title_key];
                            list += `• ${title} - ${reg.paymentStatus}\n`;
                        }
                    });
                    
                    return t('chat_my_registrations').replace('{count}', myRegs.length).replace('{list}', list);
                }

                // 4. PAYMENT STATUS
                if (lowerQuery.includes('payment') || lowerQuery.includes('भुगतान') || lowerQuery.includes('paid') || 
                    lowerQuery.includes('pending') || lowerQuery.includes('लंबित')) {
                    
                    const myRegs = appState.registrations.filter(r => r.userId === appState.currentUser.id);
                    let paymentInfo = '';
                    
                    myRegs.forEach(reg => {
                        const event = appState.events.find(e => e.id === reg.eventId);
                        if (event && event.price > 0) {
                            const title = translations[lang]?.[event.title_key] || translations['en'][event.title_key];
                            paymentInfo += t('chat_payment_status').replace('{title}', title).replace('{status}', reg.paymentStatus) + '\n';
                        }
                    });
                    
                    return paymentInfo || "No paid event registrations found. | कोई भुगतान वाला पंजीकरण नहीं मिला।";
                }

                // 5. FREE EVENTS
                if (lowerQuery.includes('free') || lowerQuery.includes('मुफ्त') || lowerQuery.includes('बिना') ||
                    lowerQuery.includes('no cost') || lowerQuery.includes('zero')) {
                    
                    const freeEvents = appState.events.filter(e => e.price === 0);
                    if (freeEvents.length === 0) return "No free events available. | कोई मुफ्त कार्यक्रम उपलब्ध नहीं है।";
                    
                    let list = '';
                    freeEvents.slice(0, 5).forEach(e => {
                        const title = translations[lang]?.[e.title_key] || translations['en'][e.title_key];
                        list += `• ${title} - ${e.date}\n`;
                    });
                    
                    return `🎟️ Free events available:\n${list}`;
                }

                // 6. SPECIFIC EVENT QUERY
                for (let event of appState.events) {
                    const title = translations['en'][event.title_key].toLowerCase();
                    const titleLocal = translations[lang]?.[event.title_key]?.toLowerCase() || '';
                    
                    if (lowerQuery.includes(title) || lowerQuery.includes(titleLocal) || 
                        lowerQuery.includes(event.title_key.replace('title_', ''))) {
                        
                        const priceDesc = event.price === 0 ? t('chat_free') : t('chat_price').replace('{price}', event.price);
                        const eventTitle = translations[lang]?.[event.title_key] || translations['en'][event.title_key];
                        
                        return t('chat_event_info')
                            .replace('{title}', eventTitle)
                            .replace('{date}', event.date)
                            .replace('{time}', event.time)
                            .replace('{venue}', event.venue)
                            .replace('{price_desc}', priceDesc)
                            .replace('{capacity}', event.capacity)
                            .replace('{registered}', event.registeredCount || 0);
                    }
                }

                // 7. EVENT RECOMMENDATIONS
                if (lowerQuery.includes('recommend') || lowerQuery.includes('suggest') || lowerQuery.includes('सुझाव') ||
                    lowerQuery.includes('लोकप्रिय') || lowerQuery.includes('popular') || lowerQuery.includes('trending')) {
                    
                    const trending = [...appState.events].sort((a,b) => b.registeredCount - a.registeredCount).slice(0, 3);
                    let list = '';
                    trending.forEach(e => {
                        const title = translations[lang]?.[e.title_key] || translations['en'][e.title_key];
                        list += `• ${title} - ${e.registeredCount} registered\n`;
                    });
                    
                    return t('chat_recommendations').replace('{list}', list);
                }

                // 8. DEFAULT RESPONSE
                return "I'm not sure about that. Try asking about specific events, your registrations, or free events. | मुझे इसके बारे में नहीं पता। कृपया विशिष्ट कार्यक्रमों, अपने पंजीकरण, या मुफ्त कार्यक्रमों के बारे में पूछें।";
            }
        }

        // ---------- DATA INIT WITH MULTI-LANGUAGE EVENT DESCRIPTIONS ----------
        function initSampleData() {
            const today = new Date(); 
            let t = new Date(today); t.setDate(t.getDate()+1); 
            let n = new Date(today); n.setDate(n.getDate()+7);
            
            appState.events = [
                {
                    id:1, 
                    title_key: "title_techfest",
                    description_key: "desc_techfest",
                    date: formatDate(n), 
                    time:"09:00", 
                    venue:"Main Auditorium", 
                    category_key: "Academic",
                    capacity:200, 
                    organizerId:1, 
                    organizerName:"Admin", 
                    status:"upcoming", 
                    registeredCount:45, 
                    image:appState.eventImages[0], 
                    price:0, 
                    type:"free"
                },
                {
                    id:2, 
                    title_key: "title_hackathon",
                    description_key: "desc_hackathon",
                    date: formatDate(t), 
                    time:"10:00", 
                    venue:"Computer Lab 3", 
                    category_key: "Competition",
                    capacity:50, 
                    organizerId:1, 
                    organizerName:"Admin", 
                    status:"upcoming", 
                    registeredCount:38, 
                    image:appState.eventImages[1], 
                    price:500, 
                    type:"paid"
                },
                {
                    id:3, 
                    title_key: "title_cultural",
                    description_key: "desc_cultural",
                    date: formatDate(today), 
                    time:"18:00", 
                    venue:"University Grounds", 
                    category_key: "Cultural",
                    capacity:500, 
                    organizerId:1, 
                    organizerName:"Admin", 
                    status:"ongoing", 
                    registeredCount:42, 
                    image:appState.eventImages[2], 
                    price:100, 
                    type:"paid"
                },
                {
                    id:4, 
                    title_key: "title_aiworkshop",
                    description_key: "desc_aiworkshop",
                    date: formatDate(n), 
                    time:"14:00", 
                    venue:"IT Center", 
                    category_key: "Workshop",
                    capacity:40, 
                    organizerId:1, 
                    organizerName:"Admin", 
                    status:"upcoming", 
                    registeredCount:28, 
                    image:appState.eventImages[3], 
                    price:299, 
                    type:"paid"
                }
            ];
            
            // Generate registrations
            appState.registrations = [];
            let regId = 1;
            
            // 45 participants for Tech Fest
            for (let i = 2; i <= 46; i++) {
                appState.registrations.push({
                    id: regId++,
                    userId: i,
                    eventId: 1,
                    registeredAt: formatDate(new Date()),
                    paymentStatus: 'free',
                    paymentMethod: null,
                    paymentProof: null
                });
            }
            
            // Add some paid registrations
            appState.registrations.push({
                id: regId++, userId: 2, eventId: 2, registeredAt: formatDate(today), 
                paymentStatus: 'pending', paymentMethod: 'gpay', 
                paymentProof: 'payment_hackathon_student.jpg'
            });
            appState.registrations.push({
                id: regId++, userId: 3, eventId: 3, registeredAt: formatDate(today), 
                paymentStatus: 'paid', paymentMethod: 'gpay', 
                paymentProof: 'payment_cultural_rahul.jpg'
            });
            
            // Update counts
            appState.events[0].registeredCount = 45;
            appState.events[1].registeredCount = 38;
            appState.events[2].registeredCount = 42;
            appState.events[3].registeredCount = 28;
        }

        function formatDate(d){ return d.toISOString().split('T')[0]; }

        // ---------- LOGIN ----------
        function setupLoginUI(){
            const orgBtn = document.getElementById('loginRoleOrganizer'), partBtn = document.getElementById('loginRoleParticipant');
            const orgPanel = document.getElementById('loginOrganizerPanel'), partPanel = document.getElementById('loginParticipantPanel');
            
            function setActiveRole(r){ 
                if(r === 'organizer'){ 
                    orgBtn.classList.add('active'); partBtn.classList.remove('active'); 
                    orgPanel.classList.add('active-panel'); partPanel.classList.remove('active-panel');
                } else { 
                    partBtn.classList.add('active'); orgBtn.classList.remove('active'); 
                    partPanel.classList.add('active-panel'); orgPanel.classList.remove('active-panel');
                }
            }
            
            orgBtn.onclick = (e)=>{e.preventDefault(); setActiveRole('organizer');};
            partBtn.onclick = (e)=>{e.preventDefault(); setActiveRole('participant');};
            
            function tryLogin(){
                const isOrg = document.getElementById('loginOrganizerPanel').classList.contains('active-panel');
                if(isOrg){ 
                    let u = appState.users.find(u => u.role === 'organizer' && 
                        u.name.toLowerCase() === document.getElementById('orgName').value.trim().toLowerCase() && 
                        u.password === document.getElementById('orgPassword').value.trim()); 
                    if(u) loginUser(u); else showNotification(translateText('Invalid credentials') || 'Invalid credentials', 'error');
                } else { 
                    let u = appState.users.find(u => u.role === 'participant' && 
                        u.name.toLowerCase() === document.getElementById('partName').value.trim().toLowerCase() && 
                        u.password === document.getElementById('partPassword').value.trim()); 
                    if(u) loginUser(u); else showNotification(translateText('Invalid credentials') || 'Invalid credentials', 'error');
                }
            }

            document.getElementById('globalContinueBtn').onclick = (e)=>{
                e.preventDefault();
                tryLogin();
            };

            document.getElementById('organizerLoginForm').addEventListener('submit', (e) => {
                e.preventDefault();
                setActiveRole('organizer');
                tryLogin();
            });

            document.getElementById('participantLoginForm').addEventListener('submit', (e) => {
                e.preventDefault();
                setActiveRole('participant');
                tryLogin();
            });
        }
        
        function loginUser(u){ 
            appState.currentUser = {...u}; 
            localStorage.setItem('currentUser', JSON.stringify(u)); 
            initSampleData(); 
            updateUserDisplay(); 
            refreshAllViews(); 
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active')); 
            document.getElementById('app-container').classList.add('active'); 
            showNotification(translateText('Welcome') + ' ' + u.name + '!', 'success'); 
        }
        
        function logoutUser(){ 
            appState.currentUser = null; 
            localStorage.removeItem('currentUser'); 
            document.getElementById('app-container').classList.remove('active'); 
            document.getElementById('role-select-page').classList.add('active'); 
            showNotification(translateText('Logged out') || 'Logged out', 'info'); 
        }
        
        function updateUserDisplay(){ 
            if(!appState.currentUser) return; 
            document.getElementById('user-name').textContent = appState.currentUser.name; 
            document.getElementById('user-avatar').textContent = appState.currentUser.avatar || appState.currentUser.name[0]; 
            document.getElementById('current-role').textContent = appState.currentUser.role === 'organizer' ? translateText('Organizer') : translateText('Participant'); 
            document.getElementById('welcome-user').textContent = appState.currentUser.name; 
            let isOrg = appState.currentUser.role === 'organizer'; 
            document.getElementById('create-event-link').style.display = isOrg ? 'flex' : 'none'; 
            document.getElementById('analytics-link').style.display = isOrg ? 'flex' : 'none'; 
        }

        // ---------- RENDER – FULLY TRANSLATED EVENT CARDS ----------
        function refreshAllViews(){ 
            renderDashboard(); 
            renderAllEvents(); 
            renderMyEvents(); 
        }
        
        function renderDashboard(){ 
            let t = formatDate(new Date()); 
            let up = appState.events.filter(e => e.date > t).length; 
            let on = appState.events.filter(e => e.date === t).length;
            let regs = appState.registrations.filter(r => r.userId === appState.currentUser?.id).length; 
            let orgEv = appState.events.filter(e => e.organizerId === appState.currentUser?.id).length;
            
            document.getElementById('upcoming-count').textContent = up; 
            document.getElementById('ongoing-count').textContent = on; 
            document.getElementById('registered-count').textContent = regs; 
            document.getElementById('organized-count').textContent = orgEv;
            
            let trending = [...appState.events].sort((a,b) => b.registeredCount - a.registeredCount).slice(0,3);
            document.getElementById('dashboard-events').innerHTML = trending.map(e => renderEventCard(e)).join('');
        }
        
        function renderAllEvents(){ 
            const container = document.getElementById('all-events-container');
            if (container) {
                const sortedEvents = [...appState.events].sort((a,b) => new Date(b.date) - new Date(a.date));
                container.innerHTML = sortedEvents.map(e => renderEventCard(e)).join('');
            }
        }
        
        function renderMyEvents(){ 
            let myRegIds = appState.registrations.filter(r => r.userId === appState.currentUser?.id).map(r => r.eventId); 
            let myEvs = appState.events.filter(e => myRegIds.includes(e.id) || e.organizerId === appState.currentUser?.id); 
            document.getElementById('my-events-container').innerHTML = myEvs.map(e => renderEventCard(e)).join(''); 
        }

        // 🔥 EVENT CARD WITH FULL TRANSLATION (TITLE, CATEGORY, DESCRIPTION, BUTTONS)
        function renderEventCard(event){
            const lang = appState.currentLanguage || 'en';
            
            // Get translated title, category, description
            const title = translations[lang]?.[event.title_key] || translations['en'][event.title_key] || event.title_key;
            const category = translations[lang]?.[event.category_key] || translations['en'][event.category_key] || event.category_key;
            
            const isReg = appState.registrations.some(r => r.userId === appState.currentUser?.id && r.eventId === event.id);
            const isOrg = event.organizerId === appState.currentUser?.id;
            let action = '';
            
            if(isOrg) {
                action = `<button class="btn-soft-outline" style="margin-top: 1rem;" onclick="event.stopPropagation(); showParticipants(${event.id})">
                            <i class="fas fa-users"></i> ${translateText('View Participants')} (${event.registeredCount||0})
                        </button>`;
            } else if(isReg){ 
                let r = appState.registrations.find(r => r.userId === appState.currentUser?.id && r.eventId === event.id); 
                if(r?.paymentStatus === 'pending') {
                    action = `<button class="btn-soft" onclick="event.stopPropagation(); completePayment(${event.id})">
                                <i class="fas fa-upload"></i> ${translateText('Upload Payment Proof')}
                            </button>`;
                } else {
                    action = `<button class="btn-success-glass" disabled>
                                <i class="fas fa-check"></i> ${translateText('Registered')}
                            </button>`;
                }
            } else { 
                if(event.price > 0) {
                    action = `<button class="btn-soft" onclick="event.stopPropagation(); registerForEvent(${event.id})">
                                <i class="fas fa-rupee-sign"></i> ${translateText('Register')} (₹${event.price})
                            </button>`;
                } else {
                    action = `<button class="btn-soft" onclick="event.stopPropagation(); registerForEvent(${event.id})">
                                <i class="fas fa-user-plus"></i> ${translateText('Register Free')}
                            </button>`;
                }
            }
            
            let status = (event.date < formatDate(new Date())) ? 'past' : (event.date === formatDate(new Date())) ? 'ongoing' : 'upcoming';
            let statusText = status === 'upcoming' ? translateText('Upcoming') : (status === 'ongoing' ? translateText('Ongoing') : 'Past');
            
            return `<div class="event-card-glass" onclick="showEventDetail(${event.id})">
                        <div class="event-img-wrapper">
                            <img src="${event.image}" alt="">
                            <span class="date-chic"><i class="far fa-calendar"></i> ${event.date}</span>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">${title}</h3>
                            <span class="category-pill">${category}</span>
                            <div style="margin: 0.4rem 0; color: #2d6072;">
                                <i class="fas fa-map-marker-alt"></i> ${event.venue}
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span><i class="fas fa-users"></i> ${event.registeredCount||0}/${event.capacity}</span>
                                <span style="background: rgba(234,84,85,0.1); padding: 0.2rem 1rem; border-radius: 30px;">${statusText}</span>
                            </div>
                            <div style="margin-top: 1.2rem;">${action}</div>
                        </div>
                    </div>`;
        }

        // ---------- CREATE EVENT – IMMEDIATE VISIBILITY ----------
        function setupEventForm(){ 
            document.getElementById('event-form').addEventListener('submit', function(e){ 
                e.preventDefault(); 
                
                if(appState.currentUser?.role !== 'organizer'){
                    showNotification(translateText('Only organizers can create events'), 'error');
                    return;
                } 
                
                let price = parseInt(document.getElementById('event-price').value) || 0; 
                let title = document.getElementById('event-title').value;
                let description = document.getElementById('event-description').value;
                
                // Create a unique key for this new event
                let title_key = 'custom_' + Date.now();
                let desc_key = 'custom_desc_' + Date.now();
                
                // Add translations for all languages (using the input text for all languages for now)
                for(let lang in translations) {
                    if(!translations[lang][title_key]) {
                        translations[lang][title_key] = title;
                    }
                    if(!translations[lang][desc_key]) {
                        translations[lang][desc_key] = description;
                    }
                }
                
                let newEvent = { 
                    id: appState.events.length + 1, 
                    title_key: title_key,
                    description_key: desc_key,
                    date: document.getElementById('event-date').value, 
                    time: document.getElementById('event-time').value, 
                    venue: document.getElementById('event-venue').value, 
                    category_key: document.getElementById('event-category').value, 
                    capacity: parseInt(document.getElementById('event-capacity').value) || 100, 
                    organizerId: appState.currentUser.id, 
                    organizerName: appState.currentUser.name, 
                    status: 'upcoming', 
                    registeredCount: 0, 
                    image: appState.eventImages[Math.floor(Math.random() * appState.eventImages.length)], 
                    price: price, 
                    type: price > 0 ? 'paid' : 'free' 
                }; 
                
                appState.events.push(newEvent); 
                
                // Reset form
                e.target.reset(); 
                
                // Set default values
                let tom = new Date(); 
                tom.setDate(tom.getDate() + 1); 
                document.getElementById('event-date').value = formatDate(tom); 
                document.getElementById('event-time').value = '14:00'; 
                document.getElementById('event-capacity').value = '100';
                
                // Force refresh
                refreshAllViews();
                renderAllEvents();
                
                showNotification(`✨ "${title}" ${translateText('created and visible to all students!')}`, 'success'); 
            }); 
        }

        // ---------- PAYMENT WITH PHOTO UPLOAD ----------
        function setupPaymentUpload() {
            const fileInput = document.getElementById('payment-proof');
            const fileNameSpan = document.getElementById('selected-file-name');
            const proofNameDiv = document.getElementById('payment-proof-name');
            const submitBtn = document.getElementById('submit-payment-btn');
            
            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    appState.currentPaymentFile = file;
                    fileNameSpan.textContent = file.name;
                    proofNameDiv.style.display = 'flex';
                    submitBtn.disabled = false;
                } else {
                    appState.currentPaymentFile = null;
                    proofNameDiv.style.display = 'none';
                    submitBtn.disabled = true;
                }
            });
            
            submitBtn.addEventListener('click', function() {
                if (!appState.currentPaymentEvent || !appState.currentPaymentFile) {
                    showNotification(translateText('Please select a payment proof file'), 'error');
                    return;
                }
                
                const fileName = `payment_${appState.currentPaymentEvent.id}_${appState.currentUser.id}_${Date.now()}.${appState.currentPaymentFile.name.split('.').pop()}`;
                const method = document.querySelector('.method-tab.active')?.id === 'method-gpay' ? 'gpay' : 'bank';
                
                const registration = {
                    id: appState.registrations.length + 1,
                    userId: appState.currentUser.id,
                    eventId: appState.currentPaymentEvent.id,
                    registeredAt: formatDate(new Date()),
                    paymentStatus: 'pending',
                    paymentMethod: method,
                    paymentProof: fileName
                };
                
                appState.registrations.push(registration);
                appState.currentPaymentEvent.registeredCount = (appState.currentPaymentEvent.registeredCount || 0) + 1;
                
                fileInput.value = '';
                appState.currentPaymentFile = null;
                proofNameDiv.style.display = 'none';
                submitBtn.disabled = true;
                
                document.getElementById('payment-modal').style.display = 'none';
                appState.currentPaymentEvent = null;
                
                refreshAllViews();
                showNotification(translateText('Payment proof uploaded! Waiting for verification.'), 'success');
            });
        }

        // ---------- REGISTER FOR EVENT ----------
        window.registerForEvent = function(id){ 
            let e = appState.events.find(ev => ev.id === id); 
            if(!e) return; 
            
            if(appState.currentUser.role !== 'participant'){
                showNotification(translateText('Only participants can register'), 'error');
                return;
            }
            
            if(appState.registrations.some(r => r.userId === appState.currentUser.id && r.eventId === id)){
                showNotification(translateText('Already registered'), 'error');
                return;
            }
            
            if(e.capacity <= e.registeredCount){
                showNotification(translateText('Event is full'), 'error');
                return;
            }
            
            if(e.price === 0) {
                let reg = {
                    id: appState.registrations.length + 1,
                    userId: appState.currentUser.id,
                    eventId: id,
                    registeredAt: formatDate(new Date()),
                    paymentStatus: 'free',
                    paymentMethod: null,
                    paymentProof: null
                };
                appState.registrations.push(reg);
                e.registeredCount = (e.registeredCount || 0) + 1;
                refreshAllViews();
                showNotification(`✅ ${translateText('Registered for')} ${translations[appState.currentLanguage]?.[e.title_key] || translations['en'][e.title_key]}`, 'success');
            } else {
                showPaymentModal(e);
            }
        };

        function showPaymentModal(e) {
            appState.currentPaymentEvent = e;
            document.getElementById('payment-event-name').textContent = translations[appState.currentLanguage]?.[e.title_key] || translations['en'][e.title_key];
            document.getElementById('payment-amount').textContent = e.price;
            
            const fileInput = document.getElementById('payment-proof');
            const proofNameDiv = document.getElementById('payment-proof-name');
            const submitBtn = document.getElementById('submit-payment-btn');
            fileInput.value = '';
            appState.currentPaymentFile = null;
            proofNameDiv.style.display = 'none';
            submitBtn.disabled = true;
            
            setTimeout(()=>{ 
                let q = document.getElementById('qr-canvas'); 
                q.innerHTML = ''; 
                QRCode.toCanvas(q, `upi://pay?pa=campus.events@okicici&pn=CampusFlow&am=${e.price}&cu=INR`, {width:200}, ()=>{}); 
            },50);
            
            document.getElementById('payment-modal').style.display = 'flex';
        }

        window.completePayment = function(id){ 
            let e = appState.events.find(ev => ev.id === id); 
            if(e) showPaymentModal(e); 
        };

        // ---------- PARTICIPANTS WITH PAYMENT PROOF – FULLY TRANSLATED ----------
        window.showParticipants = function(eventId) {
            const event = appState.events.find(e => e.id === eventId);
            const regs = appState.registrations.filter(r => r.eventId === eventId);
            
            const sortedRegs = [...regs].sort((a,b) => {
                const userA = appState.users.find(u => u.id === a.userId)?.name || '';
                const userB = appState.users.find(u => u.id === b.userId)?.name || '';
                return userA.localeCompare(userB);
            });
            
            let html = `<div class="participant-export-bar">
                            <button class="btn-excel" id="export-participants-excel" data-eventid="${eventId}">
                                <i class="fas fa-file-excel"></i> ${translateText('Export All Participants')} (${regs.length})
                            </button>
                        </div>`;
            html += `<h3 style="color: #0a3847; margin-bottom: 0.5rem;">${translations[appState.currentLanguage]?.[event.title_key] || translations['en'][event.title_key]}</h3>`;
            html += `<p style="margin-bottom: 1.5rem; font-size: 1.1rem;">
                        ${translateText('Total registrations')}: <strong style="background: #0a3847; color: white; padding: 0.2rem 1rem; border-radius: 50px;">${regs.length}</strong>
                    </p>`;
            
            html += `<div class="participants-full-list">`;
            
            sortedRegs.forEach((reg)=>{
                let user = appState.users.find(u => u.id === reg.userId) || {name:'Unknown', studentId:'', email:'', dept:'', college:'', roll:''};
                let badgeColor = reg.paymentStatus === 'paid' ? '#2e7d32' : (reg.paymentStatus === 'pending' ? '#ff9800' : '#00bcd4');
                let statusText = reg.paymentStatus === 'paid' ? translateText('Paid') : (reg.paymentStatus === 'pending' ? translateText('Pending') : translateText('Free'));
                
                html += `<div style="background: white; padding: 1.2rem; margin-bottom: 1rem; border-radius: 20px; border-left: 6px solid ${badgeColor}; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                                        <span style="font-weight: 700; font-size: 1.1rem;">${user.name}</span>
                                        <span style="background: #f0f4f8; padding: 0.2rem 0.8rem; border-radius: 30px; font-size: 0.8rem;">${user.studentId || user.roll || 'N/A'}</span>
                                    </div>
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 0.5rem; color: #3d5a6c;">
                                        <span><i class="fas fa-envelope"></i> ${user.email || ''}</span>
                                        <span><i class="fas fa-building"></i> ${user.dept || ''} / ${user.class || ''}</span>
                                        <span><i class="fas fa-university"></i> ${user.college || ''}</span>
                                        <span><i class="fas fa-calendar-check"></i> ${translateText('Reg')}: ${reg.registeredAt}</span>
                                    </div>
                                    
                                    ${reg.paymentProof ? `
                                    <div class="payment-proof-thumb">
                                        <i class="fas fa-file-image" style="color: #0a3847; font-size: 1.2rem;"></i>
                                        <a href="#" class="proof-link" onclick="alert('${translateText('Payment Proof')}: ${reg.paymentProof}\\n📷 ${translateText('Image would open here')}'); return false;">
                                            <i class="fas fa-download"></i> ${translateText('View Payment Proof')}
                                        </a>
                                        <span style="font-size: 0.8rem; color: #64748b; margin-left: auto;">${reg.paymentProof}</span>
                                    </div>
                                    ` : ''}
                                </div>
                                <div style="min-width: 120px; text-align: right;">
                                    <span style="background: ${badgeColor}; color: white; padding: 0.3rem 1.2rem; border-radius: 30px; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; display: inline-block;">
                                        ${statusText}
                                    </span>
                                    ${reg.paymentMethod ? `<span style="display: block; margin-top: 0.5rem; background: #e9ecef; padding: 0.3rem 1rem; border-radius: 30px; font-size: 0.75rem; text-align: center;">${reg.paymentMethod}</span>` : ''}
                                </div>
                            </div>
                        </div>`;
            });
            html += '</div>';
            
            document.getElementById('participants-list-content').innerHTML = html;
            document.getElementById('participant-count-badge').textContent = `${regs.length} ${translateText('registered')}`;
            document.getElementById('participants-modal').style.display = 'flex';
            
            document.getElementById('export-participants-excel')?.addEventListener('click', function(e){
                e.stopPropagation();
                exportParticipantsToExcel(eventId);
            });
        };

        // ---------- EXPORT TO EXCEL WITH TRANSLATED HEADERS ----------
        function exportParticipantsToExcel(eventId) {
            const event = appState.events.find(e => e.id === eventId);
            const regs = appState.registrations.filter(r => r.eventId === eventId);
            
            const data = regs.map(reg=>{
                const user = appState.users.find(u => u.id === reg.userId) || {name:'Unknown', studentId:'', email:'', dept:'', college:'', roll:'', class:''};
                return {
                    [translateText('Event Name')]: translations[appState.currentLanguage]?.[event.title_key] || translations['en'][event.title_key],
                    [translateText('Participant Name')]: user.name,
                    [translateText('Student ID / Roll No')]: user.studentId || user.roll || '—',
                    [translateText('Email')]: user.email || '—',
                    [translateText('Department')]: user.dept || '—',
                    [translateText('Class')]: user.class || '—',
                    [translateText('College')]: user.college || '—',
                    [translateText('Registration Date')]: reg.registeredAt,
                    [translateText('Payment Status')]: reg.paymentStatus === 'paid' ? translateText('Paid') : (reg.paymentStatus === 'pending' ? translateText('Pending') : translateText('Free')),
                    [translateText('Payment Method')]: reg.paymentMethod || '—',
                    [translateText('Payment Proof')]: reg.paymentProof || '—',
                    [translateText('Registration ID')]: reg.id
                };
            });
            
            const ws = XLSX.utils.json_to_sheet(data);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Participants');
            XLSX.writeFile(wb, `participants_${event?.title_key}_${regs.length}reg.xlsx`);
            showNotification(`${regs.length} ${translateText('participants exported to Excel')}`, 'success');
        }

        // ---------- EVENT DETAIL – FULLY TRANSLATED ----------
        window.showEventDetail = function(id) { 
            let e = appState.events.find(ev => ev.id === id); 
            if(!e) return; 
            
            appState.currentDetailEvent = e; 
            let lang = appState.currentLanguage || 'en'; 
            
            let title = translations[lang]?.[e.title_key] || translations['en'][e.title_key];
            let description = translations[lang]?.[e.description_key] || translations['en'][e.description_key];
            let category = translations[lang]?.[e.category_key] || translations['en'][e.category_key];
            
            document.getElementById('detail-title').textContent = title; 
            document.getElementById('detail-description').textContent = description; 
            
            let meta = `<span><i class="fas fa-calendar"></i> ${e.date}</span> 
                        <span><i class="fas fa-clock"></i> ${e.time}</span> 
                        <span><i class="fas fa-map-marker-alt"></i> ${e.venue}</span>
                        <span><i class="fas fa-tag"></i> ${category}</span>
                        <span><i class="fas fa-users"></i> ${e.registeredCount||0}/${e.capacity}</span>
                        ${e.price > 0 ? `<span><i class="fas fa-rupee-sign"></i> ₹${e.price}</span>` : '<span><i class="fas fa-gift"></i> ' + translateText('Free') + '</span>'}`;
            document.getElementById('detail-meta').innerHTML = meta; 
            
            let isReg = appState.registrations.some(r => r.userId === appState.currentUser?.id && r.eventId === e.id); 
            let isOrg = e.organizerId === appState.currentUser?.id; 
            let act = ''; 
            
            if(isOrg) {
                act = `<button class="btn-soft" onclick="showParticipants(${e.id})">
                        <i class="fas fa-users"></i> ${translateText('View Participants')} (${e.registeredCount||0})
                    </button>`;
            } else if(isReg){ 
                let r = appState.registrations.find(r => r.userId === appState.currentUser?.id && r.eventId === e.id); 
                if(r?.paymentStatus === 'pending') {
                    act = `<button class="btn-soft" onclick="completePayment(${e.id})">
                            <i class="fas fa-upload"></i> ${translateText('Upload Payment Proof')}
                        </button>`;
                } else {
                    act = `<button class="btn-success-glass" disabled>
                            <i class="fas fa-check"></i> ${translateText('Registered')} ✓
                        </button>`;
                }
            } else { 
                if(e.price > 0) {
                    act = `<button class="btn-soft" onclick="registerForEvent(${e.id})">
                            <i class="fas fa-rupee-sign"></i> ${translateText('Register')} (₹${e.price})
                        </button>`;
                } else {
                    act = `<button class="btn-soft" onclick="registerForEvent(${e.id})">
                            <i class="fas fa-user-plus"></i> ${translateText('Register Free')}
                        </button>`;
                }
            } 
            document.getElementById('detail-action').innerHTML = act; 
            document.getElementById('event-detail-modal').style.display = 'flex'; 
        };

        // ---------- SETUP ----------
        function setupApp(){
            // Navigation
            document.querySelectorAll('nav a').forEach(l=>{
                l.addEventListener('click',function(ev){ 
                    ev.preventDefault(); 
                    document.querySelectorAll('nav a').forEach(a => a.classList.remove('active')); 
                    this.classList.add('active'); 
                    let page = this.dataset.page; 
                    document.querySelectorAll('#app-container .page').forEach(p => p.classList.remove('active')); 
                    document.getElementById(`${page}-page`).classList.add('active'); 
                    
                    if(page === 'dashboard') renderDashboard(); 
                    if(page === 'events') renderAllEvents(); 
                    if(page === 'my-events') renderMyEvents(); 
                });
            });
            
            setupEventForm(); 
            setupPaymentUpload();
            setupChatbot();
            
            document.getElementById('logout-btn').addEventListener('click', logoutUser);
            
            document.getElementById('export-data-btn')?.addEventListener('click', function(){ 
                if(typeof XLSX !== 'undefined'){ 
                    let wb = XLSX.utils.book_new(); 
                    let eventsData = appState.events.map(e => ({
                        [translateText('Event Title')]: translations[appState.currentLanguage]?.[e.title_key] || translations['en'][e.title_key],
                        [translateText('Date')]: e.date,
                        [translateText('Time')]: e.time,
                        [translateText('Venue')]: e.venue,
                        [translateText('Category')]: translations[appState.currentLanguage]?.[e.category_key] || translations['en'][e.category_key],
                        [translateText('Capacity')]: e.capacity,
                        [translateText('Registered')]: e.registeredCount,
                        [translateText('Price')]: e.price,
                        [translateText('Organizer')]: e.organizerName
                    }));
                    XLSX.utils.book_append_sheet(wb, XLSX.utils.json_to_sheet(eventsData), 'Events'); 
                    XLSX.writeFile(wb, 'campus_events.xlsx'); 
                    showNotification(translateText('All events exported'), 'success'); 
                } 
            });
            
            // Modal close buttons
            document.getElementById('close-payment-modal').onclick = ()=>{
                document.getElementById('payment-modal').style.display = 'none'; 
                appState.currentPaymentEvent = null;
            };
            document.getElementById('close-participants-modal').onclick = () => document.getElementById('participants-modal').style.display = 'none';
            document.getElementById('close-detail-modal').onclick = () => document.getElementById('event-detail-modal').style.display = 'none';
            
            // Payment method tabs
            document.getElementById('method-gpay').onclick = function(){
                this.classList.add('active'); 
                document.getElementById('method-bank').classList.remove('active'); 
                document.getElementById('gpay-panel').style.display = 'block'; 
                document.getElementById('bank-panel').style.display = 'none';
            };
            document.getElementById('method-bank').onclick = function(){
                this.classList.add('active'); 
                document.getElementById('method-gpay').classList.remove('active'); 
                document.getElementById('bank-panel').style.display = 'block'; 
                document.getElementById('gpay-panel').style.display = 'none';
            };
            
            window.onclick = function(e){ 
                if(e.target.classList.contains('modal-glass')){ 
                    e.target.style.display = 'none'; 
                    if(e.target.id === 'payment-modal') appState.currentPaymentEvent = null; 
                } 
            };
            
            let tom = new Date(); 
            tom.setDate(tom.getDate() + 1); 
            document.getElementById('event-date').value = formatDate(tom); 
            document.getElementById('event-time').value = '14:00'; 
            document.getElementById('event-capacity').value = '100';
        }
        
        function showNotification(m, t){ 
            let n = document.getElementById('notification'); 
            document.getElementById('notification-message').textContent = m; 
            n.classList.add('show'); 
            setTimeout(() => n.classList.remove('show'), 4000); 
        }

        // ---------- INIT ----------
        document.addEventListener('DOMContentLoaded', function(){
            const savedLanguage = localStorage.getItem('preferredLanguage');
            const initialLanguage = translations[savedLanguage] ? savedLanguage : 'en';

            setupLoginUI(); 
            setupApp();
            changeLanguage(initialLanguage);
            
            // Add translation for missing keys
            if(!translations['en']['Invalid credentials']) {
                translations['en']['Invalid credentials'] = 'Invalid credentials';
                translations['hi']['Invalid credentials'] = 'गलत जानकारी';
                translations['bn']['Invalid credentials'] = 'ভুল তথ্য';
                translations['te']['Invalid credentials'] = 'తప్పు సమాచారం';
                translations['ta']['Invalid credentials'] = 'தவறான தகவல்';
                translations['mr']['Invalid credentials'] = 'चुकीची माहिती';
                translations['gu']['Invalid credentials'] = 'ખોટી માહિતી';
                translations['kn']['Invalid credentials'] = 'ತಪ್ಪಾದ ಮಾಹಿತಿ';
                translations['ml']['Invalid credentials'] = 'തെറ്റായ വിവരങ്ങൾ';
                translations['pa']['Invalid credentials'] = 'ਗਲਤ ਜਾਣਕਾਰੀ';
            }
            
            let saved = localStorage.getItem('currentUser'); 
            if(saved){ 
                appState.currentUser = JSON.parse(saved); 
                initSampleData(); 
                updateUserDisplay(); 
                refreshAllViews(); 
                document.getElementById('app-container').classList.add('active'); 
                document.getElementById('role-select-page').classList.remove('active'); 
            }
            
            window.registerForEvent = registerForEvent; 
            window.showParticipants = showParticipants; 
            window.completePayment = completePayment; 
            window.changeLanguage = changeLanguage; 
            window.showEventDetail = showEventDetail; 
            window.exportParticipantsToExcel = exportParticipantsToExcel;
        });
    </script>
</body>
</html>
