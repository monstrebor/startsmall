<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\{User, UserInfo};
use App\Http\Requests\UserInfoRequest;
use Illuminate\Support\Facades\{Auth, log, Mail};


class AccountController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view("account.index", compact('user'));
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::findOrFail($request->id);
        $user->email = $request->email;

        try {
            $user->save();

            Mail::send('mails.email_updated', [
                'details' => [
                    'name' => $user->name,
                    'new_email' => $user->email,
                ]
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your email has been updated');
            });

            return back()->with('success', 'Email updated successfully. A confirmation was sent to the new address.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update email. Error: ' . $e->getMessage());
        }
    }

    public function update(UserInfoRequest $request)
    {
        $user_id = Auth::id();

        try {
            $data = $request->safe()->except('user_id');

            if (isset($data['full_name'])) {
                $data['full_name'] = strtoupper($data['full_name']);
            }

            UserInfo::updateOrCreate(
                ['user_id' => $user_id],
                $data
            );

            return redirect()->back()->with('success', 'Customer information updated successfully.');
        } catch (\Exception $e) {
            Log::error('CustomerInfo update failed', [
                'user_id' => $user_id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while updating customer information.');
        }
    }
}
