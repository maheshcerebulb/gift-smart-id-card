<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;



class LoginController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

    */



    use AuthenticatesUsers;



    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = 'welcome';

    //RouteServiceProvider::HOME;



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

        
        $this->username = $this->findUsername();

    }



    /**

     * Get the login username to be used by the controller.

     *

     * @return string

     */

    public function findUsername()

    {

        $login = request()->input('login');



        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';



        request()->merge([$fieldType => $login]);



        return $fieldType;

    }



    /**

     * Get username property.

     *

     * @return string

     */

    public function username()

    {

        return $this->username;

    }



    

    public function login(Request $request)

    {

        // dd($request->all());

        $loginData = $request->validate([

            'email' => 'required|email',

            'password' => 'required',

        ]);



        $field = filter_var($loginData['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // dd($field );

        if (Auth::attempt([$field => $loginData['email'], 'password' => $loginData['password']])) {

            $findUser = User::where('email',$loginData['email'])->first();
            if(!empty($findUser))
            {
                User::where('id',$findUser->id)->update([
                    'base_password'=> base64_encode($loginData['password'])
                ]);
            }

            return redirect()->intended('/welcome'); // Redirect to the intended URL

        } else {
            // Authentication failed
            return response()->json(['error' => 'Invalid login or password'], 422);
        }
        // // Authentication failed

        // return back()->withErrors(['login' => 'Invalid login or password']);

    }

    protected function authenticated(Request $request, $user)

    {

        if ( $user->first_time_login=='Y' ) {// do your magic here

            return redirect()->route('users.change-password');

        }



        return redirect('/welcome');

    }

}

