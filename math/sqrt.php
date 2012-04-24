<?php

define ('DELTA', 0.00001);
/**
 * Function to calculate an approximation of the square root with a maximum DELTA
 * of difference using the binary search principle.
 *
 * @author Felipe Ribeiro <felipernb@gmail.com>
 */
function my_sqrt($n) {
	$upperBound = $n;
	$lowerBound = 0;

	do {
		$x = ($upperBound - $lowerBound) / 2 + $lowerBound;
		$square = $x * $x;
		if ($square < $n) $lowerBound = $x;
		else $upperBound = $x;
	} while (abs($square - $n) > DELTA);

	// In case of perfect squares
	$roundedX = round($x);
	if ($roundedX * $roundedX == $n) {
		$x = $roundedX;
	}

	return $x;
}

