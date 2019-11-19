<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

use Tymon\JWTAuth\Facades\JWTAuth;
use Cookie;
use App\Employee;

class PostLoginController extends Controller
{
    public function getLogin()
    {
        session(['link' => url()->previous()]);

        $username = Cookie::get('usernamethm');
        if(is_null($username)){
            return view('auth.login');
        } else {
            return redirect ('admin/request/myrequestedlist/'.$username);
        }
    }
    public function login(Request $request)
    {
        
    	// echo "1234";
    	$username =  $request->username;
    	$password = $request->password;
        // ======================== Giả lập
        if($password == "1") {
           
            $user =  Employee::where('username', $username)->first();
            // echo "<pre>";
            // var_dump($user);
            // exit();

            Cookie::queue('usernamethm', $username, 360);
            Cookie::queue('fullnamethm', $user['name'], 360);
            return redirect(session('link'));
            // return redirect('admin/request/myrequestedlist/'.$username);
        }
        // ======================== Giả lập
    	// echo $email.$password;
    	$login = $this->checkLogin($username, $password);
    	


    	if(isset($login->error))
    	{
            return redirect('/')->with('notify', 'Bạn vui lòng kiểm tra lại Username và Password');
    	}else {
    		$token =  $login->access_token;
    		$jwt666 = new JWT666;
    		$payload_data = $jwt666->decode($token, '', false);
    		
    		$username = $payload_data->username;
            $fullname = $payload_data->fullname;
           
            Cookie::queue('usernamethm', $username, 360);
            Cookie::queue('fullnamethm', $fullname, 360);
            return redirect('admin/request/myrequestedlist/'.$username);
    	}


    	//return redirect('admin/request/list');
    }
    public function logout()
    {   


        // $cookie = Cookie::forget('usernamethm');
        Cookie::queue(Cookie::forget('usernamethm'));
        Cookie::queue(Cookie::forget('fullnamethm'));
        return redirect('/');
        
    }

    public function checkLogin($username, $password) {
    	$service_url = 'https://auth.tanhoangminh.com.vn/connect/token';
		$curl = curl_init($service_url);
		$curl_post_data = array(
		        'client_id' => 'client.QuanLyYeuCau',
		        'client_secret' => 'quanlyyeuCauThm2019',
		        'grant_type' => 'password',
		        'username' => $username,
		        'password' => $password,
		);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$decoded = json_decode($curl_response);
		return $decoded;
    }
    
}

class JWT666
{
    /**
     * @param string      $jwt    The JWT
     * @param string|null $key    The secret key
     * @param bool        $verify Don't skip verification process 
     *
     * @return object The JWT's payload as a PHP object
     */
    public static function decode($jwt, $key = null, $verify = true)
    {
        $tks = explode('.', $jwt);
        if (count($tks) != 3) {
            throw new UnexpectedValueException('Wrong number of segments');
        }
        list($headb64, $payloadb64, $cryptob64) = $tks;
        if (null === ($header = JWT::jsonDecode(JWT::urlsafeB64Decode($headb64)))
        ) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        if (null === $payload = JWT::jsonDecode(JWT::urlsafeB64Decode($payloadb64))
        ) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        $sig = JWT::urlsafeB64Decode($cryptob64);
        if ($verify) {
            if (empty($header->alg)) {
                throw new DomainException('Empty algorithm');
            }
            if ($sig != JWT::sign("$headb64.$payloadb64", $key, $header->alg)) {
                throw new UnexpectedValueException('Signature verification failed');
            }
        }
        return $payload;
    }
    /**
     * @param object|array $payload PHP object or array
     * @param string       $key     The secret key
     * @param string       $algo    The signing algorithm
     *
     * @return string A JWT
     */
    public static function encode($payload, $key, $algo = 'HS256')
    {
        $header = array('typ' => 'JWT', 'alg' => $algo);
        $segments = array();
        $segments[] = JWT::urlsafeB64Encode(JWT::jsonEncode($header));
        $segments[] = JWT::urlsafeB64Encode(JWT::jsonEncode($payload));
        $signing_input = implode('.', $segments);
        $signature = JWT::sign($signing_input, $key, $algo);
        $segments[] = JWT::urlsafeB64Encode($signature);
        return implode('.', $segments);
    }
    /**
     * @param string $msg    The message to sign
     * @param string $key    The secret key
     * @param string $method The signing algorithm
     *
     * @return string An encrypted message
     */
    public static function sign($msg, $key, $method = 'HS256')
    {
        $methods = array(
            'HS256' => 'sha256',
            'HS384' => 'sha384',
            'HS512' => 'sha512',
        );
        if (empty($methods[$method])) {
            throw new DomainException('Algorithm not supported');
        }
        return hash_hmac($methods[$method], $msg, $key, true);
    }
    /**
     * @param string $input JSON string
     *
     * @return object Object representation of JSON string
     */
    public static function jsonDecode($input)
    {
        $obj = json_decode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            JWT::handleJsonError($errno);
        }
        else if ($obj === null && $input !== 'null') {
            throw new DomainException('Null result with non-null input');
        }
        return $obj;
    }
    /**
     * @param object|array $input A PHP object or array
     *
     * @return string JSON representation of the PHP object or array
     */
    public static function jsonEncode($input)
    {
        $json = json_encode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            JWT::handleJsonError($errno);
        }
        else if ($json === 'null' && $input !== null) {
            throw new DomainException('Null result with non-null input');
        }
        return $json;
    }
    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }
    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
    /**
     * @param int $errno An error number from json_last_error()
     *
     * @return void
     */
    private static function handleJsonError($errno)
    {
        $messages = array(
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON'
        );
        throw new DomainException(isset($messages[$errno])
            ? $messages[$errno]
            : 'Unknown JSON error: ' . $errno
        );
    }
}