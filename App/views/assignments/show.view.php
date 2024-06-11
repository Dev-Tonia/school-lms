<?php
loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');
?>
<main class="d-flex mt-5 px-3 px-md-5">
    <div class=" col-2">
    </div>
    <div class="col-12 col-md-10 mx-auto">
        <div class="">
            <div class="rounded shadow bg-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="block p-4 text-primary" href="/assignments">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back To Assignments
                    </a>

                    <div>
                        <?php if ($_SESSION['user']['userType'] ===  'Lecturer') : ?>

                            <div class="d-flex align-item-center ">
                                <a href="/edit" class="px-4 py-2 bg-success me-2  text-white rounded">Edit</a>
                                <!-- Delete Form -->
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $assignment->id ?>">

                                    <button type="submit" class="px-4 py-2 btn-danger btn   text-white rounded">Delete</button>
                                </form>
                                <!-- End Delete Form -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="rounded shadow bg-white p-3 my-4">
                <div class="mb-0 d-flex justify-content-between align-items-center">
                    <p> <span class=" fw-bold">Due date:</span> <span class=" fw-medium"><?= $assignment->due_date ?> </span>
                    </p>
                    <p>mark: <?= $assignment->grade ?></p>
                </div>
                <div class="mb-3 fw-medium d-flex justify-content-between align-items-center">
                    <p>course: <?= $assignment->course  ?></p>
                    <p>Level: <?= $assignment->class  ?></p>
                </div>
                <div class=" fw-bold fs-6">
                    <span class=" ">Assignment Title:</span> <span class=""><?= $assignment->title ?> </span>

                </div>
                <div>
                    <span class=" fw-light ">published date:</span> <span class="fw-light"><?= $assignment->created_at ?> </span>

                </div>
                <div class=" py-2 mb-3">
                    <h5 class=" fs-4 fw-semibold">
                        Question
                    </h5>
                    <p>
                        <?= $assignment->question ?>
                    </p>
                </div>
            </div>


            <?php if ($_SESSION['user']['userType'] !==  'Lecturer') : ?>

                <div class="rounded shadow bg-white p-3 my-4">
                    <div class="bg-red  bg-opacity-20">
                        <?= $error  ?? '' ?>
                    </div>
                    <h5 class=" fs-4 fw-medium"> Submission Details</h5>
                    <div>
                        <p class=" leading">
                            You are advice to do the assignment in word doc and upload the soft copy.
                        </p>
                        <p class=" leading">
                            Review the file you are about to submit, once submitted you can't be able to change it
                        </p>

                    </div>
                    <form method="POST" action="/assignments/submit" class="col-8" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $assignment->id ?>">
                        <input type="file" name="file" class="form-control" accept=".doc,.docx,.xml,.pdf">
                        <div class=" col-4 pt-2 pb-4">
                            <button type="submit" class="px-4 py-2 w-100 btn-outline-warning btn text-black fw-medium rounded"> Submit</button>
                        </div>
                    </form>
                </div>
            <?php endif ?>
        </div>

    </div>

    <?php



    // loadPartial('bottom-banner');
    loadPartial('footer');
    ?>