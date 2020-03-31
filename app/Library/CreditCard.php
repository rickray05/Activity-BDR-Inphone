<?php
namespace App\Library;

class CreditCard
{ 
    private static $_number = null;
    private static $_error = null;

    static function Set($number = NULL){

      if (!is_null($number))                  // anything passed?
        return static::IsValid($number);     // yes, check/update the number

      $this->_number  = NULL;
      $this->_error   = 'ERROR_NOT_SET';
      return 'ERROR_NOT_SET';
        
    }

   static function IsValid($number = NULL)
   {
    if (!is_null($number))
    {

      static::$_number  = NULL;
      static::$_error   = 'ERROR_NOT_SET';

      $k = strlen($number);

      $value = '';                                            // init copy buffer
      for ($i = 0; $i < $k; $i++)                             // check input
      {
        $c = $number[$i];                                   // grab a character

        if (ctype_digit($c))                                // is a digit?
          $value .= $c;                                   // yes, save it

        elseif (!ctype_space($c) && !ctype_punct($c))
        {
          static::$_error = 'ERROR_INVALID_CHAR';
          break;
        }
      }

      $number = $value;

      if($number[0] == '4'){ $lencat = 2;}
      if($number[0] == '5'){ $lencat = 2;}
      if($number[0] == '3'){ $lencat = 4;}
      if($number[0] == '2'){ $lencat = 3;}

      if (!static::_check_length(strlen($number),$lencat)) {
        {static::$_error  = 'ERROR_INVALID_LENGTH';}
      } else {
        static::$_number = $number;
        static::$_error  = true;
      }
    } else {
      {static::$_error = 'ERROR_INVALID_CHAR';}
    }

    return static::$_error;
  }

  static function _check_length($length,$category)
  {
    if ($category == 0) {return (($length == 13) || ($length == 16));}
    if ($category == 1) {return (($length == 16) || ($length == 18) || ($length == 19));}
    if ($category == 2) {return ($length == 16);}
    if ($category == 3) {return ($length == 15);}
    if ($category == 4) {return ($length == 14);}

    return 1;
  }

  static function Get()
  {return @static::$_number;}


}