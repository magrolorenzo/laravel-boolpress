<?php

// ******************************* PUBLIC HomeController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

use App\Mail\MessageFromWebsite;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // Aggiunto ->middleware('auth') alle rotte che richiedomo autenticazione
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    public function contatti()
    {
        return view('guest.contatti');
    }

    public function thankYou()
    {
        return view('guest.thank-you');
    }

    public function contattiSent(Request $request)
    {
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();
        Mail::to("info@boolpress.com")->send(new MessageFromWebsite());
        return redirect()->route("contatti.thank-you");
    }
}
