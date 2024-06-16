<?php
loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');
?>

<main class="d-flex mt-5 px-3 px-md-5">
  <div class=" col-2">
  </div>


  <div class="col-12 col-md-10 mx-auto">


    <div class="grid  gap-5 w-full">
      <div class=" col-7 mx-auto bg-white px-3 py-3 my-4 rounded">
        <h5 class="text-center"> Create new Assignment</h5>

        <section class=" pb-4">
          <form method="POST" action="/assignments">
            <div class="mb-3">
              <label for="title" class="form-label  mb-1 font-medium">Title</label>
              <input type="text" value="<?= $assignment['title'] ?? '' ?>" name="title" class="form-control" id="title" placeholder="Question title">
              <small class="text-danger"><?= $errors['title'] ?? '' ?> </small>

            </div>
            <div class="mb-3">
              <label for="question" class="form-label  mb-1 font-medium">Question</label>
              <textarea class="form-control" name="question" id="question" rows="3" placeholder="what is ..."><?= $assignment['question'] ?? '' ?></textarea>
              <small class="text-danger"><?= $errors['question'] ?? '' ?> </small>

            </div>
            <div class="form-wrapper mb-3">
              <label for="course" class="form-label mb-1 fw-medium">
                Course
              </label>
              <select class="form-select" id="course" value="<?= $assignment['course'] ?? '' ?>" name="course" aria-label="">
                <option value="">Select course</option>
                <option value="English">English</option>
                <option value="Maths">Maths</option>
                <option value="Physics">Physics</option>
              </select>
              <small class="text-danger"><?= $errors['course'] ?? '' ?> </small>

            </div>
            <div class="form-wrapper mb-3">
              <label for="class" class="form-label mb-1 fw-medium">
                Class
              </label>
              <select class="form-select" id="class" value="<?= $assignment['class'] ?? '' ?>" name="class" aria-label="">
                <option value="">Select class</option>
                <option value="year 1">year 1</option>
                <option value="year 2">year 2</option>
                <option value="year 3">year 3</option>
                <option value="year 4">year 4</option>
                <option value="year 5">year 5</option>
              </select>
              <small class="text-danger"><?= $errors['class'] ?? '' ?> </small>

            </div>
            <div class="mb-3">
              <label for="grade" class="form-label mb-1 font-medium">Mark obtainable</label>
              <input type="text" value="<?= $assignment['markObtainable'] ?? '' ?>" name="mark-obtainable" class="form-control" id="mark-obtainable" placeholder="mark obtainable">
              <small class="text-danger"><?= $errors['markObtainable'] ?? '' ?> </small>

            </div>
            <div class="mb-3">
              <label for="dueDate" class="form-label mb-1 font-medium">Due date</label>
              <input type="date" value="<?= $assignment['dueDate'] ?? '' ?>" name="dueDate" class="form-control" id="dueDate" placeholder="">
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
loadPartial('footer');
?>