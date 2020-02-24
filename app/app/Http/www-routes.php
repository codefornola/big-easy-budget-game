<?php

Route::get('/', function (){
    return view('www.welcome');
});

Route::get('/privacy-policy', function (){
	return view('www.privacy-policy');
});

//Route::get('/test', function(){
//   return view('emails.admin.sign-up', [
//       'data' => [
//           'location' => 'Nelson, New Zealand',
//           'annual_budget' => '150,000,000',
//           'name' => 'Joe Williamson',
//           'email' => 'joe@williamson.com',
//           'phone' => '985-501-5838'
//       ]
//   ]);
//});

Route::post('/action/sign-up', function (){

    sleep(1);
    $input = Request::input();

    // CSRF protection
    if (Request::ajax()) {
        if (Session::token() !== $input['_token']) {
            return response()->json([
                'error' => 404,
                'message' => '<strong>Hm, something went wrong.</strong> Please refresh and try again.'
            ], 400);
        }
    }

    $errorMsg = false;

    if (empty($input['name'])) {
        $errorMsg = '<strong>Uh-oh, you forgot something.</strong> Please provide your name.';
    }

    if (!empty($input['email']) && filter_var($input['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errorMsg = '<strong>Hm, something went wrong.</strong> Your email address is invalid.';
        $emailIsValid = false;
    }else{
        $emailIsValid = true;
    }

    if (!empty($input['phone']) && strlen(preg_replace('/[^0-9]/', '', $input['phone'])) < 7) {
        $errorMsg = '<strong>Hm, something went wrong.</strong> Your phone number is invalid.';
    }

    if (empty($input['email']) && empty($input['phone'])) {
        $errorMsg = '<strong>Uh-oh, you forgot something.</strong> Please include some contact info.';
    }

    if (!$errorMsg) {

        // Send admin email
        Mail::send('www.emails.admin.sign-up', ['data' => $input], function ($m){
            $adminEmails = explode(',', env('MAIL_TO_SALES', 'dev+team@legnd.com'));
            foreach($adminEmails as $adminEmail){
                $m->to(trim($adminEmail));
            }
            $m->subject('New Sign Up!');
        });

        if($emailIsValid){
            // Send admin email
            Mail::send('www.emails.customer.sign-up', ['data' => $input], function ($m) use($input){
                $m->to($input['email'], $input['name'])->subject('We received your request!');
            });
        }

        return response()->json([
            'success' => true,
            'message' => '<strong>Awesome, thanks!</strong> We received your request and will be in touch.'
        ]);
    }

    return response()->json(['error' => 404, 'message' => $errorMsg], 400);
});