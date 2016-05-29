<?php

namespace Component\Navbar;

class NavWalker extends \Walker_Nav_Menu
{
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent";
		$output .= '<div class="navbar-subnav"> <ul class="navbar-subnav-list">';
		$output .= "\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
	}
}