<?php
/**
 * Basic way to calculate the roots of a quadratic equation
 *
 * In some places this formula is known as the Bhaskara's Formula
 *
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */

function quadratic_roots($a, $b, $c) {
	if ($a == 0) {
		throw new Exception("This is not a quadratic equation");
	}
	$delta = pow($b, 2) - 4 * $a * $c;	
	$roots = array();
	# if delta < 0, there are no real roots
	# if delta == 0 there's only one root (or two equal roots, if you prefer), 
	# otherwise, if delta > 0 there are two
	if ($delta >= 0) {
		$m1 = sqrt($delta);
		$roots[] = (-$b + $m1) / (2 * $a);
		if ($delta > 0) {
			$roots[] = (-$b - $m1) / (2 * $a);
		}
	}
	return $roots;
}

