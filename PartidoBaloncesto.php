<?php
class PartidoBaloncesto extends Partido {
    private $cantInfracciones;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2,$cantInfracciones) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->cantInfracciones=$cantInfracciones;
       
    }
    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }
    public function setCantInfracciones($cantInfracciones){
        $this->cantInfracciones=$cantInfracciones;
    }
    /*Por otro lado, si se trata de un partido de basquetbol  se almacena la cantidad de infracciones de manera tal que al 
    coeficiente base se debe restar un coeficiente de penalización, cuyo valor por defecto es: 0.75, * (por) la cantidad de 
    infracciones. Es decir:coef  = coeficiente_base_partido  - (coef_penalización*cant_infracciones);
    */
    public function coeficientePartido() {
        $penalizacion=0.75;
        $coeficienteBase=parent::coeficientePartido();
        $coef=$coeficienteBase-($penalizacion*$this->getCantInfracciones());
        return $coef;
    }
}