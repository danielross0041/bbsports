<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\ApiFeedsController;
use App\Http\Controllers\CustomerController;
use App\Mail\mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
// Route::get('/', [IndexController::class, 'index'])->name('welcome');
// Route::get('/about-us', [IndexController::class, 'about_us'])->name('about_us');
// Route::get('/contact-us', [IndexController::class, 'contact'])->name('contact');
// Route::get('privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy-policy'); 
// Route::post('/contact-us-submit', [IndexController::class, 'contact_submit'])->name('contact_submit');
// Route::get('/pricing', [IndexController::class, 'pricing'])->name('pricing');
// Route::get('/how-it-works', [IndexController::class, 'how_it_work'])->name('how_it_work');
// Route::get('/signup', [IndexController::class, 'signup'])->name('signup');
// Route::get('/signin', [IndexController::class, 'signup_login'])->name('signup_login');

Route::get('/', [IndexController::class, 'index'])->name('welcome');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/about/instructor', [IndexController::class, 'instructor'])->name('instructor');
Route::get('/about/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/teams', [IndexController::class, 'teams'])->name('teams');
Route::get('/teams/highschool-team', [IndexController::class, 'highschoolteam'])->name('highschoolteam');
Route::get('/teams/youth-team', [IndexController::class, 'youthteam'])->name('youthteam');
Route::get('/services', [IndexController::class, 'services'])->name('services');
Route::get('/services/peaktop-program', [IndexController::class, 'peaktop_program'])->name('peaktop_program');
Route::get('/services/private-lesson', [IndexController::class, 'privatelesson'])->name('privatelesson');
Route::get('/services/online-lesson', [IndexController::class, 'onlinelesson'])->name('onlinelesson');
Route::get('/event', [IndexController::class, 'event'])->name('event');
Route::get('/event/tournament', [IndexController::class, 'tournament'])->name('tournament');
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/register', [IndexController::class, 'register'])->name('register');
// Route::get('/login', [IndexController::class, 'login'])->name('signup_login');
Route::get('/pricing/', [IndexController::class, 'pricinghome'])->name('pricinghome');
Route::get('/blog', [IndexController::class, 'blog'])->name('blog');

Route::get('/blog/blog-detail/{id}', [IndexController::class, 'blog_details'])->name('blog_details');

Route::get('/recruiting', [IndexController::class, 'recruiting'])->name('recruiting');
Route::get('/services/online-lessons/online-training-payment/', [IndexController::class, 'onlinetraining'])->name('onlinetraining');
Route::get('about/instructor/instructor_profile/{user_id}', [IndexController::class, 'instructor_profile'])->name('instructor_profile');
Route::get('hittrax-leagues', [IndexController::class, 'hittrax'])->name('hittrax');
Route::get('/event/tournament/baseball', [IndexController::class, 'baseball'])->name('baseball');
Route::get('/event/tournament/softball', [IndexController::class, 'softball'])->name('softball');



Route::get('/team/{id}', [IndexController::class, 'team_listing'])->name('team_listing');



Route::post('/contcct/contact-details', [IndexController::class, 'contact_details'])->name('contact_details');

Route::get('/player_profile/{id?}', [IndexController::class, 'player_profile'])->name('player_profile');


Route::get('send_mail/{email?}', [IndexController::class, 'send_mail'])->name('send_mail');

Route::get('/shop/product-details/{id?}', [IndexController::class, 'product_details'])->name('product_details');


Route::post('/get_sizes', [IndexController::class, 'get_sizes'])->name('get_sizes');
Route::post('/get_stock', [IndexController::class, 'get_stock'])->name('get_stock');


Route::get('/shop', [IndexController::class, 'shop'])->name('shop');
Route::get('/shop/product/{url?}/', [IndexController::class, 'shopall'])->name('shopall');
Route::post('/shop/pricing', [ProductController::class, 'pricing'])->name('pricing');
Route::post('/shop/save_cart', [ProductController::class, 'save_cart'])->name('save_cart');
Route::get('/shop/forget_cart', [ProductController::class, 'forget_cart'])->name('forget_cart');
Route::get('/shop/forget_coupon', [ProductController::class, 'forget_coupon'])->name('forget_coupon');
Route::get('/shop/cart', [ProductController::class, 'get_cart'])->name('get_cart');
Route::post('/shop/remove_cart', [ProductController::class, 'remove_cart'])->name('remove_cart');

Route::get('/shop/invoice_mail/{email?}/{order_details_id?}', [ProductController::class, 'invoice_mail'])->name('invoice_mail');



Route::post('/apply_coupon', [ProductController::class, 'apply_coupon'])->name('apply_coupon');
Route::post('/shop/update_cart', [ProductController::class, 'update_cart'])->name('update_cart');


Route::get('/shop/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/shop/register_customer', [ProductController::class, 'register_customer'])->name('register_customer');

Route::post('/login_customer', [ProductController::class, 'login_customer'])->name('login_customer');

Route::post('/register_team', [IndexController::class , 'register_team'])->name('register_team');

// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     return "Cache is cleared";
// });


// Route::get('/forex-feed-news', [ApiFeedsController::class, 'forex_trackr'])->name('forex_trackr');

// //  Route::get('connect-my-account', [TelegramController::class , 'connect_my_account'])->name('connect_my_account');   
Route::post('/registration-submit', [RegistrationController::class, 'registration_submit'])->name('registration_submit');
// Route::post('validator', [RegistrationController::class , 'validator_check'])->name('validator_check');

// Route::get('/terms-and-condition', [IndexController::class, 'terms'])->name('terms');
// Route::get('/Privacy-Policy', [IndexController::class, 'policy'])->name('policy');

//Route::get('/news-detail', [IndexController::class, 'news_detail'])->name('news_detail');

//Route::get('/upload-resume', [IndexController::class, 'upload_resume'])->name('upload_resume');

//Route::post('/upload-resume-submit', [IndexController::class, 'upload_resume_submit'])->name('upload_resume_submit');
//Route::get('/', [IndexController::class, 'home'])->name('welcome');

//Route::get('/employee-registration', [RegistrationController::class, 'index'])->name('employee_registration');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/steps', [HomeController::class, 'steps'])->name('steps');
    Route::get('/switch-project/{id}', [HomeController::class, 'switch_project'])->name('switch_project');
    Route::get('/profile', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/user-profile', [HomeController::class , 'user_profile'])->name('user_profile');

    Route::get('/update-password', [HomeController::class , 'update_password'])->name('update_password');
    Route::post('/user-password-update', [HomeController::class, 'user_passwordupdate'])->name('user_passwordupdate');
    
    Route::post('/user-info-update', [HomeController::class, 'user_infoupdate'])->name('user_infoupdate');
    Route::get('/user-office-details', [HomeController::class , 'user_office_details'])->name('user_office_details');
    Route::post('/user-office-info-update', [HomeController::class, 'user_office_infoupdate'])->name('user_office_infoupdate');
    Route::post('/user-file-info-update', [HomeController::class, 'user_file_infoupdate'])->name('user_file_infoupdate');
    Route::get('/user-file-details', [HomeController::class , 'user_file_details'])->name('user_file_details');
    Route::post('/user-photo-update', [HomeController::class, 'upload_image'])->name('upload_image');
    Route::post('/profile-submit', [HomeController::class, 'profile_submit'])->name('profile_submit');
    Route::get('/user-rights', [HomeController::class , 'user_rights'])->name('user_rights');
    Route::get('/inquiry-manage', [HomeController::class , 'inquiry_manage'])->name('inquiry_manage');
    // Reports Routes
    Route::post('/user-updates', [HomeController::class , 'user_updates'])->name('user_updates');
    Route::post('/shift-change', [HomeController::class , 'shift_change'])->name('shift_change');

    Route::get('/registered-user-report', [ReportController::class , 'registered_user_report'])->name('registered_user_report');
    Route::get('/all-user-report/{slug?}', [ReportController::class , 'all_registered_user_report'])->name('all_registered_user_report');


    Route::get('/attendance-sheet-import', [ReportController::class , 'attendance_sheet_import'])->name('attendance_sheet_import');
    Route::post('attendance-import-submit', [ReportController::class, 'attendance_import_submit'])->name('attendance_import_submit');

    Route::get('/all-leave-application-report', [ReportController::class , 'all_leave_application_report'])->name('all_leave_application_report');

    Route::get('/birthday-list', [ReportController::class , 'birthday_list'])->name('birthday_list');
    
    // Reports Routes End
    
    Route::post('ckeditor/image_upload', [GenericController::class, 'upload'])->name('upload');

    Route::get('order-details/{id}', [GenericController::class, 'order_details'])->name('order_details');


    Route::post('/cms_create', [GenericController::class , 'cms_generator'])->name('cms_generator');
    Route::post('/modalform', [GenericController::class , 'modalform'])->name('modalform');
    
    Route::post('/coupon_generator', [GenericController::class , 'coupon_generator'])->name('coupon_generator');

    
    // Route::post('/upload', [GenericController::class , 'upload'])->name('upload');
    






    Route::post('/blog_generator', [GenericController::class , 'blog_generator'])->name('blog_generator');
    Route::post('/instructor_create', [GenericController::class , 'instructor_generator'])->name('instructor_generator');
    Route::post('/{slug?}/create', [GenericController::class , 'crud_generator'])->name('crud_generator');
    Route::post('/{slug?}/product_create', [GenericController::class , 'product_generator'])->name('product_generator');
    Route::post('/variation_create', [GenericController::class , 'variation_generator'])->name('variation_generator');
    
    Route::post('/{slug?}/create_pro', [GenericController::class , 'pro_crud_generator'])->name('pro_crud_generator');
    Route::post('/{slug?}/create_product', [GenericController::class , 'pro_generator'])->name('pro_generator');
    Route::post('/create_cms/{slug?}', [GenericController::class , 'cms_crud_generator'])->name('cms_crud_generator');
    Route::post('/{slug?}/create_image', [GenericController::class , 'image_crud_generator'])->name('image_crud_generator');
    Route::post('/create_instructor', [GenericController::class , 'instructor_registration'])->name('instructor_registration');


    Route::get('/attributes', [GenericController::class , 'roles'])->name('roles');
    Route::get('/attribute/{slug}', [GenericController::class , 'listing'])->name('listing');
    Route::get('/attribute/product-variation/{id}', [GenericController::class , 'variation_product'])->name('variation_product');
    Route::post('/delete-record', [GenericController::class , 'delete_record'])->name('delete_record');
    Route::post('/delete-pitcher', [GenericController::class , 'delete_pitcher'])->name('delete_pitcher');

    Route::post('/variation', [GenericController::class , 'variation'])->name('variation');
    
    Route::post('/variation_of_product', [GenericController::class , 'variation_of_product'])->name('variation_of_product');

    Route::post('/setlist', [GenericController::class , 'setlist'])->name('setlist');
    Route::get('/report/{slug}', [GenericController::class , 'report_user'])->name('report_user');
    Route::post('/custom-report', [GenericController::class , 'custom_report'])->name('custom_report');
    Route::get('/custom-report/{slug}/{slug2}', [GenericController::class , 'custom_report_user'])->name('custom_report_user');
    Route::post('/generic-submit', [GenericController::class , 'generic_submit'])->name('generic_submit');
    Route::post('/assign-role-submit', [GenericController::class , 'roleassign_submit'])->name('roleassign_submit');
    Route::post('/role-assign-modal', [GenericController::class , 'role_assign_modal'])->name('role_assign_modal');
    
    // Player Details Routes
    Route::get('/player_details/{slug}/{id}', [PlayerController::class , 'player_details'])->name('player_details');
    Route::post('/{slug?}/player_create', [PlayerController::class , 'player_crud_generator'])->name('player_crud_generator');

    Route::post('/attributes/approve_player', [PlayerController::class , 'approve_player'])->name('approve_player');
    Route::post('/attributes/recruited_player', [PlayerController::class , 'recruited_player'])->name('recruited_player');

    Route::post('/attributes/team_set', [GenericController::class , 'team_set'])->name('team_set');


    // Payroll Routes
    Route::get('/payroller', [PayrollController::class , 'payroller'])->name('payroller');
    Route::post('/payroll-month-report', [PayrollController::class , 'payroll_month_report'])->name('payroll_month_report');

    Route::get('/payslips', [PayrollController::class , 'payslips'])->name('payslips');
    Route::get('/view-payslip/{id}', [PayrollController::class , 'view_payslip'])->name('view_payslip');
    Route::post('/payslip-generate', [PayrollController::class , 'payslip_generate'])->name('payslip_generate');
    // Payroll Routes End

    // Chat Room
    Route::get('chat', [ChatController::class , 'chat'])->name('chat');
    Route::post('save-msg', [ChatController::class , 'save_msg'])->name('save_msg');
    Route::post('fetch-messages', [ChatController::class , 'fetch_msg'])->name('fetch_msg');

    // Leave Application Form
    Route::get('all-leave-application', [LeaveApplicationController::class , 'all_leave_application'])->name('all_leave_application');
    Route::get('leave-applicaton/show', [LeaveApplicationController::class , 'leave_show'])->name('leave_show');
    Route::get('leave-applicaton/team-show', [LeaveApplicationController::class , 'leave_teamshow'])->name('leave_teamshow');
    Route::post('leave-applicaton-submit', [LeaveApplicationController::class , 'leave_submit'])->name('leave_submit');
    Route::get('leave-applicaton-delete/{id}', [LeaveApplicationController::class , 'application_delete'])->name('application_delete');
    Route::post('update-team-leave-applicaton', [LeaveApplicationController::class , 'update_leave_form'])->name('update_leave_form');
    Route::post('leave-form-validate', [LeaveApplicationController::class , 'leave_form_validate'])->name('leave_form_validate');
    
    // Candidate Form
    // Step 1
    Route::get('dashboard/job/get-started/{id?}', [CandidateController::class , 'step1_form'])->name('step1_form');
    Route::get('dashboard/job/include-details/{id?}', [CandidateController::class , 'step3_form'])->name('step3_form');
    Route::get('dashboard/job/compensation-details/{id?}', [CandidateController::class , 'step4_form'])->name('step4_form');
    Route::get('dashboard/job/job-description/{id?}', [CandidateController::class , 'step5_form'])->name('step5_form');

    Route::get('application', [CandidateController::class , 'candidate_form'])->name('candidate_form');
    Route::get('dashboard/job/create/{id?}', [CandidateController::class , 'create_job'])->name('create_job');
    Route::get('dashboard/job/company-profile/{id?}', [CandidateController::class , 'company_profile'])->name('company_profile');

    
    Route::post('dashboard/job/save', [CandidateController::class , 'job_create_save'])->name('job_create_save');
    Route::post('dashboard/company/save', [CandidateController::class , 'company_create_save'])->name('company_create_save');
    Route::post('dashboard/company/logo', [CandidateController::class , 'companylogo_submit'])->name('companylogo_submit');

    Route::get('dashboard/jobs', [CandidateController::class , 'job_display'])->name('job_display');
    Route::get('dashboard/job-edit/{id?}', [CandidateController::class , 'job_edit'])->name('job_edit');

    // Send Message to telegram
    Route::get('web-config', [HomeController::class , 'web_config'])->name('web_config');    
    Route::get('logo', [HomeController::class , 'logo'])->name('logo');    
    Route::post('change_logo', [HomeController::class , 'change_logo'])->name('change_logo');    
    Route::post('config-update', [HomeController::class , 'config_update'])->name('config_update');    
    Route::get('send-message', [TelegramController::class , 'sendMessage'])->name('sendMessage');    
    
    Route::post('connect-user', [TelegramController::class , 'connectUser'])->name('connectUser');    
});

Route::middleware([customer::class])->group(function(){

    Route::get("user-dashboard",[CustomerController::class,'index'])->name('index');
    Route::get("education",[CustomerController::class,'education'])->name('education');
    Route::get("edit-profile",[CustomerController::class,'edit_profile'])->name('editprofile');
    Route::get("reset-password",[CustomerController::class,'reset_Password'])->name('resetpassword');
    Route::get("view-weekly-breakdown",[CustomerController::class,'view_Weeklybrekdown'])->name('view-weekly-breakdown');
    Route::get("mid-week-market-review",[CustomerController::class,'mid_Week_marketReview'])->name('mid-week-market-review'); 
    Route::get("monthy-signals-reports",[CustomerController::class,'monthly_SignalReport'])->name('monthy-signals-reports'); 
    Route::get("economiccal",[CustomerController::class,'economiccal'])->name('economiccal'); 
    Route::get("billing",[CustomerController::class,'billing'])->name('billing'); 
    Route::get("edit-payment-card",[CustomerController::class,'edit_paymentcard'])->name('Edit-paymentcard'); 
    Route::get("all-invoices",[CustomerController::class,'allinvoices'])->name('allinvoices');
    Route::get("edit-join-telegram",[CustomerController::class,'edit_Jointelegram'])->name('edit-join-telegram');
    Route::get("edit-books",[CustomerController::class,'edit_books'])->name('edit-books');
    Route::get("edit-vedios",[CustomerController::class,'edit_vedios'])->name('edit-vedios');
    Route::get("weekly-breakdown",[CustomerController::class,'weekly_breakdown'])->name('weekly-breakdown');
    Route::get("mid-week-review",[CustomerController::class,'mid_weekreview'])->name('mid-week-review');
    Route::get("edit-monthly-signals-report",[CustomerController::class,'edit_monthly_signalsreport'])->name('edit-monthly-signals-report');
    Route::get("terms-policy",[CustomerController::class,'terms_policy'])->name('terms-policy'); 
 });





