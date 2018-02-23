<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if (!function_exists('create_slug'))
{
    function create_slug($string) {
                $search = array (
                    '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
                    '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
                    '#(ì|í|ị|ỉ|ĩ)#',
                    '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
                    '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
                    '#(ỳ|ý|ỵ|ỷ|ỹ)#',
                    '#(đ)#',
                    '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
                    '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
                    '#(Ì|Í|Ị|Ỉ|Ĩ)#',
                    '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
                    '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
                    '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
                    '#(Đ)#',
                    "/[^a-zA-Z0-9\-\_]/",
                    ) ;
                $replace = array (
                    'a',
                    'e',
                    'i',
                    'o',
                    'u',
                    'y',
                    'd',
                    'A',
                    'E',
                    'I',
                    'O',
                    'U',
                    'Y',
                    'D',
                    '-',
                    ) ;
                $string = preg_replace($search, $replace, $string);
                $string = preg_replace('/(-)+/', '-', $string);
                $string = strtolower($string);
                $string = trim($string,'-');
                return $string;
          }
}
if (!function_exists('unNumber_Format'))
{
  function unNumber_Format($number)
  {
    return str_replace(',', '',$number);
  }
}
if ( ! function_exists('redirect_back'))
{
    function redirect_back()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        exit;
    }
}
