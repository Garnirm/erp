<?php

namespace App\Domains\User\Controllers\Settings;

use App\Domains\User\Data\SettingsProfileSaveData;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileSaveController extends Controller
{
    public function __invoke(SettingsProfileSaveData $data): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->fullname_first = $user->firstname.' '.$user->lastname;
        $user->fullname_last = $user->lastname.' '.$user->firstname;
        $user->save();

        Inertia::flash('success', 'Paramètres mis à jour avec succès !');

        return redirect('/user/settings');
    }
}