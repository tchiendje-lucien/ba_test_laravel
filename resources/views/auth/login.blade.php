<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/styleLogin.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form id="signup-form" class="signup-form" action="{{ URL::to('/login_user') }}" method="POST">
                        @csrf
                        <h2 class="form-title">se Connecter</h2>
                        @if (session('error'))
                            <div class="alert" role="alert" style="background-color: rgb(248, 215, 218)">
                                {{ session('error') }}
                            </div>
                        @endif
                        <br>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email"
                                placeholder="Votre adresse email" value="{{ @old('email') }}" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password"
                                placeholder="Votre mot de passe" required />
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="color: red">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>Se souvenir de
                                moi</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit"
                                value="se Connecter" />
                        </div>
                        <p class="loginhere">
                            Haven't you an account ? <a href="/register" class="loginhere-link">register here</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="../js/jqueryLogin.min.js"></script>
    <script src="../js/mainLogin.js"></script>
</body>

</html>
