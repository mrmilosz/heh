<?php
// This literally just replaces any occurence of \heh with the HTML for a giant HEH (class "huge" defined in static CSS file included from main layout)
function hehify($string) {
	return str_replace('\heh', '<span class="huge">heh</span>', $string);
}
