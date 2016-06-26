<table class="table table-striped">
    <?php foreach($resources as $resourceItem): ?>
        <tr>
            <!-- Edit record -->
            <td>
                <?php resource_item($submitUrl,
                    $resourceDeleteUrl,
                    $resourceCategory,
                    $resourceItem->resource_name,
                    $resourceItem->resource_category,
                    $resourceItem->resource_url,
                    $resourceItem->id
                );
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td>
            <!-- New record -->
            <?php resource_item($submitUrl, $resourceDeleteUrl, $resourceCategory); ?>
        </td>
    </tr>
</table>