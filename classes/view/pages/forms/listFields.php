<?php
if(!isset($field)){
		$var = new Field;
}

echo "<ul>";
//para cada campo macro chama o listar campos
foreach ($fields as &$var) {
	listFields($var);
}
echo "</ul>";

public function listFields($field){
	
	if($field == global $field->getParent()){
		$checked = "CHECKED";
	}
	echo "<li><input type=\"radio\" name=\"id\" value=\"" . $field->getID() . "\"" . $checked . ">" . $field->getName() "</li>";
	echo "<ul>";
	foreach ($field->getChildren() as &$child) {
	echo " <li><input type=\"radio\" name=\"id\" value=\"" . $child->getID() . "\"" . $checked . ">" . $child->getName() "</li>";
		listFields($child);
	}
	echo "</ul>";
}
?>