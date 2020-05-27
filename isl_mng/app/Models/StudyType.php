<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudyType
 *
 * @property $id
 * @property $type_name
 * @property $created_at
 * @property $updated_at
 *
 * @property TuitionFee[] $tuitionFees
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StudyType extends Model
{
    
    static $rules = [
		'type_name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type_name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tuitionFees()
    {
        return $this->hasMany('App\Models\TuitionFee', 'study_type_id', 'id');
    }
    

}
