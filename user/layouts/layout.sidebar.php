<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - layout.sidebar.php
 */
?>
<div class="side-nav uk-animation-slide-left-medium">

    <div class="side-nav-bg"></div>

    <!-- logo -->
    <div class="logo uk-visible@s">
        <a href="dashboard.html">
            <img src="<?php echo BASE_URL ?>assets/images/ryd_logo.png" class=" uil-graduation-hat"></img>
        </a>
    </div>

    <ul>
        <li>
            <a href="#"> <i class="uil-play-circle"></i> </a>
            <div class="side-menu-slide">
                <div class="side-menu-slide-content">
                    <ul data-simplebar>
                        <li>
                            <a href="courses.html"> <i class="uil-brush-alt "></i> Web Development </a>
                        </li>
                </div>
            </div>
        </li>
        <li>
            <!-- book -->
            <a href="book.html"> <i class="uil-book-alt"></i> <span class="tooltips"> Book</span> </a>
        </li>
        <li>
            <!-- Episodes -->
            <a href="episode.html"> <i class="uil-youtube-alt"></i> <span class="tooltips"> Episodes</span></a>
        </li>
        <li>
            <!-- Blog-->
            <a href="blog-1.html"> <i class="uil-file-alt"></i> <span class="tooltips"> Blog</span></a>
        </li>
    </ul>
    <ul class="uk-position-bottom">
        <li>
            <!-- Lunch information box -->
            <a href="#">
                <i class="uil-paint-tool"></i>
            </a>
            <div uk-drop="pos: right-bottom ;mode:click ; offset: 10;animation: uk-animation-slide-right-small">
                <div class="uk-card-default rounded p-0">
                    <h5 class="mb-0 p-3 px-4  bg-light"> Night mode</h5>
                    <div class="p-3 px-4">
                        <p>Turns the light surfaces of the page dark, creating an experience ideal for night.
                        </p>
                        <div class="uk-flex">
                            <p class="uk-text-small text-muted">DARK THEME </p>
                            <!-- night mode button -->
                            <span href="#" id="night-mode" class="btn-night-mode">
                                        <label class="btn-night-mode-switch">
                                            <span class="uk-switch-button"></span>
                                        </label>
                                    </span>
                        </div>

                    </div>
                </div>

        </li>
        <li>
            <a href="#">
                <span class="icon-feather-user"></span>
            </a>
            <div uk-drop="pos: right-bottom ;mode:click ; offset: 10;animation: uk-animation-slide-right-small">
                <div class="uk-card-default rounded p-0">
                    <a href="user-profile.html" class="p-0">

                        <div class="dropdown-user-details">
                            <div class="dropdown-user-avatar">
                                <img src="assets/images/avatars/avatar-2.jpg" alt="">
                            </div>
                            <div class="dropdown-user-name">
                                Richard Ali <span>Students</span>
                            </div>
                        </div>

                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <i class="icon-material-outline-dashboard"></i> Dashboard</a>
                        </li>
                        <li><a href="user-profile-edit.html">
                                <i class="icon-feather-settings"></i> Account Settings</a>
                        </li>
                        <li><a href="#" class="text-grey">
                                <i class="icon-feather-star"></i> Upgrade To Premium</a>
                        </li>
                        <li class="menu-divider">
                        </li>
                        <li><a href="#">
                                <i class="icon-feather-help-circle"></i> Help</a>
                        </li>
                        <li><a href="page-login.html">
                                <i class="icon-feather-log-out"></i> Sing Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>

