<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ setting('website_name') }}</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <!-- Main Faile Css  -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body>
    <x:messages />
    <section class="page-login">
        <form class="form-login" method="POST">
            @csrf
            <div class="box-login">
                <div class="img-login">
                    <img src="{{ asset('img/login-img.jpg') }}" alt="">
                </div>
                <div class="content-login">
                    <div class="w-100">
                        <h3 class="title d-flex align-items-center justify-content-between">
                            {{ __('site.login') }}

                            @if (app()->getLocale() == 'ar')
                                <a class="lang-control" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                    <i class="fa-solid fa-language"></i>
                                </a>
                            @else
                                <a class="lang-control" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                                    <i class="fa-solid fa-language"></i>
                                </a>
                            @endif
                        </h3>

                        <div class="lable">{{ __('site.E-mail') }}</div>
                        <input required="" type="email" name="email" placeholder="{{ __('site.E-mail') }}"
                            class="form-control">

                        <div class="lable mt-3">{{ __('site.Password') }}</div>

                        <div class="d-flex align-items-center">
                            <input id="passwordField" class="form-control" style="border-radius: 0 0 .25rem .25rem;" type="password" placeholder="{{ __('site.Password') }}" name="password">
                            <button id="togglePassword" class="btn btn-sm btn-light" style="height: 34px; border-radius: .25rem .25rem 0 0;" type="button">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <button class="btn sub" type="submit">
                        {{ __('site.login') }}
                        </button>
                        <hr class="my-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="https://www.const-tech.org/" class="fs-10px">
                                {{ __('site.Programming_and_development_of_Tech_Constellation') }}
                                <img src="{{ asset('img/LOGO3.png') }}" alt="" class="logo-footer">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>
    <!-- Js Files -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script>
        const passwordField = document.getElementById('passwordField');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
