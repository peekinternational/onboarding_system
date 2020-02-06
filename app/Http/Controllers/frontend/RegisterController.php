<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // public function register(Request $request)
    // {
    //   return view('frontend.register');
    // }

    public function register(Request $request){
       
        if($request->session()->has('User')){
			return redirect('dashboard');
		}

        if($request->isMethod('post')){
      // dd($request->all());
            
        $mobile = str_replace(' ', '', $request->input('mobile'));
           // dd($mobile);
			$this->validate($request,[
				'email' => 'required|email|unique:users,email',
				'sur_name' => 'required|min:2|max:32',
				'mobile' => 'required',
				'f_name' => 'required|min:1|max:50',
                'password' => 'required|min:5|max:50'

			],[

				'email.unique' => 'Email must be unique',
				'email.required' => 'Enter Email',
				'f_name.required' =>'Enter First Name',
				'sur_name.required' => 'Enter Last Name',
				'password.required' => 'Enter password',
				'mobile.required' => 'Enter Phone Number',
				'mobile.digits_between' => 'Phone Number must be contain 10,17 digits',
            ]);
            $string = rand(1, 1000000);
            
            $input['f_name'] = trim($request->input('f_name'));
            $input['sur_name'] = trim($request->input('sur_name'));
            $input['email'] = trim($request->input('email'));
           
            $input['password'] = md5(trim($request->input('password')));
            $input['mobile'] = trim($mobile);
            $input['local'] = trim($request->input('local'));
            $input['location'] = trim($request->input('location'));
            $input['choice_number'] = trim($request->input('choice_number'));
            $input['company_name'] = trim($request->input('company_name'));
            $input['status'] ='inactive';
            $input['verify_code'] =$string;

            $sms_to=$input['mobile'];
			//dd($number);
             $user='APIR95FJDOI1K';
             $pass='APIR95FJDOI1KR95FJ';
             $sms_from='PLE';
            // $sms_to='6581234567';
             $sms_msg='Your Verification Code is '.$string;
                $query_string = "api.aspx?apiusername=".$user."&apipassword=".$pass;
                $query_string .= "&senderid=".rawurlencode($sms_from)."&mobileno=".rawurlencode($sms_to);
                $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
                $url = "http://gateway80.onewaysms.sg/api2.aspx/".$query_string;       
                $fd = @implode ('', file ($url));      
                if ($fd)  
                {                       
                    if ($fd > 0) {
                    Print("MT ID : " . $fd);
                    $ok = "success";
                    }        
                    else {
                    print("Please refer to API on Error : " . $fd);
                    $ok = "fail";
                    }
                }           
                    else      
                    {                       
                                // no contact with gateway                      
                                $ok = "fail";       
                    }           
                  //  dd($ok); 
     
      if($ok == "success"){
        //   / dd($result);
           $userId = DB::table('users')->insertGetId($input);
            setcookie('cc_data', $userId, time() + (86400 * 30), "/");
            $fNotice = 'Please check your mobile for verification code';
			$request->session()->flash('fNotice',$fNotice);
            return redirect('verification');
            }
        }

		return view('frontend.register');
    }


 public function accountVerify(Request $request){

        if($request->isMethod('post')){
            $code=trim($request->input('verify_code'));
            // dd($code);
        $verify=DB::table('users')->where('verify_code','=', $code)->update(['status'=> 'active']);
      
        if($verify == 1){
            $verifys = 'Your account verify successfully';
            $request->session()->flash('verify',$verifys);
            return redirect('pricing-plan');
        }

        }
		return view('frontend.verification');
	}
    
public function accountLogin(Request $request){
        if($request->session()->has('User')){
			return redirect('dashboard');
		}
		$next = $request->input('next');
		if($request->isMethod('post')){

            $email = $request->input('email');
            $password = md5(trim($request->input('password')));
            // /dd($password);

			$user = $this->doLogin($email,$password);
            //dd($user);
			if($user == 'invalid'){
				$request->session()->flash('loginAlert', 'Invalid Email & Password');
				if($next != ''){
					return redirect('login?next='.$next);
				}else{
					return redirect('login');
				}
			}
			else{

				$request->session()->put('User', $user);
				setcookie('cc_data', $user->user_id, time() + (86400 * 30), "/");

				if($next != ''){
					return redirect($next);
				}else{
					return redirect('/dashboard');
				}
			}
   

		}


		return view('frontend.login');
    }

    public function doLogin($email,$password){
        /* do login */
        //dd($password);
        $user = DB::table('users')->where('email','=',$email)->where('password','=',$password)->where('status','active')->first();
       
        if(empty($user)){
            return 'invalid';
        }else{
            return $user;
        }
		/* end */
	}

     public function logout(Request $request){
         
               Session::flush();
               return redirect('login');
           
       }
   
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
