<template>

    <div class="uk-grid pk-grid-large uk-form-stacked" data-uk-grid-margin>
        <div class="uk-flex-item-1">

            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" type="text" name="page[title]" placeholder="{{ 'Enter Title' | trans }}" v-model="page.title">
            </div>

            <div class="uk-form-row">
                <v-editor name="page[content]" value="{{@ page.content }}" options="{{ {markdown : page.data.markdown} }}"></v-editor>
            </div>

        </div>
        <div class="pk-width-sidebar">

            <div class="uk-panel">

                <div class="uk-form-row">
                    <label for="form-navigation-title" class="uk-form-label">{{ 'Navigation Title' | trans }}</label>
                    <div class="uk-form-controls">
                        <input id="form-navigation-title" class="uk-form-width-large" type="text" name="node[title]" v-model="node.title" v-valid="required">
                        <div class="uk-form-help-block uk-text-danger" v-show="form['node[title]'].invalid">{{ 'Invalid name.' | trans }}</div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="form-slug" class="uk-form-label">{{ 'Slug' | trans }}</label>
                    <div class="uk-form-controls">
                        <input id="form-slug" class="uk-form-width-large" type="text" name="node[slug]" v-model="node.slug">
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="form-status" class="uk-form-label">{{ 'Status' | trans }}</label>
                    <div class="uk-form-controls">
                        <select id="form-status" class="uk-form-width-large" v-model="node.status">
                            <option value="0">{{ 'Disabled' | trans }}</option>
                            <option value="1">{{ 'Enabled' | trans }}</option>
                        </select>
                    </div>
                </div>


                <div class="uk-form-row">
                    <span class="uk-form-label">{{ 'Options' | trans }}</span>
                    <div class="uk-form-controls">
                        <label><input type="checkbox" name="page[data][title]" v-model="page.data.title"> {{ 'Show Title' | trans }}</label>
                    </div>
                    <div class="uk-form-controls">
                        <label><input type="checkbox" name="page[data][markdown]" v-model="page.data.markdown"> {{ 'Enable Markdown' | trans }}</label>
                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

    module.exports = {

        props: ['node', 'form', 'type'],

        section: {
            name: 'page-settings',
            label: 'Settings',
            priority: 0,
            active: 'page'
        }

    };

</script>
