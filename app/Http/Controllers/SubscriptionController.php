<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscription;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Handle the subscription request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Save the email to the database
        Subscription::create(['email' => $request->input('email')]);

        // Send confirmation email
        Mail::to($request->input('email'))->send(new NewsletterSubscription($request->input('email')));

        return redirect()->back()->with('success', 'Subscription successful! A confirmation email has been sent to you.');
    }
}
