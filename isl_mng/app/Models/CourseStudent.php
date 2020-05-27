<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseStudent
 *
 * @property $id
 * @property $students_id
 * @property $tuition_fees_id
 *
 * @property Student $student
 * @property TuitionFee $tuitionFee
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CourseStudent extends Model
{
    
    static $rules = [
		'students_id' => 'required',
		'tuition_fees_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['students_id','tuition_fees_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'students_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tuitionFee()
    {
        return $this->hasOne('App\Models\TuitionFee', 'id', 'tuition_fees_id');
    }
    

}
