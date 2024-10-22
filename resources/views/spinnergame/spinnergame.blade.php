<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nims</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('account/landing_page_images/assets/NIMS.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- bs -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=workspace_premium" />
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
    @include('partials.OnLoadReferalModal')
    <video class="coin_video" width="100%" autoplay loop muted>
        <source src="./assets/falling_coin.mp4" type="video/mp4" />
    </video>
    <div class="background"></div>

    <div class="container content">
        <div class="row">
            <div class="col">
                <!-- START PROFILE -->
                <div class="user_profile">
                    <img src="{{ asset('account/landing_page_images/assets/profile7.svg') }}" alt><span
                        style="margin-right:20px">{{ session('user_email') }}</span>
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
                    <div class="timeup sign" id="time-up-message" style="display: none;">

                        <span class="fast-flicker">S</span>PIN<span class="flicker">N</span>NOW

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

                <div class="pop-up-content" id="confettiModal" style="text-align: center">
                    <h1>You Won!!</h1>
                    <p class="pop-up-para"></p>
                    <input type="hidden" value="" id="reward_tokens">
                    {{-- <button class="pop-up-btn" id="closePopup">Activate Bonus</button> --}}
                </div>
                <audio src="./account/landing_page_images/assets/Cheer.wav" id="sound_" preload="auto" hidden></audio>

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
            <div id="spin-btn" class="spin_btn" data-user_id="{{ session('user_id') }}" data-button_click_val="0">
                <img class="spin-btn" src="{{ asset('account/landing_page_images/assets/blue_button.png') }}" alt />
            </div>
            <div class="invite_reward">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="{{ asset('account/landing_page_images/assets/invite.svg') }}" alt><span>Friends</span>
                </button>

                <button data-bs-toggle="modal" data-bs-target="#walletModal" id="wallet_modal_btn">
                    <img style="margin-bottom: 4px;" src="{{ asset('account/landing_page_images/assets/wallet.svg') }}"
                        alt><span>Wallet</span>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#leaderboardModal" id="leaderboard_modal_btn">
                    <img style="margin-bottom: 4px;"
                        src="{{ asset('account/landing_page_images/assets/leaderboard.svg') }}"
                        alt><span>Leaderboard</span>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#example_Modal">
                    <img style="width: 16px; margin-top: -5px;"
                        src="{{ asset('account/landing_page_images/assets/rewardbox.svg') }}" alt><span>Quests</span>
                </button>
            </div>
            <div class="spin_rule">
                <button data-bs-toggle="modal" data-bs-target="#exampleModalrule">
                    <span>Playing Field Rules</span>
                </button>
            </div>

            <div class="spin_rule">
                <button data-bs-toggle="modal" data-bs-target="#leaderBoardModal">
                    <span>Leader Board</span>
                </button>
            </div>
            <div class="spin_rule">
                <a href="https://www.instagram.com/join_nims/" target="_blank"><img
                        src="{{ asset('account/landing_page_images/assets/instagram.svg') }}"
                        style="width: 25px;margin: 0px 18px 0px 0px;" alt=""></a>
                <a href="https://t.me/join_NIMS" target="_blank"><img
                        src="{{ asset('account/landing_page_images/assets/telegram.svg') }}"
                        style="width: 25px;margin: 0px 18px 0px 0px;" alt=""></a>
                <a href="https://www.linkedin.com/company/nims-network/mycompany/" target="_blank"><img
                        src="{{ asset('account/landing_page_images/assets/linkedIn.svg') }}"
                        style="width: 25px;margin: 0px 18px 0px 0px;" alt=""></a>
                <a href="https://www.facebook.com/nimsnetwork?mibextid=kFxxJD" target="_blank"><img
                        src="{{ asset('account/landing_page_images/assets/facebook.svg') }}"
                        style="width: 25px;margin: 0px 18px 0px 0px;" alt=""></a>
                <a href="https://x.com/join_nims" target="_blank"><img
                        src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                        style="width: 25px;margin: 0px 18px 0px 0px;" alt=""></a>
                <a href="https://www.youtube.com/@NimsNetwork" target="_blank"><img
                        src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                        style="width: 25px;margin: 0px 18px 0px 0px;" alt=""></a>

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
                            <li>
                                {{ $row->username }}
                                <span class="badge badge-success" style="margin-left: 10px;">
                                    Claimed
                                    <span class="badge badge-warning" style="margin-left: 5px;">500</span>
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="invite_button">
                        <button onclick="myFunction()">
                            Invite Friends...
                            <input type="text" value="{{ $user_referral_link }}" id="myInput" style="display: none">
                            <i class="fa fa-clone"></i>
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
                    <h5 class="modal-title" id="walletModalLabel">BEP20 Wallet Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form id="walletForm" method="POST" action="{{ route('add-wallet-address') }}"> --}}
                    <form id="walletForm">
                        @csrf
                        <div class="wallet_button">
                            <input type="text" name="wallet_address" id="wallet_address"
                                placeholder="Enter your wallet address"
                                value="{{ old('wallet_address', $walletAddress ?? '') }}" required>
                        </div>
                        <div class="wallet_button">
                            <button id="wallet_submit_button" type="button" data-wallet_address_value=""></button>
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

    <!-- START Wallet Modal -->
    <div class="modal fade" id="leaderboardModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal_body_invite">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletModalLabel">NIMS Leaderboard</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($leaders_list as $key => $leader)
                        <div class="leader_ranks">
                            <div class="leader_names">
                                <!-- Display different icons for top 3 ranks -->
                                @if ($key == 0)
                                    <!-- Gold icon -->
                                    <span class="material-symbols-outlined" style="color: #FFD700;position: relative;top: 2px; font-size: 16px;">workspace_premium</span>
                                @elseif ($key == 1)
                                    <!-- Silver icon -->
                                    <span class="material-symbols-outlined" style="color: #C0C0C0;position: relative;top: 2px; font-size: 16px;">workspace_premium</span>
                                @elseif ($key == 2)
                                    <!-- Bronze icon -->
                                    <span class="material-symbols-outlined" style="color: #CD7F32;position: relative;top: 2px; font-size: 16px;">workspace_premium</span>
                                @else
                                <span class="material-symbols-outlined" style="color: #00b6ff;position: relative;top: 2px; font-size: 16px;">
                                    workspace_premium
                                </span>
                                @endif
                                <span style="font-size: 14px;margin-left: 10px;">{{ $leader->username }}</span>
                            </div>
                            <div class="leaders_point">
                                <img src="{{ asset('account/landing_page_images/assets/star.svg') }}" alt="">
                                <span>{{ $leader->total_reward_tokens }}</span>
                            </div>
                        </div>
                    @endforeach
                    
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="reward_modal_cls_btn"></button>
                </div>
                <div class="modal-body">
                    <div class="reward_main">
                        <h5 style="">Rewards: {{ $social_media_rewards }}</h5>
                        {{-- <hr> --}}
                        <div>
                            @if (!@$DailyQuest)
                            <div class="social-link quest " id="daily-quest" data-quest="0"
                                style="color:white; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/daily_quest.gif') }}"
                                        style="width: 36px;height: 36px;margin: 0px 18px 0px 0px;border-radius: 8px;"
                                        alt="">
                                    <div style="color: white">
                                        Daily Quest<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            500</span>
                                    </div>
                                </span>
                                <button id="start-quest-btn" class="claim-daily-quest"
                                    data-user_id="{{ session('user_id') }}" style="cursor: pointer;">
                                    Start Quest
                                </button>
                            </div>

                            <div id="quest-form" class="d-none" style="margin-top: 20px;text-align:center; ">
                                <p id="question" style="color: white;"></p>
                                <input type="text" class="form-control" id="quest-answer" data-quest_reward_tokens="500"
                                    placeholder="Enter your answer" style="margin-bottom: 10px;" />
                                <button id="submit-answer-btn" class="claim-daily-quest" style="cursor: pointer;">Submit
                                    Answer</button> <br>
                                <small class="blinking-text" style="color: white">Check Our Social Media For Quest
                                    Answers.</small>
                            </div>
                            @else
                            <div class="url-claim social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/daily_quest.gif') }}"
                                        style="width: 36px;height: 36px;margin: 0px 18px 0px 0px;border-radius: 8px;"
                                        alt="">
                                    Daily Quest<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        500</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️ Claimed</span>
                                </span>
                            </div>
                            @endif
                            <hr style="color: #fff">

                            @if (@$watchYouTubeVideo_NimsDecentralizationAndSecurity != true)
                            <div class="social-link" data-link_clicked="0" data-url="https://youtu.be/vsoQoeF2g60"
                                data-wait-time="5000" style="">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                                        style="width: 25px; border-radius:20px;margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Nims Decentralization<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>
                                <button id="video_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="watchYouTubeVideo_NimsDecentralizationAndSecurity" data-points="100"
                                    style="visibility: hidden">Watch
                                    Video</button>
                            </div>
                            @else
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    Nims Decentralization<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>
                                </span>
                            </div>
                            @endif

                            @if (@$ReTweetLink != true)
                            <div class="social-link" id="retweet-link" data-link_clicked="0"
                                data-url="https://x.com/RootBlockCEO" data-wait-time="5000">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Re-Tweet Post<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            200</span>
                                    </div>
                                </span>
                            </div>
                            @else
                            <div class="url-claim social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    ReTweet Link<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        200</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️ Claimed</span>
                                </span>
                            </div>
                            @endif

                            @if ($instagram_claimed != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://www.instagram.com/join_nims/" data-wait-time="5000">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/instagram.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
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
                                    <img src="{{ asset('account/landing_page_images/assets/instagram.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    Follow NIMS<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
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
                                    <img src="{{ asset('account/landing_page_images/assets/telegram.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
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
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/telegram.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    Follow NIMS<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        200</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>
                                </span>
                            </div>
                            @endif

                            @if ($linkedIn_claimed != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://www.linkedin.com/company/nims-network/mycompany/"
                                data-wait-time="5000">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/linkedIn.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
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
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/linkedIn.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    Follow NIMS<br>
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
                                    <img src="{{ asset('account/landing_page_images/assets/facebook.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
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
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/facebook.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    Follow NIMS<br>
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

                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Follow NIMS
                                        <br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            200</span>
                                    </div>
                                </span>

                                <button id="x_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="x_join(twitter)" data-points="200"
                                    style="visibility: hidden">Follow</button>

                            </div>
                            @else
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text" style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    Follow NIMS<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        200</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>
                            </div>
                            </span>
                            @endif
                            @if ($twitter_like_claimed != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://x.com/join_nims/status/1845443105220428214?s=46"
                                data-wait-time="5000">
                                <span class="social-text d-flex">

                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    <div>
                                        Like pined Tweet on X
                                        <br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>

                                <button id="x_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="x_like(twitter)" data-points="100"
                                    style="visibility: hidden">Like</button>

                            </div>
                            @else
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    Like pined Tweet on X<br>
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
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
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
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">

                                    Follow Nims CEO<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>

                                </span>
                            </div>
                            @endif

                            @if (@$FollowCTO != true)
                            <div class="social-link" data-link_clicked="0" data-url="https://x.com/@kalzsm"
                                data-wait-time="5000">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
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
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/x.svg') }}"
                                        style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                                    Follow Nims CTO<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>
                                </span>
                            </div>
                            @endif



                            @if ($youtube_claimed != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://www.youtube.com/@NimsNetwork" data-wait-time="5000">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    <div>

                                        Subscribe NIMS<br>
                                        <span class="muted-point-value" style="font-size: 12px; color: gray;">Points:
                                            100</span>
                                    </div>
                                </span>
                                <button id="youtube_btn" class="claim-button" data-user_id="{{ session('user_id') }}"
                                    data-source="youtube_follow" data-points="100"
                                    style="visibility: hidden">Follow</button>

                            </div>
                            @else
                            <div class="social-link"
                                style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    Subscribe Our Channel<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>
                                </span>
                            </div>
                            @endif


                            @if (@$watchYouTubeVideo != true)
                            <div class="social-link" data-link_clicked="0"
                                data-url="https://www.youtube.com/watch?v=H3-qw3olnB4&ab_channel=NimsNetwork"
                                data-wait-time="5000" style="">
                                <span class="social-text d-flex">
                                    <img src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                                        style="width: 25px; border-radius:20px;margin: 0px 18px 0px 0px;" alt="">
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
                                <span class="social-text d-flex"
                                    style="display:flex; align-items: center; width: 100%;">
                                    <img src="{{ asset('account/landing_page_images/assets/youTube.svg') }}"
                                        style="width: 25px; margin: 0px 18px 0px 0px;" alt="">
                                    Watch Video YouTube<br>
                                    <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points:
                                        100</span>
                                    <span class="claimed-icon" style="color: green;margin-left: auto;">✔️
                                        Claimed</span>
                                </span>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- END REWARD MODAL -->

    <!-- START RULES MODAL -->
    <div class="modal fade" id="leaderBoardModal" tabindex="-1" aria-labelledby="leaderBoardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal_body_invite">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Top Leaders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rule_modal">
                        @foreach ($leaders_list as $key => $value)
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="position">
                                    {{ $key + 1 }}
                                </div>
                                <div class="user_name">
                                    {{ $value->username }}
                                </div>
                            </div>
                            <div class="points">
                                {{ $value->total_reward_tokens }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RULES MODAL -->


    <!-- START RULES MODAL -->
    <div class="modal fade" id="exampleModalrule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal_body_invite">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Playing field rules</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rule_modal">
                        <h3>Game Rules and Participation</h3>
                        <h5>1. Eligibility: <span> All participants with a valid email address are welcome.</span></h5>
                        <h5>2. Spinning: <span> Participants can spin the wheel every 6 hours and earn an extra spin for
                                inviting three friends.</span></h5>
                        <h5>3. Points: <span> Players accumulate points based on spin outcomes and quest
                                completion.</span></h5>
                        <h5>4. Airdrop: <span> Quest completion is essential for eligibility to maximize airdrop
                                rewards.</span></h5>
                        <h5>5. Fair Play: <span> The use of bots, multiple accounts, or any form of cheating is strictly
                                prohibited.</span></h5>
                        <h5>6. Dispute Resolution: <span> The NIMS team reserves the right to resolve any
                                disputes.</span></h5>
                        <h3>Additional Requirements</h3>
                        <h5>7. Social Media Engagement: <span> Following, liking, or subscribing to our social media
                                channels is mandatory for full point accumulation.</span></h5>
                        <h5>8. Quest Answers: <span> Daily quest answers can be found on our social
                                media platforms.</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RULES MODAL -->
    {{-- <script src="{{ asset('account/js/spinnergame.js') }}"></script> --}}
</body>

</html>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    $('#OnLoadReferalModal').modal('show');
    // $('#closePopup').click(function(event) {
    //     event.preventDefault();
    //     spinnerClaimReward();
    // });
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
    // Show the modal and trigger the celebration after the modal fades in
    $(".pop-up-content").fadeIn(500, function() {
        triggerCelebration();
    });
    setTimeout(function() {
        spinnerClaimReward();
        $(".pop-up-content").fadeOut();
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
        let btn_clicked = $(this).data('button_click_val');

        if (btn_clicked == '0') {
            var userID = $(this).data('user_id');

            if (userID == null || userID == '') {
                window.location.href = "{{ route('spinner-game-login') }}";
                return;
            }

            // Disable further clicks
            $(this).data('button_click_val', '1');

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

                    // Re-enable the button for next use (if needed)
                    setTimeout(function() {
                        $('#spin-btn').data('button_click_val', '0');
                    }, 3000);
                }
            });
        }
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
        const timeUpMessage = document.getElementById('time-up-message');
        timerElement.style.visibility = 'visible';

        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');

        if (isNaN(seconds) || seconds === null || seconds < 0) {
            console.error("Invalid seconds value:", seconds);
            return;
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
                timerElement.style.display = 'none';
                timeUpMessage.textContent = "Time's up! Spin now.";
                timeUpMessage.style.display = 'block';
            }
        }

        updateTimer();
        timerInterval = setInterval(updateTimer, 1000);
    }

    function timeStringToSeconds(timeString) {
        if (!timeString || typeof timeString !== 'string') {
            console.error("Invalid time string:", timeString);
            return 0;
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
                                        <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;"></span>
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
    });
});

setTimeout(function() {
    document.getElementById('message').style.display = 'none';
}, 5000);


$(document).ready(function() {
    $('#retweet-link').click(function(event) {
        event.preventDefault();

        // Open the retweet URL in a new tab/window
        var retweetUrl = $(this).data('url');
        window.open(retweetUrl, '_blank');

        // Replace the clicked section with the input field and claim button
        $(this).replaceWith(`
            <div class="url-claim social-link" style="color:white ; display: flex; justify-content: space-between; align-items: center;">
                <span class="social-text d-flex" style="display:flex; align-items: center; width: 100%;">
                     <img src="{{ asset('account/landing_page_images/assets/x.svg') }}" style="width: 25px;margin: 0px 18px 0px 0px;" alt="">
                <input type="text" id="url-input" placeholder="Paste retweet link" required style="color:white" />
                <span class="error-message" style="color: red; display: none;">Please enter a valid retweet link.</span>
                <button class="claim-button" data-user_id="{{ session('user_id') }}" data-source="ReTweetLink"
                    data-points="200" id="claim-url-btn">Claim</button>
                    </span>
            </div>
        `);
    });

    function isValidRetweetUrl(url) {
        const regex = /^https:\/\/x\.com\/.+/; // Check if it starts with 'https://x.com/'
        return regex.test(url) && url.includes('join_nims'); // Ensure 'join_nims' is part of the URL
    }

    $(document).on('click', '#claim-url-btn', function(event) {
        event.preventDefault();

        let user_id = $(this).data('user_id');
        let source = $(this).data('source');
        let points = $(this).data('points');
        let retweetLink = $('#url-input').val();

        // Check if the retweet link is valid
        if (!isValidRetweetUrl(retweetLink)) {
            $('.error-message').show();
            return;
        } else {
            $('.error-message').hide();
        }

        $.ajax({
            url: "{{ route('claim-retweet-link') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                user_id: user_id,
                source: source,
                points: points,
                retweet_link: retweetLink
            },
            success: function(response) {
                if (response.status) {
                    $('.url-claim').html(`
                        <span class="social-text">
                            ReTweet Link<br>
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points: 200</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️ Claimed</span>
                        </span>
                    `);
                } else {
                    $('.error-message').text(response.message).show();
                }
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    let underScore = String.fromCharCode(95);
    let under_score_string = underScore + underScore + underScore + underScore + underScore + underScore;
    console.log(under_score_string);
    // 1st quest ask on 16-10-24    (ans='wallet')
    // const questions = [
    //     `A ${under_score_string} is a digital software program that stores your cryptocurrencies?`,
    // ];

    // 2nd quest ask on 17-10-24 (ans='decentralized')
    //const questions = [
    //    `Cryptocurrencies are ${under_score_string}, meaning they are not controlled by a single entity like a government or bank.`,
    //];

    // 3rd quest ask on 18-10-24 (ans='volatile')
    // const questions = [
    //     `Cryptocurrencies can be ${under_score_string}, meaning their prices can fluctuate significantly.`,
    // ];

    // 4th quest ask on 19-10-24 (ans='cryptocurrency exchange')
     const questions = [
         `Cryptocurrencies can be purchased on a ${under_score_string} or directly from another person.`,
     ];

    // 5th quest ask on 20-10-24 (ans='cryptography')
    // const questions = [
    //     `A cryptocurrency is a digital or virtual currency that uses ${under_score_string} for security and to control the creation of units of a currency`,
    // ];

    $('#start-quest-btn').click(function() {
        $(this).hide();
        $('#quest-form').removeClass('d-none');

        let randomQuestion = questions[Math.floor(Math.random() * questions.length)];
        $('#question').text(randomQuestion);
    });

    $('#submit-answer-btn').click(function() {
        $(this).addClass('disabled' , true);
        let question = $('#question').text();
        let answer = $('#quest-answer').val();
        let quest_reward_tokens = $('#quest-answer').data('quest_reward_tokens');

        if (answer === '') {
            alert('Please enter an answer.');
            return;
        }

        $.ajax({
            url: "{{ route('submit-daily-quest') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                user_id: "{{ session('user_id') }}",
                quest_reward_tokens: quest_reward_tokens,
                question: question,
                answer: answer
            },
            success: function(response) {
                if (response.status) {
                    $('#quest-form').addClass('d-none');
                    $('.quest').html(`
                        <div style="color:white; display: flex; justify-content: space-between; align-items: center;">
                            <span class="social-text d-flex">
                            Daily Quest
                            <span class="muted-point-value ml-3" style="font-size: 12px; color: gray;">Points: 500</span>
                            <span class="claimed-icon" style="color: green;margin-left: auto;">✔️ Claimed</span>
                            </span>
                        </div>
                    `);
                } else {
                    $('#quest-form').append(
                        '<p style="color: red; font-size: 14px;" id="error-message">Incorrect answer. Try again.</p>'
                    );

                    // Remove the error message after a few seconds
                    setTimeout(function() {
                        $('#error-message').remove();
                    }, 3000);
                }
            }
        });
    });

    $('#wallet_modal_btn').click(function() {
        let wallet_address = '{{ $walletAddress }}';

        if (wallet_address === '' || wallet_address === null) {
            $('#wallet_submit_button').text('Add Wallet');
            $('#wallet_submit_button').data('wallet_address_value', '0');
        } else {
            $('#wallet_submit_button').text('Update Wallet');
            $('#wallet_submit_button').data('wallet_address_value', '1');
        }
        console.log("Wallet Address is : " + wallet_address);
    });

    $('#wallet_submit_button').click(function() {
        let wallet_address_verification = $(this).data('wallet_address_value');
        console.log("wallet address already verified value is : " + wallet_address_verification);

        url = '';
        if (wallet_address_verification == '0') {
            url = "{{ route('add-wallet-address') }}";
        } else {
            url = "{{ route('update-wallet-address') }}";
        }
        console.log("wallet address url is : " + url);

        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                user_id: "{{ session('user_id') }}",
                wallet_address: $('#wallet_address').val()
            },
            success: function(response) {
                if (response.status) {
                    swal({
                        title: "Success",
                        text: response.message,
                        icon: "success",
                        button: "OK",
                    }).then(function() {
                        window.location.reload();
                    });

                } else {
                    swal({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        button: "OK",
                    });
                }
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
const defaults = {
    disableForReducedMotion: true
};

function triggerCelebration() {
    const sound = document.getElementById("sound_");
    const modal = document.getElementById("confettiModal");
    const trigger = document.querySelector(".pop-up-content");

    // Show the modal
    modal.style.display = "block";

    function fire(particleRatio, opts) {
        confetti(
            Object.assign({}, defaults, opts, {
                particleCount: Math.floor(200 * particleRatio)
            })
        );
    }

    function confettiExplosion(origin) {
        fire(0.25, {
            spread: 26,
            startVelocity: 55,
            origin
        });
        fire(0.2, {
            spread: 60,
            origin
        });
        fire(0.35, {
            spread: 100,
            decay: 0.91,
            origin
        });
        fire(0.1, {
            spread: 120,
            startVelocity: 25,
            decay: 0.92,
            origin
        });
        fire(0.1, {
            spread: 120,
            startVelocity: 45,
            origin
        });
    }

    // Get the center of the modal content for confetti explosion
    const rect = trigger.getBoundingClientRect();
    const center = {
        x: rect.left + rect.width / 2,
        y: rect.top + rect.height / 2
    };
    const origin = {
        x: center.x / window.innerWidth,
        y: center.y / window.innerHeight
    };

    // Play sound and trigger confetti
    if (sound) {
        sound.currentTime = 0;
        sound.play();
    }
    confettiExplosion(origin);
}
// $(document).ready(function() {
//     // Show the Video Add-On Index Modal on page load
//     $('#OnLoadReferalModal').modal('show');
// });
</script>