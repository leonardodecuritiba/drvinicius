<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	use EntrustUserTrait; // add this trait to your user model
	protected $table = 'users';
	protected $primaryKey = 'idusers';
	protected $fillable = [
		'email',
		'password'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	// ******************** BELONGSTO ****************************
	// Relação profissional - 1 <-> 1 - user.
	public function profissional() {
		return $this->hasOne( 'App\Profissional', 'idusers' );
	}

	public function nome() {
		return $this->profissional->nome;
	}

	public function is( $role = null ) {
		if ( $role == null ) {
			$roles = Role::all();
			foreach ( $roles as $role ) {
				if ( $this->hasRole( $role->name ) ) {
					return ucfirst( $role->name );
				}
			}
		}
	}


}
