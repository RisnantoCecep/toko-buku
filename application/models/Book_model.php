<?php 
class Book_model extends CI_Model {

    public function categories(){
        return $this->db->get("categories")->result_array();
        
    }
    
    public function get_category($id)
    {
        return $this->db->get_where("categories", ['category_slug'=>$id])->row_array();

    }

    public function countAllCategory(){
        return $this->db->get("categories")->num_rows();
    }

    public function countBuku($category_id=null, $search=null){
        if($category_id){
            $this->db->where(["category_id"=>$category_id]);
        }
        if($search){
            $this->db->where("(book_title LIKE '%$search%')");
        }
        return $this->db->get("books")->num_rows();
    }

    // ambil data list buku
    public function find($limit=10, $offset=0, $category_id=null, $search=null){
        $this->db->select("*, CONCAT('".base_url('assets/img/books/')."', book_image) as book_image");
        $this->db->join("categories", "categories.category_id = books.category_id");
        if($category_id){
            $this->db->where(["books.category_id"=>$category_id]);
        }
        if($search){
            $this->db->where("(book_title LIKE '%$search%')");
        }
        $this->db->where("(book_stok > 0)");
        $this->db->limit($limit,$offset);
        $this->db->order_by("book_created DESC");
        return $this->db->get("books")->result_array();
    }

    // ambil data satu buku
    public function get($slug){
        $this->db->select("*, CONCAT('".base_url('assets/img/books/')."', book_image) as book_image, book_image as image_path");
        $this->db->join("categories", "categories.category_id = books.category_id");
        $data = $this->db->get_where("books", ["book_slug"=>$slug])->row_array();
        if($data){
            $this->db->join("transactions", "transactions.transaction_id = transaction_detail.transaction_id");
            $data['terjual'] = $this->db->get_where("transaction_detail", ["book_id"=>$data["book_id"], "transaction_status"=>"Selesai"])->num_rows();
        }
        return $data;
    }

    public function saveBuku($id, $category_id, $title, $image, $stok, $price, $desc){
        $data['category_id'] = $category_id;
        $data['book_title'] = $title;
        $data['book_slug'] = uniqid(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title))).'-');
        $data['book_stok'] = $stok;
        $data['book_price'] = $price;
        $data['book_desc'] = $desc;
        if($image){
            $data['book_image'] = $image;
        }
        if($id){
            return $this->db->update("books", $data, ['book_id'=>$id]);
        }else{
            return $this->db->insert("books", $data);
        }
    }

    public function findBasket(){
        $baskets = getBaskets();
        $basket = null;
        $ids = [];
        for($i = 0; $i < count($baskets); $i++){
            $spliter = explode(":", $baskets[$i]);
            if(count($spliter)==2){
                $basket[$spliter[0]] = $spliter[1];
                $ids[] = $spliter[0];
            }
        }

        if($ids){
            // QUERY
            $this->db->select("*, CONCAT('".base_url('assets/img/books/')."', book_image) as book_image, book_image as image_path");
            $this->db->join("categories", "categories.category_id = books.category_id");
            $this->db->where_in('book_id', $ids);
            $data = $this->db->get("books")->result_array();
            if($data){
                foreach($data as $i => $book){
                    $data[$i]['qty'] = $basket[$book['book_id']];
                    $data[$i]['total'] = $data[$i]['qty'] * $book['book_price'];
                }
            }
            return $data;
        }
        return [];
    }
}
?>