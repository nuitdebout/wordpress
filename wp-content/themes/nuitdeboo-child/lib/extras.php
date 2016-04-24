<?php

function nd_get_revolutionary_date()
{
	$days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

	$start = new \DateTime('2016-03-31');
	$now = new \DateTime();
	$diff = $now->diff($start);
	$diffDays = $diff->format('%a');
	$dayNumber = $diffDays + 31;

	return sprintf('%s %s Mars', $days[$now->format('w')], $dayNumber);
}