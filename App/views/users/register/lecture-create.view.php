<?php
loadPartial('head');
loadPartial('navbar');
?>

<div class=" grid mt-5 ">
    <div class=" col-5 mx-auto bg-white px-3 py-4 rounded shadow">
        <div class="d-flex justify-content-center flex-column pb-2">
            <h2 class="fw-medium fs-5 text-center mb-3">Lecturer Registration</h2>
        </div>
        <form method="POST" action="/auth/lecture/register">
            <div class="row row-cols-1 row-cols-md-2 g-3 mb-3">
                <div class="form-wrapper">
                    <label for="firstName" class="form-label mb-1 fw-medium">
                        First name
                    </label>
                    <input type="text" id="firstName" name="firstName" class="form-control" value="<?= $user['firstName'] ?? '' ?>" placeholder="John" required />
                    <small class="text-danger"><?= $errors['firstName'] ?? '' ?> </small>
                </div>
                <div class="form-wrapper">
                    <label for="lastName" class="form-label mb-1 fw-medium">
                        Last name
                    </label>
                    <input type="text" id="LastName" name="lastName" class="form-control" value="<?= $user['lastName'] ?? '' ?>" placeholder="Doe" required />
                    <small class="text-danger"><?= $errors['lastName'] ?? '' ?> </small>
                </div>
            </div>

            <div class="form-wrapper mb-3">
                <label for="email" class="form-label mb-1 fw-medium">
                    Email
                </label>
                <input type="email" id="email" name="email" class="form-control" value="<?= $user['email'] ?? '' ?>" placeholder="johndoe@email.com " required />
                <small class="text-danger"><?= $errors['email'] ?? '' ?> </small>
            </div>
            <div class="form-wrapper mb-3">
                <label for="reg-no" class="form-label mb-1 fw-medium">
                    Lecture Id
                </label>
                <input type="text" id="reg-no" name="reg-no" class="form-control" value="<?= $user['reg-no'] ?? '' ?>" placeholder="lec/002" required />
                <small class="text-danger"><?= $errors['reg-no'] ?? '' ?> </small>
            </div>
            <div class="form-wrapper mb-3">
                <label for="phoneNumber" class="form-label mb-1 fw-medium">
                    Password
                </label>
                <input type="password" id="password" name="password" class="form-control" placeholder="****************" required />
                <small class="text-danger"><?= $errors['password'] ?? '' ?> </small>

            </div>

            <div class="form-wrapper mb-3">
                <label for="confirm-password" class="form-label mb-1 fw-medium">
                    Confirm Password
                </label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="****************" required />
                <small class=" text-danger"><?= $errors['password-confirmation'] ?? '' ?></small>

            </div>
            <button type="submit" class="justify-content-center btn btn-warning w-100 mt-3 d-flex gap-2 align-items-center fw-bolder shadow ">
                <span class="text-white">Create Account</span>
            </button>
        </form>
        <p class="py-2">
            Already have an account? <a href="/auth/login" class="text-primary">Login</a>
        </p>
    </div>
</div>

<?php
loadPartial('footer');
?>