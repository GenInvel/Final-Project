<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->get('view', 'active'); // 'active' or 'archived'
        
        if ($view === 'archived') {
            // Show archived staff
            $query = Staff::archived()->orderBy('archived_at', 'desc');
            
            // Search by name
            if ($request->has('search') && $request->search != '') {
                $query->where('full_name', 'like', '%' . $request->search . '%');
            }
            
            $staff = $query->paginate(15)->appends(['search' => $request->search, 'view' => 'archived']);
        } else {
            // Show active staff - Editorial Board first, then others
            $editorialQuery = Staff::active()
                ->editorialBoard()
                ->orderByRaw("FIELD(position, 
                    'Editor-In-Chief',
                    'Associate Editor for Internal',
                    'Associate Editor for External',
                    'Managing Editor',
                    'Assistant Managing Editor',
                    'Circulation Manager',
                    'Copy Editor',
                    'Art Editor',
                    'Layout Editor'
                )");
            
            $otherQuery = Staff::active()
                ->whereNotIn('position', [
                    'Editor-In-Chief',
                    'Associate Editor for Internal',
                    'Associate Editor for External',
                    'Managing Editor',
                    'Assistant Managing Editor',
                    'Circulation Manager',
                    'Copy Editor',
                    'Art Editor',
                    'Layout Editor'
                ])
                ->orderBy('position')
                ->orderBy('full_name');
            
            // Search by name
            if ($request->has('search') && $request->search != '') {
                $editorialQuery->where('full_name', 'like', '%' . $request->search . '%');
                $otherQuery->where('full_name', 'like', '%' . $request->search . '%');
            }
            
            $editorialStaff = $editorialQuery->get();
            $otherStaff = $otherQuery->get();
            
            $staff = $editorialStaff->concat($otherStaff);
        }
        
        return view('admin.staff.index', compact('staff', 'view'));
    }

    public function create()
    {
        $recentStaff = Staff::active()->latest()->take(5)->get();
        return view('admin.staff.create', compact('recentStaff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,cspc_email|regex:/^[a-zA-Z0-9._%+-]+@my\.cspc\.edu\.ph$/',
            'position' => 'required|string|max:100',
            'program' => 'required|string|max:100',
            'year_section' => 'required|string|max:10',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
        ], [
            'email.regex' => 'Email must be a valid CSPC email address (@my.cspc.edu.ph)',
            'email.unique' => 'This email is already registered',
        ]);

        $data = [
            'full_name' => $validated['name'],
            'cspc_email' => $validated['email'],
            'position' => $validated['position'],
            'program' => $validated['program'],
            'year_section' => $validated['year_section'],
            'is_active' => true,
            'status' => 'active',
        ];

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('staff-pictures', 'public');
            $data['photo'] = $picturePath;
        }

        Staff::create($data);

        return redirect()->route('admin.staff.create')
            ->with('success', 'Staff member added successfully!');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@my\.cspc\.edu\.ph$/|unique:staff,cspc_email,' . $staff->id,
            'position' => 'required|string|max:100',
            'program' => 'required|string|max:100',
            'year_section' => 'required|string|max:10',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
        ], [
            'email.regex' => 'Email must be a valid CSPC email address (@my.cspc.edu.ph)',
        ]);

        $data = [
            'full_name' => $validated['name'],
            'cspc_email' => $validated['email'],
            'position' => $validated['position'],
            'program' => $validated['program'],
            'year_section' => $validated['year_section'],
        ];

        if ($request->hasFile('picture')) {
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $picturePath = $request->file('picture')->store('staff-pictures', 'public');
            $data['photo'] = $picturePath;
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member updated successfully!');
    }

    public function archive(Staff $staff)
    {
        $staff->archive();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member archived successfully!');
    }

    public function unarchive(Staff $staff)
    {
        $staff->unarchive();

        return redirect()->route('admin.staff.index', ['view' => 'archived'])
            ->with('success', 'Staff member restored successfully!');
    }

    public function destroy(Staff $staff)
    {
        // Soft delete (only for permanently removing)
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member removed successfully!');
    }
}
