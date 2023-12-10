<?php 
class Book extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Book_model","book");
    }

    public function category($slug){
        $data["page"] = "book/category";
        $data["category"] = $this->book->get_category($slug);
        $data["title"] = $data["category"]["category_title"];

        $config['base_url'] = current_url();
        $config['total_rows'] = $this->book->countBuku($data["category"]["category_id"]);
        $config['query_string_segment'] = 'pages';
        $config['page_query_string'] = true;
        $config['reuse_query_string'] = true;
        $config['per_page'] = 4;
 
        // styling
        $config["full_tag_open"] = '<nav><ul class="pagination my-pagination justify-content-center">';
        $config["full_tag_close"] = "</ul></nav>";
        
        $config["first_link"] = "First";
        $config["first_tag_open"] = '<li class="page-item">';
        $config["first_tag_close"] = "</li>";
        
        $config["last_link"] = "Last";
        $config["last_tag_open"] = '<li class="page-item">';
        $config["last_tag_close"] = "</li>";
        
        $config["next_link"] = "&raquo";
        $config["next_tag_open"] = '<li class="page-item">';
        $config["next_tag_close"] = "</li>";
        
        $config["prev_link"] = "&laquo";
        $config["prev_tag_open"] = '<li class="page-item">';
        $config["prev_tag_close"] = "</li>";
        
        $config["cur_tag_open"] = '<li class="page-item active"><a class="page-link" href="#">';
        $config["cur_tag_close"] = "</a></li>";
        
        $config["num_tag_open"] = '<li class="page-item">';
        $config["num_tag_close"] = "</li>";

        $config["attributes"] = array("class" => "page-link");


        $this->pagination->initialize($config);

        $data["start"] = $this->input->get('pages');
        $data["books"] = $this->book->find($config["per_page"], $data["start"], $data["category"]["category_id"], $this->input->get("search"));
        $this->load->view("templates/main", $data);
        
    }

    public function desc($slug){
        $data["book"] = $this->book->get($slug);
        $data["title"] = $data["book"]["book_title"];
        $data["page"] = "book/description";
        $this->load->view("templates/main", $data);
    }

    // public function desc() {
    //     $this->load->model('Book_model', 'book');
    //     $data['page'] = "book/category";


    // }

}
?>