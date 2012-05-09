<?php
/**
 * Given a node (root of a binary search tree), traverses it, in order, printing the first $max elements
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */

require 'bst.php';

function printWithDFS(Node $n = null, $max, &$actual = 0) {
	if ($n == null) return;

	printWithDFS($n->left, $max, $actual);

	if ($actual++ < $max) {
		echo $n->value;
		printWithDFS($n->right, $max, $actual);
	}
}

/**
 * The code bellow creates the following tree:
 *      5
 *   3      8
 * 2   4  7   9
 */
$tree = new BinarySearchTree();
$tree->insert(5);
$tree->insert(3);
$tree->insert(8);
$tree->insert(2);
$tree->insert(4);
$tree->insert(7);
$tree->insert(9);

$in = fopen('php://STDIN', 'r');
while( ($n = (int)fgets($in)))
	printWithDFS($tree->getRoot(), $n); //Print the first $n elements
