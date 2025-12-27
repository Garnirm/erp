<?php

namespace App\Domains\User\Models;

use App\Domains\I18n\Models\I18nLang;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

/**
 * @property int $id
 * @property int $account_id
 * @property int $i18n_country_id
 * @property int $i18n_lang_id
 * @property int $i18n_timezone_id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $fullname_first
 * @property string $fullname_last
 * @property string $avatar
 * @property string $date_format
 * @property bool $active
 * @property null|Carbon $enabled_at
 * @property Carbon $updated_at
 * 
 * @property-read I18nLang $lang
 */
class User extends Authenticatable
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'user';

    protected $casts = [
        'enabled_at' => 'datetime:Y-m-d',
    ];

    /**
     * @param Builder<User> $query
     * @return Builder<User>
     */
    #[Scope]
    public function account(Builder $query, int $account_id): Builder
    {
        return $query->where('account_id', $account_id);
    }

    /**
     * @return BelongsTo<I18nLang,$this>
     */
    public function lang(): BelongsTo
    {
        return $this->belongsTo(I18nLang::class, 'i18n_lang_id');
    }

    /*public function loginUsingCredentials(array $credentials)
    {
        $user = User::query()->where('email', $credentials['email'])->account($credentials['account_id'])->first();

        if (is_null($user) || !Hash::check($credentials['password'], $user->password)) {
            return;
        }

        //$this->loadUser($user);

        //$this->session_id = base64_encode(now().'|'.$user->id.'|'.rand(100, 999));

        // $session = new UserSession();
        // $session->user_id = $user->id;
        // $session->session_id = $this->session_id;
        // $session->save();

        return $this;
    }*/

    /*private function loadUser(User $user): void
    {
        $this->id = $user->id;
        $this->account_id = $user->account_id;
        $this->company_id = $user->company_id;
        $this->email = $user->email;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->avatar = $user->avatar;
        $this->token_enable = $user->token_enable;
        $this->active = $user->active;
        $this->enabled_at = $user->enabled_at;
        $this->i18n_country_id = $user->i18n_country_id;
        $this->lang = $user->lang;
        $this->timezone = $user->timezone;
        $this->date_format = $user->date_format;
        $this->role = $user->role;

        Cache::put('auth_'.$this->session_id.'_last_activity', now());
    }*/
}
