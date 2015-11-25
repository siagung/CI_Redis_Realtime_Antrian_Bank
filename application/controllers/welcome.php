<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    var $vint=0;

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct()
    {
        parent::__construct();
         $this->load->library('form_validation');
    }

	public function index()
	{
		$this->data['message'] = $this->redis->command('PING');
		$this->load->view('welcome_message',$this->data);
	}

	public function index2()
	{		
		//$this->data['message'] = $this->redis->command('publish realtime '.$this->input->post('cmd'));
		//$this->redis->set('realtime', $this->input->post('cmd'));

        $this->data['message']= $this->redis->command('publish realtime loket02-102');
		$this->load->view('welcome_message',$this->data);
	}


    public function indexr()
    {
        for ($i = 0; $i <= 10; $i++) {
             $this->redis->command('publish loop ' .$i);
             sleep(1);
        }
    }

	public function index3()
	{

		$this->data['message'] = $this->redis->command($this->input->post('publish'));
		//$this->redis->set('realtime', $this->input->post('cmd'));
		$this->load->view('welcome_message',$this->data);
	}

    public function terbilang()
    {

        if ($this->input->post('desc') == 1) {
            $this->data['message'] = $this->redis->command("publish realtime loket01-" . $this->input->post('nilai'));
        } else if ($this->input->post('desc') == 2)  {
            $this->data['message'] = $this->redis->command("publish realtime loket02-" . $this->input->post('nilai'));
        } else if ($this->input->post('desc') == 3){
            $this->data['message'] = $this->redis->command("publish realtime kasir01-" . $this->input->post('nilai2'));
        }
        //$this->redis->set('realtime', $this->input->post('cmd'));
        $this->load->view('welcome_message',$this->data);
    }
//    public function zephirTest()
//    {
//        echo Utils\Greeting::say(), "\n";
//    }
//    public function zephirTest2()
//    {
//        $f = new Utils\Filter();
//        $f->alpha("agung susanto");
//
//    }
//
//    public function zephirTest3()
//    {
//        $f = new Utils\Filter();
//        echo $f->alpha2("agung susanto");
//
//    }
//
//
//    public function zephirTest4()
//    {
//        $f = new Utils\Filter();
//
//        echo $f->alpha3("agung susanto!he#02l3'121lo.");
//
//    }
//    public function zephirTest5()
//    {
//        $f = new Utils\Filter();
//
//        echo $f->hitung(5);
//
//    }
//
//    public function zephirTest6()
//    {
//        $f = new Utils\Filter();
//
//        $f->testvar();
//
//        $b = 100;
//        $a = "b";
//        echo $$a; // prints 100
//
//    }
//
//    public function zephirTest7()
//    {
//        $f = new Utils\Filter();
//
//
//        echo $f->testvar2();
//
//    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */