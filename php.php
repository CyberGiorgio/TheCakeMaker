function add_row()
{
        $rowno=$("#cakeTable tr").length;
        $rowno=$rowno+1;
        $("#cakeTable tr:last").after("<tr id='row"+$rowno+"'> <td>Name Ingredient: <input type='text' name='ingredientName[]'  required></td><td>Type Ingredient:<select name='type[]' required> <option value='echo $row['type']'></option><option value='null'>-</option><option value='Dry'>Dry</option><option value='Wet'>Wet</option></select></td></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
}
function delete_row(rowno)
{
        $('#'+rowno).remove();
}
