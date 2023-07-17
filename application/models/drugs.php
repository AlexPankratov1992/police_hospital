<?php

class Drugs extends MY_Model
{

    const DB_TABLE = 'drugs';
    const DB_TABLE_PK = 'drug_id';

    /**
     * Table unique identifier.
     * @var int
     */
    public $drug_id;

    /**
     * Item Name in English.
     * @var string
     */
    public $drug_name_en;
    public $dosage;
    public $dosage_mg;
    public $dosage_ml;

    /**
     * Item Name in Farsi.
     * @var string
     */
    public $drug_name_fa;

    /*
     * category of Item
     * @var string
     */
    public $category;

    /*
     * Price of Item
     * @var decimal(10,0)
     */
    public $price;

    /*
     * Total available number of this item
     * @var int
     */
    public $num = 0;

    /*
     * Memo and aditional description for this Item
     * @var string
     */
    public $memo;

    public $no_of_item;
    public $times;
    public $slot;

    public function get_categories_list()
    {
        $query = $this->db->query("select distinct category from drugs where trim(category)!='' order by category asc");
        return $query->result();
    }

    public function drug_usage_count()
    {
        $query = $this->db->query("SELECT drug_id, COUNT(drug_id) as count FROM drug_patient GROUP BY drug_id");
        return $query->result();
    }

    function search_drugs($category, $name, $no_of_item, $times, $slot)
    {
        $this->db->order_by("drug_name_en", "asc");
        if (!empty($category)) $this->db->like('category', $category);
        if (!empty($name)) $this->db->like('drug_name_en', $name);
        if (!empty($no_of_item)) $this->db->like('no_of_item', $no_of_item);
        if (!empty($times)) $this->db->like('times', $times);
        if (!empty($slot)) $this->db->like('slot', $slot);
        $query = $this->db->get('drugs');
        return $query->result();
    }

    function getlist()
    {
        // $this->db->where('is_active', 1);
        $this->db->order_by("drug_name_en", "asc");
        $query = $this->db->get('drugs');
        return $query->result();
    }
}
