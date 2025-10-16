<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newpurchase;

class MailsendController extends Controller
{

    public function newpurchase(){
        $subject = 'My subject';
        $urls = ['Myurl1', 'myurl2'];
        $name = 'Test user';
        // ->from('gradestar@mail.com')
        mail::to('fake@mail.com')
        ->send(new Newpurchase($subject, $urls, $name));

        return view('welcome');
    }
}
