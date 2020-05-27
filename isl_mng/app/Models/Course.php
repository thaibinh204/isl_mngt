<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 *
 * @property $id
 * @property $name
 * @property $start_date
 * @property $end_date
 * @property $estimate
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property TuitionFee[] $tuitionFees
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Course extends Model
{
    
    static $rules = [
		'name' => 'required',
		'start_date' => 'required',
		'estimate' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','start_date','end_date','estimate','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tuitionFees()
    {
        return $this->hasMany('App\Models\TuitionFee', 'course_id', 'id');
    }
    

}
