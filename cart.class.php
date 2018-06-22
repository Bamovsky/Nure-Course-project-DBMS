<?php
class Cart
{
    private $products;
    
    function __construct()
    {
        $this->products = Cookie::get('Products') == null ?
            array()
            :
            unserialize(Cookie::get('Products'));
    }


    public function getProducts($for_sql = false)
    {
    if ($for_sql) {
        return implode(',', $this->products);
    }
    return $this->products;
    }


    public function addProduct($id)
    {
        $id = (int)$id;

        if (!in_array($id, $this->products)) {
            array_push($this->products, $id);
        }

        Cookie::set('Products', serialize($this->products));
    }



    public function deleteProduct($id)
    {
        $id = (int)$id;

        $key = array_search($id, $this->products);
        if ($key !== false){
            unset($this->products[$key]);
        }

        Cookie::set('Products', serialize($this->products));
    }


    public function clear()
    {
        Cookie::delete('Products');
    }

    public function isEmpty()
    {
        return !$this->products;
    }

}