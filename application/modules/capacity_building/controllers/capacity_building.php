<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * capacity_building controller
 */
class capacity_building extends BaseResourceController
{
    protected $latestVersionEnabled = false;
    protected $contactPersonEnabled = true;
    protected $gateKeeperEnabled = false;
    
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->resourceCategory = 'capacity_building';

		$this->load->library('form_validation');
		$this->lang->load('capacity_building');

		$this->load->model('capacity_building/Capacity_Building_Content_Model', 'Content_Model');
        $this->Content_Model->setBaseUrl(site_url('capacity_building/index'));

		// Set menu item (active)
		Template::set('capacity_building_active', true);

		Assets::add_module_js('capacity_building', 'capacity_building.js');

        $category = $this->input->get('category', false);

        if($category) {
            $this->session->set_userdata('capacity_building_category', $category);
        } else {
            if(!$this->session->userdata('capacity_building_category')) {
                $this->session->set_userdata('capacity_building_category', 'ecampus_courses');
            }
        }
	}



	/**
	 * Get categories
	 *
	 * @return array
	 */
	protected function getCategories()
	{
		return [
			'ecampus_courses' => 'eCampus Courses',
			'other_resources' => 'Other Resources'
		];
	}

   public function category_list()
    {
        $provider_id=$this->input->get('provider_id');
        $where="";
         if(!empty($provider_id))
        {
            
            $providers=implode(",",json_decode($provider_id));
            $where.= " AND  c.course_provider_id in($providers)";
        }

        

        $categories=$this->db->query("select 
                cc.id as category_id, 
                cc.name as name, 
                count(*) as count 
                from bf_courses c 
                left join bf_course_categories cc 
                on c.course_category_id =cc.id 
                left join bf_course_providers p on c.course_provider_id =p.id



                where 1 

                $where
                 group by c.course_category_id

                  order by cc.name asc

                ");

        $this->load->view('category_list',
            [
            'course_categories'=>$categories->result()
            ]
        );

    }

     public function course_list(){


       
        $provider_id=$this->input->get('provider_id');
        $category_id=$this->input->get('category_id');
        $language=$this->input->get('language');


        

        $where="";
        $url="";
        $menu="";

       $provider_id=json_decode($provider_id);

       

        if(count($provider_id)>0)
        {
            
            $providers=implode(",",$provider_id);

            $where.= " AND  c.course_provider_id in ($providers) ";
            //$url.="provider_id=$provider_id";

            //get the clicked provider name
            //$provider=$this->db->query("select id,name from bf_course_providers where id='$provider_id'")->row();

            //$menu.="<li class='breadcrumb-item'>Provider > <a href='#' class='providers' provider_id='$provider->id'> $provider->name</a></li>";
            
            

            

        }
         $category_id=json_decode($category_id);



         if(count($category_id)>0)
        {
            
           
            $categories=implode(",",$category_id);

            $where .=" AND pv.category_id in ($categories)";



            //$url.="&category_id=$category_id";

            //$category_menu=$this->db->query("select id,name from bf_course_categories where id='$category_id'")->row();

            //$menu.="<li class='breadcrumb-item'>Category > <a href='#' class='categories' category_id='$category_menu->id'> $category_menu->name</a></li>";

        }

        //print($where); exit;

        if(!empty($language))
        {
            $where .=" AND c.language like '%$language%'";

            $url.="language=$language";
            $menu.="<li class='breadcrumb-item'>Langugage > <a href='#' class='languages' language='$language'> $language</a></li>";

        }

        

        $providers=$this->db->query("select 
            p.id as provider_id, 
            p.name as name, 
            count(*) as count 
            from bf_courses c 
            left join bf_course_providers p on c.course_provider_id =p.id 
            group by c.course_provider_id
             order by p.name asc
            ");



        $categories=$this->db->query("select 
                cc.id as category_id, 
                cc.name as name, 
                count(*) as count 
                from bf_courses c 
                left join bf_course_categories cc on c.course_category_id =cc.id 
                left join bf_course_providers p on c.course_provider_id =p.id
                left join bf_course_categories_pivot pv on pv.course_id=c.id

                where 1 

                $where
                 group by pv.category_id

                 order by cc.name asc

                ");




        $languages=$this->db->query("select 
                cl.id as id, 
                cl.name as name
                from bf_languages cl
                ");

        $courses_sql="select 
            c.id as id,
            c.name as name, 
            c.description,
            c.duration,
            c.url as url,
            c.language as language,
            p.id as provider_id,
            p.name as provider
            from bf_courses c 
            left join bf_course_providers p on c.course_provider_id =p.id
            left join bf_course_categories_pivot pv on pv.course_id=c.id
          
             where 1

            $where

            order by c.name asc

            ";

        $resource=$this->db->query($courses_sql);



        $all_courses=$this->db->query("select count(*) as total from bf_courses");

      
        $this->load->view('course_list',
            [
            "courses"=>$resource->result(),
            "menu"=>$menu,
            "all_courses"=>$all_courses->result()[0]->total,
            'providers'=>$providers->result(),
            'categories'=>$categories->result(),
            'course_categories'=>$categories->result(),
            'languages'=>$languages->result(),
            'url'=>$url,
            'db'=>$this->db
            ]
        );
      }

    public function view($id){

       $course=$this->db->query("select 
            c.id as id,
            c.name as name, 
            c.description,
            c.duration,
            c.url as url,
            c.language as language,
            p.id as provider_id,
            p.name as provider,
            cc.name as category
            from bf_courses c left join bf_course_providers p on c.course_provider_id =p.id
            left join bf_course_categories cc on cc.id=c.course_category_id
             where c.id='$id'
            ")->row();

        Template::set('course',$course);

       Template::render();
    }


    /**
     * Displays a list of form data.
     *
     * @param int $pageNumber
     */
	public function index($pageNumber = 1)
	{
		$this->force_login();

        

        //conditions for providers filter

        $where="";
        $url="?";
        $provider_id=$this->input->get('provider_id');
        $category_id=$this->input->get('category_id');
        $language=$this->input->get('language');






        $menu="";


        if(!empty($provider_id))
        {
            $where.= " AND  c.course_provider_id=$provider_id ";
            $url.="provider_id=$provider_id";

            //get the clicked provider name
            $provider=$this->db->query("select id,name from bf_course_providers where id='$provider_id'")->row();

            $menu.="<li class='breadcrumb-item'>Provider > <a href='?provider_id=$provider->id'> $provider->name</a></li>";
            
               
            

        }

        if(!empty($category_id))
        {
            $where .=" AND c.course_category_id=$category_id";

            $url.="&category_id=$category_id";

            $category_menu=$this->db->query("select id,name from bf_course_categories where id='$category_id'")->row();

            $menu.="<li class='breadcrumb-item'>Category > <a href='&category_id=$category_menu->id'> $category_menu->name</a></li>";

        }

        if(!empty($language))
        {
            $where .=" AND c.language like '%$language%'";

            $url.="language=$language";
            $menu.="<li class='breadcrumb-item'>Langugage > <a href='&language=$language'> $language</a></li>";

        }

        if(!empty($provider_id) && !empty($category_id))
        {

             //$where .=" AND  c.course_provider_id=$provider_id AND c.course_category_id=$category_id";

                $url="?provider_id=$provider_id&category_id=$category_id";
        }


        //echo $url;

        $providers=$this->db->query("select 
            p.id as provider_id, 
            p.name as name, 
            count(*) as count 
            from bf_courses c 
            left join bf_course_providers p on c.course_provider_id =p.id 
            group by c.course_provider_id order by name asc");



        $categories=$this->db->query("select 
                cc.id as category_id, 
                cc.name as name, 
                count(*) as count 
                from bf_courses c 
                left join bf_course_categories cc 
                on c.course_category_id =cc.id 
                left join bf_course_providers p on c.course_provider_id =p.id

                where 1 

                $where
                 group by c.course_category_id
                 order by cc.name asc
                ");


        $languages=$this->db->query("select 
                cl.id as id, 
                cl.name as name
                from bf_languages cl order by name asc
                ");

        $resource=$this->db->query("select 
            c.id as id,
            c.name as name, 
            c.description,
            c.duration,
            c.language as language,
            p.id as provider_id,
            p.name as provider,
            cc.name as category
            from bf_courses c left join bf_course_providers p on c.course_provider_id =p.id
            left join bf_course_categories cc on cc.id=c.course_category_id
          
             where 1

            $where

            ");

        $all_courses=$this->db->query("select count(*) as total from bf_courses");
         



        Template::set('course_categories',$categories->result());
        Template::set('providers',$providers->result());
        Template::set('languages',$languages->result());

        Template::set('url',$url);
        Template::set('all_courses',$all_courses->result()[0]->total);

        Template::set('menu',$menu);
        //print_r($all_courses->result()[0]->total);
        Template::set('categories', $categories);

        Template::set('courses',$resource->result());
        /*Template::set('keyInsights', $this->showKeyInsights($this->resourceCategory));
		Template::set('listView', $this->showResourcesList($this->resourceCategory,
            $this->Content_Model,
            true,
            $category,
            'table table-condensed table-striped table-hover mru_tbl',
            $id
        ));


        
        Template::set('tabsUrl', site_url('capacity_building'));*/
		Template::render();
	}
}