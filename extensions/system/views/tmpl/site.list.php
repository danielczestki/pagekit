<?php $this['sections']->start('toolbar', 'show') ?>
<div class="uk-float-left">

    <div class="uk-button-dropdown" data-uk-dropdown="{ mode: 'click' }">
        <button class="uk-button uk-button-primary" type="button"><?php echo __('Add') ?></button>
        <div class="uk-dropdown uk-dropdown-small">
            <ul class="uk-nav uk-nav-dropdown">
                <li ng-repeat="type in types" ng-if="!vm.isMounted(type)"><a ng-href="#/create/{{type.id}}">{{ type.label }}</a></li>
            </ul>
        </div>
    </div>

    <a class="uk-button pk-button-danger" ng-click="vm.deleteNodes()" ng-show="selected.length"><?php echo __('Delete') ?></a>
    <a class="uk-button" ng-click="vm.makeFrontpage()" ng-show="selected.length === 1"><?php echo __('Make Frontpage') ?></a>

</div>
<?php $this['sections']->end() ?>

<div class="uk-overflow-container">

    <div class="pk-table-fake pk-table-fake-header pk-table-fake-header-indent-nested">
        <div class="pk-table-width-minimum"><input type="checkbox" check-all="nodes" check-selected="selected"></div>
        <div class="pk-table-min-width-100">Title</div>
        <div class="pk-table-width-100 uk-text-center"></div>
        <div class="pk-table-width-100 uk-text-center">Status</div>
        <div class="pk-table-width-150">URL</div>
    </div>

</div>

<ul class="uk-nestable" data-uk-nestable ng-include="'site.item'" ng-init="parent = 0"></ul>