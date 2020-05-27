<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $password
 * @property $birthday
 * @property $created_at
 * @property $updated_at
 *
 * @property CourseStudent[] $courseStudents
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Student extends Model
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
    protected $fillable = ['first_name','last_name','email','birthday'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseStudents()
    {
        return $this->hasMany('App\Models\CourseStudent', 'students_id', 'id');
    }
    

}
