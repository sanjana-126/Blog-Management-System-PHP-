<div class="global-navbar bg-white">
  <div class="container">
    <div class="row">
      <div class="col-md-3 d-none d-sm-none d-md-inline">
        <img src="assets/images/logo.png" alt="logo" class="w-100">
      </div>
      <div class="col-md-9 my-auto">
        <div class="border text-center p-2">
          <h5>Advertise Here</h5>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="sticky-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-nav">

    <div class="container">

      <a href="" class="navbar-brand d-inline d-sm-inline d-md-none">
        <img src="assets/images/logo.png" alt="logo" style="width: 140px">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/PHP/php-blog/">Home</a>
          </li>
          <?php
          $navbarCategory = "SELECT * FROM categories WHERE navbar_status='0' AND status='0'";
          $navbarCategory_run = mysqli_query($con, $navbarCategory);

          if (mysqli_num_rows($navbarCategory_run) > 0) {
            foreach ($navbarCategory_run as $navItem) {
          ?>
              <li class="nav-item">
                <a class="nav-link" href="category.php?c=<?= $navItem['slug'] ?>"><?= $navItem['name']; ?></a>
              </li>
          <?php
            }
          }
          ?>
          <?php if (isset($_SESSION['auth_user'])) : ?>
            <?php
            if ($_SESSION['auth_role'] == '1') {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="admin/index.php">Dashboard</a>
              </li>
            <?php
            }
            elseif($_SESSION['auth_role'] == '0')
            {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="author-dashboard.php">Dashboard</a>
              </li>
            <?php
            }
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['auth_user']['user_name']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <form action="allcode.php" method="post">
                    <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</div>