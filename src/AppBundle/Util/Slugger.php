<?php

namespace AppBundle\Util;

class Slugger
{
    /**
     * This function is copied from "The perfect PHP clean URL generator"
     * http://cubiq.org/the-perfect-php-clean-url-generator
     */
    public function slugify($string, $delimiter = '-')
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $slug = preg_replace('/[^a-zA-Z0-9\/_|+ -]/', '', $slug);
        $slug = strtolower(trim($slug, $delimiter));
        $slug = preg_replace('/[\/_|+ -]+/', $delimiter, $slug);

        return $slug;
    }
}

