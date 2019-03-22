<?php

class Player extends yidas\rest\Controller
{
  public function multimedia()
  {
        $playername = $this->input->get('playername');
        $this->response->json($this->db->query("CALL sp_getplayermultimedia('".$playername."')")->result(), 200);
  }

  public function ticker()
  { 
    $playername = $this->input->get('playername');
    $this->response->json($this->db->query("CALL sp_getplayerticker('".$playername."')")->result(), 200);
  }
}