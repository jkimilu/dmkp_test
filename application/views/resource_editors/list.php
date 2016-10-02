<?php require_once(__DIR__.'/../../core/includes/ResourceDataModel.php'); ?>

<table <?php if(isset($tableClass)) { ?> class="<?php echo $tableClass; ?>" <?php  } else { ?> class="table table-striped" <?php } ?>  >
    <tr>
        <th class="th_grouping">Grouping</th>
        <th class="th_guidance">Guidance Descriptors</th>
        <th class="th_links">Links &amp; Resources</th>
        <?php if($latestVersionEnabled) : ?>
            <th class="th_version">Latest Version</th>
        <?php endif; ?>
        <?php if($contactPersonEnabled) : ?>
            <th class="th_version">Contact Person</th>
        <?php endif; ?>
        <?php if($gateKeeperEnabled) : ?>
            <th class="th_gate">Gate Keeper</th>
        <?php endif; ?>
        <?php if($showActionFields) : ?>
            <th>Extra Actions</th>
        <?php endif; ?>
    </tr>

    <?php if($records) : ?>
        <?php foreach($records as $record): ?>
            <tr>
                <td><?php echo $groups[$record->object->{ResourceDataModel::$fieldSpecGroup}]; ?></td>

                <td>
                    <h5><?php echo $record->object->{ResourceDataModel::$fieldSpecGuidanceDescriptorsTitle}; ?></h5>
                    <p class="desc"><?php echo $record->object->{ResourceDataModel::$fieldSpecGuidanceDescriptorsText}; ?></p>
                </td>

                <td>
                    <?php foreach($record->resources as $resource): ?>
                        <?php if($showActionFields) : ?>
                            <div>
                        <?php endif; ?>
                        <?php if($resource->resource_type == ResourceDataModel::$resourceIsFile): ?>
                            <a target="_blank" href="<?php echo $resource->resource_url; ?>"><i class="fa fa-file"></i> <?php echo $resource->resource_name ;?></a>
                        <?php elseif($resource->resource_type == ResourceDataModel::$resourceIsUrl): ?>
                            <a target="_blank" href="<?php echo $resource->resource_url; ?>"><i class="fa fa-link"></i> <?php echo $resource->resource_name ;?></a>
                        <?php endif; ?>
                        <?php if($showActionFields) : ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>

                <?php if($latestVersionEnabled) : ?>
                    <td><?php echo $record->object->{ResourceDataModel::$fieldSpecVersion}; ?></td>
                <?php endif; ?>

                <?php if($contactPersonEnabled) : ?>
<?php
    $contactPerson = isset($contactPersons['persons'][$record->object->{ResourceDataModel::$fieldSpecKeyContactPerson}]) ? $contactPersons['persons'][$record->object->{ResourceDataModel::$fieldSpecKeyContactPerson}] : '';
    $contactPersonLink = isset($contactPersons['links'][$record->object->{ResourceDataModel::$fieldSpecKeyContactPerson}]) ? $contactPersons['links'][$record->object->{ResourceDataModel::$fieldSpecKeyContactPerson}] : '';
?>
                    <td><a target="_blank" href="<?php echo $contactPersonLink; ?>"><?php echo $contactPerson; ?></a></td>
                <?php endif; ?>

<?php
    $gateKeeper = isset($gateKeepers['persons'][$record->object->{ResourceDataModel::$fieldSpecGateKeeper}]) ? $gateKeepers['persons'][$record->object->{ResourceDataModel::$fieldSpecGateKeeper}] : '';
    $gateKeeperLink = isset($gateKeepers['links'][$record->object->{ResourceDataModel::$fieldSpecGateKeeper}]) ? $gateKeepers['links'][$record->object->{ResourceDataModel::$fieldSpecGateKeeper}] : '';
?>

                <?php if($gateKeeperEnabled) : ?>
                    <td><a target="_blank" href="<?php echo $gateKeeperLink; ?>"><?php echo $gateKeeper; ?></a></td>
                <?php endif; ?>

                <?php if($showActionFields) : ?>
                    <td>
                        <a href="<?php echo $resourceResourcesUrl.'/'.$record->id; ?>" class="btn btn-primary">Resources</a>
                        <a href="<?php echo $resourceEditUrl.'/'.$record->id; ?>" class="btn btn-primary">Edit</a>
                        <a id="delete_<?php echo $record->id; ?>" href="<?php echo $resourceDeleteUrl.'/'.$record->id; ?>" class="btn btn-danger">Delete</a>
                        <a href="<?php echo $resourceVisibilityUrl.'/'.$record->id.'/'.($record->visible ? '0' : '1'); ?>" class="btn btn-primary"><?php echo($record->visible ? 'Set Invisible' : 'Set Visible'); ?></a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php if($showActionFields) : ?>
    <div>
        <a href="<?php echo $resourceAddUrl; ?>" class="btn btn-primary">Add new resource</a>
    </div>
<?php endif; ?>

<div class="pagination" style="margin-top: 10px;">
    <ul>
        <?php echo($pagination); ?>
    </ul>
</div>