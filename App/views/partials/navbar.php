<nav class="navbar bg-white shadow sticky-top">
  <div class="container-fluid py-2 px-5">
    <div>
      <a href="/" class="navbar-brand fw-bold">School Lms</a>
    </div>

    <?php if (isset($_SESSION['user'])) : ?>
      <form method="POST" action="/auth/logout">
        <button type="submit" class="btn btn-warning text-white fw-medium py-2 px-4">
          <span> <i class="bi bi-box-arrow-right"></i></span>
          Logout</button>
      </form>
    <?php else : ?>
      <a class="btn btn-outline-warning text-black fw-medium py-2 px-4" href="/auth/login">
        Get Started</a>
    <?php endif; ?>
  </div>
</nav>