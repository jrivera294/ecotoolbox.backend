<?php

class punto extends Eloquent {

	protected $table = 'puntos';

    protected $fillable = array('lat','lng','nombre','categoria','descripcion','foto',
                                'user_id',);
    public $errors;

    public function isValid($data)
    {
        $rules = array(
            'lat' => 'required',
            'lng' => 'required',
            'nombre'  => 'required|max:50',
            'categoria'  => 'required|numeric|max:2',
            'descripcion' => 'required|max:500',
            'foto'  => 'url|max:255',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public static function getNearbyPoints($lat,$lng,$radius){
        $results = DB::select( DB::raw("SELECT id,categoria,lat,lng,
        ( 6371 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance
        FROM puntos
        WHERE puntos.aprobado = 1
        HAVING distance < '$radius'
        ORDER BY distance"));

        return $results;
    }
}
