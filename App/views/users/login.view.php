<?php
loadPartial('head');
loadPartial('navbar');
?>

<div class=" grid mt-5 ">
    <div class=" col-5 mx-auto bg-white px-3 py-4 rounded shadow">
        <h2 class="fw-medium fs-4 mb-3 text-center">Login To School Lms</h2>
        <form method="POST" action="/auth/login">
            <div class="mb-3">
                <label for="email" class="form-label mb-1 fw-medium">
                    Email
                </label>
                <input type="email" required id="email" name="email" class="form-control" placeholder="johndoe@email.com " />
            </div>
            <div className=" mb-3">
                <label for="password" class="form-label mb-1 fw-medium">
                    Password
                </label>
                <input type="password" required id="password" name="password" class="form-control" placeholder="****************" />
            </div>
            <button type="submit" class="justify-content-center btn btn-warning w-100 mt-3 d-flex align-items-center fw-bolder shadow ">
                <span class="text-white">Login</span>
            </button>
        </form>
        <!-- <p class="mt-1">
            <a href="/password-rest.html">Forget Password</a>
        </p> -->
        <p class=" mt-3">
            Don't have an account?
            <a href="/auth/student/register" class=" text-primary">Create account</a>
        </p>
    </div>
</div>

<?php
loadPartial('footer');
?>