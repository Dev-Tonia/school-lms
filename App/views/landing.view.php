<?php
loadPartial('head');
loadPartial('navbar');
?>
<main>
    <div style="height: 80vh;" class="container d-flex align-items-center justify-content-center">
        <div>
            <div class="space-y-1">
                <h2 class="fs-2 fw-bold">
                    Welcome to School LMS landing page
                </h2>
                <div>
                    <a href="/auth/login">Login</a> / <a href="/auth/student/register">Register</a> to get started
                </div>
            </div>
        </div>
    </div>
</main>


<?php
loadPartial('footer');
?>