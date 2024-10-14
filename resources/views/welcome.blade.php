<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nims</title>
    <link rel="icon" type="image/x-icon" src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"    >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- bs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('account/css/spinnergame.css') }}" />


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Bodoni Moda', serif;
        background-size: cover;
        font-weight: bold;
    }

    .gold {
        font-size: 5vw;
        text-transform: uppercase;
        line-height: 1;
        text-align: center;
        background: linear-gradient(90deg, rgba(186, 148, 62, 1) 0%, rgba(236, 172, 32, 1) 20%, rgba(186, 148, 62, 1) 39%, rgba(249, 244, 180, 1) 50%, rgba(186, 148, 62, 1) 60%, rgba(236, 172, 32, 1) 80%, rgba(186, 148, 62, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s infinite;
        background-size: 200%;
        background-position: left;
        margin-top: 20%;
    }

    @keyframes shine {
        to {
            background-position: right
        }

    }
    </style>
    <style>
    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }
    </style>
</head>

<body class="antialiased">
    <video class="coin_video" width="100%" autoplay loop muted>
        <source src="./assets/falling_coin.mp4" type="video/mp4" />
    </video>
    <div class="background"></div>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <h1 class="gold">Spin To Win Nims</h1>
        <a href="{{ route('spinner-game') }}">
        <img style="text-align: center; position: relative; left: 37%; width: 27%;" src="{{ asset('account/landing_page_images/assets/spinner_button.png') }}" alt="">
        </a>
    </div>
</body>
<script>
// START BACKGROUND ANIMATION
const background = document.querySelector('.background');

// Function to generate random circles
function createCircle() {
    const circle = document.createElement('div');
    circle.classList.add('circle');

    // Random size between 10px and 50px
    const size = Math.random() * 40 + 10;
    circle.style.width = `${size}px`;
    circle.style.height = `${size}px`;

    // Random horizontal position across the screen
    const posX = Math.random() * window.innerWidth;
    circle.style.left = `${posX}px`;

    // Random animation duration between 3s and 10s
    const duration = Math.random() * 7 + 3;
    circle.style.animationDuration = `${duration}s`;

    // Append circle to the background container
    background.appendChild(circle);

    // Remove circle after animation is complete
    setTimeout(() => {
        circle.remove();
    }, duration * 1000);
}

// Generate circles at random intervals
setInterval(createCircle, 300);

// END BACKGROUND ANIMATION
</script>

</html>