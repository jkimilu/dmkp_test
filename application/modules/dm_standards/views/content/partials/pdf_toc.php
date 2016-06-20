<h2>Table of Contents</h2>
<hr/>

<?php foreach($ems_tree as $pdf_tree_item) : ?>
    <p><?php echo $language[$pdf_tree_item[0]];?></p>
    <ul>
        <?php foreach($pdf_tree_item[1] as $pdf_sub_tree_item): ?>
            <li><?php echo $language[$pdf_sub_tree_item];?></li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>

<pagebreak />