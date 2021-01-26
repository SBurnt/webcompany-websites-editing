<?php 
$result = mail('machorich@list.ru', 'проверка', ' проверка ');

if($result)	

{
	echo 'все путем';
}
else
{
	echo 'что-то не так';
}

?>