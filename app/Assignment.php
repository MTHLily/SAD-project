<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'computer_id',
        'peripheral_setup_id',
    ];
    
    public function employee(){
        return $this->belongsTo('App\Employee');
    }
    public function computer(){
        return $this->belongsTo('App\Computer');
    }
    public function peripherals(){
        return $this->hasMany( 'App\Peripheral' );
    }
    public function clearPeripherals(){
        foreach( $this->peripherals as $peripheral ){
            $peripheral->assignment_id = null;
            $peripheral->status = "Available";
            $peripheral->save();
        }
    }
}
