<template>

    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>

            <h2 class="uk-margin-remove">{{ 'Cache' | trans }}</h2>

        </div>
        <div data-uk-margin>

            <button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>

        </div>
    </div>

    <div class="uk-form-row">
        <span class="uk-form-label">{{ 'Cache' | trans }}</span>
        <div class="uk-form-controls uk-form-controls-text">
            <p class="uk-form-controls-condensed" v-repeat="cache: caches">
                <label><input type="radio" value="{{ $key }}" v-model="config.caches.cache.storage" v-attr="disabled: !cache.supported"> {{ cache.name }}</label>
            </p>
        </div>
    </div>

    <div class="uk-form-row">
        <span class="uk-form-label">{{ 'Developer' | trans }}</span>
        <div class="uk-form-controls uk-form-controls-text">
            <p class="uk-form-controls-condensed">
                <label><input type="checkbox" value="1" v-model="config.nocache"> {{ 'Disable cache' | trans }}</label>
            </p>
            <p>
                <button class="uk-button uk-button-primary" v-on="click: open">{{ 'Clear Cache' | trans }}</button>
            </p>
        </div>
    </div>

    <div class="uk-modal" v-el="modal">
        <div class="uk-modal-dialog uk-form-stacked">

            <div class="uk-modal-header">
                <h2>{{ 'Select Cache to Clear' | trans }}</h2>
            </div>

            <div class="uk-form-row">
                <p class="uk-form-controls-condensed">
                    <label><input type="checkbox" v-model="clear.cache"> {{ 'System Cache' | trans }}</label>
                </p>
                <p class="uk-form-controls-condensed">
                    <label><input type="checkbox" v-model="clear.temp"> {{ 'Temporary Files' | trans }}</label>
                </p>
            </div>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-link uk-modal-close" type="submit" v-on="click: cancel">{{ 'Cancel' | trans }}</button>
                <button class="uk-button uk-button-link" type="submit" v-on="click: clear">{{ 'Clear' | trans }}</button>
            </div>

        </div>
    </div>

</template>

<script>

    module.exports = {

        section: {
            name: 'system/cache',
            label: 'Cache',
            icon: 'uk-icon-bolt',
            priority: 30
        },

        props: ['config', 'options'],

        data: function() {
            return {
                caches: window.$caches,
                clear: {}
            };
        },

        methods: {

            open: function(e) {
                e.preventDefault();

                this.$set('clear', { cache: true });

                this.modal = UIkit.modal(this.$$.modal);
                this.modal.show();
            },

            clear: function(e) {
                e.preventDefault();

                this.$http.post('admin/system/cache/clear', { caches: this.clear });
                this.cancel(e);
            },

            cancel: function(e) {
                e.preventDefault();

                this.modal.hide();
            }

        },

        template: __vue_template__

    };

    Settings.component('system/cache', module.exports);

</script>
