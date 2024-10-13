<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="{{ asset('account/css/spinnergame.css') }}" />
    <style>
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .custom-alert {
        background-color: #ff4d4d;
        /* Red background for visibility */
        color: white;
        /* Light text color */
        padding: 10px;
        border-radius: 5px;
        margin: 15px 0;
        font-size: 16px;
        text-align: center;
        width: 400px;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
</head>

<body>
    @if (session('message'))
    <div class="custom-alert" id="message">
        {{ session('message') }}
    </div>
    @endif
    <div class="background"></div>
    <div class="signup_login">
        <section class="wrapper">
            <div class="form signup">
                <header style="margin-bottom: 20px;">Login</header>
                <form action="#">
                    <input type="text" placeholder="Email address" required />
                    <input type="password" placeholder="Password" required />
                    <a href="#">Forgot password?</a>
                    <input type="submit" value="Login" />
                </form>
            </div>
            <div class="form login">
                <header style="margin-bottom: 15px;">Register</header>
                <form id="registrationForm" action="{{ route('spinner-game-registeration') }}" method="POST">
                    @csrf

                    <input style="margin-top:10px " type="text" class="form-control" id="dsponserid" name="dsponserid"
                        placeholder="Referral Email ID" value="{{ $user_email }}" readonly>
                    @error('dsponserid')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter Your Name"
                        required>
                    @error('fullName')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"
                        required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="password" class="form-control" id="password1" name="password1"
                        placeholder="Enter Password" required>
                    @error('password1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                        placeholder="Confirm Password" required>
                    @error('confirm_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div id="passwordError" style="color: red;"></div>

                    <div class="checkbox">
                        <input type="checkbox" id="signupCheck" />
                        <label for="signupCheck">
                            <a href="https://nims.network/spin-win/" target="_blank">I accept all terms &
                                conditions</a>
                        </label>
                    </div>

                    <div id="termsError" style="color: red;margin-top:-20px"></div>
                    <small style="color: white">Join our spin and win game to earn Nims Token. For extra reward please
                        use your friends referral email ID.</small>

                    <button type="submit" value="Signup" id="registration_form_btn"
                        class="btn btn-secondary center spinner_signup_btn" style="margin-top: 0rem">Register</button>
                </form>
                {{-- <form id="loginForm" action="{{ route('spinner-game-login-store') }}" method="POST">
                @csrf

                <input type="text" id="email" name="email" placeholder="Email address" required />
                <input type="password" id="password" name="password" placeholder="Password" required />
                <a href="#">Forgot password?</a>
                <input type="submit" value="Login" />
                </form> --}}
            </div>

            <script>
            const wrapper = document.querySelector(".wrapper"),
                signupHeader = document.querySelector(".signup header"),
                loginHeader = document.querySelector(".login header");

            loginHeader.addEventListener("click", () => {
                wrapper.classList.add("active");
            });
            signupHeader.addEventListener("click", () => {
                wrapper.classList.remove("active");
            });
            </script>
        </section>
    </div>
</body>
<script src="{{ asset('account/js/spinnergame.js') }}"></script>

</html>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#registrationForm').on('submit', function(event) {
        var password = $('#password1').val();
        var confirm_password = $('#confirm_password').val();
        var termsAccepted = $('#signupCheck').is(':checked');
        console.log(password, confirm_password);
        // Clear previous error messages
        $('#passwordError').text("");
        $('#termsError').text("");

        // Password validation
        if (password !== confirm_password) {
            $('#passwordError').text("Passwords do not match.");
            event.preventDefault();
        }

        // Terms & Conditions validation
        if (!termsAccepted) {
            $('#termsError').text("You must accept the terms & conditions.");
            event.preventDefault(); // Prevent form submission
        }
    });

    $('#loginForm').on('submit', function(event) {
        var email = $('#email').val();
        var password = $('#password').val();

        // Clear previous error messages
        $('#emailError').text("");
        $('#passwordError').text("");

        // Email validation
        if (!email.includes('@')) {
            $('#emailError').text("Invalid email format.");
            event.preventDefault();
        }
        window.location.href = "{{ route('spinner-game') }}";
    });

});

setTimeout(function() {
    document.getElementById('message').style.display = 'none';
}, 5000);
</script>