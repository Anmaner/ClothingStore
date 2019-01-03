<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
	public function contact()
	{
		return view('other.contact');
	}

	public function send(Request $request, Message $message) 
	{
		$message->create([
			'email' => $request->all()['email'],
			'text' => $request->all()['text']
		]);

		return redirect()->back();
	}
}
