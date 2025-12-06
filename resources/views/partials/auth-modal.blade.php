<div class="auth-modal" id="authModal">
    <div class="auth-modal-content">
        <button class="auth-modal-close" onclick="closeAuthModal()">×</button>
        
        <div class="auth-header">
            <img src="{{ asset('images/sparklogo.png') }}" alt="TheSPARK Logo" class="auth-logo">
            <h2>Welcome to TheSPARK</h2>
            <p>Truth knows no limits</p>
        </div>
        
        <div class="auth-tabs">
            <button class="auth-tab active" id="loginTab" onclick="switchAuthTab('login')">Log In</button>
            <button class="auth-tab" id="signupTab" onclick="switchAuthTab('signup')">Sign Up</button>
        </div>
        
        <!-- Login Form -->
        <form class="auth-form" id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            
            @if($errors->has('email') && !old('username'))
                <div style="background: #fee; border: 1px solid #fcc; padding: 10px; border-radius: 5px; margin-bottom: 15px; color: #c00;">
                    {{ $errors->first('email') }}
                </div>
            @endif
            
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="auth-submit-btn">Log In</button>
        </form>
        
        <!-- Signup Form -->
        <form class="auth-form" id="signupForm" action="{{ route('register') }}" method="POST" style="display: none;">
            @csrf
            
            @if($errors->any() && old('username'))
                <div style="background: #fee; border: 1px solid #fcc; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li style="color: #c00;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="form-group">
                <label for="signup-username">Username</label>
                <input type="text" id="signup-username" name="username" placeholder="Choose a username" value="{{ old('username') }}" required>
            </div>
            
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input type="email" id="signup-email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="signup-password">Password</label>
                <input type="password" id="signup-password" name="password" placeholder="Create a password (min 8 characters)" required>
            </div>
            
            <div class="form-group">
                <label for="signup-password-confirm">Confirm Password</label>
                <input type="password" id="signup-password-confirm" name="password_confirmation" placeholder="Confirm your password" required>
            </div>
            
            <button type="submit" class="auth-submit-btn">Sign Up</button>
        </form>
    </div>
</div>

<div class="auth-modal-overlay" id="authModalOverlay" onclick="closeAuthModal()"></div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        openAuthModal();
        @if(old('username'))
            switchAuthTab('signup');
        @endif
    });
</script>
@endif
