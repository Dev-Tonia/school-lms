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
                    <a class="block p-4 text-primary" href="/submissions">
                        <i class="bi bi-arrow-left-circle"></i>
                        Back To Submission
                    </a>
                    <div>

                    </div>
                </div>
            </div>

            <div class="rounded shadow bg-white p-3 my-4">
                <div class="mb-0 d-flex justify-content-between align-items-center">
                    <!-- <p> <span class=" fw-bold">Due date:</span> <span class=" fw-medium"><?= $submission->due_date ?> </span>
                    </p> -->
                    <p>mark: <?= $submission->grade ?></p>
                </div>
                <div class="mb-3 fw-medium ">
                    <p>course: <?= $submission->course  ?></p>
                    <p>Level: <?= $submission->class  ?></p>
                </div>
                <div class=" fw-bold fs-6">
                    <span class=" ">Assignment Title:</span> <span class=""><?= $submission->title ?> </span>

                </div>
                <div>
                    <span class=" fw-light ">Submitted date:</span> <span class="fw-light"><?= $submission->created_at ?> </span>

                </div>
                <div class=" py-2 mb-3">
                    <h5 class=" fs-4 fw-semibold">
                        Question
                    </h5>
                    <p>
                        <?= $submission->question ?>
                    </p>
                </div>
                <div>
                    <h5>
                        Student Submission
                    </h5>
                    <div>
                        <div class="pdf position-relative">
                            <iframe src="/upload/<?= $submission->file_path ?>" width="100%" height="100%" frameborder="0" class=" overflow-hidden"></iframe>

                        </div>
                        <a href="/upload/<?= $submission->file_path ?>" download=" <?= $submission->file_path ?>" class="d-block fw-medium mt-3">
                            Download Full PDF </a>
                    </div>
                </div>
            </div>


            <!-- display the submission button -->

            <div class="rounded shadow bg-white p-3 my-3">
                <div class="bg-red  bg-opacity-20">
                    <?= $error  ?? '' ?>
                </div>
                <h5 class=" fs-4 fw-medium"> Grade Student</h5>

                <form method="POST" action="/submissions/grade" class="col-8">
                    <input type="hidden" name="id" value="<?= $submission->id ?>">
                    <input type="number" class="form-control" name="score" id="score">
                    <div class=" col-4 pt-2 pb-4">
                        <button type="submit" class="px-4 py-2 w-100 btn-outline-warning btn text-black fw-medium rounded"> Grade</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <?php
    loadPartial('footer');
    ?>