<?php

class Category_model extends CI_Model
{

	public function getMainCategories()
	{
		$this->db->where('parent_id IS NULL');
		$this->db->or_where('parent_id', 0);
		$query = $this->db->get('categories');
		return $query->result();
	}

	public function getChildCategories($parentId)
	{
		$this->db->where('parent_id', $parentId);
		$query = $this->db->get('categories');
		$childCategories = $query->result();

		/*foreach ($childCategories as $category) {
			$category->children = $this->getChildCategories($category->category_id);
		}*/

		return $childCategories;
	}
}
