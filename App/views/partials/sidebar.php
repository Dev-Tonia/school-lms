<aside class="col-2 border-end border-4 position-fixed z-2 d-none d-md-block bg-light
" style="height: 100vh; padding-bottom: 40px;">
    <div class="overflow-y-auto h-100">
        <nav class="nav flex-column px-3 justify-content-center">
            <ul class="navbar-nav text-black my-3">
                <li class="nav-item fw-bold border-2 border-bottom pt-3">
                    <a class="nav-link active d-flex  align-items-center" aria-current="page" href="/">
                        <div class="pe-2">
                            <i class="bi bi-speedometer2 fs-5"></i>
                        </div>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="nav-item fw-bold border-2 border-bottom pt-3">
                    <a class="nav-link active d-flex  align-items-center" href="/assignments">
                        <div class="pe-2">
                            <i class="bi bi-card-checklist fs-5"></i>
                        </div>
                        <span> Assignments </span>
                    </a>
                </li>

                <?php if ($_SESSION['user']['userType'] ===  'Lecturer') : ?>
                    <li class="nav-item fw-bold border-2 border-bottom pt-3">
                        <a class="nav-link active d-flex  align-items-center" href="/submissions">
                            <div class="pe-2">
                                <i class="bi bi-card-checklist fs-5"></i>
                            </div>
                            <span> Submissions </span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item d-flex align-items-center  fw-bold border-2 border-bottom pt-3">
                    <form method="POST" action="/auth/logout">
                        <button type="submit" class="nav-link d-flex  align-items-center">
                            <div class="pe-2">
                                <i class="bi bi-box-arrow-right fs-5"></i>
                            </div>
                            <span> Log out </span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>