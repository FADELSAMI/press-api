<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function handleLogin(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('user');
        $password = $request->input('password');

        // Define the path to the CSV file
        $filePath = public_path('users.csv');

        // Save the username and hashed password to the CSV file
        $fileHandle = fopen($filePath, 'a');
        if ($fileHandle === false) {
            return back()->withErrors(['error' => 'Unable to open the file for writing.']);
        }

        fputcsv($fileHandle, [$username, bcrypt($password)]);
        fclose($fileHandle);

        return redirect('/login')->with('success', 'Login details saved successfully!');
    }
}