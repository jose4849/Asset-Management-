<?php
$col = 0;
if (isset($results[0])) {
    $tdhead = $results[0];
}
?>
<?php
if (isset($title)) {
    ?>
    <h1 style="text-align:center">Lion Asset Managemnt</h1>
    <h3 style="text-align:center" ><?php echo $title; ?></h3>
    <p style="text-align:center;width:100%"><?php echo ADDRESS; ?></p>

<? }
?>
<?php
if (isset($css)) {
    echo $css;
}
?>    
<table class="table table-striped table-advance table-hover" >
    <tbody>

        <tr>
            <?php foreach ($tdhead as $key => $head) { ?>
                <th class='printhead' style='text-transform: uppercase;'>
                    <?php
                    echo str_replace('_', ' ', $key);
                    $col++;
                    ?> 
                </th>
            <?php } ?>
        </tr>

        <?php foreach ($results as $result) { ?>
            <tr>
                <?php foreach ($result as $res) { ?>

                    <td >
                        <?php echo $res; ?> 
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="<?php echo $col; ?>" text-align="center"><?php
                if(isset($view)){
                if ($view == 'print') {
                    echo '';
                } else {
                    echo $link;
                }}
                ?></td> 
        </tr>              
    </tbody>
</table>