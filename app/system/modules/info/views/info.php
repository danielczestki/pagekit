<?php $view->script('info', 'app/system/modules/info/app/bundle/info.js', 'vue') ?>

<div id="info" class="uk-grid pk-grid-large" data-uk-grid-margin>
    <div class="pk-width-sidebar">

        <div class="uk-panel">
            <ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
                <li class="uk-active"><a> <i class="uk-icon-hdd-o uk-icon-small uk-margin-right"></i>{{ 'System' | trans }}</a></li>
                <li><a><i class="uk-icon-code uk-icon-small uk-margin-right"></i> {{ 'PHP' | trans }}</a></li>
                <li><a><i class="uk-icon-database uk-icon-small uk-margin-right"></i> {{ 'Database' | trans }}</a></li>
                <li><a><i class="uk-icon-file-text-o uk-icon-small uk-margin-right"></i> {{ 'Permissions' | trans }}</a></li>
            </ul>
        </div>

    </div>
    <div class="uk-flex-item-1">

        <ul id="tab-content" class="uk-switcher uk-margin">
            <li>
                <h2>{{ 'System' | trans }}</h2>
                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover">
                        <thead>
                            <tr>
                                <th class="pk-table-width-150">{{ 'Setting' | trans }}</th>
                                <th>{{ 'Value' | trans }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="uk-text-nowrap">{{ 'Pagekit Version' | trans }}</td>
                                <td>{{ info.version }}</td>
                            </tr>
                            <tr>
                                <td class="uk-text-nowrap">{{ 'Web Server' | trans }}</td>
                                <td class="pk-table-text-break">{{ info.server }}</td>
                            </tr>
                            <tr>
                                <td class="uk-text-nowrap">{{ 'User Agent' | trans }}</td>
                                <td class="pk-table-text-break">{{ info.useragent }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>
            <li>
                <h2>{{ 'PHP' | trans }}</h2>
                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover">
                        <thead>
                            <tr>
                                <th class="pk-table-width-150">{{ 'Setting' | trans }}</th>
                                <th>{{ 'Value' | trans }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ 'Version' | trans }}</td>
                                <td>{{ info.phpversion }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Handler' | trans }}</td>
                                <td>{{ info.sapi_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Built On' | trans }}</td>
                                <td class="pk-table-text-break">{{ info.php }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Extensions' | trans }}</td>
                                <td class="pk-table-text-break">{{ info.extensions }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>
            <li>
                <h2>{{ 'Database' | trans }}</h2>
                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover">
                        <thead>
                            <tr>
                                <th class="pk-table-width-150">{{ 'Setting' | trans }}</th>
                                <th>{{ 'Value' | trans }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ 'Driver' | trans }}</td>
                                <td>{{ info.dbdriver }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Version' | trans }}</td>
                                <td>{{ info.dbversion }}</td>
                            </tr>
                            <tr>
                                <td>{{ 'Client' | trans }}</td>
                                <td class="pk-table-text-break">{{ info.dbclient }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>
            <li>
                <h2>{{ 'Permission' | trans }}</h2>
                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover">
                        <thead>
                            <tr>
                                <th>{{ 'Path' | trans }}</th>
                                <th class="pk-table-width-100">{{ 'Status' | trans }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-repeat="info.directories">
                                <td>{{ $key }}</td>
                                <td class="uk-text-success" v-show="$value">{{ 'Writable' | trans }}</span></td>
                                <td class="uk-text-danger" v-show="!$value">{{ 'Unwritable' | trans }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>

    </div>
</div>
