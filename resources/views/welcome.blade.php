<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Question Set</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <!-- Styles -->
<!-- {{--        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}} -->
        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            html, body {

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <div class="loader" style="color: black">
        <img src="images/loader1.gif">
        <!-- <h4>Loading...</h4> -->
    </div>
    <body>
            <div class="content"  style="padding-top: 5rem; padding-bottom: 5rem">
                <img src="images/maxresdefault.jpg" style="width: 30%; height: auto">
                <div class="title m-b-md">
                    The Question Set
                </div>

                <div class="links">
                    <a href="https://github.com/laravel/laravel">GitHub</a>

                    @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/profile') }}">Home</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                    @endif

                    <a href="https://laravel.com/docs">About</a>
                </div>
            </div>
    </body>

        <div class="row"style="background-color: white !important; color: black;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style=" padding-bottom: 5rem; padding-top: 5rem ">
                <center>
                    <p style="font-size: 3rem; font-weight: bold">Semester Papers</p>
                    <p class="text-muted">All your semester papers at one place :)
                        <br>
                        Filter and download.
                        <br><br>
                        <p><a href="/about" class="btn" style="color: blue">Learn More <img src="https://img.icons8.com/officexs/10/000000/arrow.png"></a>
                        <a href="https://en.wikipedia.org/wiki/Abuse" class="btn" style="color: blue">Abuse <img src="https://img.icons8.com/ultraviolet/16/000000/strike.png"></a>
                        </p>
                    </p>
                </center>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 0.5rem" >
                <img src="images/exam.jpg" alt="" style="max-width: 680px; height: auto">
            </div>
        </div>
    <div class="row" style="background-color: whitesmoke !important; color: black">
        <div class="col-lg-12">
           <div class="container pt-3" >
               <p class="text-muted" style="font-weight: lighter; font-size: small">* Trade In: Trade‑in values vary. iPhone 11 and iPhone 11 Pro promotional pricing is after trade‑in of iPhone 8 Plus and iPhone X in good condition. Additional trade‑in values require purchase of a new iPhone, subject to availability and limits. Must be at least 18. Apple or its trade-in partners reserve the right to refuse or limit any Trade In transaction for any reason. In‑store trade‑in requires presentation of a valid, government-issued photo ID (local law may require saving this information). Sales tax may be assessed on full value of new iPhone. Additional terms from Apple or Apple’s trade-in partners may apply. Monthly pricing: Available to qualified customers and requires 0% APR, 24‑month installment loan with Citizens One, and iPhone activation with AT&T, Sprint, T‑Mobile, or Verizon. Full terms apply.
                   ** Apple Arcade and Apple TV+ require a subscription. Apple Arcade is now available on iPhone, iPad, and Apple TV and will be available on Mac this fall.
                   Case and band combinations can be made within collections (Apple Watch, Apple Watch Nike, and Apple Watch Hermès) only.</p>
           </div>
        </div>
    </div>

</html>

<script type="text/javascript">
    !function(e,t,r,n,a){if(!e[a]){for(var i=e[a]=[],c=0;c<r.length;c++){var s=r[c];i[s]=i[s]||function(e){return function(){var t=Array.prototype.slice.call(arguments);i.push([e,t])}}(s)}i.SNIPPET_VERSION="1.0.1";var o=t.createElement("script");o.type="text/javascript",o.async=!0,o.src="https://d2yyd1h5u9mauk.cloudfront.net/integrations/web/v1/library/"+n+"/"+a+".js";var p=t.getElementsByTagName("script")[0];p.parentNode.insertBefore(o,p)}}(window,document,["survey","reset","config","init","set","get","event","identify","track","page","screen","group","alias"],"1vJnWzDNYczcC48d","delighted");

    delighted.survey();
</script>

<script>

    // $(window).load(function() {
    //     // Animate loader off screen
    //     $(".loader").delay(2000).fadeOut("slow");
    //     if ( ! sessionStorage.getItem( 'doNotShow' ) ) {
    //         sessionStorage.setItem( 'doNotShow', true );
    //         Preloader();
    //     } else {
    //         $ ('.loader, .preloader').hide();
    //     }
    // });
    $(document).ready(function() {
        $(window).load(function() {
            function Preloader() {
                var preloader = $ ('.loader');
                preloader.delay(4000) .fadeOut (1000);
                // var preloader = $('.preloader');
                // preloader.delay (1500) .slideUp(500);
            }
            if ( ! sessionStorage.getItem( 'doNotShow' ) ) {
                sessionStorage.setItem( 'doNotShow', true );
                Preloader();
            }
            else {
                $ ('.loader, .preloader').hide();
                // $(".loader").attr("class", "d-none");
            }
        });
    });
</script>



