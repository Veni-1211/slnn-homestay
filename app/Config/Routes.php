<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// route since we don't have to scan directories.
$routes->get('/', 'frontend\SettingsController::home');
$routes->get('about', 'frontend\SettingsController::about');
$routes->get('services', 'frontend\SettingsController::services');
$routes->get('rooms', 'frontend\SettingsController::rooms');
$routes->get('bookings', 'frontend\SettingsController::bookings');
$routes->get('team', 'frontend\SettingsController::our_team');
$routes->get('testimonial', 'frontend\SettingsController::testimonial');
$routes->get('contact', 'frontend\SettingsController::contact');
$routes->post('contact', 'frontend\SettingsController::contact');
$routes->post('booking/submit', 'frontend\SettingsController::bookings_byCustomer');
// Bakcend
$routes->get('dashboard', 'backend\DashboardController::dashboard');
$routes->get('admin', 'backend\AuthenticationController::login');
$routes->post('admin', 'backend\AuthenticationController::login');
$routes->get('forgot-password', 'backend\AuthenticationController::forgot_password');
$routes->post('forgot-password', 'backend\AuthenticationController::forgot_password');
$routes->get('verify-forgot-otp/(:any)', 'backend\AuthenticationController::verify_forgot_password/$1');
$routes->post('verify-forgot-otp/(:any)', 'backend\AuthenticationController::verify_forgot_password/$1');
$routes->get('reset-password/(:any)', 'backend\AuthenticationController::reset_password/$1');
$routes->post('reset-password/(:any)', 'backend\AuthenticationController::reset_password/$1');
$routes->get('change-password', 'backend\AuthenticationController::change_password');
$routes->post('change-password', 'backend\AuthenticationController::change_password');
$routes->get('verify-change-password-otp/(:any)', 'backend\AuthenticationController::verify_change_password_otp/$1');
$routes->post('verify-change-password-otp/(:any)', 'backend\AuthenticationController::verify_change_password_otp/$1');
$routes->get('password-change/(:any)', 'backend\AuthenticationController::change_password_final/$1');
$routes->post('password-change/(:any)', 'backend\AuthenticationController::change_password_final/$1');
$routes->get('logout', 'backend\AuthenticationController::logout');

$routes->get('manage-contact-reply', 'backend\ReplyContactController::manage_contact_reply');
$routes->post('manage-contact-reply', 'backend\ReplyContactController::manage_contact_reply');
$routes->get('get-mobile-replies', 'backend\ReplyContactController::getMobileReplies');
$routes->post('save-mobile-reply', 'backend\ReplyContactController::saveMobileReply');
$routes->post('saveEmailReply', 'backend\ReplyContactController::saveEmailReply');
$routes->get('saveEmailReply', 'backend\ReplyContactController::saveEmailReply');
$routes->post('filter-contact-replies', 'backend\ReplyContactController::filterContactReplies');
// Booking list
$routes->get('manage-reply-bookings', 'backend\BookingReplyController::manage_reply_bookings');

// Save booking reply
$routes->post('save-booking-reply', 'backend\BookingReplyController::save_booking_reply');

// Booking report page
$routes->get('booking-report/(:any)', 'backend\BookingReplyController::booking_report/$1');

$routes->post('rooms-availability', 'backend\RoomsAvailabilityController::rooms_availability');
$routes->get('rooms-availability', 'backend\RoomsAvailabilityController::rooms_availability');

// room_types
$routes->get('manage-room-types', 'backend\RoomsController::manage_room_types');
$routes->get('add-room-types', 'backend\RoomsController::add_room_types');
$routes->post('add-room-types', 'backend\RoomsController::add_room_types');
$routes->get('view-room-types/(:any)', 'backend\RoomsController::view_room_types/$1');
$routes->get('edit-room-types/(:any)', 'backend\RoomsController::edit_room_types/$1');
$routes->post('edit-room-types/(:any)', 'backend\RoomsController::edit_room_types/$1');
$routes->get('delete-room-types/(:any)/(:any)', 'backend\RoomsController::delete_room_types/$1/$2');
//rooms
$routes->get('manage-rooms', 'backend\RoomsController::manage_rooms');
$routes->get('add-rooms', 'backend\RoomsController::add_rooms');
$routes->post('add-rooms', 'backend\RoomsController::add_rooms');
$routes->get('view-rooms/(:any)', 'backend\RoomsController::view_rooms/$1');
$routes->get('edit-rooms/(:any)', 'backend\RoomsController::edit_rooms/$1');
$routes->post('edit-rooms/(:any)', 'backend\RoomsController::edit_rooms/$1');
$routes->get('delete-rooms/(:any)/(:any)', 'backend\RoomsController::delete_rooms/$1/$2');
// Booking
$routes->get('manage-bookings', 'backend\BookingsController::manage_bookings');
$routes->get('add-bookings', 'backend\BookingsController::add_bookings');
$routes->post('add-bookings', 'backend\BookingsController::add_bookings');
$routes->get('view-bookings/(:any)', 'backend\BookingsController::view_bookings/$1');
$routes->get('edit-bookings/(:any)', 'backend\BookingsController::edit_bookings/$1');
$routes->post('edit-bookings/(:any)', 'backend\BookingsController::edit_bookings/$1');
$routes->get('delete-bookings/(:any)/(:any)', 'backend\BookingsController::delete_bookings/$1/$2');
// reports
$routes->get('reports', 'backend\ReportsController::reports');
// testimonials
$routes->get('manage-testimonials', 'backend\ReportsController::manage_testimonials');
$routes->get('add-testimonials', 'backend\ReportsController::add_testimonials');
$routes->post('add-testimonials', 'backend\ReportsController::add_testimonials');
$routes->get('edit-testimonials/(:any)', 'backend\ReportsController::edit_testimonials/$1');
$routes->post('edit-testimonials/(:any)', 'backend\ReportsController::edit_testimonials/$1');
$routes->get('view-testimonials/(:any)', 'backend\ReportsController::view_testimonials/$1');
$routes->get('delete-testimonials/(:any)/(:any)', 'backend\ReportsController::delete_testimonials/$1/$2');
// Booking Model
$routes->post('add-invoice', 'backend\BookingsController::add_invoice');
$routes->post('add-payment', 'backend\BookingsController::add_payment');
$routes->post('add-charges', 'backend\BookingsController::add_charges');
$routes->get('/getBookingRooms/(:any)', 'backend\BookingsController::getBookingRooms/$1');
$routes->get('/getAllRooms', 'backend\BookingsController::getAllRooms');
$routes->get('checkout-summary/(:any)', 'backend\BookingsController::checkoutSummary/$1');
$routes->get('getRoomPayments/(:any)/(:any)', 'backend\BookingsController::getRoomPayments/$1/$2');
$routes->post('update-room-checkout', 'backend\BookingsController::update_checkout');
$routes->get('get-bill-details/(:any)', 'backend\BookingsController::getBillDetails/$1');






















/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
//hello new  added
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
