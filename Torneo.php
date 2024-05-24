<?php
class Torneo {
    private $partidos;
    private $premio;

    public function __construct($premio,$partidos) {
        $this->partidos = $partidos ? $partidos : [] ;
        $this->premio = $premio;
    }
    public function getPartidos(){
        return $this->partidos;
    }
    public function getPremio(){
        return $this->premio;
    }
    public function agregarPartido($partido) {
        $this->partidos[] = $partido;
    }
    /*Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la  clase Torneo el cual 
    recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un partido de futbol o basquetbol . 
    El método debe crear y retornar la instancia de la clase Partido que corresponda y almacenarla en la colección de partidos del Torneo. 
    Se debe chequear que los 2 equipos tengan la  misma categoría e igual cantidad de jugadores, caso contrario no podrá ser registrado 
    ese partido en el torneo.  
    */
    protected function leerColObj($arrayDeObjetos){
        $cadena = "";
            foreach($arrayDeObjetos as $objAnalizado){
                $cadena = $cadena . $objAnalizado ."\n";
            }
        return $cadena;
    }
    public function __toString()
    {
        $objpartidos = leerColObj($this->getPartidos());
        return "Partidos: ".$objpartidos."Premio ".$this->getPremio();
    }
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){
        $partido=true;
        if ($OBJEquipo1->getObjCategoria()->getDescripcion() != $OBJEquipo2->getObjCategoria()->getDescripcion() ) {
            $partido= null;
        }
        if ($OBJEquipo1->getCantJugadores() != $OBJEquipo2->getCantJugadores()) {
            $partido= null;
        }
        if($partido!=null&&$OBJEquipo1->getNombre()!=$OBJEquipo2->getNombre()){
            
            $idPartido = count($this->partidos) + 1;
            if ($tipoPartido == 'futbol') {
                //$idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2
                $partido = new PartidoFutbol($idPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0);
            } elseif ($tipoPartido == 'basquetbol') {
                
                $partido = new PartidoBaloncesto($idPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0,0);
            } else {
                $partido= null;
            }
                $this->agregarPartido($partido);
        }
        else{
            $partido=null;
        }
        return $partido;
    }
    /*Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata de un partido 
    de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos los equipos ganadores ( equipo con mayor 
    cantidad de goles). El método retorna una colección con los objetos de los equipos encontrados.*/
    public function darGanadores($deporte){
        $colPartidos=$this->getPartidos();
        $ganadores = [];
        foreach ($colPartidos as $partido) {
            if (($deporte === 'futbol' && $partido instanceof PartidoFutbol) || 
                ($deporte === 'basquet' && $partido instanceof PartidoBaloncesto)) {
                $equipoGanador = $partido->darEquipoGanador();
                if (is_array($equipoGanador)) {
                    foreach ($equipoGanador as $equipo) {
                        $ganadores[] = $equipo;
                    }
                } else {
                    $ganadores[] = $equipoGanador;
                }
            }
        }

        return $ganadores;
    }
    /*Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo asociativo donde una de sus 
    claves es ‘equipoGanador’  y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’ que contiene 
    el valor obtenido del coeficiente del Partido por el importe configurado para el torneo. 
    (premioPartido = Coef_partido * ImportePremio)*/
    public function calcularPremioPartido($OBJPartido){
        $ganador=$OBJPartido->darEquipoGanador();
        $coefPartido = $OBJPartido->calcularCoeficiente();
        $premioPartido = $coefPartido * $this->getPremio();

        $arr= [
            'equipoGanador' => $ganador,
            'premioPartido' => $premioPartido
        ];
        return $arr;
    }
}
    

