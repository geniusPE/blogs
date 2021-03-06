<?php
/**
 * User: dingman<app@youxiake.com>
 * Date: 2018/8/31
 * Time: 下午4:59
 */

namespace App\Http\Controllers;


use App\Student;
use Illuminate\Support\Facades\DB;

class backendController extends Controller
{
    public function index()
    {
        $data = $this->user;
        return view('backend.index');
    }

    public function welcome()
    {
        $data = [
            'laravel_ver' => env('LARAVEL_VER'),
            'php_ver' => phpversion(),
            'server_ip' => $_SERVER['SERVER_ADDR'],
            'php_run_method' => php_sapi_name()
        ];
        $student_mdl = new Student();
        $data['member_count'] = $student_mdl->count();
        $info = DB::selectOne("select version() as v;");
        if ($info != null) {
            $data ['mysql_ver'] = $info->v;
        }
        return view('backend.welcome', $data);
    }
    public function logout()
    {
        \Session::forget('user');
        return view('login.index');
    }
}
