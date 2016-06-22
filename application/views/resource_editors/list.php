<?php require_once(__DIR__.'/../../core/includes/ResourceDataModel.php'); ?>

<table class="table table-striped">
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
        <th>Extra Actions</th>
    </tr>
    <?php foreach($records as $record): ?>
        <tr>
            <td><?php echo $groups[$record->object->{ResourceDataModel::$fieldSpecGroup}]; ?></td>

            <td>
                <h5><?php echo $record->object->{ResourceDataModel::$fieldSpecGuidanceDescriptorsTitle}; ?></h5>
                <p class="desc"><?php echo $record->object->{ResourceDataModel::$fieldSpecGuidanceDescriptorsText}; ?></p>
            </td>

            <td>
                <?php foreach($record->resources as $resource): ?>
                    <?php if($resource->resource_type == ResourceDataModel::$resourceIsFile): ?>
                        <a target="_blank" href="<?php echo site_url('dmkp/download_file/'.$resource->resource_doc_reference) ?>"><i class="fa fa-file"></i> <?php echo $resource->resource_name ;?></a>
                    <?php elseif($resource->resource_type == ResourceDataModel::$resourceIsUrl): ?>
                        <a target="_blank" href="<?php echo $resource->resource_url; ?>"><i class="fa fa-link"></i> <?php echo $resource->resource_name ;?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>

            <?php if($latestVersionEnabled) : ?>
                <td><?php echo $record->object->{ResourceDataModel::$fieldSpecVersion}; ?></td>
            <?php endif; ?>

            <?php if($contactPersonEnabled) : ?>
                <td><a target="_blank" href="<?php echo $contactPersons['links'][$record->object->{ResourceDataModel::$fieldSpecKeyContactPerson}]; ?>"><?php echo $contactPersons['persons'][$record->object->{ResourceDataModel::$fieldSpecKeyContactPerson}]; ?></a></td>
            <?php endif; ?>

            <?php if($gateKeeperEnabled) : ?>
                <td><a target="_blank" href="<?php echo $gateKeepers['links'][$record->object->{ResourceDataModel::$fieldSpecGateKeeper}]; ?>"><?php echo $gateKeepers['persons'][$record->object->{ResourceDataModel::$fieldSpecGateKeeper}]; ?></a></td>
            <?php endif; ?>

            <td>
                <a href="<?php echo $resourceEditUrl; ?>" class="btn btn-primary">Edit</a>
                <a href="<?php echo $resourceDeleteUrl; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="<?php echo $resourceAddUrl; ?>" class="btn btn-primary">Add new resource</a>