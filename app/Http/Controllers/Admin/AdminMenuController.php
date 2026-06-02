<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    /**
     * Display all menu items for enabling/disabling and renaming.
     */
    public function index()
    {
        $menus = Menu::orderBy('sort_order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Update the menu items configuration.
     */
    public function update(Request $request)
    {
        $request->validate([
            'menu' => 'required|array',
            'menu.*.id' => 'required|exists:menus,id',
            'menu.*.label' => 'required|string|max:100',
            'menu.*.sort_order' => 'required|integer',
        ]);

        $enabledIds = $request->input('enabled_menus', []);

        foreach ($request->input('menu') as $menuData) {
            $menu = Menu::find($menuData['id']);
            if ($menu) {
                $menu->update([
                    'label' => $menuData['label'],
                    'sort_order' => $menuData['sort_order'],
                    'is_enabled' => in_array($menuData['id'], $enabledIds),
                ]);
            }
        }

        return redirect()->route('admin.menus.index')->with('success', 'Navigation menu configurations updated.');
    }
}
