<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - layout.header.php
 */
?>
<!-- mobile header -->
<div class="mobile-header nav-overlay">

    <!-- menu icon -->
    <span class="btn-mobile" uk-toggle="target: #wrapper ; cls: mobile-active"></span>

    <a href="dashboard.html" class="logo">
        <i class=" uil-graduation-hat-3"></i> Courseplus
    </a>

    <!-- icon search-->
    <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade"
       href="#"></a>

</div>

<!-- search overlay-->
<div id="searchbox">

    <div class="search-overlay"></div>

    <div class="search-input-wrapper">
        <div class="search-input-container">
            <div class="search-input-control">
                        <span class="icon-feather-x btn-close uk-animation-scale-up"
                              uk-toggle="target: #searchbox; cls: is-active"></span>
                <div class=" uk-animation-slide-bottom">
                    <input type="text" name="search" autofocus required>
                    <p class="search-help">Type the name of the Course and book you are looking for</p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- overlay seach on mobile-->
<div class="nav-overlay uk-navbar-left uk-flex-1 bg-grey uk-light p-3" hidden>
    <div class="uk-navbar-item uk-width-expand">
        <form class="uk-search uk-search-navbar uk-width-1-1">
            <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
        </form>
    </div>
    <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade"
       href="#"></a>
</div>

