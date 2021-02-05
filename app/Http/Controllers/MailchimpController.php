<?php


namespace App\Http\Controllers;
use App\Models\UsersToSend;
use Illuminate\Http\Request;


class MailchimpController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users_to_send|email',
        ]);


        UsersToSend::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'subscribed' => 0,
        ]);

        return [
          'status' => 'ok'
        ];
    }
}
