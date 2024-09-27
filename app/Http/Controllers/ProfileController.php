<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    public function assignRoleToUser($userId, $role)
{
    $user = User::find($userId);

    if (!$user) {
        return redirect()->back()->with('error', 'Utilisateur non trouvé.');
    }

    // Vérifiez si l'utilisateur a déjà un rôle
    if ($user->roles()->count() > 0) {
        // Supprimez tous les rôles de l'utilisateur
        $user->syncRoles([]); // Cela supprimera tous les rôles
    }

    // Assignez le nouveau rôle
    $user->assignRole($role); 

    return redirect()->back()->with('success', 'Rôle assigné avec succès.');
}


    public function removeRoleFromUser($userId, $role)
    {
        $user = User::find($userId);
        // Vérifier si l'utilisateur a bien le rôle avant de le retirer
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return redirect()->back()->with('success', "Le rôle $role a été retiré avec succès.");
        }

        return redirect()->back()->with('error', "Cet utilisateur n'a pas ce rôle.");
    }

    public function showUserRole($id)
{
    $user = User::find($id); // Récupérer l'utilisateur avec l'ID donné
    $roles = $user->getRoleNames(); // Récupère les noms des rôles assignés à l'utilisateur

    return view('user-role', compact('user', 'roles'));
}
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
