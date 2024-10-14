<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spin Wheel</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet" />
    <style>
    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }
    </style>

</head>

<body>
    <video class="coin_video" width="100%" autoplay loop muted>
        <source src="./assets/falling_coin.mp4" type="video/mp4" />
    </video>
    <div class="background"></div>

    <div class="container content">
        <div class="row">
            <div class="col">
                <!-- START PROFILE -->
                <div class="user_profile">
                    <img src="{{ asset('account/landing_page_images/assets/profile7.svg') }}"
                        alt><span style="margin-right:20px">{{ session('user_email') }}</span>
                    {{-- <button type="button" class="sta_r">
                            <span>Login</span>
                        </button> --}}
                </div>
                <!-- END PROFILE -->
                <div class="items_3">
                    <!-- COWNDOWN -->
                    <div id="timer" class="coun_down" style="display: flex;">
                        <img src="{{ asset('account/landing_page_images/assets/stop_1.svg') }}" alt>
                        <div id="hours" class="count_digit"></div>
                        <div id="minutes" class="count_digit"></div>
                        <div id="seconds" class="count_digit"></div>
                    </div>

                    <div class="sta_r">
                        <div class="icon"><img src="{{ asset('account/landing_page_images/assets/star.svg') }}" alt>
                            <span>{{ $prize_tokens }}</span>
                        </div>
                    </div>
                    <!-- COWNDOWN -->
                </div>
                @if (session('message'))
                <div class="custom-alert" id="message">
                    {{ session('message') }}
                </div>
                @endif
                <img id="arrow" class="arrow float"
                    src="{{ asset('account/landing_page_images/assets/7-comic-arrow-1.png') }}" />
                <h4 class="instruct">
                    PRESS "SPACE" KEY TO SPIN THE WHEEL
                </h4>

                <div class="pop-up-content" style="text-align: center">
                    <h1>You Won!!</h1>
                    <p class="pop-up-para"></p>
                    <input type="hidden" value="" id="reward_tokens">
                    <button class="pop-up-btn" id="closePopup">Activate Bonus</button>
                </div>

                <!-- START RANKING -->

                <!-- <div class="rating-stars">
            <input type="radio" name="rating" id="rs0" checked><label for="rs0"></label>
            <input type="radio" name="rating" id="rs1"><label for="rs1"></label>
            
            <span class="rating-counter"></span>
          </div> -->
                <!-- START RANKING -->
                {{-- @dd(session()->all()) --}}
                <img style="margin-top: 1rem; position: relative; top: 22px; z-index: 1;" class="pin"
                    src="{{ asset('account/landing_page_images/assets/pin_.png') }}" alt />
                <img id="spinner" class="shake"
                    src="{{ asset('account/landing_page_images/assets/spin_wheel.png') }}" />
                <!-- <img class="wheel-stand" src="./assets/stand.png" alt /> -->
                {{-- <div id="spin-btn" class="spin_btn" onclick="spin()" data-user_id="{{ session('user_id') }}">
                <img class="spin-btn" src="{{ asset('account/landing_page_images/assets/blue_button.png') }}" alt />
            </div> --}}
            <div id="spin-btn" class="spin_btn" data-user_id="{{ session('user_id') }}">
                <img class="spin-btn" src="{{ asset('account/landing_page_images/assets/blue_button.png') }}" alt />
            </div>
            <div class="invite_reward">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="{{ asset('account/landing_page_images/assets/invite.svg') }}" alt><span>Friends</span>
                </button>

                    <button data-bs-toggle="modal" data-bs-target="#walletModal">
                        <img style="margin-bottom: 4px;"
                            src="{{ asset('account/landing_page_images/assets/wallet.svg') }}" alt><span>Wallet</span>
                    </button>
                    <button data-bs-toggle="modal" data-bs-target="#example_Modal">
                        <img style="width: 16px; margin-top: -5px;"
                            src="{{ asset('account/landing_page_images/assets/rewardbox.svg') }}"
                            alt><span>Rewards</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- <div class="pop-up">
      
    </div> -->

    <!-- START INVITE Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal_body_invite">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Invitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="invite_list">
                        <ul>
                            @foreach ($direct_referral as $key => $row)
                            <li>{{ $row->username }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="invite_button">
                        <button>
                            Invite Friends...
                            <input type="text" value="{{ $user_referral_link }}" id="myInput" style="display: none">
                            <i onclick="myFunction()" class="fa fa-clone"></i>
                        </button>
                        <button>
                            <span>Your Referal</span><span>{{ $direct_referral_count }}</span>
                        </button>
                    </div>
                </div>
                <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
            </div>
        </div>
    </div>
    <!--END INVITE Modal -->

    <!-- START Wallet Modal -->
    <div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal_body_invite">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletModalLabel">Wallet Adress</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="walletForm" method="POST" action="{{ route('add-wallet-address') }}">
                        @csrf
                        <div class="wallet_button">
                            <input type="text" name="wallet_address" id="wallet_address"
                                placeholder="Enter your wallet address"
                                value="{{ old('wallet_address', $walletAddress ?? '') }}"
                                {{ isset($walletAddress) ? 'disabled' : '' }} required>
                        </div>
                        <div class="wallet_button">
                            <button type="submit" {{ isset($walletAddress) && $walletAddress != '' ? 'disabled' : '' }}>
                                Add Wallet
                            </button>
                        </div>
                    </form>
                </div>

                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
            </div>
        </div>
    </div>
    <!--END Wallet Modal -->

    <!-- START REWARD MODAL -->
    <div class="modal fade" id="example_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal_body_reward">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Rewards</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="reward_modal_cls_btn"></button>
                </div>
                <div class="modal-body">
                    <div class="reward_main">
                        <h5 style="">Rewards: {{ $social_media_rewards }}</h5>
                        <!-- Social Media Buttons -->
                        <div class="social-links">

                            @if ($instagram_claimed != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://www.instagram.com/join_nims/" data-wait-time="5000">
                                <span class="social-text d-flex">
                                <img src="{{ asset('account/landing_page_images/assets/instagram.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Follow NIMS<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>

                                <button id="instagram_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    style="cursor: pointer ; visibility: hidden;" data-source="instagram"
                                    data-points="100">Follow
                                </button>

                            </div>
                            @else
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                <img src="{{ asset('account/landing_page_images/assets/instagram.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                        Follow on Instagram<br>
                                        <span class="muted-point-value ml-3"
                                            style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                        <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                            Claimed</span>
                                    </span>
                                </div>
                            @endif

                            @if ($telegram_claimed != true)
                            <div class="social-link" data-link_clicked="0" data-url="https://t.me/join_NIMS"
                                data-wait-time="5000">
                                <span class="social-text d-flex">
                                <img src="{{ asset('account/landing_page_images/assets/telegram.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>

                                        Follow NIMS<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            200</span>
                                    </div>
                                </span>
                                <button id="telegram_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="telegram" data-points="200" style="visibility: hidden">Follow</button>

                            </div>
                            @else
                            <div class="social-link" style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                <img src="{{ asset('account/landing_page_images/assets/telegram.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                Follow on Telegram<br>
                                <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                    200</span>
                                <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                    Claimed</span>
                                </span>
                            </div>
                            @endif

                            @if ($telegram_claimed != true)
                            <div class="social-link" data-link_clicked="0" data-url="https://www.linkedin.com/company/nims-network/mycompany/"
                                data-wait-time="5000">
                                <span class="social-text d-flex">
                                <img src="{{ asset('account/landing_page_images/assets/linkedIn.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>

                                        Follow NIMS<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>
                                <button id="linkedIn_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="linkedIn" data-points="100" style="visibility: hidden">Follow</button>

                            </div>
                            @else
                            <div class="social-link" style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                <img src="{{ asset('account/landing_page_images/assets/linkedIn.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                Follow on LinkedIn<br>
                                <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                    100</span>
                                <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                    Claimed</span>
                                </span>
                            </div>
                            @endif

                            @if ($facebook_claimed != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://www.facebook.com/nimsnetwork?mibextid=kFxxJD" data-wait-time="5000">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/facebook.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Follow NIMS<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>
                                <button id="facebook_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="facebook" data-points="100" style="visibility: hidden">Follow</button>

                            </div>
                            @else
                            <div class="social-link" style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                <img src="{{ asset('account/landing_page_images/assets/facebook.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                Follow on Facebook<br>
                                <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                    100</span>
                                <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                    Claimed</span>
                                </span>
                            </div>
                            @endif


                            @if ($twitter_join_claimed != true)
                            <div class="social-link" data-link_clicked="0" data-url="https://x.com/join_nims"
                                data-wait-time="5000">
                                <span class="social-text d-flex">

                                <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Follow NIMS
                                        <br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            200</span>
                                </span>
                            </div>

                            <button id="x_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                data-source="x_join(twitter)" data-points="200" style="visibility: hidden">Follow</button>

                        </div>
                        @else
                        <div class="social-link"
                            style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                            <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                            <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                Follow on X<br>
                                <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                    200</span>
                                <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                    Claimed</span>
                                </div>
                            </span>
                        @endif
                        @if ($twitter_like_claimed != true)
                        <div class="social-link" data-link_clicked="0" data-url="https://x.com/join_nims"
                            data-wait-time="5000">
                            <span class="social-text d-flex">

                            <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                <div>
                                    Like our Tweet
                                    <br>
                                    <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                    </div>
                            </span>

                        <button id="x_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                            data-source="x_like(twitter)" data-points="100" style="visibility: hidden">Like</button>

                    </div>
                    @else
                    <div class="social-link"
                        style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                        <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                        <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                            Liked<br>
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                100</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                Claimed</span>
                        </span>
                    </div>
                    @endif

                    @if (@$FollowCEO != true)
                        <div class="social-link" data-link_clicked="0" data-url="https://x.com/RootBlockCEO"
                            data-wait-time="5000">
                            <span class="social-text d-flex">
                            <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                <div>
                                    Follow Nims CEO<br>
                                    <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                </div>
                            </span>
                            <button id="ceo_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                data-source="FollowCEO" data-points="100" style="visibility: hidden">Follow</button>
                        </div>
                    @else
                        <div class="social-link"
                            style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text">
                            Follow Nims CEO<br>
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                100</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                Claimed</span>
                            </span>
                        </div>
                    @endif

                    @if (@$FollowCTO != true)
                        <div class="social-link" data-link_clicked="0"
                            data-url="https://x.com/@kalzsm" data-wait-time="5000">
                            <span class="social-text d-flex">
                            <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"  style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                            <div>

                                Follow Nims CTO<br>
                                <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                    100</span>
                                </div>

                            </span>
                            <button id="cio_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                data-source="FollowCTO" data-points="100" style="visibility: hidden">Follow</button>
                        </div>
                    @else
                        <div class="social-link"
                            style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text">
                            Follow Nims CTO<br>
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                100</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                Claimed</span>
                            </span>
                        </div>
                    @endif



                    @if ($telegram_claimed != true)
                            <div class="social-link" data-link_clicked="0" data-url="https://www.youtube.com/@NimsNetwork"
                                data-wait-time="5000">
                                <span class="social-text d-flex">
                                <img src="{{ asset('account/landing_page_images/assets/youtube.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>

                                        Follow NIMS<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>
                                <button id="telegram_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="telegram" data-points="100" style="visibility: hidden">Follow</button>

                            </div>
                            @else
                            <div class="social-link" style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                <img src="{{ asset('account/landing_page_images/assets/telegram.svg') }}"  style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                Subscribe Our YouTube Channel<br>
                                <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                    100</span>
                                <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                    Claimed</span>
                                </span>
                            </div>
                            @endif


                    @if (@$watchYouTubeVideo != true)
                    <div class="social-link" data-link_clicked="0" data-url="https://www.youtube.com/watch?v=H3-qw3olnB4&ab_channel=NimsNetwork"
                        data-wait-time="5000" style="">
                        <span class="social-text d-flex">
                        <img src="{{ asset('account/landing_page_images/assets/youtube.svg') }}"  style="width: 25px; border-radius:20px;margin: 0px 18px 0px 0px;" alt="">
                            <div>
                                Watch Video YouTube<br>
                                <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                    100</span>
                            </div>
                        </span>
                        <button id="video_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                            data-source="watchYouTubeVideo" data-points="100" style="visibility: hidden">Watch
                            Video</button>
                    </div>
                    @else
                    <div class="social-link"
                            style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text">
                            Watch Video YouTube<br>
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                100</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                Claimed</span>
                            </span>
                        </div>
                    @endif

                    {{-- @if(@$ReTweetLink != true)
                    <div class="url-claim social-link">
                        <input type="text" id="url-input" placeholder="Paste retweet link" />
                        <button class="claim-button" data-user_id="{{ session('user_id') }}"
                            data-source="ReTweetLink" data-points="200" id="claim-url-btn">Claim
                        </button>
                    </div>
                    @else
                    <div class="url-claim social-link"
                            style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text">
                            ReTweet Link<br>
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                200</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                Claimed</span>
                            </span>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    <!-- END REWARD MODAL -->

    {{-- <script src="{{ asset('account/js/spinnergame.js') }}"></script> --}}
</body>

</html>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {

    $('#closePopup').click(function(event) {
        event.preventDefault();
        spinnerClaimReward();
    });
});

const prizes = [{
        id: 0,
        msg: "0",
    },
    {
        id: 1,
        msg: "10",
    },
    {
        id: 2,
        msg: "300",
    },
    {
        id: 3,
        msg: "50",
    },
    {
        id: 4,
        msg: "150",
    },
    {
        id: 5,
        msg: "200",
    },
    {
        id: 6,
        msg: "400",
    },
    {
        id: 7,
        msg: "1",
    },
    {
        id: 8,
        msg: "500",
    },
    {
        id: 9,
        msg: "-1",
    },
    {
        id: 10,
        msg: "250",
    },
    {
        id: 11,
        msg: "100",
    },
];

var activeBtn = false;
var audio = new Audio("./account/landing_page_images/assets/wheel-audio.mp3");

function randomNum() {
    var prizeNum = Math.random() * 12;
    prizeNum = Math.floor(prizeNum);
    console.log(prizeNum);
    return prizeNum;
}

function removeClass() {
    prize = randomNum();

    document.getElementById("spinner").classList.remove("spin");
    document.getElementById("spin-btn").classList.remove("disabled");
    //   document.getElementById("spinner").classList.add("shake");

    document.getElementById("spinner").style.transform =
        "rotate(" + prize * 30 + "deg)";

    // $(".pop-up-content").fadeIn();
    $(".pop-up-content").fadeIn(); // Show the modal

    // Set a timeout to hide the modal after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        spinnerClaimReward();
        $(".pop-up-content").fadeOut(); // Hide the modal with a fade out effect
    }, 5000);

    setTimeout(function() {
        document.getElementById("spin-btn").disabled = false;
        document.getElementById("arrow").classList.add("float");
        activeBtn = false;
    }, 2000);

    prizeText = prizes[prize].msg;

    // console.log("Current Prize Amount is: " +prizeText);
    sessionStorage.setItem("prizeAmount", prizeText);


    document.getElementsByClassName("pop-up-para")[0].innerHTML = prizeText;
    document.getElementById("reward_tokens").value = prizeText;
    $(".pop-up").fadeIn();
}

function spinnerClaimReward() {
    // event.preventDefault();
    $userID = $('.spin_btn').data('user_id');
    let prize_amount = sessionStorage.getItem('prizeAmount');
    console.log($userID);
    console.log("prize_amount: " + prize_amount);

    $.ajax({
        url: "{{ route('spinner-game-reward') }}",
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            user_id: $userID,
            prize_amount: prize_amount,
            source: 'web_app'
        },
        success: function(response) {
            console.log(response);
            if (response.status == true) {
                window.location.reload();
            } else {
                swal({
                    title: "Oops",
                    text: response.message,
                    icon: "error",
                    button: "OK",
                });
            }
        },
    });

    $(".pop-up-content").fadeOut();
}

function spin() {
    activeBtn = true;
    audio.play();

    //   document.getElementById("spinner").classList.remove("shake");
    document.getElementById("arrow").classList.remove("float");
    document.getElementById("spinner").classList.add("spin");
    document.getElementById("spin-btn").disabled = true;

    setTimeout(removeClass, 5000);
}
activeBtn = false;

document.addEventListener("keydown", (event) => {
    console.log(event);
    if (event.key === " " && activeBtn === false) {
        $("#spin-btn").trigger("click");
    }
});

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


// START "COPY" JAVASCRIPT
function myFunction() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    alert("Copied the text: " + copyText.value);
}
// END "COPY" JAVASCRIPT
</script>


{{-- spinner and timer code --}}
<script>
    $(document).ready(function() {
        // default load time count down
        let remaining_time = "{{ $timeRemaining }}";
        console.log("Remaining Time for Spin Again: " + remaining_time);
        let totalSeconds = timeStringToSeconds(remaining_time);
        startCountdown(totalSeconds);

    $('#spin-btn').click(function(event) {
        event.preventDefault();

        var userID = $(this).data('user_id');

        if (userID == null || userID == '') {
            window.location.href = "{{ route('spinner-game-login') }}";
            return;
        }

        // AJAX request to check if the user has already spun
        $.ajax({
            url: "{{ route('verify-user-already-spinned') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userID
            },
            success: function(response) {
                const totalSeconds = timeStringToSeconds(response.remaining_time);
                if (response.status == true) {
                    swal({
                        title: "Hang tight, your spin is next.",
                        text: response.next_spin_time,
                        
                        button: "OK",
                    });
                    startCountdown(totalSeconds);
                } else {
                    spin();
                }
            }
        });
    });

    function spin() {
        // Your existing spin logic
        activeBtn = true;
        audio.play();
        document.getElementById("arrow").classList.remove("float");
        document.getElementById("spinner").classList.add("spin");
        document.getElementById("spin-btn").disabled = true;
        setTimeout(removeClass, 5000);
    }

    function startCountdown(seconds) {
        const timerElement = document.getElementById('timer');
        timerElement.style.visibility = 'visible'; // Show the timer

        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');

        // Ensure seconds is a valid number
        if (isNaN(seconds) || seconds === null || seconds < 0) {
            console.error("Invalid seconds value:", seconds);
            return; // Exit the function if seconds is invalid
        }

        // Declare timerInterval here to avoid 'before initialization' error
        let timerInterval;

        function updateTimer() {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = seconds % 60;

            // Update the timer elements with formatted values
            hoursElement.textContent = hours.toString().padStart(2, '0') + 'h';
            minutesElement.textContent = minutes.toString().padStart(2, '0') + 'm';
            secondsElement.textContent = remainingSeconds.toString().padStart(2, '0') + 's';

            // Decrease the seconds
            seconds--;

            // Stop the countdown when it reaches 0
            if (seconds < 0) {
                clearInterval(timerInterval);
                timerElement.style.display = 'none'; // Hide the timer
                // Optionally, allow the user to spin again here
                document.getElementById("spin-btn").disabled = false; // Enable spin button
            }
        }

        // Update the timer immediately
        updateTimer();
        // Update the timer every second
        timerInterval = setInterval(updateTimer, 1000);
    }

    function timeStringToSeconds(timeString) {
        if (!timeString || typeof timeString !== 'string') {
            console.error("Invalid time string:", timeString);
            return 0; // Return 0 or handle the error appropriately
        }

        const [hours, minutes, seconds] = timeString.split(':').map(Number);
        return hours * 3600 + minutes * 60 + seconds;
    }
});


$(document).ready(function() {
    $('.social-link').click(function() {
        const span = $(this);
        const url = span.data('url');
        const waitTime = span.data('wait-time');
        const link_clicked = span.data('link_clicked');

        if (link_clicked == 0) {
            window.open(url, '_blank');
            span.data('link_clicked', 1);
            $('.badge').css('display', 'none');
        }

        let claimButton = span.closest('.social-link').find('.claim-button');
        claimButton.prop('disabled', true).css('visibility', 'visible').text('Please wait...');

        setTimeout(function() {
            claimButton.prop('disabled', false).text('Claim Reward');
        }, waitTime);
    });

    // Handle the click on the claim button to send an AJAX request
    $('.claim-button').click(function(event) {
        event.preventDefault();
        const button = $(this);
        const container = button.closest('.social-link');
        const userID = button.data('user_id');
        const source = button.data('source');
        const points = button.data('points');

        // Check if the user is logged in
        if (!userID) {
            window.location.href = "{{ route('spinner-game-login') }}";
            return;
        }

        // AJAX request to claim the reward
        $.ajax({
            url: "{{ route('social-media-rewards') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userID,
                source: source,
                points: points
            },
            success: function(response) {
                if (response.status) {
                    // Disable the button and container after claiming the reward
                    button.prop('disabled', true).text('Reward Claimed');

                    // Disable all interactions within the container
                    container.find('span.social-text').off('click');
                    container.find('.claim-button').off('click').prop('disabled', true);

                    // Display claimed icon/message
                    container.html(`
                                <div style="color:white; display: flex; justify-content: space-between; align-items: center;">
                                    <span class="social-text">
                                        Thanks for joining!
                                        <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points: 100</span>
                                    </span>
                                </div>
                                <div>
                                    <span class="claimed-icon" style="color: green; margin-left: auto;">✔️ Claimed</span>
                                </div>
                            `);

                } else {
                    swal({
                        title: "Oops",
                        text: response.message,
                        icon: "error",
                        button: "OK",
                    });
                }
            },
            error: function(xhr, status, error) {
                swal({
                    title: "Error",
                    text: "There was an error claiming the reward. Please try again.",
                    icon: "error",
                    button: "OK",
                });
            }
        });
    });

    $('#reward_modal_cls_btn').click(function() {
        window.location.reload();
    })
});

setTimeout(function() {
    document.getElementById('message').style.display = 'none';
}, 5000);
</script>