<?php
class DateChange
{
    public static $months = array(
	    1=> 'января',  
	    2=> 'февраля', 
	    3=> 'марта',   
	    4=> 'апреля',  
	    5=> 'мая',     
	    6=> 'июня',    
	    7=> 'июля',    
	    8=> 'августа', 
	    9=> 'сентября',
	    10=> 'октября', 
	    11=> 'ноября',  
	    12=> 'декабря', 
    ),$translation = array(
           "am" => "дп",
           "pm" => "пп",
           "AM" => "ДП",
           "PM" => "ПП",
           "Monday" => "Понедельник",
           "Mon" => "Пн",
           "Tuesday" => "Вторник",
           "Tue" => "Вт",
           "Wednesday" => "Среда",
           "Wed" => "Ср",
           "Thursday" => "Четверг",
           "Thu" => "Чт",
           "Friday" => "Пятница",
           "Fri" => "Пт",
           "Saturday" => "Суббота",
           "Sat" => "Сб",
           "Sunday" => "Воскресенье",
           "Sun" => "Вс",
           "January" => "января",
           "Jan" => "янв",
           "February" => "февраля",
           "Feb" => "фев",
           "March" => "марта",
           "Mar" => "мар",
           "April" => "апреля",
           "Apr" => "апр",
           "May" => "мая",
           "May" => "мая",
           "June" => "июня",
           "Jun" => "июн",
           "July" => "июля",
           "Jul" => "июл",
           "August" => "августа",
           "Aug" => "авг",
           "September" => "сентября",
           "Sep" => "сен",
           "October" => "октября",
           "Oct" => "окт",
           "November" => "ноября",
           "Nov" => "ноя",
           "December" => "декабря",
           "Dec" => "дек",
           "st" => "ое",
           "nd" => "ое",
           "rd" => "е",
           "th" => "ое");
    public static function ChangeDate($date,$flag=0)
    {
        $array = date_parse($date);
	$month = isset(self::$months[$array['month']])?self::$months[$array['month']]:0;
	if($flag)
	    return $array['day'].' '.$month.' '.$array['year'];
	//return ($array['day']>9?$array['day']:'0'.$array['day']).' '.$month.' '.$array['year'].' года';
	else    
	return $array['day'].'.'.$array['month'].'.'.$array['year'];
    
    }
    public static function ReverseDate($date)
    {
	$text = strtr($date, array_flip(self::$translation));
	return date('Y-m-d',  strtotime($text));
    }
}
?>
