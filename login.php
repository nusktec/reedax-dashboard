<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - index.php
 */
?>
<!doctype html>
<html lang="en">

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
                <h1 class="mb-4"> RYD Institute</h1>
                <p>The Place You can learn Every Thing. </p>
            </div>

            <!-- column two -->
            <div class="uk-card-default p-6">
                <div class="my-4 uk-text-center">
                    <h2 class="mb-0"> Welcome back</h2>
                    <p class="my-2">Login to manage your account.</p>
                </div>
                <form>

                    <div class="uk-form-group">
                        <label class="uk-form-label"> Email</label>

                        <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-mail"></i>
                                </span>
                            <input class="uk-input" type="email" placeholder="name@example.com">
                        </div>

                    </div>

                    <div class="uk-form-group">
                        <label class="uk-form-label"> Password</label>

                        <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-lock"></i>
                                </span>
                            <input class="uk-input" type="password" placeholder="********">
                        </div>

                    </div>

                    <div class="mt-4 uk-flex-middle" uk-grid>
                        <div class="uk-width-expand@s">
                            <p> Don't have account <a href="page-register.html">Sign up</a></p>
                        </div>
                        <div class="uk-width-auto@s">
                            <button type="submit" class="button grey">Get Started</button>
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
