<?php

namespace App\Http\Middleware;

use App\Domains\User\Models\User;
use App\Domains\User\Services\RetrieveCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string,mixed>
     */
    public function share(Request $request): array
    {
        $is_inertia_request = $request->header('X-Inertia');

        $share = parent::share($request);

        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            $share['sidebar_fullname'] = $user->fullname_first;
            $share['topbar_companies_list'] = RetrieveCompanies::handle($user);
        }

        return $share;
    }
}
