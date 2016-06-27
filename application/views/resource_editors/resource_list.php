<?php if($resources) : ?>
    <h4>Edit existing resources</h4>
<?php endif; ?>
<table class="table table-striped">
    <?php if($resources) : ?>
        <?php foreach($resources as $resourceItem): ?>
            <tr>
                <!-- Edit record -->
                <td>
                    <?php resource_item($resourceMainId,
                        $submitUrl,
                        $resourceDeleteUrl,
                        $resourceCategory,
                        $resourceItem->resource_name,
                        $resourceItem->resource_type,
                        $resourceItem->resource_url,
                        $resourceItem->id
                    );
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <td>
            <div class="well well-small">
                <!-- New record -->
                <h4>Add a new resource</h4>
                <?php resource_item($resourceMainId, $submitUrl, $resourceDeleteUrl, $resourceCategory); ?>
            </div>
        </td>
    </tr>
</table>