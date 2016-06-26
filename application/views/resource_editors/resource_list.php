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
            <!-- New record -->
            <?php resource_item($resourceMainId, $submitUrl, $resourceDeleteUrl, $resourceCategory); ?>
        </td>
    </tr>
</table>