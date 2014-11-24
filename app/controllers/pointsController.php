<?php

class pointsController extends BaseController {

	public function postPoints()
	{
        $nuevoPunto = new punto;

        $data = Input::all();

        if($nuevoPunto->isValid($data)){
            $nuevoPunto->lat = $data['lat'];
            $nuevoPunto->lng = $data['lng'];
            $nuevoPunto->nombre = $data['nombre'];
            $nuevoPunto->categoria = $data['categoria'];
            $nuevoPunto->descripcion = $data['descripcion'];
            $nuevoPunto->foto = $data['foto'];
            //$nuevoPunto->user_id = $data['user_id'];

            $nuevoPunto->save();

            return Response::json([
                'status' => 201
            ]);
        }else{
            return Response::json([
                'msg:' => $nuevoPunto->errors,
                'status' => 400
            ]);
        }
	}

    public function getPoints($id){
        $punto = punto::find($id);

        if($punto != null){
            return Response::json([
                'data' => $punto,
                'status' => 200
            ]);
        }else{
            return Response::json([
                'msg:' => 'Punto '.$id.' no encontrado',
                'status' => 404
            ]);
        }
    }

    public function getNearbyPoints($lat,$lng,$radius){
        $puntos = punto::getNearbyPoints($lat,$lng,$radius);

        if($puntos){
            return Response::json([
                'data' => $puntos,
                'status' => 200
            ]);
        }else{
            return Response::json([
                'msg:' => 'No hay puntos cercanos',
                'status' => 404
            ]);
        }
    }
}
