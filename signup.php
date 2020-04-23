<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - index.php
 */
?>
<!doctype html>
<html lang="en">


<!-- Mirrored from demo.foxthemes.net/courseplusnew/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2017], Thu, 12 Dec 2019 23:22:33 GMT -->
<head>
    <?php include 'user/layouts/layout.head.php'; ?>
</head>

<body>

<!-- Content
================================================== -->
<div uk-height-viewport class="uk-flex uk-flex-middle">
    <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded">
        <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-grey" uk-grid>

            <!-- column one -->
            <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                <i class=" uil-graduation-hat icon-medium"></i>
                <h1 class="mb-4"> Courseplus</h1>
                <p>The Place You can learn Every Thing. </p>
            </div>

            <!-- column two -->
            <div class="uk-card-default p-6">
                <div class="my-4 uk-text-center">
                    <h3 class="mb-0">Create new Account</h3>
                    <p class="my-2">Fill blank to create new account.</p>
                </div>
                <form class="uk-child-width-1-1 uk-grid-small" uk-grid>

                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Name</label>

                            <div class="uk-position-relative w-100">
                                    <span class="uk-form-icon">
                                        <i class="icon-feather-user"></i>
                                    </span>
                                <input class="uk-input" type="text" placeholder="Full name">
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Email</label>

                            <div class="uk-position-relative w-100">
                                    <span class="uk-form-icon">
                                        <i class="icon-feather-mail"></i>
                                    </span>
                                <input class="uk-input" type="email" placeholder="name@example.com">
                            </div>

                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Password</label>

                            <div class="uk-position-relative w-100">
                                    <span class="uk-form-icon">
                                        <i class="icon-feather-lock"></i>
                                    </span>
                                <input class="uk-input" type="password" placeholder="********">
                            </div>

                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Confirm password</label>

                            <div class="uk-position-relative w-100">
                                    <span class="uk-form-icon">
                                        <i class="icon-feather-lock"></i>
                                    </span>
                                <input class="uk-input" type="password" placeholder="********">
                            </div>

                        </div>
                    </div>

                    <div>
                        <div class="mt-4 uk-flex-middle" uk-grid>
                            <div class="uk-width-expand@s">
                                <p> Dont hava account <a href="#">Sign up</a></p>
                            </div>
                            <div class="uk-width-auto@s">
                                <input type="submit" class="button grey" value="Get Started"></input>
                            </div>
                        </div>
                    </div>

                </form>
            </div><!--  End column two -->

        </div>
    </div>
</div>



<?php include 'user/layouts/layout.foot.php'; ?>

</body>

<!-- Mirrored from demo.foxthemes.net/courseplusnew/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2017], Thu, 12 Dec 2019 23:23:23 GMT -->
</html>
