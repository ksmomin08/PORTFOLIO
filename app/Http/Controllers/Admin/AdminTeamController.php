<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('sort_order')->paginate(10);
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'linkedin' => 'nullable|url',
            'status' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        // Parameter name matches the route resource 'team'
        $teamMember = $team;
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $teamMember = $team;
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'linkedin' => 'nullable|url',
            'status' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('photo')) {
            if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
                Storage::disk('public')->delete($teamMember->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member details updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        $teamMember = $team;
        if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
            Storage::disk('public')->delete($teamMember->photo);
        }
        $teamMember->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member removed successfully.');
    }
}
