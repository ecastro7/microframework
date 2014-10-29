<?php

namespace application\app_News\models {

    class NewsModel {

        private $id;
        private $descripcion;
        private $fecha;

        public function getId() {
            return $this->id;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }

        public function getFecha() {
            return $this->fecha;
        }

        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }

    }

}
