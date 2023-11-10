<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // ORM: Eloquent Methods
        $users = User::all(); // get all users
        // $users = User::find(1); // get user by id
        // $users = User::where('age', '>=', 30)->get();
        // $users = User::where('age', '>=', 30)->first();
        // $users = User::where('age', 35); // get user by age [age = 35]
        // $users = User::where('age', '>=', 30)->orderBy('age', 'desc')->limit(5, 10)->get(); // get user by age with compare params (<=, !=, like, === etc)
        // $users = User::where('age', '>=', 18)->where('zip_code', '123456'); // get with multiple conditions (chained methods).
        // $users = User::where('age', '>=', 30)->orWhere('zip_code', '123456'); // get with or cond.
        // return view('user.index', ["users" => $users]); // Op1


        // SQL SINGLE: DB Methods for SQL Raw
        $age = 21;
        // $users = DB::select('SELECT * FROM users'); // Select all users
        // $users = DB::select('SELECT * FROM users WHERE age = ?', [$age]); // With conditions (var)

        // Mix SQL DB & ORM: DB Methods for SQL Raw with ORM
        // $users = DB::table('users')->select('name', 'age')->get();

        // Returns
        return view('user.index', compact('users'));
    }

    public function create()
    {
        // Op 1
        $user = new User;
        $user->name = "John";
        $user->email = "John@example.com";
        $user->password = Hash::make('123456');
        $user->age = 21;
        $user->address = "Cr Testing";
        $user->zip_code = "123456";
        $user->save();

        // Op 2
        User::create([
            "name" => "Ralph",
            "email" => "Ralph@example.com",
            "password" => Hash::make('123456'),
            "age" => 35,
            "address" => "San Francisco",
            "zip_code" => "123456",
        ]);

        User::create([
            "name" => "Chris",
            "email" => "Chris@example.com",
            "password" => Hash::make('123456'),
            "age" => 43,
            "address" => "Sao Paulo",
            "zip_code" => "123456",
        ]);

        // Op 3
        DB::insert('INSERT INTO users (name, email, password, age, address, zip_code)
        VALUES (?, ?, ?, ?, ?, ?)', ['Juan', 'Juan3@example.com', '123456', 24, 'Santa Elena', '123456']);

        // Op 4
        DB::table('users')->insert(['name' => 'Josh', 'email' => 'Josh@example.com', 'password' => '123456', 'age' => 19, 'address' => 'Testing address', 'zip_code' => '123456']);

        return redirect()->route('user.index');
    }
}
