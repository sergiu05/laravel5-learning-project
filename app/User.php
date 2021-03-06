<?php

namespace Unicorn;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * Is the current User admin?
     *
     * @return boolean
     */
    public function isAdmin() {

        return (1 == $this->is_admin);

    }

    /**
     * Is the current user non-admin
     *
     * @return boolean
     */
    public function isNotAdmin() {

        return (1 != $this->is_admin);

    }

    /**
     * Get the user's orders
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders() {

        return $this->hasMany('Unicorn\Order');

    }
}
