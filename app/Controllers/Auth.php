<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Auth;

class Auth {
    public function login($email, $password) {
        $user = User::where('email', $email)->first();
        if ($user && password_verify($password, $user->password)) {
            Auth::login($user);
            return ['status' => 'success', 'user' => $user];
        }
        return ['status' => 'error', 'message' => 'Invalid credentials.'];
    }

    public function logout() {
        Auth::logout();
        return ['status' => 'success', 'message' => 'Logged out successfully.'];
    }

    public function register($data) {
        $user = new User();
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->save();
        return ['status' => 'success', 'user' => $user];
    }
}