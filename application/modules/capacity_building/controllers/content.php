<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * content controller
 */
class content extends ResourceContentController
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->contactPersonEnabled = true;

        $this->homeScreenUrl = site_url(SITE_AREA .'/content/capacity_building');
        $this->submitUrl = site_url(SITE_AREA .'/content/capacity_building/save');
        $this->saveCourseUrl = site_url(SITE_AREA .'/content/capacity_building/save_course');
        $this->addCourseUrl = site_url(SITE_AREA .'/content/capacity_building/add_course');
        $this->editCourseUrl = site_url(SITE_AREA .'/content/capacity_building/edit_course');
        $this->deleteCourseUrl = site_url(SITE_AREA .'/content/capacity_building/delete_course');
        $this->resourceEditUrl = site_url(SITE_AREA .'/content/capacity_building/edit');
        $this->resourceAddUrl = site_url(SITE_AREA .'/content/capacity_building/edit');
        $this->resourceDeleteUrl = site_url(SITE_AREA .'/content/capacity_building/delete');
        $this->resourceResourcesUrl = site_url(SITE_AREA .'/content/capacity_building/resources');
        $this->resourceResourceDeleteUrl = site_url(SITE_AREA .'/content/capacity_building/delete_resource');
        $this->resourceVisibilityUrl = site_url(SITE_AREA .'/content/capacity_building/set_visible');

        $this->providersUrl = site_url(SITE_AREA .'/content/capacity_building/providers');
        $this->categoriesUrl = site_url(SITE_AREA .'/content/capacity_building/categories');

        $this->resourceCategory = 'capacity_building';

		parent::__construct();

        $this->auth->restrict('Capacity_Building.Content.View');

		$this->load->model('capacity_building/Capacity_Building_Content_Model', 'Content_Model');
		$this->lang->load('capacity_building');
		$this->load->library('pagination');

        $this->resourceModel = $this->Content_Model;
        $this->resourceModel->setBaseUrl(site_url('admin/content/capacity_building/index'));
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('capacity_building', 'capacity_building.js');
	}

	protected function getCategories()
    {
        return [
            'ecampus_courses' => 'eCampus Courses',
            'other_resources' => 'Other Resources'
        ];
    }

    
    /**
     * Displays a list of form data.
     * @param int $pageNumber
     */
	public function index($pageNumber = 1)
	{
       //$this->force_login();

        

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

            $menu.="<li class='breadcrumb-item'>Provider > <span class='provider' provider_id=$provider->id> $provider->name</span></li>";
            
               
            

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
            group by c.course_provider_id order by p.name asc");



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
                l.id as id, 
                l.name as name
                from bf_languages l left join bf_course_languages cl on cl.language_id=l.id 
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

            order by c.name asc

            ");

        $all_courses=$this->db->query("select count(*) as total from bf_courses ");
         



        Template::set('course_categories',$categories->result());
        Template::set('providers',$providers->result());
        Template::set('languages',$languages->result());

        Template::set('url',$url);
        Template::set('all_courses',$all_courses->result()[0]->total);

        Template::set('menu',$menu);
        //print_r($all_courses->result()[0]->total);
        Template::set('categories', $categories);

        Template::set('courses',$resource->result());
        Template::set('db',$this->db);

        Template::set('addCourseUrl', $this->addCourseUrl);
		Template::render();
	}

    public function add_course($id=null){


        //$course=$this->db->get("courses");

        $data["category_id"]=$this->input->get('category_id');
       

        $data['course_provider_id']=$id;

        
     
        $providers_res=$this->db->query("select id,name from bf_course_providers order by name asc")->result_array();
        $categories_res=$this->db->query("select id,name from bf_course_categories order by name asc")->result_array();
        $lang_res=$this->db->query("select name,name from bf_languages order by name asc")->result_array();
        $languages=array_column($lang_res, 'name', 'name');

        $providers=array_column($providers_res, 'name', 'id');
        $categories=array_column($categories_res, 'name', 'id');
        Template::set('providers', $providers);
        Template::set('categories', $categories);
        //Template::set('course', $course);
        Template::set('saveCourseUrl', $this->saveCourseUrl); 

        Template::set('backUrl', $this->homeScreenUrl); 

        Template::set('data', $data); 
        Template::set('languages', $languages);


        Template::render();
    }
    public function edit_course($id){

         
       
       
        $course=$this->db->query("select * from bf_courses where id='$id'")->row();

        $coursecategories=$this->db->query("select category_id from bf_course_categories_pivot where course_id='$id'")->result();
     
        $providers_res=$this->db->query("select id,name from bf_course_providers order by name asc")->result_array();
        $categories_res=$this->db->query("select id,name from bf_course_categories order by name asc")->result_array();
        $lang_res=$this->db->query("select name,name from bf_languages order by name asc")->result_array();


        $providers=array_column($providers_res, 'name', 'id');
        $categories=array_column($categories_res, 'name', 'id');
        $languages=array_column($lang_res, 'name', 'name');
        //$coursecategories=array_column($lang_res, 'name', 'name');




        $data["language"]=explode(",",$course->language);

        $data["category_id"]=$coursecategories;


        $cats=[];
        foreach($coursecategories as $cat){

            $cats[]=$cat->category_id;

        }

        

        if(count($data["language"])==1)
        $data["language"]=explode(" ",$data["language"][0]);


        Template::set('coursecategories', $cats);
        Template::set('providers', $providers);
        Template::set('categories', $categories);
        Template::set('course', $course);
        Template::set('data', $data);
        Template::set('languages', $languages);
        Template::set('saveCourseUrl', $this->saveCourseUrl); 
        Template::set('backUrl', $this->homeScreenUrl); 

        Template::render();
    }
    public function view_course($id){

         
       
       $course=$this->db->query("select 
            c.id as id,
            c.name as name, 
            c.description,
            c.duration,
            c.url as url,
            c.language as language,
            p.id as provider_id,
            p.name as provider,
            cc.name as category,
            cc.id as category_id
            from bf_courses c left join bf_course_providers p on c.course_provider_id =p.id
            left join bf_course_categories cc on cc.id=c.course_category_id
             where c.id='$id'
             order by c.name asc
            ")->row();

        $resources=$this->db->query("select 
                r.id as id, 
                r.resource_name as name,
                r.resource_type as type,
                r.resource_url as url
                from bf_resource_tracker r where resource_id=$id
                ")->result();



       $languages=$this->db->query("select 
                l.id as id, 
                l.name as name
                from bf_languages l left join bf_course_languages cl on cl.language_id=l.id
                where course_id=$id
                ")->result();

        Template::set('course',$course);
        Template::set('editCourseUrl',$this->editCourseUrl);
        Template::set('deleteCourseUrl',$this->deleteCourseUrl);
        Template::set('resourceAddUrl',$this->resourceAddUrl);
        Template::set('backUrl',$this->homeScreenUrl);
        Template::set('languages',$languages);
         Template::set('resources',$resources);


        Template::render();
    }


    public function providers(){


        $providers=$this->db->query("select * from bf_course_providers order by name asc")->result();

        Template::set('providers',$providers);


        Template::render();

    }

     public function categories(){


        $categories=$this->db->query("select * from bf_course_categories order by name asc")->result();

        Template::set('categories',$categories);


        Template::render();

    }

     public function languages(){


        $languages=$this->db->query("select * from bf_languages order by name asc")->result();

        Template::set('languages',$languages);


        Template::render();

    }

    public function add_provider(){

        

        Template::render();

    }
    public function add_language(){

        

        Template::render();

    }

    public function add_category($id=null){

        $data["category_id"]=$id;

        Template::set("data",$data);


        Template::render();

    }

    public function edit_provider($id){

        
        $provider=$this->db->query("select * from bf_course_providers where id='$id'")->row();
        Template::set('provider',$provider);
        Template::render();

    }
    public function edit_category($id){

        
        $category=$this->db->query("select * from bf_course_categories where id='$id'")->row();
        Template::set('category',$category);
        Template::render();

    }
    public function edit_language($id){

        
        $language=$this->db->query("select * from bf_languages where id='$id'")->row();


        Template::set("language",$language);
        Template::render();

    }
    public function view_provider($id){

        
        $provider=$this->db->query("select * from bf_course_providers
         where id='$id'")->row();


        $courses=$this->db->query("select 
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
          
             where p.id='$id'

            order by c.name asc

            ")->result();
        Template::set('provider',$provider);
        Template::set('courses',$courses);
        Template::set('db',$this->db);
        Template::render();

    }
    public function view_category($id){




        
        $category=$this->db->query("select * from bf_course_categories
         where id='$id'")->row();


        $courses=$this->db->query("select 
            c.id as id,
            c.name as name, 
            c.description,
            c.duration,
            c.language as language,
            p.id as provider_id,
            p.name as provider,
            cc.name as category,
            cc.id as category_id
            from bf_courses c left join bf_course_providers p on c.course_provider_id =p.id
            left join bf_course_categories cc on cc.id=c.course_category_id
          
             where cc.id='$id'

            order by c.name asc

            ")->result();

        
        Template::set('category',$category);
        Template::set('courses',$courses);
        Template::set('db',$this->db);
        Template::render();

    }

    public function save_provider(){

        
        if(!empty($this->input->post("name"))){

            $id=$this->input->post("id");
            $this->input->post('id', null);
            if(!empty($id))
            {
                $this->db->update("course_providers",
                    $this->input->post(),
                    ["id"=>"$id"]
                );
            }
            else
            {

            $this->db->insert("course_providers",$this->input->post());
             $id=$this->db->insert_id();
            }
            Template::redirect(SITE_AREA ."/content/capacity_building/view_provider/$id");
        }
    

      

    }
    public function save_category(){

        
        if(!empty($this->input->post("name"))){

            $id=$this->input->post("id");
            $this->input->post('id', null);
            if(!empty($id))
            {
                $this->db->update("course_categories",
                    $this->input->post(),
                    ["id"=>"$id"]
                );
            }
            else
            {

            $this->db->insert("course_categories",$this->input->post());
             $id=$this->db->insert_id();
            }
            Template::redirect(SITE_AREA ."/content/capacity_building/view_category/$id");
        }
    

      

    }

    public function save_language(){

        
        if(!empty($this->input->post("name"))){

            $id=$this->input->post("id");
            $this->input->post('id', null);
            if(!empty($id))
            {
                $this->db->update("languages",
                    $this->input->post(),
                    ["id"=>"$id"]
                );
            }
            else
            {

            $this->db->insert("languages",$this->input->post());
             $id=$this->db->insert_id();
            }
            Template::redirect(SITE_AREA ."/content/capacity_building/languages");
        }
    

      

    }

    public function add_resource($id){

         

            $data = ['resource_id'=>$id];

            $courses_res=$this->db->query("select id,name from bf_courses order by name asc")->result_array();
       


        $courses=array_column($courses_res, 'name', 'id');

         Template::set('data',$data);
        Template::set('types',["Document"=>"Document","Link"=>"Link"]);

        


         Template::set('courses',$courses);

        
    

        

        Template::render();

    }

    public function edit_resource($id){

         

            $data = ['id'=>$id];

            $resource=$this->db->query("select * from bf_resource_tracker where id=$id")->row();

            $courses_res=$this->db->query("select id,name from bf_courses order by name asc")->result_array();
       


        $courses=array_column($courses_res, 'name', 'id');

         Template::set('data',$data);
         Template::set('resource',$resource);
        Template::set('types',["Document"=>"Document","Link"=>"Link"]);

        


         Template::set('courses',$courses);

        
    

        

        Template::render();

    }

    

	/**
	 * Allows editing of Capacity Building data.
	 *
	 * @return void
	 */
	public function edit()
	{
        $this->auth->restrict('Capacity_Building.Content.Create');

		$id = $this->uri->segment(5);

		if(empty($id)) {
            // New record
			Template::set('formView', $this->showEditor());
		} else {
            // Existing record
            Template::set('formView', $this->showEditor($id));
        }

		Template::set('toolbar_title', lang('capacity_building_edit') .' Capacity Building');
		Template::render();
	}

    /**
     * Save edited / inserted resource
     */
	public function save() {
        $this->auth->restrict('Capacity_Building.Content.Create');

        $this->saveResource($this->input, $this->input->post('id', null));
        Template::redirect(SITE_AREA .'/content/capacity_building/index');
    }
    public function save_course() {
        $this->auth->restrict('Capacity_Building.Content.Create');
            $id=$this->input->post("id");

            $language=implode(",", $this->input->post("language"));

           $_POST["language"]=$language;



          $categories=$this->input->post("category_id");


          unset($_POST["category_id"]);


           $this->input->post('id', null);
            if(!empty($id))
            {
                $this->db->update("courses",
                    $this->input->post(),
                    ["id"=>"$id"]
                );
            }
            else
            {

                $this->db->insert("courses",
                    $this->input->post()
                );

            $id=$this->db->insert_id();
            

            

            }


           $this->db->query("delete from bf_course_categories_pivot where course_id=$id");


        
            $i=0;
            if(count($categories)>0){
                    foreach($categories as $category){
                   
                    $rs=$this->db->query("INSERT INTO bf_course_categories_pivot 
                        (course_id, category_id) VALUES ($id, $categories[$i])
                        ON DUPLICATE KEY UPDATE category_id=VALUES(category_id)"
                        );

                
                    
                    $i++;
                }
               
            }


        Template::redirect(SITE_AREA ."/content/capacity_building/view_course/$id");
    }

     public function delete_course() {
        $this->auth->restrict('Capacity_Building.Content.Delete');
            
            $id = $this->uri->segment(5);

           

        if(!empty($id)) {
            $this->db->delete("courses",["id"=>"$id"]);
            $this->db->delete("course_categories_pivot",["course_id"=>"$id"]);
        }


        Template::redirect(SITE_AREA ."/content/capacity_building");
    }

    public function delete_provider() {
        $this->auth->restrict('Capacity_Building.Content.Delete');
            
            $id = $this->uri->segment(5);

           

        if(!empty($id)) {
            $this->db>delete("courses",["course_provider_id"=>'$id']);
            $this->db->delete("course_providers",["id"=>"$id"]);

        }


        Template::redirect(SITE_AREA ."/content/capacity_building/providers");
    }

    public function delete_category() {
        $this->auth->restrict('Capacity_Building.Content.Delete');
            
            $id = $this->uri->segment(5);



           

        if(!empty($id)) {
            //$this->db->delete("courses",["course_category_id"=>'$id']);
            $this->db->delete("courses_categories_pivot",["category_id"=>"$id"]);
            $this->db->delete("course_categories",["id"=>"$id"]);

        }


        Template::redirect(SITE_AREA ."/content/capacity_building/categories");
    }

    /**
     * Delete existing resource
     */
    public function delete() {
        $this->auth->restrict('Capacity_Building.Content.Delete');

        $id = $this->uri->segment(5);

        if(!empty($id)) {
            $this->deleteResource($id);
        }

        Template::redirect(SITE_AREA .'/content/capacity_building/index');
    }

    /**
     * Edit resources for a specific resource
     */
    public function resources()
    {
        if($this->input->post('resource_id', false)) {
            $this->auth->restrict('Capacity_Building.Content.Create');
            $this->addOrEditResourceLink();
            $id = $this->input->post('resource_id');

            Template::redirect($this->resourceResourcesUrl.'/'.$id);
        } else {
            $this->auth->restrict('Capacity_Building.Content.View');
            $id = $this->uri->segment(5);
            $listView = $this->showResourceResourcesList($id);

            Template::set('backUrl', $this->homeScreenUrl);
            Template::set('listView', $listView);
            Template::render();
        }
    }

    public function saveResource(){
         $this->auth->restrict('Capacity_Building.Content.Create');
         $id=$this->input->post("id");

         $course_id=$this->input->post("resource_id");

         
            if(!empty($id))
            {
                $this->db->update("resource_tracker",
                    $this->input->post(),
                    ["id"=>"$id"]
                );
            }
            else
            {

                $this->db->insert("resource_tracker",
                    $this->input->post()
                );

            $id=$this->db->insert_id();
            }


        Template::redirect(SITE_AREA ."/content/capacity_building/view_course/$course_id");

    }

    /**
     * Delete a resource
     */
    public function delete_resource() {
        $this->auth->restrict('Capacity_Building.Content.Delete');

        $id = $this->uri->segment(5);
        $resourceResourceId = $this->uri->segment(6);
        $this->Resource_Resources_Model->delete($id);

        Template::redirect($this->resourceResourcesUrl.'/'.$resourceResourceId);
    }

    /**
     * Sets visibility of a resource
     */
    public function set_visible() {
        $id = $this->uri->segment(5);
        $visibility = $this->uri->segment(6);

        $this->setVisible($id, $visibility);

        Template::redirect($this->homeScreenUrl);
    }
}