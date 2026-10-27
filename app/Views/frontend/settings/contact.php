  <div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?php echo base_url(); ?>utilities/frontend/img/carousel-1.jpg);">
      <div class="container-fluid page-header-inner py-5">
          <div class="container text-center pb-5">
              <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center text-uppercase">
                      <li class=""><a href="<?php echo base_url(); ?>">Home&nbsp;/&nbsp;</a></li>
                      <li class=""><a href="">Pages&nbsp;/&nbsp;</a></li>
                      <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>

  <!-- Booking End -->


  <!-- Contact Start -->
  <div class="container-xxl py-5">
      <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
              <h6 class="section-title text-center text-primary text-uppercase">Contact Us</h6>
              <h1 class="mb-5"><span class="text-primary text-uppercase">Contact</span> For Any Query</h1>
          </div>
          <div class="row g-4">
              <div class="container-fluid">
                  <div class="row gy-4">
                      <!-- Booking Column -->
                      <div class="col-12 col-md-6">
                          <h6 class="section-title text-start text-primary text-uppercase">Booking</h6>
                          <p class="text-wrap">
                              <i class="fa fa-envelope-open text-primary me-2"></i>
                              contactus@srilakshminarayananivashomestay.com
                          </p>
                      </div>

                      <!-- General Column -->
                      <div class="col-12 col-md-6">
                          <h6 class="section-title text-start text-primary text-uppercase">General</h6>
                          <p class="text-wrap">
                              <i class="fa fa-envelope-open text-primary me-2"></i>
                              srilakshminarayananivas@gmail.com
                          </p>
                      </div>
                  </div>
              </div>

              <div class="col-md-6 wow fadeIn mb-5" data-wow-delay="0.1s">
                  <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.8445552197472!2d79.42358617413127!3d13.606304300647412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a4d4b7d811d5c41%3A0x142649af7f922b54!2sSri%20Lakshmi%20Narayana%20Nivas%20Home%20Stay!5e0!3m2!1sen!2sin!4v1767081387239!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
              <div class="col-md-6 ">
                  <div class="wow fadeInUp mb-5 pb-5" data-wow-delay="0.2s">
                      <?php $attributes = ['method' => 'post', 'id' => 'contactForm']; ?>
                      <?php echo form_open('', $attributes); ?>
                      <div class="row g-3">
                          <?php if (!empty($success)) : ?>
                              <p class="text-success">
                                  <?= esc($success) ?>
                              </p>
                          <?php endif; ?>

                          <div class="col-md-12">
                              <div class="form-floating">
                                  <input type="text" class="form-control" id="name" placeholder="Your Name" name="name" required value="<?php echo set_value('name'); ?>">
                                  <label for="name">Your Name</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" required value="<?php echo set_value('email'); ?>">
                                  <label for="email">Your Email</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-floating">
                                  <input type="tel" class="form-control" id="mobile" inputmode="numeric" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Your Mobile" name="mobile" required value="<?php echo set_value('mobile'); ?>">
                                  <label for="email">Your Mobile No</label>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-floating">
                                  <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required value="<?php echo set_value('subject'); ?>">
                                  <label for="subject">Subject</label>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-floating">
                                  <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px" name="message" required><?= set_value('message') ?></textarea>
                                  <label for="message">Message</label>
                              </div>
                          </div>
                          <div class="col-12">
                              <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="bookingModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">Book Your Stay</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body p-4">
                  <?php echo form_open('booking/submit', ['method' => 'post']); ?>
                  <!-- Dates -->
                  <div class="row mb-3">
                      <div class="col-md-6">
                          <div class="date" id="date1" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input"
                                  placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" name="checkin" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="date" id="date2" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" name="checkout" data-toggle="datetimepicker" />
                          </div>
                      </div>
                  </div>

                  <!-- Name -->
                  <div class="mb-3">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Your Name" name="name" required>
                  </div>

                  <!-- Email -->
                  <div class="mb-3">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="Your Email" name="email" required>
                  </div>

                  <!-- Mobile -->
                  <div class="mb-3">
                      <label>Mobile</label>
                      <input type="tel" class="form-control" placeholder="Your Mobile Number" name="mobile" required>
                  </div>

                  <!-- Room Type -->
                  <div class="mb-3">
                      <label>Room Type</label>
                      <select class="form-select" id="roomType" name="roomType" required>
                          <option value="" selected>Select Room</option>
                          <option value="Deluxe">Deluxe</option>
                          <option value="Super Luxury">Super Luxury</option>
                          <option value="Super Deluxe">Super Deluxe</option>
                          <option value="Grand Suite">Grand Suite</option>
                      </select>


                  </div>

                  <div class="d-flex justify-content-end">
                      <button class="btn btn-primary btn-sm text-dark fw-bold p-2">Confirm Booking</button>
                  </div>
                  <?php echo form_close(); ?>
              </div>

          </div>
      </div>
  </div>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const form = document.getElementById('contactForm');
          if (!form) return; // stops if slipForm not present

          const submitBtn = form.querySelector('button[type="submit"]');
          if (submitBtn) {
              form.addEventListener('submit', function() {
                  submitBtn.disabled = true;
                  submitBtn.innerHTML = 'Submitting...';
              });
          }
      });
  </script>