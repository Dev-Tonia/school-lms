<?php loadPartial('layout');

?>



<div class="grid  gap-5 w-full">
    <div class=" col-11 col-md-7 mx-auto bg-white px-3 py-3 my-4 rounded">
        <h5 class="text-center"> Edit Assignment</h5>

        <section class=" pb-4">
            <form method="POST" action="/assignments/update">
                <input type="hidden" name="_method" value="put" />
                <input type="hidden" name="id" value="<?= $assignment->id ?>" />
                <div class="mb-3">
                    <label for="title" class="form-label  mb-1 font-medium">Title</label>
                    <input type="text" value="<?= $assignment->title ?? '' ?>" name="title" class="form-control" id="title" placeholder="Question title">
                    <small class="text-danger"><?= $errors['title'] ?? '' ?> </small>
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label  mb-1 font-medium">Question</label>
                    <textarea class="form-control" name="question" id="question" rows="3" placeholder="what is ..."><?= $assignment->question ?? '' ?></textarea>
                    <small class="text-danger"><?= $errors['question'] ?? '' ?> </small>

                </div>
                <div class="form-wrapper mb-3">
                    <label for="course" class="form-label mb-1 fw-medium">
                        Course
                    </label>
                    <select class="form-select" id="course" value="" name="course" aria-label="">
                        <option value=""> Select course</option>
                        <option value="English" <?= $assignment->course === 'English' ? 'selected' : ''; ?>>English</option>
                        <option value="Maths" <?= $assignment->course === 'Maths' ? 'selected' : ''; ?>>Maths</option>
                        <option value="Physics" <?= $assignment->course === 'Physics' ? 'selected' : ''; ?>>Physics</option>
                    </select>
                    <small class="text-danger"><?= $errors['course'] ?? '' ?> </small>

                </div>
                <div class="form-wrapper mb-3">
                    <label for="class" class="form-label mb-1 fw-medium">
                        Class
                    </label>
                    <select class="form-select" id="class" value="" name="class" aria-label="">
                        <option value=""> "Select Class"</option>
                        <option value="year 1" <?= $assignment->class === 'year 1' ? 'selected' : '' ?>>year 1</option>
                        <option value="year 2 " <?= $assignment->class === 'year 2' ? 'selected' : '' ?>>year 2</option>
                        <option value="year 3" <?= $assignment->class === 'year 3' ? 'selected' : '' ?>>year 3</option>
                        <option value="year 4" <?= $assignment->class === 'year 4' ? 'selected' : '' ?>>year 4</option>
                        <option value="year 5" <?= $assignment->class === 'year 5' ? 'selected' : '' ?>>year 5</option>
                    </select>
                    <small class="text-danger"><?= $errors['class'] ?? '' ?> </small>

                </div>
                <div class="mb-3">
                    <label for="grade" class="form-label mb-1 font-medium">Mark obtainable</label>
                    <input type="text" value="<?= $assignment->mark_obtainable  ?? '' ?>" name="mark-obtainable" class="form-control" id="mark-obtainable" placeholder="mark obtainable">
                    <small class="text-danger"><?= $errors['markObtainable'] ?? '' ?> </small>

                </div>
                <div class="mb-3">
                    <label for="dueDate" class="form-label mb-1 font-medium">Due date</label>
                    <input type="date" value="<?= $assignment->due_date ?? '' ?>" name="dueDate" class="form-control" id="dueDate" placeholder="">
                    <small class="text-danger"><?= $errors['dueDate'] ?? '' ?> </small>

                </div>
                <button type="submit" class="justify-content-center btn btn-warning w-100 mt-3 d-flex gap-2 align-items-center fw-bolder shadow custom-btn">
                    <span class="text-white">Add Assignment</span>
                </button>
            </form>
        </section>
    </div>
</div>

</div>

</main>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>