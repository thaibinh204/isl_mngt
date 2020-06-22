<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScheduleStatus
 *
 * @property $id
 * @property $schedule_id
 * @property $status
 * @property $remark
 *
 * @property Schedule $schedule
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ScheduleStatus extends Model
{

  protected $table = 'schedule_status';
    
    static $rules = [
		'schedule_id' => 'required',
		'status' => 'required',
		'remark' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['schedule_id','status','remark'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schedule()
    {
        return $this->hasOne('App\Models\Schedule', 'id', 'schedule_id');
    }
    

}
