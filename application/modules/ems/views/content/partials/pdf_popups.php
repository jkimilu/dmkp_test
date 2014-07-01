<pagebreak />
<h2>Footnotes</h2>
<hr/>
<table style="border: 1px solid #000000;">
    <?php foreach($popus as $popup) : ?>
    <tr>
        <td><?php echo ($popup->title); ?></td>
        <td><?php echo ($popup->popup_content); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<pagebreak />