<?php
loadPartial('head');
?>
<nav class="navbar bg-white shadow sticky-top">
    <div class="container-fluid py-2 px-3 px-md-5">
        <div>
            <i class="bi bi-list fs-4 text-black me-3 d-inline-block menu" role="button"></i>
            <a href="/" class="navbar-brand fw-bold">School Lms</a>
        </div>

        <?php if (isset($_SESSION['user'])) : ?>
            <form method="POST" action="/auth/logout">
                <button type="submit" class="btn btn-warning text-white fw-medium py-2 px-4">
                    <span> <i class="bi bi-box-arrow-right"></i></span>
                    Logout</button>
            </form>
        <?php else : ?>
            <a class="btn btn-outline-warning text-black fw-medium py-2 px-4" href="/auth/login">
                Get Started</a>
        <?php endif; ?>
    </div>
</nav>
<?php
loadPartial('sidebar');
?>
<main class="d-flex mt-5 px-3 px-md-5">
    <div class=" d-none d-md-block col-md-3 col-lg-2 sideUnderlay">
    </div>

    <div class="col-12 col-md-9 col-lg-10 mx-auto">