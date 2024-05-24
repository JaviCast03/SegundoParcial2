<?php
class PartidoFutbol extends Partido {
    private $tiempoExtra;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->tiempoExtra = false;
    }

    public function coeficientePartido() {
        $coeficienteBase=parent::coeficientePartido();
        if($this->getObjEquipo1()->getCategoria()==$this->getObjEquipo2()->getCategoria()){
            if ($this->getObjEquipo1()->getCategoria()->getDescripcion() == 'Menores') {
                $coef=0.13 * $coeficienteBase;
            } elseif ($this->getObjEquipo1()->getCategoria()->getDescripcion() == 'Juveniles') {
                $coef=0.19 * $coeficienteBase;
            } elseif ($this->getObjEquipo1()->getCategoria()->getDescripcion() == 'Mayores') {
                $coef=0.27 * $coeficienteBase;
            }
        }
        return $coef;
    }
}
