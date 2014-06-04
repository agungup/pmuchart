<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Phasor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->database();
	}
	
	function index()
	{
		$query = $this->db->query("SELECT PDC_ID,PMU_ID,STN FROM SUB_CFG_TABLE");
		$data['output'] = $query->result_array();
		$this->load->view('phasor_index',$data);
	}
	
	function chart($pdcid,$pmuid,$limit=300)
	{
		//echo 'ok';
		$query = $this->db->query("SELECT SOC,FRACSEC,PHASOR_AMPLITUDE,PHASOR_ANGLE FROM PHASOR_MEASUREMENTS WHERE PDC_ID=".$pdcid." AND PMU_ID=".$pmuid." AND PHASOR_NAME='Va' ORDER BY SOC desc, FRACSEC desc LIMIT ".$limit);
		//echo 'ok';
		$va = $query->result_array();
		$query = $this->db->query("SELECT SOC,FRACSEC,PHASOR_AMPLITUDE,PHASOR_ANGLE FROM PHASOR_MEASUREMENTS WHERE PDC_ID=".$pdcid." AND PMU_ID=".$pmuid." AND PHASOR_NAME='Vb' ORDER BY SOC desc, FRACSEC desc LIMIT ".$limit);
		//echo 'ok';
		$vb = $query->result_array();
		$query = $this->db->query("SELECT SOC,FRACSEC,PHASOR_AMPLITUDE,PHASOR_ANGLE FROM PHASOR_MEASUREMENTS WHERE PDC_ID=".$pdcid." AND PMU_ID=".$pmuid." AND PHASOR_NAME='Vc' ORDER BY SOC desc, FRACSEC desc LIMIT ".$limit);
		//echo 'ok';
		$vc = $query->result_array();
		$data['chart'] = array();
		//echo 'ok';
		for($i=$limit-1;$i>=0;$i--)
		{
			$arr = array('timestamp' => ($va[$i]['SOC']*1000+$va[$i]['FRACSEC']/1000),
							'va' => ($va[$i]['PHASOR_AMPLITUDE']),
							'vb' => ($vb[$i]['PHASOR_AMPLITUDE']),
							'vc' => ($vc[$i]['PHASOR_AMPLITUDE']),
							'vaa' => ($va[$i]['PHASOR_ANGLE']),
							'vba' => ($vb[$i]['PHASOR_ANGLE']),
							'vca' => ($vc[$i]['PHASOR_ANGLE'])
						);
			array_push($data['chart'],$arr);
			//array_push($data['chart'],array('timestamp' => ($va[$i]['SOC']*1000+$va[$i]['FRACSEC']/1000)));
			//array_push($data['chart'],array('va' => ($va[$i]['PHASOR_AMPLITUDE']));
			//array_push($data['chart'],array('vb' => ($vb[$i]['PHASOR_AMPLITUDE']));
			//array_push($data['chart'],array('vc' => ($vc[$i]['PHASOR_AMPLITUDE']));
		}
		//print_r($data);
		//echo json_encode($query->result_array());
		$this->load->view('phasor_graph',$data);
	}
	
	function current($pdcid,$pmuid,$limit=300)
	{
		//echo 'ok';
		$query = $this->db->query("SELECT SOC,FRACSEC,PHASOR_AMPLITUDE,PHASOR_ANGLE FROM PHASOR_MEASUREMENTS WHERE PDC_ID=".$pdcid." AND PMU_ID=".$pmuid." AND PHASOR_NAME='Ia' ORDER BY SOC desc, FRACSEC desc LIMIT ".$limit);
		//echo 'ok';
		$va = $query->result_array();
		$query = $this->db->query("SELECT SOC,FRACSEC,PHASOR_AMPLITUDE,PHASOR_ANGLE FROM PHASOR_MEASUREMENTS WHERE PDC_ID=".$pdcid." AND PMU_ID=".$pmuid." AND PHASOR_NAME='Ib' ORDER BY SOC desc, FRACSEC desc LIMIT ".$limit);
		//echo 'ok';
		$vb = $query->result_array();
		$query = $this->db->query("SELECT SOC,FRACSEC,PHASOR_AMPLITUDE,PHASOR_ANGLE FROM PHASOR_MEASUREMENTS WHERE PDC_ID=".$pdcid." AND PMU_ID=".$pmuid." AND PHASOR_NAME='Ic' ORDER BY SOC desc, FRACSEC desc LIMIT ".$limit);
		//echo 'ok';
		$vc = $query->result_array();
		$data['chart'] = array();
		//echo 'ok';
		for($i=$limit-1;$i>=0;$i--)
		{
			$arr = array('timestamp' => ($va[$i]['SOC']*1000+$va[$i]['FRACSEC']/1000),
							'ia' => ($va[$i]['PHASOR_AMPLITUDE']),
							'ib' => ($vb[$i]['PHASOR_AMPLITUDE']),
							'ic' => ($vc[$i]['PHASOR_AMPLITUDE']),
							'iaa' => ($va[$i]['PHASOR_ANGLE']),
							'iba' => ($vb[$i]['PHASOR_ANGLE']),
							'ica' => ($vc[$i]['PHASOR_ANGLE'])
						);
			array_push($data['chart'],$arr);
			//array_push($data['chart'],array('timestamp' => ($va[$i]['SOC']*1000+$va[$i]['FRACSEC']/1000)));
			//array_push($data['chart'],array('va' => ($va[$i]['PHASOR_AMPLITUDE']));
			//array_push($data['chart'],array('vb' => ($vb[$i]['PHASOR_AMPLITUDE']));
			//array_push($data['chart'],array('vc' => ($vc[$i]['PHASOR_AMPLITUDE']));
		}
		//print_r($data);
		//echo json_encode($query->result_array());
		$this->load->view('current_graph',$data);
	}
}
