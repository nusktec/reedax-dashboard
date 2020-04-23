<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - index.php
 */
define("SPECIAL_CODE", 200);
require_once(__DIR__ . "/configs/loader.php");
require_once(__DIR__ . "/lib/lib.php");
//script config start
set_title("Home");
//script config ends
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'user/layouts/layout.head.php'; ?>
</head>

<body>

<div id="wrapper">
    <?php include 'user/layouts/layout.header.php'; ?>

    <!-- side nav-->
    <?php include 'user/layouts/layout.sidebar.php'; ?>

    <div class="page-content">
        <div class="page-content__inner">
            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="#"> Dashboard </a></li>
                    <li><a href="#">Courses</a></li>
                    <li>Browse Web Development</li>
                </ul>
            </nav>

            <!-- course card resume sliders  -->
            <div class="section-small">

                <div uk-slider="finite: true" class="course-grid-slider">

                    <div class="grid-slider-header">
                        <div>
                            <h4 class="uk-text-truncate"> Progress Courses</a>
                            </h4>
                        </div>
                        <div class="grid-slider-header-link">

                            <a href="courses.html" class="button transparent uk-visible@m"> View all </a>
                            <a href="#" class="slide-nav-prev" uk-slider-item="previous"></a>
                            <a href="#" class="slide-nav-next" uk-slider-item="next"></a>

                        </div>
                    </div>

                    <ul
                            class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-5@m uk-grid">
                        <li><a href="course-lesson-1.html">
                                <div class="course-card-resume">
                                    <div class="course-card-resume-thumbnail">
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/course/7.png">
                                    </div>
                                    <div class="course-card-resume-body">
                                        <h5> Learn The Complete Ruby on Rails Developer </h5>
                                        <span class="number"> 3/20 </span>
                                        <div class="course-progressbar">
                                            <div class="course-progressbar-filler" style="width:65%"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="course-lesson-1.html">
                                <div class="course-card-resume">
                                    <div class="course-card-resume-thumbnail">
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/course/3.png">
                                    </div>
                                    <div class="course-card-resume-body">
                                        <h5> Ultimate Web Designer And Developer Course </h5>
                                        <span class="number"> 3/20 </span>
                                        <div class="course-progressbar">
                                            <div class="course-progressbar-filler" style="width:65%"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><a href="course-lesson-1.html">
                                <div class="course-card-resume">
                                    <div class="course-card-resume-thumbnail">
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/course/1.png">
                                    </div>
                                    <div class="course-card-resume-body">
                                        <h5> Ultimate Web Designer And Developer Course </h5>
                                        <span class="number"> 3/20 </span>
                                        <div class="course-progressbar">
                                            <div class="course-progressbar-filler" style="width:65%"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="course-lesson-1.html">
                                <div class="course-card-resume">
                                    <div class="course-card-resume-thumbnail">
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/course/4.png">
                                    </div>
                                    <div class="course-card-resume-body">
                                        <h5>Learn Programming Game From Scratch To Experts</h5>
                                        <span class="number"> 3/20 </span>
                                        <div class="course-progressbar">
                                            <div class="course-progressbar-filler" style="width:65%"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><a href="course-lesson-1.html">
                                <div class="course-card-resume">
                                    <div class="course-card-resume-thumbnail">
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/course/2.png">
                                    </div>
                                    <div class="course-card-resume-body">
                                        <h5> Learn Programming Game From Scratch </h5>
                                        <span class="number"> 3/20 </span>
                                        <div class="course-progressbar">
                                            <div class="course-progressbar-filler" style="width:65%"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="course-path-level.html" class="skill-card">
                                <i class="icon-brand-python skill-card-icon" style="color:#154f5f"></i>
                                <div>
                                    <h2 class="skill-card-title"> Python Courses</h2>
                                    <p class="skill-card-subtitle"> 12 courses <span
                                                class="skill-card-bullet"></span> 4
                                        bundles
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>


            <div class="section-small pt-0">

                <div class="course-grid-slider" uk-slider>

                    <div class="grid-slider-header">
                        <div>
                            <h4 class="uk-text-truncate"> popular <a href="#" class="text-success">Topics</a></h4>
                        </div>
                        <div class="grid-slider-header-link">

                            <a href="course-path.html" class="button transparent uk-visible@m"> View all </a>
                            <a href="#" class="slide-nav-prev" uk-slider-item="previous"></a>
                            <a href="#" class="slide-nav-next" uk-slider-item="next"></a>

                        </div>
                    </div>

                    <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-grid">
                        <li>
                            <a href="course-path-level.html" class="skill-card">
                                <i class="icon-brand-angular skill-card-icon" style="color:#dd0031"></i>
                                <div>
                                    <h2 class="skill-card-title"> Angular Courses</h2>
                                    <p class="skill-card-subtitle"> 5 courses <span
                                                class="skill-card-bullet"></span> 3
                                        bundles
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="course-path-level.html" class="skill-card">
                                <i class="icon-brand-js-square skill-card-icon" style="color:#f7df1e"></i>
                                <div>
                                    <h2 class="skill-card-title"> Angular Courses</h2>
                                    <p class="skill-card-subtitle"> 5 courses <span
                                                class="skill-card-bullet"></span> 3
                                        bundles
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="course-path-level.html" class="skill-card">
                                <i class="icon-brand-html5 skill-card-icon" style="color:#f0653f"></i>
                                <div>
                                    <h2 class="skill-card-title"> Angular Courses</h2>
                                    <p class="skill-card-subtitle"> 5 courses <span
                                                class="skill-card-bullet"></span> 3
                                        bundles
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="course-path-level.html" class="skill-card">
                                <i class="icon-brand-node-js skill-card-icon" style="color:#64d25d"></i>
                                <div>
                                    <h2 class="skill-card-title"> NodeJS Courses</h2>
                                    <p class="skill-card-subtitle"> 5 courses <span
                                                class="skill-card-bullet"></span> 3
                                        bundles
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>


            <div class="section-small pt-0">

                <div class="course-grid-slider" uk-slider>

                    <div class="grid-slider-header">
                        <div>
                            <h4 class="uk-text-truncate"> Browse Web Development
                                <a href="episode.html" class="text-success">Episodes</a></h4>
                        </div>
                        <div class="grid-slider-header-link">

                            <a href="courses.html" class="button transparent uk-visible@m"> View all </a>
                            <a href="#" class="slide-nav-prev" uk-slider-item="previous"></a>
                            <a href="#" class="slide-nav-next" uk-slider-item="next"></a>

                        </div>
                    </div>

                    <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-grid">
                        <li>
                            <a href="episode-details.html">
                                <div class="course-card episode-card animate-this">
                                    <div class="course-card-thumbnail ">
                                        <span class="item-tag">HTML</span>
                                        <span class="duration">2:39</span>
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/episodes/2.png">
                                        <span class="play-button-trigger"></span>
                                    </div>
                                    <div class="course-card-body">
                                        <h4 class="mb-0"> Creating sticky in HTML </h4>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="episode-details.html">
                                <div class="course-card episode-card animate-this">
                                    <div class="course-card-thumbnail ">
                                        <span class="item-tag">Tips</span>
                                        <span class="duration">5:39</span>
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/episodes/3.png">
                                        <span class="play-button-trigger"></span>
                                    </div>
                                    <div class="course-card-body">
                                        <h4 class="mb-0"> er Creating a Laravel Package </h4>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="episode-details.html">
                                <div class="course-card episode-card animate-this">
                                    <div class="course-card-thumbnail ">
                                        <span class="item-tag">PHP</span>
                                        <span class="duration">5:39</span>
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/episodes/1.png">
                                        <span class="play-button-trigger"></span>
                                    </div>
                                    <div class="course-card-body">
                                        <h4 class="mb-0"> The PHP Singleton class </h4>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="episode-details.html">
                                <div class="course-card episode-card animate-this">
                                    <div class="course-card-thumbnail ">
                                        <span class="item-tag">HTML</span>
                                        <span class="duration">2:39</span>
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/episodes/2.png">
                                        <span class="play-button-trigger"></span>
                                    </div>
                                    <div class="course-card-body">
                                        <h4 class="mb-0"> Creating sticky in HTML </h4>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="episode-details.html">
                                <div class="course-card episode-card animate-this">
                                    <div class="course-card-thumbnail ">
                                        <span class="item-tag">Design</span>
                                        <span class="duration">2:39</span>
                                        <img src="<?php echo BASE_URL ?>assets/fe/images/episodes/5.png">
                                        <span class="play-button-trigger"></span>
                                    </div>
                                    <div class="course-card-body">
                                        <h4 class="mb-0"> Dev Design Quickie </h4>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>

            <!-- footer-->
            <? include 'user/layouts/layout.footer.php' ?>

        </div>
    </div>

</div>


<?php include 'user/layouts/layout.foot.php'; ?>

</body>

</html>
