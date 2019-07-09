<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables {
    protected $entity = false;
    protected $filter = false;
    protected $dtRowClass;
    protected $columnCounter = 0;
    protected $column = array();
    protected $ci;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function addEntity($entity, $filter = array()){

        if(!$this->entity){
            $this->entity = $entity;
            $this->ci->load->model($this->entity);
        }

        if(!empty($filter))
            $this->filter = $filter;

        return $this;
    }

    public function populate(){

        $params = array(
            'where' => isset($this->filter['where']) ? $this->filter['where'] : null

        );

        if($this->ci->input->get('length') != -1){
            if($this->ci->input->get('start') > 0)
                $params['page'] = $this->ci->input->get('start') / $this->ci->input->get('length') + 1;
            else 
                $params['page'] = 1;

            $params['pagesize'] = $this->ci->input->get('length');
        }

        if($this->ci->input->get('search') && $this->ci->input->get('search')['value'] != ''){
            $searchValue = $this->ci->input->get('search')['value'];

            foreach($this->column as $column){
                if($column['searchable']){
                    $params['like'][$column['column']] = $searchValue;
                }
            }
        }

        if($this->ci->input->get('order') && count($this->ci->input->get('order'))){
            $order = $this->ci->input->get('order')[0];
            $params['order'] = array(
                $this->column[$order['column']]['column'] =>  $order['dir'] === 'asc' ? "ASC" : "DESC"
            );
        }
        // echo json_encode($params, JSON_PRETTY_PRINT);
        $ent = $this->entity;
        $result = $this->ci->$ent->get_list(null, null, $params);

        return array(
			"draw"            => !empty($this->ci->input->get('draw')) ?
				intval( $this->ci->input->get('draw') ) :
				0,
			"recordsTotal"    => intval( count($result) ),
			"recordsFiltered" => intval( $this->allData($params) ),
			"data"            => $this->output( $result )
		);

    }

    private function allData($filter = array()){
        $params = array(
            'where' => isset($filter['where']) ? $filter['where'] : null,
            'group' => isset($filter['group']) ? $filter['group'] : null,
            'order' => isset($filter['order']) ? $filter['order'] : null,
        );
        $ent = $this->entity;
        return $this->ci->$ent->count(null, null, $params);
        // return $model->count($params);
    }

    private function output($datas){
        $out = array();
        foreach($datas as $data){
			$row = array();
            foreach($this->column as $column){
                $rowdata = $column['callback']($data);
                $row[] = $rowdata;

                if($this->dtRowId){
                    $rowid = $this->dtRowId;
                    $row['DT_RowId'] = $data->$rowid;
                }

                $row['DT_RowClass'] = $this->dtRowClass;
            }
			$out[] = $row;
        }
        return $out;

    }

    public function addColumn($column, $callback, $searchable = true, $orderable = true, $isdefaultorder = false){

        $columns = array('column' => $column, 
                        'callback' => $callback, 
                        'searchable' => $searchable, 
                        'orderable' => $orderable,
                        'isdefaultorder' => $isdefaultorder
                    );
        array_push($this->column, $columns);
        $this->columnCounter++;
        return $this;
    }

    public function addDtRowClass($className){
        $this->dtRowClass = $className;
        return $this;
    }

    public function addDtRowId($columName){
        $this->dtRowId = $columName;
        return $this;
    }
}