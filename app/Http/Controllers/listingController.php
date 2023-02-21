<?php

namespace App\Http\Controllers;

use App\Models\listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class listingController extends Controller
{
    public function addListing(Request $request){

        // if (Auth::check()) {
            $listing = new listings();

            $listing->position = $request->position;
            $listing->requirements = $request->requirements;
            $listing->tasks = $request->tasks;
            $listing->benefits = $request->benefits;
            $listing->name = $request->name;
            $listing->logo = $request->logo;
            $listing->salary = $request->salary;
    
            $res = $listing ->save();
    
            if ($res) {
                return response(
                    [
                    'success' =>true,
                    'message'=>'Listing added successfully',
                    
                    
                ],200);
            } else {
                return response(
                    [
                    'success' =>false,
                    'message'=>'Listing add failed',
                ],201);
            }
        // }
       

        return response(
            [
            'success' =>false,
            'message'=>'Listing add failed',
            
        ],401);
    }

    public function getListing(){
        // if(Auth::check()){
            $jobs = listings::all();

            return response(
                [
                'success' =>true,
                'message'=>'Data Fetch success',
                'listings' => $jobs,
            ],200);
        // } else {
            // return response(
            //     [
            //     'success' =>false,
            //     'message'=>'Data Fetch Failed',
            // ],201);
        // }

        return response(
            [
            'success' =>false,
            'message'=>'Listing add failed',
            
        ],401);
    }

    public function deleteListing($id){
        
        if(Auth::check()){
            
            $listing= listings::find($id);
            
            $res = $listing->delete();

            if($res){
                return response(
                    [
                    'success' =>true,
                    'message'=>'listing deleted successfully',
                ],200);
            } else {
                return response(
                    [
                    'success' =>false,
                    'message'=>'listing delete failed',
                ],201);
            }
        }
    }
}