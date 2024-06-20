<?php loadPartial('layout') ?>



<div class="rounded shadow bg-white p-2">
    <div class="d-flex justify-content-between align-items-center">
        <a class="block p-2 text-primary" href="/">
            <i class="bi bi-arrow-left-circle"></i>
            Back To Home
        </a>
        <!-- Button trigger modal -->
        <button type="button" class="text-white rounded border-0 d-inline-block py-1 px-3 btn-outline-warning d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class=" d-flex  align-items-center text-success fw-bold ">
                <div class="pe-2">
                    <i class="bi bi-pen-fill fs-6"></i>
                </div>
                <span class=" "> New course </span>
            </div>

        </button>
        <!-- <div class="border border-warning border-2 rounded d-inline-block py-1 px-3">
            <a class=" d-flex  align-items-center text-success fw-bold text-decoration-none" href="/admin/create">
                <div class="pe-2">
                    <i class="bi bi-pen-fill fs-6"></i>
                </div>
                <span class=" "> New Assignment </span>
            </a>
        </div> -->
    </div>
</div>
<section class=" px-2 py-2 shadow my-5 table-responsive rounded bg-success bg-opacity-10">

    <table class="table table-light">
        <thead>
            <tr>
                <th style="white-space: nowrap;" scope="col">index</th>
                <th style="white-space: nowrap;" scope="col">code</th>

                <th style="white-space: nowrap;" scope="col">course</th>

                <th style="white-space: nowrap;" scope="col">actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $index => $class) : ?>
                <tr>

                    <td style="white-space: nowrap;" class="w-25"> <?= $index + 1 ?> </td>
                    <td style="white-space: nowrap;" class="w-25"> <?= $class->course_code ?> </td>

                    <td style="white-space: nowrap;" class="w-25"> <?= $class->course_name ?> </td>

                    <td class="w-25 gap-1" style="white-space: nowrap;">
                        <span class="bg-success rounded-pill d-inline-block py-1 px-3"><a href="" class="text-white text-decoration-none">Edit</a></span>

                        <span class="bg-danger text-white rounded-pill d-inline-block py-1 px-3"><a href="" class="text-white text-decoration-none">
                                Delete</a></span>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</section>

<!-- Modal For Adding class detail -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="modal-content ">
            <div class="modal-header align-items-start">
                <div class="modal-title" id="exampleModalLabel">
                    <h1 class="fs-5">Add New Course</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/courses">
                    <div class="mb-3">
                        <label for="course" class="form-label mb-1 fw-medium">
                            New course
                        </label>
                        <input type="text" required id="course" name="course" class="form-control" placeholder="Gns 101" />
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label mb-1 fw-medium">
                            Course code
                        </label>
                        <input type="text" required id="code" name="code" class="form-control" placeholder="Gns 101" />
                    </div>
                    <button type="submit" class="justify-content-center btn btn-warning w-100 mt-3 d-flex align-items-center fw-bolder shadow " data-bs-dismiss="modal">
                        <span class="text-white">Add course</span>
                    </button>
                </form>
            </div>
            <!-- <div class="modal-footer">
                </div>  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div> -->
        </div>
    </div>
</div>
</div>
<?php
loadPartial('layout-footer');
loadPartial('footer');
?>