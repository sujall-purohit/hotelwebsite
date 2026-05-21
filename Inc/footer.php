 <!-- Footer -->
 <div class="container-fluid bg-white mt-5">
     <div class="row">
         <div class="col-lg-4 p-4">
             <h3 class="h-font fw-bold fs-3 mb-2">Hotel</h3>
             <p>
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea maiores officia odio, amet beatae quam ipsum molestiae nam exercitationem earum nihil laborum, officiis, aut corrupti provident sapiente aspernatur fuga rerum?
             </p>
         </div>
         <div class="col-lg-4 p-4">
             <h5 class="mb-3"></h5>
             <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
             <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
             <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
             <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
             <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About Us</a>

         </div>
         <div class="col-lg-4 p-4">
             <h5 class="mb-3">Follow Us</h5>
             <a href="<?php echo $contact_r['tw'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
                 <i class="bi bi-twitter-x me-1"></i> Twitter
             </a>
             <br>
             <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
                 <i class="bi bi-facebook me-1"></i> Facebook
             </a>
             <br>
             <a href="<?php echo $contact_r['ins'] ?>" class="d-inline-block  text-dark text-decoration-none">
                 <i class="bi bi-instagram me-1"></i> Instagram
             </a>
         </div>
     </div>
 </div>

 <h6 class="text-center bg-dark text-white p-3 m-0"> Designed By Sujal</h6>



 <!-- Bootstrap JS bundle -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

 <script>
     function setActive() {
         let navbar = document.getElementById('nav-bar');
         let a_tags = navbar.getElementsByTagName('a');

         for (let i = 0; i < a_tags.length; i++) {
             let file = a_tags[i].href.split('/').pop();
             let file_name = file.split('.')[0];

             if (document.location.href.indexOf(file_name) >= 0) {
                 a_tags[i].classList.add('active');
             }
         }
     }
     setActive();
 </script>