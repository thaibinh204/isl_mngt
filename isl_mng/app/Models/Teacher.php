<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Teacher as Authenticatable;



/**
 * Class Teacher
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $birthday
 * @property $email
 * @property $password
 * @property $created_at
 * @property $updated_at
 *
 * @property Experience[] $experiences
 * @property Schedule[] $schedules
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Teacher extends Model 
{
    
    static $rules = [
		'first_name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    

    protected $fillable = ['first_name','last_name','birthday','email','password'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experiences()
    {
        return $this->hasMany('App\Models\Experience', 'teacher_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'teacher_id', 'id');
    }
    

}
