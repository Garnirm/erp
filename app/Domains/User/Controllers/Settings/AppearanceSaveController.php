<?php

namespace App\Domains\User\Controllers\Settings;

use App\Domains\User\Data\SettingsAppearanceSaveData;
use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppearanceSaveController extends Controller
{
    public function __invoke(SettingsAppearanceSaveData $data): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->i18n_country_id = $data->country->id;
        $user->i18n_lang_id = $data->lang->id;
        $user->i18n_timezone_id = $data->timezone->id;
        $user->date_format = $data->date_format;
        $user->save();

        Inertia::flash('success', 'Paramètres mis à jour avec succès !');

        return redirect('/user/settings/appearance');
    }
}