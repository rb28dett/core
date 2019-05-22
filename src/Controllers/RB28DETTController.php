<?php

namespace RB28DETT\RB28DETT\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RB28DETTController extends Controller
{
    /**
     * Redirects the user to their default module.
     */
    public function index()
    {
        // Needs to change to the default user location.
        return redirect()->route('rb28dett::dashboard');
    }

    /**
     * Saves the last active menu.
     */
    public function saveMenuAction(Request $request)
    {
        $request->session()->flash('menu_action', $request->menu);
    }
}
