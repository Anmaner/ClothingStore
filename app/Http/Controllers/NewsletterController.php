<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
	public function subscribe(Request $request, Newsletter $newsletter)
	{
		if(!$newsletter->where('email', $request->all()['email'])->count() > 0) {
			$newsletter->create([
				'email' => $request->all()['email']
			]);
		}

		return redirect()->back();
	}
}
