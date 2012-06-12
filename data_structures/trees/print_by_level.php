<?php

/**
 * Prints a Binary Tree level by level (BFS).
 *
 * E.g.: for a tree like:
 *       5
 *    3      8
 * 2    4  7   9
 *
 * print:
 * 5
 * 38
 * 2479
 *
 *
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */

require 'bst.php';
/**
 * Use BFS to traverse the tree printing every level with an end-of-line after each one
 */
function printByLevel(BinarySearchTree $tree) {

	$root = $tree->getRoot();
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

		echo $item->value;

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

printByLevel($tree);