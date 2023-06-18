<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Create(){
        return view('register_form');
    }

    public function Store(){
        //validate
        $required = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'password'   => 'required|password'
        );
        $validator = Validator::make(Input::all(), $required);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('sharks/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = new user;
            $user->name       = Input::get('name');
            $user->email      = Input::get('email');
            $user->password = Input::get('password');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully created account!');
            return Redirect::to('user_page');
        }
    }

    

    public function Index(){
         // get the user
         $user = user::find($id);

         // show the view and pass the user to it
         return View::make('user_page')
             ->with('user', $user);
    }

    public function Edit($id){
      // get the user
      $user = user::find($id);

      // show the edit form and pass the user
      return View::make('user.edit')
          ->with('user', $user);
    }

    public function Update($id){
        $required = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'password' => 'required|password'
        );
        $validator = Validator::make(Input::all(), $required);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(' ' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = shark::find($id);
            $user->name       = Input::get('name');
            $user->email      = Input::get('email');
            $user->password = Input::get('password');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated account!');
            return Redirect::to('users');
        }

    }

    public function Delete($id){
        // delete
        $user = user::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the account!');
        return Redirect::to('users');
    }




}
