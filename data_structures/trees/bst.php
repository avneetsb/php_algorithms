<?php
/**
 * Creates a binary search tree (BST) inserting each element at a time
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */


/**
 * Simple Node with value, left and right child
 *
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */
class Node {
	public $value;
	public $left;
	public $right;

	public function __construct($n) {
		$this->value = $n;
	}
}

class BinarySearchTree {

	private $root;

	public function __construct($n = null) {
		$this->root = ($n == null ? null : new Node($n));
	}

	/**
 	* Finds the proper position for the value and insert the node
 	*/
 	public function insert($n, $parent = null) {
 		if ($parent == null) {
			// There's no root, so the inserted element will be the root
 			if ($this->root == null) {
 				$this->root = new Node($n);
 				return;
 			}
 			$parent = $this->root;
 		}

 		if ($n < $parent->value) {
 			if ($parent->left != null) {
 				$this->insert($n, $parent->left);
 			} else {
 				$parent->left = new Node($n);
 			}
 		} else {
 			if ($parent->right != null) {
 				$this->insert($n, $parent->right);
 			} else {
 				$parent->right = new Node($n);
 			}
 		}
 	}

 	public function sortedElements() {
 		$elements = array();
 		$this->dfs($this->root, $elements);

 		return $elements;
 	}

 	private function dfs($root, &$elements) {
 		if ($root == null) return;
 		$this->dfs($root->left, $elements);
 		array_push($elements, $root->value);
 		$this->dfs($root->right, $elements);

 	}

 	public function getRoot() {
 		return $this->root;
 	}

}

/**
 * Creates the tree:
 *
 *           5
 *      3          7
 *  1      4    6     8
 *    2
 */
$bst = new BinarySearchTree();
$bst->insert(5);
$bst->insert(3);
$bst->insert(1);
$bst->insert(7);
$bst->insert(6);
$bst->insert(8);
$bst->insert(2);
$bst->insert(4);

$bst->sortedElements(); // returns [1, 2, 3,4,5,6,7,8]