<?php
//-------------------------- Configure estos parámetros --------------------------

// Asunto del mensaje
$asunto = 'Mensaje enviado desde el sitio JAMS TUTORIALES';

// Your email address. This is where the form information will be sent.
$emailadd = 'romulomiranda20092009@yahoo.com';

// Where to redirect after form is processed.
$url = 'contacto_gracias.html';

// Revisa que todos los campos estén llenos. Use '1' si ningún campo debe estar vacío. Use '0' si uno o todos los campos pueden estar vacíos.
$req = '0';

// --------------------------Do not edit below this line--------------------------
$text = "Datos del mensaje:\n\n";
$space = ' ';
$line = '
';
foreach ($_POST as $key => $value)
{
if ($req == '1')
{
if ($value == '')
{echo "$key está vacio";die;}
}
$j = strlen($key);
if ($j >= 20)
{echo "El nombre del elemento $key no debe ser mas grande que 20 caracteres";die;}
$j = 20 - $j;
for ($i = 1; $i <= $j; $i++)
{$space .= ' ';}
$value = str_replace('\n', "$line", $value);
$conc = "{$key}:$space{$value}$line";
$text .= $conc;
$space = ' ';
}
mail($emailadd, $asunto, $text, 'From: '.$emailadd.'');
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
?>
