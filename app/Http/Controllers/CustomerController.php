<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\orders;
use Auth;
class CustomerController extends Controller {

    // for index page
    public function index() {
        return view('customer.index');
    }
    // for Education page View
    public function education() {
        return view('customer.education');
    }
    // for Edit Profile page View
    public function edit_profile() {
        return view('customer.edit-profile');
    }
    // for reset Password page View
    public function reset_Password() {
        return view('customer.reset-password');
    }
    // for View Weekly Breakdown page
    public function view_Weeklybrekdown() {
        return view('customer.view-weeklybreakdown');
    }
    // for View Mid week MArket page
    public function mid_Week_marketReview() {
        return view('customer.mid-week-market-review');
    }
    // for Monthly signals Report  page
    public function monthly_SignalReport() {
        return view('customer.monthly-signals-report');
    }
    // for economiccal  page  View
    public function economiccal() {
        return view('customer.economiccal');
    }
    // for Billing  page  View
    public function billing() {
        return view('customer.billing');
    }
    // for Edit payment Card  page  View
    public function edit_paymentcard() {
        return view('customer.edit-paymentcard');
    }
    // for All Invoices  page  View
    public function allinvoices() {
        $user =  Auth::user();
        $orders = orders::where("user_id" , $user->id)->get();
        return view('customer.allinvoices')->with(compact('orders'));
    }
    // for Edit Join Telegram  page  View
    public function edit_Jointelegram() {
        return view('customer.edit-join-telegram');
    }
    // for Edit Books  page  View
    public function edit_books() {
        return view('customer.edit-books');
    }
    // for Edit Vedios  page  View
    public function edit_vedios() {
        return view('customer.edit-videos');
    }
    // for Weekly Breakdown  page  View
    public function weekly_breakdown() {
        return view('customer.weekly-breakdown');
    }
    // for Mid Week Review page  View
    public function mid_weekreview() {
        return view('customer.mid-week-review');
    }
    // forEdit Monthly Signals Report Page View
    public function edit_monthly_signalsreport() {
        return view('customer.edit-monthly-signalsreport');
    } 

    public function terms_policy() {
        return view('customer.terms-policy');
    }

    public function file_reader() {
        return view('file-reader');
    }

}
