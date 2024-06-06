<?php
loadPartial('head');
loadPartial('navbar');
?>

<div class=" grid mt-5 ">
    <div class=" col-5 mx-auto bg-white px-3 py-4 rounded shadow">
        <div class="d-flex justify-content-center flex-column pb-2">
            <h2 class="fw-medium fs-5 text-center mb-3">Student Registration</h2>
        </div>
        <form method="POST" action="/auth/student/register">
            <div class="row row-cols-1 row-cols-md-2 g-3 mb-3">
                <div class="form-wrapper">
                    <label for="firstName" class="form-label mb-1 fw-medium">
                        First name
                    </label>
                    <input type="text" id="firstName" value="<?= $user['firstName'] ?? '' ?>" name="firstName" class="form-control" placeholder="John" required />
                    <small class=" text-danger"><?= $errors['firstName'] ?? '' ?></small>
                </div>
                <div class="form-wrapper">
                    <label for="lastName" class="form-label mb-1 fw-medium">
                        Last name
                    </label>
                    <input type="text" id="lastName" value="<?= $user['lastName'] ?? '' ?>" name="lastName" class="form-control" placeholder="Doe" required />
                    <small class=" text-danger"><?= $errors['lastName'] ?? '' ?></small>

                </div>
            </div>

            <div class="form-wrapper mb-3">
                <label for="email" class="form-label mb-1 fw-medium">
                    Email
                </label>
                <input type="email" id="email" value="<?= $user['email'] ?? '' ?>" name="email" class="form-control" placeholder="johndoe@email.com " required />
                <small class=" text-danger"><?= $errors['email'] ?? '' ?></small>
            </div>
            <div class="form-wrapper mb-3">
                <label for="reg-no" class="form-label mb-1 fw-medium">
                    Reg-no
                </label>
                <input type="text" id="reg-no" value="<?= $user['reg-no'] ?? '' ?>" name="reg-no" class="form-control" placeholder="HND/OO49/CHE " required />
                <small class=" text-danger"><?= $errors['reg-no'] ?? '' ?></small>
            </div>
            <div class="form-wrapper mb-3">
                <label for="level" class="form-label mb-1 fw-medium">
                    Current Level
                </label>
                <select class="form-select" id="level" value="<?= $user['level'] ?? '' ?>" name="level" aria-label="">
                    <option value="">Select your current level</option>
                    <option value="year 1">year 1</option>
                    <option value="year 2">year 2</option>
                    <option value="year 3">year 3</option>
                    <option value="year 4">year 4</option>
                    <option value="year 5">year 5</option>
                </select>
                <small class=" text-danger"><?= $errors['level'] ?? '' ?></small>

            </div>

            <div class="form-wrapper mb-3">
                <label for="phoneNumber" class="form-label mb-1 fw-medium">
                    Password
                </label>
                <input type="password" id="password" name="password" class="form-control" placeholder="****************" required />
                <small class=" text-danger"><?= $errors['password'] ?? '' ?></small>

            </div>

            <div class="form-wrapper mb-3">
                <label for="confirm-password" class="form-label mb-1 fw-medium">
                    Confirm Password
                </label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="****************" required />
                <small class=" text-danger"><?= $errors['password-confirmation'] ?? '' ?></small>

            </div>
            <button type="submit" class="justify-content-center btn btn-warning w-100 mt-3 d-flex gap-2 align-items-center fw-bolder shadow custom-btn">
                <span class="text-white">Create Account</span>
            </button>
        </form>
        <p class=" mt-3">
            Not a student? <a href="/auth/lecture/register" class=" text-success">Register here</a>
        </p>
        <p class="pb-2">
            Already have an account? <a href="/auth/login" class="text-primary">Login</a>
        </p>
    </div>
</div>

<?php
loadPartial('footer');
?>