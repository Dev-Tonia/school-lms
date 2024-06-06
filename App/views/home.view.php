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
      <div class=" col-3">
        <h5 class=""> Welcome back, <?= $_SESSION['user']['firstName'] ?></h5>
        <h5 class=" fs-6 text-center px-2 py-1 text-white rounded-pill uppercase bg-success bg-opacity-20 ">
          <?= $_SESSION['user']['userType'] ===  'Lecturer' ?  $_SESSION['user']['employee-no']  : $_SESSION['user']['reg-no'] ?> </h5>
      </div>
    </div>
    <section class=" mt-3">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
        <a href="/" class=" text-decoration-none card-wrapper d-block">
          <div class=" card d-flex shadow justify-content-center align-items-center text-center">
            <div>
              <div class=" text-primary-subtle fw-bold mt-2 fs-5"> 10 /
                30</div>
              <p class="mt-2">Score</p>
            </div>
          </div>
        </a>
        <a href="/" class=" text-decoration-none card-wrapper d-block">
          <div class=" card d-flex shadow justify-content-center align-items-center text-center">
            <div>
              <div class=" text-primary-subtle fw-bold mt-2 fs-5"> 10 /
                30</div>
              <p class="mt-2">Score</p>
            </div>
          </div>
        </a> <a href="/" class=" text-decoration-none card-wrapper d-block">
          <div class=" card d-flex shadow justify-content-center align-items-center text-center">
            <div>
              <div class=" text-primary-subtle fw-bold mt-2 fs-5"> 10 /
                30</div>
              <p class="mt-2">Score</p>
            </div>
          </div>
        </a> <a href="/" class=" text-decoration-none card-wrapper d-block">
          <div class=" card d-flex shadow justify-content-center align-items-center text-center">
            <div>
              <div class=" text-primary-subtle fw-bold mt-2 fs-5"> 10 /
                30</div>
              <p class="mt-2">Score</p>
            </div>
          </div>
        </a>

      </div>
    </section>
    <section class=" px-2 my-5 rounded bg-success bg-opacity-10">
      <table class="table table-light  ">
        <caption class="fw-bold fs-5 caption-top">
          Recent Assignment
        </caption>

        <thead>
          <tr>
            <th scope="col">Course</th>
            <th scope="col">Assignment Title</th>
            <th scope="col">Description</th>
            <th scope="col">Time Frame</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="min-width:150px;"> hello</td>
            <td> hello </td>
            <td> hello </td>
            <td> hello </td>
            <td> hello </td>

          </tr>
        </tbody>
      </table>
    </section>
  </div>

</main>

<?php
loadPartial('footer');
?>