<?php

namespace App\Domains\User\Services;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RetrieveCompanies
{
    /**
     * @return list<array{id:int,name:string,active:bool}>
     */
    public static function handle(User $user): array
    {
        if (Cache::has('companies_list_user_'.$user->id)) {
            /** @var list<array{id:int,name:string,active:bool}> $companies_list */
            $companies_list = Cache::get('companies_list_user_'.$user->id);

            return $companies_list;
        }

        $companies_list = DB::table('company', 'c')
            ->leftJoin('user_company as uc', 'uc.company_id', 'c.id')
            ->where('uc.user_id', $user->id)
            ->select('c.id', 'c.name', 'uc.active')
            ->get();

        /** @var non-empty-string $encode_list */
        $encode_list = json_encode($companies_list);

        /** @var list<array{id:int,name:string,active:bool}> $decode_list */
        $decode_list = json_decode($encode_list, true);

        Cache::put('companies_list_user_'.$user->id, $decode_list);

        return $decode_list;
    }
}