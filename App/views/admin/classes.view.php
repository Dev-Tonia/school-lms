<?php loadPartial('layout');
$editId = '';
?>



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
                <span class=" "> New class </span>
            </div>

        </button>

    </div>
</div>
<section class=" px-2 py-2 shadow my-5 table-responsive rounded bg-success bg-opacity-10">

    <table class="table table-light">
        <thead>
            <tr>
                <th style="white-space: nowrap;" scope="col">index</th>
                <th style="white-space: nowrap;" scope="col">classes</th>
                <th style="white-space: nowrap;" scope="col">actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $index => $class) : ?>
                <tr>

                    <td style="white-space: nowrap;" class="w-25"> <?= $index + 1 ?> </td>
                    <td style="white-space: nowrap;" class="w-50"> <?= $class->class_name ?> </td>

                    <td class="w-25 gap-1" style="white-space: nowrap;">
                        <!-- <button class="bg-success rounded-pill d-inline-block border-0 text-white py-1 px-3" data-bs-toggle="modal" data-bs-target="#editModal">
                         
                            Edit
                        </button> -->
                        <!-- Delete Form -->
                        <form method="POST" action="/admin/delete-class" class=" d-inline-block">
                            <input type="hidden" name="id" value="<?= $class->id ?>">

                            <button type="submit" class="bg-danger border-0 text-white rounded-pill d-inline-block py-1 px-3">
                                Delete</button>
                        </form>

                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</section>

<!-- Modal For Adding class detail -->


<!-- Modal For Adding class detail -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="modal-content ">
            <div class="modal-header align-items-start">
                <div class="modal-title" id="exampleModalLabel">
                    <h1 class="fs-5">Add New Class</h1>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/classes">
                    <div class="mb-3">
                        <label for="class" class="form-label mb-1 fw-medium">
                            New class
                        </label>
                        <input type="text" required id="class" name="class" class="form-control" placeholder="year 1" />
                    </div>

                    <button type="submit" class="justify-content-center btn btn-warning w-100 mt-3 d-flex align-items-center fw-bolder shadow " data-bs-dismiss="modal">
                        <span class="text-white">Add Class</span>
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


<?php
loadPartial('layout-footer');
loadPartial('footer');
?>