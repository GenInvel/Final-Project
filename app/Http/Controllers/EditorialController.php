<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function index()
    {
        // Get editorial board members
        $editorialBoard = Staff::whereIn('position', [
            'Editor-In-Chief',
            'Associate Editor for Internal',
            'Associate Editor for External',
            'Managing Editor',
            'Assistant Managing Editor',
            'Circulation Manager',
            'Copy Editor',
            'Art Editor',
            'Layout Editor'
        ])->get();

        // Get other staff members grouped by category
        $newsStaff = Staff::where('position', 'LIKE', '%News%')->get();
        $opinionStaff = Staff::where('position', 'LIKE', '%Opinion%')->get();
        $devcomStaff = Staff::where('position', 'LIKE', '%DevCom%')->get();
        $featureStaff = Staff::where('position', 'LIKE', '%Feature%')->get();
        $literaryStaff = Staff::where('position', 'LIKE', '%Literary%')->get();
        $scitechStaff = Staff::where('position', 'LIKE', '%Sci&Tech%')->get();
        $sportsStaff = Staff::where('position', 'LIKE', '%Sports%')->get();

        // Get other positions
        $otherStaff = Staff::whereIn('position', [
            'Copyreader',
            'Layout Artist',
            'Editorial Cartoonist',
            'Graphic Artist',
            'Photojournalist',
            'News Presenter',
            'Videographer',
            'Video Editor',
            'Technical Director',
            'Editorial Assistant'
        ])->get();

        return view('editorials', compact(
            'editorialBoard',
            'newsStaff',
            'opinionStaff',
            'devcomStaff',
            'featureStaff',
            'literaryStaff',
            'scitechStaff',
            'sportsStaff',
            'otherStaff'
        ));
    }
}
