<?php

class AdminUtils {
    protected $_registeredModel = array();
    protected $_searchColumns = array();
    protected $_filterColumns = array();
    protected $_listColumns = array();

    public function __construct(){}

    public function register($model, $name = null){
        $this->_registeredModel[] = (!empty($name)) ?
                array("table" => ucfirst($model), "name" => ucfirst($name)) :
                array("table" => ucfirst($model), "name" => ucfirst("{$model}s"));
    }

    public function lists($model, $columns = array()){
        $this->_listColumns[$model] = $columns;
    }

    public function search($model, $search_fields = array()){
        $this->_searchColumns[$model] = $search_fields;
    }

    public function filter($model, $filter_fields = array()){
        $this->_filterColumns[$model] = $filter_fields;
    }

    public function registeredModels(){
        return $this->_registeredModel;
    }

    public function searchColumns(){
        return $this->_searchColumns;
    }

    public function filterColumns(){
        return $this->_filterColumns;
    }

    public function listColumns(){
        return $this->_listColumns;
    }
}