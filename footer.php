<section id="footer" class="bg-cover">
        <div class="footer-top gy-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <a href="#"><img src="images/logonew2.png"  class="mb-4" alt=""></a>
                <p class="text-left">Lorem ipsum dolor sit ame dolorem fugit debitis corrupti, alias magnam?</p>

                <h4 class="text-white">Follow us</h4>
                <div class="social-link">
                  <a href="https://www.facebook.com/"><i class="ri-facebook-box-fill"></i></a>
                  <a href="https://www.youtube.com/"><i class="ri-youtube-fill"></i></a>
                  <a href="https://www.instagram.com/"><i class="ri-instagram-fill"></i></a>
                  <a href="https://twitter.com/"><i class="ri-twitter-fill"></i></a>
                </div>
              </div>
              <div class="col-lg-4">
                <h4 class="text-white mb-4 ms-auto">Contact</h4>
                <p class="mb-2">Phone-------> +358 417226089</p>
                <p class="mb-2">email--------> hotpot@gmail.com</p>
                <p class="mb-0">Address-----> Lindforsinkatu 14, 33720 Tampere, Finland</p>
              </div>
              <div class="col-lg-4">
                <h4 class="text-white mb-4 ms-auto">Opening Hours</h4>
                <p class="mb-2"> Opens 9 am - 5 pm ---> Mon-Fri</p>
                <p class="mb-2"> Opens 10 am - 4 pm --> Sat-Sun</p>
              </div>
            </div>
          </div>

        </div>
        <div class="footer-bottom">
          <div class="container">
            <div class="row justify-content-between gy-3">
              <div class="col-auto">
                <div class="mb-0">&copy; All Rights Reserved.</div>
              </div>
              <div class="col-auto">
              <?php
                    $file_path = isset($file_path) ? $file_path : $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF'];
                   // $file_path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF'];
                    $file_name = basename($file_path);
                    echo '<div class="mb-0">' . $file_name . ' file was last modified: ' . date("F j, Y, g:i a", filemtime($file_path)) . '</div>';
              ?>
              </div>
              <div class="col-auto">
                <div class="mb-0">Designed By: Team 17</div>
              </div>
            </div>
          </div>

        </div>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>