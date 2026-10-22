<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ChangeRoleRequest;
use App\Services\RoleManagementService;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function update( 
        ChangeRoleRequest $request, 
        User $user, 
        RoleManagementService $service 
    ): RedirectResponse { 
        $data = $request->validated(); 
        $service->changeRole($request->user(), $user, $data['role']);

        return back()->with('status', 'Role diperbarui.'); 
    } 
}