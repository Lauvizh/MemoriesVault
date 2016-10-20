<?php
// src/AppBundle/Utils/Slugger.php
namespace AppBundle\Utils;

class Slugger
{
    public function slugify($string,$len=0,$end="")
    {

	    // replace non letter or digits by -
		$data = preg_replace('~[^\\pL\d]+~u', '-', $string);

		// trim
		$data = trim($data, '-');

		// transliterate
		$data = iconv('utf-8', 'us-ascii//TRANSLIT', $data);

		// lowercase
		$data = strtolower($data);

		// remove unwanted characters
		$data = preg_replace('~[^-\w]+~', '', $data);

		if ($len>0) {
			$reduce = '';
			if (!empty($data) && !is_numeric($data)) {
				$reduce = trim(substr_unicode($data, 0,$len));
				if (strlen($end) > 0 && (strlen($data)+strlen($end)) > $len) {
					$reduce .= $end;
					}
				}
			elseif (is_numeric($data)) {
				$reduce = intval($data);
				}
			return $reduce;
			}


		if (empty($data)){
			return 'n-a';
			}

		return $data;

    }
}