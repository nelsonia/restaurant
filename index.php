<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('header.php');
include('admin/db_connect.php');

$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['setting_' . $key] = $value;
}
?>

<style>
  header.masthead {
    background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<body id="page-top">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top py-3" id="mainNav">
    <div class="container">
      <!-- <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['setting_name'] ?></a> -->
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=cart_list"><span> <span class="badge badge-danger item_count">0</span> <i class="fa fa-shopping-cart"></i> </span>Cart</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
          <?php if (isset($_SESSION['login_user_id'])) : ?>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><?php echo "Welcome " . $_SESSION['login_first_name'] . ' ' . $_SESSION['login_last_name'] ?> <i class="fa fa-power-off"></i></a></li>
          <?php else : ?>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  $page = isset($_GET['page']) ? $_GET['page'] : "home";
  include $page . '.php';
  ?>
  <!-- contact us -->
  <section class="subscribe">
    <div class="container flex items-center">
      <div>
        <img src="./images/rasberry.png" alt="">
      </div>
      <div>
        <h1>Subscribe to your newsletter</h1>
        <p>Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
          web sites
          still in their infancy.</p>
        <div class="input-wrap">
          <input type="text" placeholder="email@freshmeal.com" class="email" name="email">
          <button type="submit" name="subscribe">Subscribe</button>

        </div>
      </div>
    </div>
  </section>

  <section class="contact-us flex" id="contact">
    <div class="contact-info-wrapper">
      <h1 class="section-heading">Contact us</h1>
      <div class="contact-info">
        <div>
          <div>
            <img src="./icons/phone-2.svg" alt="">
            <div>
              <span>Call us:</span>
              <span>(+254) 123 456 789</span>
            </div>
          </div>
          <div>
            <img src="./icons/bag-2.svg" alt="">
            <div>
              <span>E-mail ::</span>
              <span>support@freshmeal.com</span>
            </div>
          </div>
          <div>
            <img src="./icons/clock-2.svg" alt="">
            <div>
              <span>Working Hours:</span>
              <span>Mon - Sat (8.00am - 12.00am)</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="map">
      <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d206253.45012861438!2d-115.31508258571672!3d36.124918453865035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80beb782a4f57dd1%3A0x3accd5e6d5b379a3!2sLas%20Vegas%2C%20NV%2C%20USA!5e0!3m2!1sen!2sru!4v1580850940897!5m2!1sen!2sru"
                            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
      <!-- <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=nairobi%20Nairobi+(restaurant%20map)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">

      <script type='text/javascript' src="https://embedmaps.com/google-maps-authorization/script.js?id=22f31b25f8ea2c06436a71598ac1a652c558681d"></script> -->
    </div>
  </section>
  <!-- footer -->
<br>

  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-righ t"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="box">
        <h3>About us</h3>
        <p>It was popularised in the 1960 with the release of Latest sheets containing Lorem Ipsum
          passage.</p>
        <button class="btn btn-secondary">Read More</button>
      </div>
      <div class="box">
        <h3>Quik Links</h3>
        <ul>
          <li>
            <a href="#home">Home</a>
          </li>
          <li>
            <a href="#about">About us</a>
          </li>
          <li>
            <a href="#product">Products</a>
          </li>
          <li>
            <a href="#blog">Blog</a>
          </li>
          <li>
            <a href="#services">Services</a>
          </li>
          <li>
            <a href="#gallery">Gallery</a>
          </li>
          <li>
            <a href="#contact">Contact us</a>
          </li>

        </ul>
      </div>
      <div class="box">
        <h3>Follow Us</h3>
        <div>
          <ul>
            <li>
              <a href="https://www.facebook.com/codersgyan">
                <img src="./icons/facebook.svg" alt="">
                <span>Facebook</span>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/CoderGyan">
                <img src="./icons/twitter.svg" alt="">
                <span>Twitter</span>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="./icons/google.svg" alt="">
                <span>Google +</span>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/codersgyan/">
                <img src="./icons/instagram.svg" alt="">
                <span>Instagram</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="box instagram-api" id="gallery">
        <h3>Instagram</h3>
        <div class="post-wrap">
          <div>
            <img src="./images/food-table.jpg" alt="">
          </div>
          <div>
            <img src="./images/food-table.jpg" alt="">
          </div>
          <div>
            <img src="./images/food-table.jpg" alt="">
          </div>
          <div>
            <img src="./images/food-table.jpg" alt="">
          </div>
          <div>
            <img src="./images/food-table.jpg" alt="">
          </div>
          <div>
            <img src="./images/food-table.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </footer>
  <footer class="copyright">
    <div>
      Copyright © 2020 .All rights reserved by <a href="https://www.instagram.com/ne.lsonia/">Nelson</a>.
    </div>
  </footer>
  </div>
  </div>
  </div>



  <?php include('footer.php') ?>
</body>

<?php $conn->close() ?>

</html>