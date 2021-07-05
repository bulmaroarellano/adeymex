<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
<<<<<<< Updated upstream
=======
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Lab404\AuthChecker\Models\HasLoginsAndDevices;
 use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\Searchable;

class User extends Authenticatable
>>>>>>> Stashed changes

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;
    use Searchable;
<<<<<<< Updated upstream
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];
=======
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
>>>>>>> Stashed changes

    protected $searchableFields = ['*'];

<<<<<<< Updated upstream
    protected $hidden = ['password', 'remember_token'];
=======
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $searchableFields = ['*'];
>>>>>>> Stashed changes

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
