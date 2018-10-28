<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	var $calendartemplate = '
		{table_open}<table id="kalender">{/table_open}

        {heading_row_start}<thead><tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}"><span class="glyphicon glyphicon-chevron-left"></span></a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}"><h3>{heading}</h3></th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}"><span class="glyphicon glyphicon-chevron-right"></span></a></th>{/heading_next_cell}

        {heading_row_end}</tr></thead>{/heading_row_end}

        {week_row_start}<tr id="week">{/week_row_start}
        {week_day_cell}<td><b>{week_day}</b></td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td><a href="#">{/cal_cell_start}
        {cal_cell_start_today}<td id="today"><a href="#">{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a id="content" href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}{day}{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</a></td>{/cal_cell_end}
        {cal_cell_end_today}</a></td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
	';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{	
		

		$this->load->view('template/header1');
		
		
		$this->load->view('template/header2');

		
		//$this->load->view('template/breadcrumb');
		//$this->load->view('header_home');
		$this->load->view('body_home');
		$this->load->view('template/footer');
		
	}
	


	private function navloader($activemenu)
	{
		$this->load->model('Navigasi_Model');

		if($this->session->userdata('logged')
			&&$this->session->userdata('status')=='1')
		{	
			$data['allmenu'] = $this->Navigasi_Model->get_menu_admin();
			$data['activemenu'] = $activemenu;
			$this->load->view('template/navigasi',$data);

		}

		elseif($this->session->userdata('logged')
			&&$this->session->userdata('status')=='2')
		{
			$data['allmenu'] = $this->Navigasi_Model->get_menu_operator();
			$data['activemenu'] = $activemenu;
			$this->load->view('template/navigasi',$data);
		}
		
		elseif($this->session->userdata('logged')
			&&$this->session->userdata('status')=='3')
		{
			$data['allmenu'] = $this->Navigasi_Model->get_menu_alumni();
			$data['activemenu'] = $activemenu;
			$this->load->view('template/navigasi',$data);
		}
		
		elseif($this->session->userdata('logged')
			&&$this->session->userdata('status')=='4')
		{
			$data['allmenu'] = $this->Navigasi_Model->get_menu_maha();
			$data['activemenu'] = $activemenu;
			$this->load->view('template/navigasi',$data);
		}

		else
		{
			$data['allmenu'] = $this->Navigasi_Model->get_menu_guest();
			$data['activemenu'] = $activemenu;
			$this->load->view('template/navigasi',$data);
		}


	}
	
	






}