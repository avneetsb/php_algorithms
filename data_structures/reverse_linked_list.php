<?php

/**
 * Given a simple linked list, reverse it to make the tail the new head
 *
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */


/**
 * Node of a simple linked list
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */
class Node {
	public $value;
	public $next;

	public function __construct($value) {
		$this->value = $value;
	}
}


/**
 * Using a stack, O(n) in time and O(n) in space
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */
function reverse_linked_list0(Node $n) {
	$stack = new SPLStack();
	while($n != null) {
		$stack->push($n);
		$n = $n->next;
	}
	$head = $stack->pop();
	$n = $head;
	while(!$stack->isEmpty()) {
		$n->next = $stack->pop();
		$n = $n->next;
	}
	$n->next = null;
	return $head;
}

/**
 * Using recursion, O(n) in time and O(n) in space due to the call stack
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */
function reverse_linked_list1(Node $n) {
	if (!$n->next) {
		return $n;
	}
	// (n)->(next)->(next.next)->...
	$next = $n->next;
	$newHead = reverse_linked_list1($next);
	// (n) (next)<-(next.next)<-...<-(newHead)
	$next->next = $n;
	// (n)<-(next)<-(next.next)<-...<-(newHead)
	$n->next = null;
	// .<-(n)<-(next)<-(next.next)<-...<-(newHead)
	return $newHead;
}

/**
 * Using iteration, O(n) in time and O(1) in space
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */
function reverse_linked_list2(Node $n) {
	//(n)->(next)->...
	$next = $n->next;
	$n->next = null;
	//(n) (next)->...
	while($next != null) {
		$tmp = $next->next;
		//...<-(n) (next)->(tmp)->...
		$next->next = $n;
		//...<-(n)<-(next) (tmp)->...
		$n = $next;
		$next = $tmp;
		//...<-(n') (next')->(tmp')->...
	}
	return $n; //new head
}

