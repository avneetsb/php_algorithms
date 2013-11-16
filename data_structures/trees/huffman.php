<?php
class MinHeapPriorityQueue extends SPLPriorityQueue {
	/**
	 * Just inverts the default behavior of PHP's native PriorityQueue
	 * that is based on a MaxHeap
	 */
	public function compare($p1, $p2) {
		return parent::compare($p2, $p1);
	}
}

class Node {
	public $value;
	public $weight;
	public $left;
	public $right;

	public function __toString() {
		return sprintf("(%c, %d)", ($this->value != null? $this->value : ord('-')), $this->weight);
	}

}

function printByLevel(Node $root) {

	$queue = new SPLQueue();
	$queue->enqueue($root);
	$currentLevel = 0;
	$root->level = $currentLevel;

	while (!$queue->isEmpty()) {
		$item = $queue->dequeue();

		if ($item->level != $currentLevel) {
			echo "\n";
			$currentLevel = $item->level;
		}

		echo $item;

		$childLevel = $currentLevel + 1;
		if ($item->left) {
			$item->left->level = $childLevel;
			$queue->enqueue($item->left);
		}
		if ($item->right) {
			$item->right->level = $childLevel;
			$queue->enqueue($item->right);
		}
	}
}

class HuffmanCode {

	private $text;

	public function __construct($text) {
		$this->text = $text;
	}

	public function buildTree() {

		$chars = count_chars($this->text, 1);

		$priorityQueue = new MinHeapPriorityQueue();

		foreach ($chars as $c => $freq) {
			$leafNode = new Node;
			$leafNode->value = $c;
			$leafNode->weight = $freq;
			$priorityQueue->insert($leafNode, $freq);
		}

		while ($priorityQueue->count() > 1) {
			$internalNode = new Node;
			$internalNode->right = $priorityQueue->extract();
			$internalNode->left = $priorityQueue->extract();
			$internalNode->weight = $internalNode->left->weight + $internalNode->right->weight;

			$priorityQueue->insert($internalNode, $internalNode->weight);
		}

		$root = $priorityQueue->extract();

		return $root;
	}

	public function generateTable() {
		$root = $this->buildTree();
		$table = array();
		$this->generateCode($root, $table);
		return $table;
	}

	private function generateCode(Node $node, &$table, $prefix = '') {
		if ($node->value) {
			$table[chr($node->value)] = $prefix;
		}
		if ($node->left) {
			$this->generateCode($node->left, $table, $prefix . '0');
		}
		if ($node->right) {
			$this->generateCode($node->right, $table, $prefix . '1');
		}
	}

}
$huffman = new HuffmanCode("this is an example of a huffman tree");
var_dump($huffman->generateTable());
