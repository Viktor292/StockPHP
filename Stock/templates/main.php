<?php
$fileStyle=__DIR__ . '/style.css';
$fileTable=__DIR__ . '/table.html';
$fileTableInput=__DIR__ . '/input.html';
$actionListener=__DIR__ . '/addItem.php';
$scriptCalc = __DIR__ . '/calcScript.js';
$table = '<style type="text/css">' . file_get_contents($fileStyle) . '</style>';
$table .= file_get_contents($fileTable);
$table .= '<div class="scroll-table-body"><table><tbody>';

while ($row = mysqli_fetch_assoc($items)) {
    $table .= '<tr>';
    $table .= '<form action="index.php" method="POST"><input name="id" type="hidden" value="'. $row['id'] .'" name="input2"/><td><div><b>'. $row['id'] .'</b></div></td>'; 
    $table .= '<td><input pattern="^[a-zA-Z0-9_.-]*$" maxlength="40" minlength="1" type="text" name="name" value='. $row['name'] .'></td>'; 
    $optionD = '<td><select name="typenumber" class="selectTypeNum">
    <optgroup label="Standart">
        <option value="pcs">pcs</option>
    </optgroup>
    <optgroup label="Weight">
        <option value="gramm">gramm</option>
        <option value="kg">kg</option>
        <option value="tons">tons</option>
    </optgroup>
    <optgroup label="Volume">
        <option value="milleliters">milleliters</option>
        <option value="liters">liters</option>
        <option value="cube">cube</option>
    </optgroup>
    <optgroup label="length">
        <option value="mm">mm</option>
        <option value="cm">cm</option>
        <option value="meters">meters</option>
    </optgroup>
</select></td>';
    $optionD = str_replace('"'.$row['typenumber'].'"', '"'.$row['typenumber'].'" selected', $optionD);
    $table .= $optionD;
    $table .= '<td><input pattern="^[0-9]*$" maxlength="11" minlength="1" type="number" min="0" name="number" value='. $row['number'] .'></td>'; 
    $table .= '<td><input pattern="^[0-9]*$" maxlength="11" minlength="1" type="number" min="0" name="price" value='. $row['price'] .'></td>'; 
    $table .= '<td><input pattern="^[0-9]*$" maxlength="11" minlength="1" type="number" min="0" name="allprice" value='. $row['allprice'] .'></td>'; 
    $table .= '<td><input pattern="^[0-9]*$" maxlength="11" minlength="1" type="number" min="0" name="resultprice" value='. $row['resultprice'] .'></td>'; 
    $table .= '<td><button name="removeAction" type="submit">Remove</button>';   
    $table .= '<button name="editAction" type="submit">Edit</button></td></form>';   
    $table .= '</tr>';
}

$table .= '</tbody></table></div>';
$table .= file_get_contents($fileTableInput);
echo $table; 
echo '<script>'.file_get_contents($scriptCalc).'</script>';
?>
