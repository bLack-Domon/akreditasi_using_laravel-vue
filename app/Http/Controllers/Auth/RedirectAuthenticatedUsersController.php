<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->status_akun == 'admin' && auth()->user()->status_aktif == 'a') {
            return redirect('/Dashboard');
        }
        elseif(auth()->user()->status_akun == 'kaprodi' && auth()->user()->status_aktif == 'a'){
            return redirect('/kaprodiDashboard');
        }
        elseif(auth()->user()->status_akun == 'lembaga' && auth()->user()->status_aktif == 'a'){
            return redirect('/lembagaDashboard');
        }
        else{
            return auth()->logout();
        }
    }
}
