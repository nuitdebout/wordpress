<?php

namespace Component\Navbar;

class NavWalker extends \Walker_Nav_Menu
{
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent";
		if ($depth === 0) {
			$output .= '<div class="navbar-subnav">';
		}
		$output  .= '<ul class="navbar-subnav-list navbar-subnav-list--depth-' . $depth . '">';
		$output .= "\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>";
		if ($depth === 0) {
			$output .= '</div>';
		}
		$output .= "\n";
	}
}