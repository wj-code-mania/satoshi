<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('obj2arr'))
{
    function obj2arr($ojb)
    {
        $ojb = serialize($ojb);
        $ojb = str_replace('O:8:"stdClass"', 'a', $ojb);
        return unserialize($ojb);
    }
}

if ( ! function_exists('echo_rating_stars'))
{
    function echo_rating_stars($mark)
    {
        echo '<div class="rating">';
        for($i=0;$i<5;$i++)
        {
            if($i<(int)$mark)
                echo '<label style="color:#23527c"><i class="fa fa-star"></i></label>';
            else
                echo '<label style="color:#ccc"><i class="fa-star-o"></i></label>';
        }
        echo '</div>';
    }
}
if ( ! function_exists('echo_js_include'))
{
    function echo_js_include($str_url)
    {
        echo '<script src="'. base_url($str_url) . '" type="text/javascript"></script>'."\r\n";
    }
}

if ( ! function_exists('echo_css_include'))
{
    function echo_css_include($str_url, $style_id="")
    {
        $str_css_include = '<link href="'. base_url($str_url) . '" rel="stylesheet" type="text/css"';
        if ($style_id != "") {
            $str_css_include .= ' id="'. $style_id . '" ';
        }
        $str_css_include .= '/>'."\r\n";
        echo $str_css_include;
    }
}

if ( ! function_exists('remove_zeros'))
{
    function remove_zeros($string) {
        if (strpos($string, '.') !== false) {
            $last_ch = substr($string, -1);
            while ($last_ch == '0' || $last_ch == '.') {
                $string = substr($string, 0, -1);
                if ($last_ch == '.') {
                    break;
                }
                
                $last_ch = substr($string, -1);
            }
        }

        return $string;
    }
}

if ( ! function_exists('round_value_by_template'))
{
    function round_value_by_template($value)
    {
        if (!isset($value) || $value == '')
            return 0;
        return remove_zeros(number_format(round($value, 3), 3));
    }
}

if ( ! function_exists('round_value_no_zero'))
{
    function round_value_no_zero($value)
    {
        if (!isset($value) || $value == 0)
            return "";
        return remove_zeros(round($value, 3));
    }
}

if ( ! function_exists('round_value_no_zero2'))
{
    function round_value_no_zero2($value)
    {
        if (!isset($value))
            return "";
        return remove_zeros(round($value, 2));
    }
}

if ( ! function_exists('round_value_no_zero1'))
{
    function round_value_no_zero1($value)
    {
        if (!isset($value))
            return "";
        return remove_zeros(round($value, 1));
    }
}

if ( ! function_exists('round_value'))
{
    function round_value($value)
    {
        if ($value == 0)
            return '';
        return round($value, 3);
    }
}
if ( ! function_exists('format_from_kb'))
{
    function format_from_kb($value)
    {
        $byteSize = $value*1024;
		if($byteSize < 1024)
			$size = ceil($byteSize)." Byte";
		else if($byteSize < (1024*1024))
			$size = ceil($byteSize/1024)." KB";
		else
			$size = ceil($byteSize/1024/1024)." MB";
		return $size;
    }
}