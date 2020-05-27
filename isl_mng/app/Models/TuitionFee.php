<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TuitionFee
 *
 * @property $id
 * @property $course_id
 * @property $study_type_id
 * @property $fee
 * @property $created_at
 * @property $updated_at
 *
 * @property CourseStudent[] $courseStudents
 * @property Course $course
 * @property StudyType $studyType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TuitionFee extends Model
{
    
    static $rules = [
		'course_id' => 'required',
		'study_type_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id','study_type_id','fee'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseStudents()
    {
        return $this->hasMany('App\Models\CourseStudent', 'tuition_fees_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'course_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studyType()
    {
        return $this->hasOne('App\Models\StudyType', 'id', 'study_type_id');
    }
    

}
