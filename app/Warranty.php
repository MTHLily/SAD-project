<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = [ 
    	'brand_id',
		'purchase_date',
		'location',
		'receipt_url',
		'serial_no',
		'warranty_life',
		'notes',
		'status', 
	];

	protected $dates = [ 'purchase_date', 'warranty_life',];

	public function purchase_date_cast(){
		return $this->purchase_date->format('Y-m-d');
	}

	public function brand(){
		return $this->belongsTo( 'App\Brand' );
	}

	public function component(){
		return $this->hasMany( 'App\Component' );
	}
	
	public function computer(){
		return $this->hasMany( 'App\Computer' );
	}

	public function peripheral(){
		return $this->hasMany('App\Peripheral');
	}

	public function products(){
		return $this->component->merge( $this->peripheral )->merge($this->computer);
	}

	public function type(){

		if($this->computer != null && $this->component != null && $this->peripheral != null  )
			return "Mixed";

		if( $this->computer != null )
			return "Computer";

		if( $this->component != null )
			return "Component";

		if( $this->peripheral != null )
			return "Peripheral";

		return "None Assigned";
	}

}
