<h2>Table of Contents</h2>
<hr/>

<?php foreach($ems_tree as $pdf_tree_item) : ?>
    <p><?php echo $language[$pdf_tree_item[0]];?></p>
    <ul>
        <?php foreach($pdf_tree_item[1] as $pdf_sub_tree_item): ?>
            <?php $entry = (isset($titles[$pdf_sub_tree_item]) ? $titles[$pdf_sub_tree_item] : $language[$pdf_sub_tree_item]); ?>
            <li><?php echo $entry;?></li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>

<pagebreak />