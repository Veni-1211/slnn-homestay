         <div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?php echo base_url(); ?>utilities/frontend/img/carousel-1.jpg);">
             <div class="container-fluid page-header-inner py-5">
                 <div class="container text-center pb-5">
                     <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                     <nav aria-label="breadcrumb">
                         <ol class="breadcrumb justify-content-center text-uppercase">
                             <li class=""><a href="<?php echo base_url(); ?>">Home&nbsp;/&nbsp;</a></li>
                             <li class=""><a href="">Pages&nbsp;/&nbsp;</a></li>
                             <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
|         <!-- Booking Start -->
         <div class="container-xxl py-2">
             <div class="container">
                 <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                     <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                     <h1 class="mb-5">Book A <span class="text-primary text-uppercase">Room</span></h1>
                 </div>
                 <div class="row g-2">
                     <div class="container-xxl py-4">
                         <div class="container">

                             <div class="card border-0 shadow rounded wow fadeInUp">
                                 <div class="row g-0 align-items-center">

                                     <!-- Image -->
                                     <div class="col-md-5">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/deluxe.svg"
                                             class="img-fluid h-100 w-100 rounded-start"
                                             alt="Deluxe Room">
                                     </div>

                                     <!-- Content -->
                                     <div class="col-md-7">
                                         <div class="card-body">

                                             <h3 class="text-uppercase text-primary mb-1">
                                                 Deluxe Room
                                                 <span class="text-muted fs-4 fw-bold ms-5 mt-1"> ₹<?php echo isset($deluxe[0]['price_per_night']) ? $deluxe[0]['price_per_night'] : 'N/A'; ?> (per day)

                                             </h3>

                                             <div class="mb-2">
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                             </div>

                                             <p class="text-body mb-3">
                                                 Deluxe Room in Tirupati homestay offers clean, comfortable interiors with quality amenities at affordable pricing.
                                                 Ideal for families and pilgrims, the room provides a peaceful stay with a hygienic environment and easy access to nearby temples and main areas of the city.
                                             </p>

                                             <a class="btn btn-sm btn-primary rounded pt-2 mt-2" href="javascript:void(0)"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#roomDetailModal">
                                                 View Detail
                                             </a>
                                             <a class="btn btn-sm btn-dark rounded ms-2 pt-2 mt-2"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#bookingModal"
                                                 data-room="Deluxe">
                                                 Book Now
                                             </a>

                                         </div>
                                     </div>

                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="container-xxl py-4">
                         <div class="container">

                             <div class="card border-0 shadow rounded wow fadeInUp">
                                 <div class="row g-0 align-items-center">

                                     <!-- Image -->
                                     <div class="col-md-5">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/superdeluxe.svg"
                                             class="img-fluid h-100 w-100 rounded-start"
                                             alt="Super Deluxe">
                                     </div>

                                     <!-- Content -->
                                     <div class="col-md-7">
                                         <div class="card-body">

                                             <h3 class="text-uppercase text-primary mb-1">
                                                 Super Deluxe
                                                 <span class="text-muted fs-4 ms-5 mt-1 fw-bold">
                                                     ₹<?php echo isset($superDeluxe[0]['price_per_night']) ? $superDeluxe[0]['price_per_night'] : 'N/A'; ?> (per day)
                                                 </span>
                                             </h3>

                                             <div class="mb-2">
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                             </div>

                                             <p class="text-body mb-3">
                                                 Super Deluxe Room in Tirupati homestay featuring spacious interiors, upgraded comfort, and great value, perfect for families and long stays. The room offers a relaxing ambience, modern amenities, and a clean, well-maintained space for a pleasant stay.
                                             </p>


                                             <a class="btn btn-sm btn-primary rounded pt-2 mt-2" href="javascript:void(0)"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#superdeluxeroomDetailModal">
                                                 View Detail
                                             </a>

                                             <a class="btn btn-sm btn-dark rounded ms-2 mt-2 pt-2"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#bookingModal"
                                                 data-room="Super Deluxe">
                                                 Book Now
                                             </a>

                                         </div>
                                     </div>

                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="container-xxl py-4">
                         <div class="container">

                             <div class="card border-0 shadow rounded wow fadeInUp">
                                 <div class="row g-0 align-items-center">

                                     <!-- Image -->
                                     <div class="col-md-5">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/superluxury.svg"
                                             class="img-fluid h-100 w-100 rounded-start"
                                             alt="Super Luxury">
                                     </div>

                                     <!-- Content -->
                                     <div class="col-md-7">
                                         <div class="card-body">

                                             <h3 class="text-uppercase text-primary mb-1">
                                                 Super Luxury
                                                 <span class="text-muted fs-4 ms-5 mt-1 fw-bold"> ₹<?php echo isset($superLuxury[0]['price_per_night']) ? $superLuxury[0]['price_per_night'] : 'N/A'; ?> (per day)
                                                 </span>
                                             </h3>

                                             <div class="mb-2">
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                             </div>

                                             <p class="text-body mb-3">
                                                 Super Luxury Room in Tirupati homestay combining premium décor, spacious comfort, and excellent value for a peaceful, refined stay. Designed for a relaxing experience, the room offers elegant interiors, modern amenities, and a calm ambience.
                                             </p>

                                             <a class="btn btn-sm btn-primary rounded pt-2 mt-2" href="javascript:void(0)"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#superluxuryDetailModal">
                                                 View Detail
                                             </a>
                                             <a class="btn btn-sm btn-dark rounded ms-2 mt-2 pt-2" href="javascript:void(0)"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#bookingModal"
                                                 data-room="Super Luxury">
                                                 Book Now
                                             </a>

                                         </div>
                                     </div>

                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="container-xxl py-4">
                         <div class="container">

                             <div class="card border-0 shadow rounded wow fadeInUp">
                                 <div class="row g-0 align-items-center">

                                     <!-- Images Column -->
                                     <div class="col-md-5">
                                         <div class="row g-2">
                                             <div class="col-12">
                                                 <img src="<?php echo base_url(); ?>utilities/frontend/img/grandsuite.svg"
                                                     class="img-fluid w-100 rounded-start" alt="Grand Suite Main">
                                             </div>
                                             <!-- <div class="col-6">
                            <img src="<?php echo base_url(); ?>utilities/frontend/img/testimonial-1.jpg"
                                 class="img-fluid w-100 rounded" alt="Grand Suite 2">
                        </div>
                        <div class="col-6">
                            <img src="<?php echo base_url(); ?>utilities/frontend/img/room-4.jpg"
                                 class="img-fluid w-100 rounded" alt="Grand Suite 3">
                        </div> -->
                                         </div>
                                     </div>

                                     <!-- Content Column -->
                                     <div class="col-md-7">
                                         <div class="card-body">

                                             <!-- Title + Stars -->
                                             <h3 class="text-uppercase text-primary mb-1">Grand Suite(3BHK)
                                                 <span class="text-muted fs-4 ms-3 fw-bold">

                                                     ₹<?php echo isset($grandSuite[0]['price_per_night']) ? $grandSuite[0]['price_per_night'] : 'N/A'; ?> (per day)
                                                 </span>
                                             </h3>

                                             <div>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                                 <small class="fa fa-star text-primary"></small>
                                             </div>

                                             <!-- Description -->
                                             <p class="text-body mb-3 mt-2">
                                                 Entire furnished flat in Tirupati homestay offering luxury comfort with budget-friendly pricing, ideal for families, groups, and pilgrim travelers. The flat provides spacious rooms, essential amenities, and a comfortable homely environment for a pleasant stay.
                                             </p>

                                             <!-- Buttons -->
                                             <a class="btn btn-sm btn-primary rounded pt-2 mt-2" href="javascript:void(0)"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#grandsuiteDetailModal">
                                                 View Detail
                                             </a>

                                             <a class="btn btn-sm btn-dark rounded ms-2 pt-2 mt-2"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#bookingModal"
                                                 data-room="Grand Suite">
                                                 Book Now
                                             </a>

                                         </div>
                                     </div>

                                 </div>
                             </div>

                         </div>
                     </div>

                 </div>
             </div>
         </div>
           <div class="container-xxl testimonial my-5 py-5 bg-dark wow zoomIn " data-wow-delay="0.1s">
            <div class="container">
                <div class="owl-carousel testimonial-carousel py-5">
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            The homestay was clean, calm, and very comfortable.
                            Rooms were well maintained with all basic amenities.
                            Perfect place for a peaceful and relaxing stay. </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Hemanth</h6>
                                <small>Business Owner</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Had a wonderful experience staying here.
                            The rooms were spacious and neatly arranged.
                            Location was convenient and the atmosphere felt homely.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/female.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Sandhya Sree</h6>
                                <small>Software Engineer</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Had a comfortable and enjoyable stay.
                            The rooms were clean and well arranged.
                            A great option for a quiet and relaxing visit.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Janardhan</h6>
                                <small>Government Employee</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            A very pleasant and comfortable homestay.
                            Clean rooms, good facilities, and a peaceful environment.
                            Would definitely recommend this place to others. </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/female.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Sadha Lalitha</h6>
                                <small>Digital Marketing Specialist</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Our stay was truly delightful and comfortable.
                            The homestay maintained high standards of cleanliness and hygiene.
                            Staff were courteous and always ready to assist.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Anand</h6>
                                <small>Hospital Administrator</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            The stay was smooth and stress-free.
                            Rooms were tidy and well designed for comfort.
                            Ideal choice for families and travelers.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Sunil Kumar</h6>
                                <small>Business Owner</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Really enjoyed our stay at this homestay.
                            Everything was clean and well organized.
                            A perfect blend of comfort and affordability.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/female.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Veni</h6>
                                <small>Web Developer</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            The homestay offered a calm and relaxing experience.
                            Rooms were comfortable and neatly maintained.
                            Felt safe, peaceful, and truly welcoming.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Sunil Kumar</h6>
                                <small>Business Owner</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Had an excellent stay with a serene environment.
                            Facilities were well-maintained and thoughtfully provided.
                            A safe and convenient choice for a relaxing visit.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Kethan</h6>
                                <small>Retail Store Owner</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            The homestay offered a calm and relaxing experience.
                            Rooms were comfortable and neatly maintained.
                            Felt safe, peaceful, and truly welcoming. </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Jagadeesh</h6>
                                <small>Entrepreneur</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Excellent homestay experience overall.
                            Clean rooms, peaceful surroundings, and good comfort.
                            Would love to stay here again in the future.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Venkata Sunil</h6>
                                <small>Sales Manager</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>
                            Had a comfortable and enjoyable stay.
                            The rooms were clean and well arranged.
                            A great option for a quiet and relaxing visit.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="<?php echo base_url(); ?>utilities/frontend/img/male.svg" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Maruthi</h6>
                                <small>Training Instructor</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                </div>
            </div>
        </div>
         <!-- Booking End -->
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
                             <input type="tel" class="form-control" placeholder="Your Mobile Number" name="mobile" required inputmode="numeric" maxlength="10"
                                      oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
         <div class="modal fade" id="roomDetailModal" tabindex="-1" aria-labelledby="roomDetailModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-xl modal-dialog-centered">
                 <div class="modal-content rounded shadow">

                     <!-- Modal Header -->
                     <div class="modal-header border-0">
                         <div class="container-fluid">
                             <div class="row w-100 align-items-center">
                                 <div class="col-md-4">
                                     <h5 class="modal-title text-uppercase text-primary mb-0" id="roomDetailModalLabel">
                                         Deluxe Room
                                     </h5>
                                 </div>
                                 <div class="col-md-8 text-end">

                                     <a href="javascript:void(0)"
                                         class="btn btn-sm btn-dark rounded py-2 px-4 room-detail-book-now"
                                         data-room="Deluxe">
                                         Book Now
                                     </a>
                                     <button type="button" class="btn btn-primary rounded " data-bs-dismiss="modal">Close</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Body -->
                     <div class="modal-body">
                         <div class="row g-4">

                             <!-- Images Column -->
                             <div class="col-lg-5">
                                 <div class="row g-3">
                                     <div class="col-6 text-end">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-D-01.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s">
                                     </div>
                                     <div class="col-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-D-04.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s">
                                     </div>
                                     <div class="col-6 text-end">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-D-03.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s">
                                     </div>
                                     <div class="col-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-D-02.svg" class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s">
                                     </div>

                                 </div>
                             </div>

                             <!-- Content Column -->
                             <div class="col-md-7">
                                 <p class="text-body mb-3">
                                     Our <b>Deluxe Rooms</b> are thoughtfully designed to provide comfort, convenience, and a peaceful stay for guests seeking a relaxing home-like experience. Ideal for solo travelers, couples, or small families, each room is well-ventilated, neatly furnished, and equipped with comfortable bedding for a restful night.
                                 </p>
                                 <p class="text-body mb-3">
                                     Guests can enjoy essential amenities such as a clean attached bathroom, fresh linens, wardrobe space, and basic seating arrangements. The calm ambiance and tidy interiors make the Deluxe Room a perfect choice for guests looking for quality accommodation at an affordable price.
                                 </p>

                                 <!-- Facilities -->
                                 <div class="row mb-4">
                                     <h6 class="text-dark mb-3">Facilities That Feel Like Home</h6>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>🛏️ Comfortable Bed</li>
                                             <li>🚿 Attached Bathroom</li>
                                             <li>❄️ Air-Conditioned</li>
                                             <li>📺 TV</li>
                                             <li>🧴 Fresh Linens</li>
                                         </ul>
                                     </div>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>📶 Free Wi-Fi</li>
                                             <li>🛋️ Shared Living Area</li>
                                             <li>🍳 Shared Kitchen</li>
                                             <li>🔥 Hot Water Geyser</li>
                                             <li>🚗 Parking</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="superdeluxeroomDetailModal" tabindex="-1" aria-labelledby="roomDetailModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-xl modal-dialog-centered">
                 <div class="modal-content rounded shadow">

                     <!-- Modal Header -->
                     <div class="modal-header border-0">
                         <div class="container-fluid">
                             <div class="row w-100 align-items-center">
                                 <div class="col-md-4">
                                     <h5 class="modal-title text-uppercase text-primary mb-0" id="roomDetailModalLabel">
                                         Super Deluxe Room
                                     </h5>
                                 </div>
                                 <div class="col-md-8 text-end">
                                     <a href="javascript:void(0)"
                                         class="btn btn-sm btn-dark rounded py-2 px-4 room-detail-book-now"
                                         data-room="Super Deluxe">
                                         Book Now
                                     </a>
                                     <button type="button" class="btn btn-primary rounded " data-bs-dismiss="modal">Close</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Body -->
                     <div class="modal-body">
                         <div class="row g-4">

                             <!-- Images Column -->
                             <div class="col-lg-5">
                                 <div class="row g-3">
                                     <div class="col-md-6 text-end">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SD-01.svg" class="img-fluid rounded w-100  wow zoomIn" data-wow-delay="0.3s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SD-04.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s">
                                     </div>
                                     <div class="col-md-6 text-center">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SD-02.svg" class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SD-03.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.5s">
                                     </div>

                                 </div>
                             </div>
                             <!-- Content Column -->
                             <div class="col-md-7">
                                 <p class="text-body mb-3">
                                     The <b>Super Deluxe Rooms</b> offer an enhanced level of comfort with additional space and upgraded furnishings. Designed for guests who prefer a more spacious and refined stay, these rooms are ideal for families and longer visits. Each Super Deluxe Room features elegant interiors, premium bedding, improved lighting, and comfortable seating areas.</p>
                                 <p class="text-body mb-3">
                                     Guests can enjoy a well-maintained attached bathroom, ample storage, and a relaxed atmosphere that blends modern comfort with homely warmth. The Super Deluxe Room is perfect for travelers who desire extra comfort and convenience during their stay while still enjoying the personalized care of a homestay.
                                 </p>
                                 <!-- Facilities -->
                                 <div class="row mb-4">
                                     <h6 class="text-dark mb-3">Facilities That Feel Like Home</h6>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>🛏️ Spacious Bed</li>
                                             <li>🚿 Attached Bathroom</li>
                                             <li>❄️ Air-Conditioner</li>
                                             <li>📺 TV</li>
                                             <li>🧴 Premium Linens</li>
                                         </ul>
                                     </div>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>📶 Free Wi-Fi</li>
                                             <li>🛋️ Shared Living Area</li>
                                             <li>🪑 Seating Area</li>
                                             <li>🍳 Shared Open Kitchen</li>
                                             <li>🔥 Common Hot Water Geyser</li>
                                             <li>🚗 Parking</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="superluxuryDetailModal" tabindex="-1" aria-labelledby="roomDetailModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-xl modal-dialog-centered">
                 <div class="modal-content rounded shadow">

                     <!-- Modal Header -->
                     <div class="modal-header border-0">
                         <div class="container-fluid">
                             <div class="row w-100 align-items-center">
                                 <div class="col-md-4">
                                     <h5 class="modal-title text-uppercase text-primary mb-0" id="roomDetailModalLabel">
                                         Super Luxury Room
                                     </h5>
                                 </div>
                                 <div class="col-md-8 text-end">
                                     <a href="javascript:void(0)"
                                         class="btn btn-sm btn-dark rounded py-2 px-4 room-detail-book-now"
                                         data-room="Super Luxury">
                                         Book Now
                                     </a>
                                     <button type="button" class="btn btn-primary rounded " data-bs-dismiss="modal">Close</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Body -->
                     <div class="modal-body">
                         <div class="row g-4">

                             <!-- Images Column -->
                             <div class="col-lg-5">
                                 <div class="row g-3">
                                     <div class="col-md-6 text-end">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SL-03.svg" class="img-fluid rounded w-75 h-100  wow zoomIn" data-wow-delay="0.3s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SL-01.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SL-02.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-SL-04.svg" class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s">
                                     </div>

                                 </div>
                             </div>

                             <!-- Content Column -->
                             <div class="col-md-7">
                                 <p class="text-body mb-3">
                                     Our <b>Super Luxury Rooms</b> provide a premium stay experience with superior interiors and a refined ambiance. These rooms are designed for guests who seek elegance, privacy, and a higher standard of comfort. Featuring spacious layouts, stylish décor, and top-quality furnishings, the Super Luxury Rooms offer a relaxing and indulgent stay.
                                 <p class="text-body mb-3">
                                     Guests can enjoy plush bedding, enhanced seating, modern amenities, and a meticulously maintained attached bathroom. The calm and sophisticated environment makes these rooms ideal for families, VIP guests, or travelers looking for a luxurious yet homely accommodation experience. </p>
                                 <!-- Facilities -->
                                 <div class="row mb-4">
                                     <h6 class="text-dark mb-3">Facilities That Feel Like Home</h6>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>🛏️ Premium Bedding</li>
                                             <li>🚿 Modern Bathroom</li>
                                             <li>❄️ Air-Conditioner</li>
                                             <li>📺 Smart TV</li>
                                             <li>🧴 Premium Linens</li>
                                             <li>✨ Stylish Interiors</li>
                                         </ul>
                                     </div>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>📶 High-Speed Wi-Fi</li>
                                             <li>🛋️ Living Area</li>
                                             <li>🪑 Elegant Seating</li>
                                             <li>🍳 Open Kitchen</li>
                                             <li>🔥 Common Hot Water Geyser</li>
                                             <li>🚗 Parking</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="grandsuiteDetailModal" tabindex="-1" aria-labelledby="roomDetailModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-xl modal-dialog-centered">
                 <div class="modal-content rounded shadow">

                     <!-- Modal Header -->
                     <div class="modal-header border-0">
                         <div class="container-fluid">
                             <div class="row w-100 align-items-center">
                                 <div class="col-md-4">
                                     <h5 class="modal-title text-uppercase text-primary mb-0" id="roomDetailModalLabel">
                                         Grand Suite<span class="text-dark">(3BHK)</span>
                                     </h5>
                                 </div>
                                 <div class="col-md-8 text-end">
                                     <a href="javascript:void(0)"
                                         class="btn btn-sm btn-dark rounded py-2 px-4 room-detail-book-now"
                                         data-room="Grand Suite">
                                         Book Now
                                     </a>
                                     <button type="button" class="btn btn-primary rounded " data-bs-dismiss="modal">Close</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Body -->
                     <div class="modal-body">
                         <div class="row g-4">

                             <!-- Images Column -->
                             <div class="col-lg-5">
                                 <div class="row g-3">
                                     <div class="col-md-6 text-end">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-GS-01.svg" class="img-fluid rounded w-100  wow zoomIn" data-wow-delay="0.3s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-GS-04.svg" class="img-fluid rounded w-100 h-100 wow zoomIn" data-wow-delay="0.7s">
                                     </div>
                                     <div class="col-md-6 text-center">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-GS-03.svg" class="img-fluid rounded w-75 h-100 wow zoomIn" data-wow-delay="0.1s">
                                     </div>
                                     <div class="col-md-6 text-start">
                                         <img src="<?php echo base_url(); ?>utilities/frontend/img/SLN-GS-02.svg" class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.5s">
                                     </div>

                                 </div>
                             </div>

                             <!-- Content Column -->
                             <div class="col-md-7">
                                 <p class="text-body mb-3">
                                     The <b>Entire Flat</b> option is perfect for large families, groups, or pilgrims traveling together who prefer privacy and exclusive use of the property. This option combines all room types into one spacious flat, offering multiple bedrooms, living areas, and shared facilities under one roof. Guests can enjoy complete independence, ample space, and the comfort of a fully furnished home.
                                 </p>
                                 <p class="text-body mb-3">
                                     The flat provides a secure, peaceful environment with sufficient room for group gatherings, relaxation, and extended stays. Ideal for family trips, group pilgrimages, or long-duration visits, the Entire Flat ensures convenience, comfort, and a true home-away-from-home experience.
                                 </p> <!-- Facilities -->
                                 <div class="row mb-4">
                                     <h6 class="text-dark mb-3">Facilities That Feel Like Home</h6>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>🏠 Private Entire Flat</li>
                                             <li>🛏️ Multiple Bedrooms</li>
                                             <li>🛋️ Living Area</li>
                                             <li>🧴 Premium Linens</li>
                                             <li>🍳 Open Kitchen</li>
                                             <li>❄️ Fully Air-Conditioner</li>
                                             <li>🔒 Complete Privacy</li>
                                         </ul>
                                     </div>
                                     <div class="col-6 facilities">
                                         <ul class="list-unstyled mb-0" style="line-height:1.6;">
                                             <li>📶 Free Wi-Fi</li>
                                             <li>🍽️ Dining Space</li>
                                             <li>🚿 Multiple Bathrooms</li>
                                             <li>🍳 Open Kitchen</li>
                                             <li>🔥 Common Hot Water Geyser</li>
                                             <li>🚗 Parking</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         
         <!-- JS to Auto-close Room Detail Modal and Open Booking Modal -->
         <script>
             document.addEventListener("DOMContentLoaded", function() {

                 /* ----------------------------------------
                    AUTO-CLOSE ANY OPEN MODAL
                 ---------------------------------------- */
                 document.querySelectorAll('.modal').forEach(function(modalEl) {
                     modalEl.addEventListener('show.bs.modal', function() {

                         const openModal = document.querySelector('.modal.show');

                         if (openModal && openModal !== modalEl) {
                             const instance = bootstrap.Modal.getInstance(openModal);
                             if (instance) instance.hide();
                         }

                     });
                 });


                 /* ----------------------------------------
                    BOOK NOW FROM ROOM DETAIL MODAL
                 ---------------------------------------- */
                 document.querySelectorAll('.room-detail-book-now').forEach(btn => {
                     btn.addEventListener('click', function() {

                         const room = this.getAttribute('data-room');

                         // Close Room Detail Modal
                         const roomModalEl = document.getElementById('roomDetailModal');
                         const roomModal = bootstrap.Modal.getInstance(roomModalEl);
                         if (roomModal) roomModal.hide();

                         // Open Booking Modal AFTER close animation
                         setTimeout(() => {
                             const bookingModalEl = document.getElementById('bookingModal');
                             const bookingModal = new bootstrap.Modal(bookingModalEl);
                             bookingModal.show();

                             // Set room type
                             const roomTypeInput = document.getElementById('roomType');
                             if (roomTypeInput) roomTypeInput.value = room;
                         }, 300); // matches Bootstrap fade timing

                     });
                 });

             });
         </script>

         <script>
             document.addEventListener("DOMContentLoaded", function() {

                 const bookingModal = document.getElementById('bookingModal');
                 const checkinInput = document.getElementById('checkin');
                 const roomTypeSelect = document.getElementById('roomType');

                 // Set today's date when modal opens
                 bookingModal.addEventListener('shown.bs.modal', function() {
                     let today = new Date().toISOString().split('T')[0];
                     checkinInput.value = today;
                 });

                 // Set room type on "Book Now" click
                 document.querySelectorAll('[data-room]').forEach(button => {
                     button.addEventListener('click', function() {
                         roomTypeSelect.value = this.getAttribute('data-room');
                     });
                 });

             });
         </script>
         <style>
             .facilities h6,
             .facilities ul li {
                 line-height: 2.0;
             }

             .content {
                 line-height: 1.5;
             }
         </style>