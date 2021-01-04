<?php

namespace App\Http\Controllers\Auth;

use App\Model\Referal;
use App\Model\ReferalTransaction;
use App\Model\Wallet;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'required|string|max:25|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|min:9',
            'password' => 'confirmed|required| min:5 |max:30',
            'password_confirmation' => 'required| min:5 |max:30',
            'age'=>'required|numeric',
            'sex'=>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'token' => base64_encode($data['email']),
            'age'=>$data['age'],
            'sex'=>$data['sex']

        ]);
     
        $user->referral_code()->create([
            'user_id' => $user->id,
            'referal_code' => $user->user_name . rand(0, 9) . rand(0, 9) . rand(0, 9)
        ]);
      
        $user->wallets()->create([
            'user_id' => $user->id,
            'amount' => 0
        ]);
        return $user;
    }

    public function register(Request $request)
    {
        
        
        //$this->validator($request->all())->validate();
        
        if ($request['referral_code']) {
            
            if (getConfiguration('active') == 0) {
                return redirect()->back()->with('error', 'Referral service has been disabled.');
            }
         
            $referal = Referal::where('referal_code', $request['referral_code'])->first();
            if ($referal) {
                
                event(new Registered($user = $this->create($request->all())));
                
                $data = [
                    'email_token' => $user->token
                ];

                //\Mail::to($request->email)->send(new EmailVerification($data));
                
                $this->guard()->login($user);
                
                return $this->registered($request, $user) ?: redirect($this->redirectPath());

                $provider = $referal->user_id;
                $provider_user = Wallet::where('user_id', $provider)->first();
                $provider_user->amount = $provider_user->amount + getConfiguration('referal');
                $provider_user->update();

                ReferalTransaction::create([
                    'sender_id' => $user->id,
                    'receiver_id' => $provider,
                    'amount' => getConfiguration('referal')
                ]);

            } else {
                return redirect()->back()->with('error', 'Referral Code Not Found.');
            }
        } else {
            event(new Registered($user = $this->create($request->all())));
            $data = [
                'email_token' => $user->token
            ];
            //Mail::to($request->email)->send(new EmailVerification($data));
            $this->guard()->login($user);
       
            //return $this->registered($request, $user) ?: redirect($this->redirectPath());
            return $this->registered($request, $user) ?: redirect()->route('user.account');

        }
    }

    public function register_through_supervendor(Request $request)
    {
        $this->validator($request->all())->validate();
        $request->validate([
            'name' => 'required|alpha_dash',
            'pan_number' => 'required|integer',
            'email' => 'required|email',
            'tax_clearance' => 'required',
            'type' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'pan_image' => 'image|required',
            'company_image' => 'required|image',
            'signature_image' => 'required|image',
        ],
            [
                'name.required' => 'Store Name Already Taken',
                'name.alpha_dash' => 'Store name may contain letters and no alphabets and spaces'
            ]);
        if ($request['referral_code']) {
            if (getConfiguration('active') == 0) {
                return redirect()->back()->with('error', 'Referral service has been disabled.');
            }
            $referal = Referal::where('referal_code', $request['referral_code'])->first();
            if ($referal) {
                event(new Registered($user = $this->create($request->all())));
                $data = [
                    'email_token' => $user->token
                ];

                \Mail::to($request->email)->send(new EmailVerification($data));

                $this->guard()->login($user);
                return $this->registered($request, $user) ?: redirect($this->redirectPath());

                $provider = $referal->user_id;
                $provider_user = Wallet::where('user_id', $provider)->first();
                $provider_user->amount = $provider_user->amount + getConfiguration('referal');
                $provider_user->update();

                ReferalTransaction::create([
                    'sender_id' => $user->id,
                    'receiver_id' => $provider,
                    'amount' => getConfiguration('referal')
                ]);

            } else {
                return redirect()->back()->with('error', 'Referral Code Not Found.');
            }
        } else {
            event(new Registered($user = $this->create($request->all())));
            Session::put('through_superAdmin', $user->id);

            $data = [
                'email_token' => $user->token
            ];
            \Mail::to($request->email)->send(new EmailVerification($data));
            return true;
        }
        return false;
    }

}
