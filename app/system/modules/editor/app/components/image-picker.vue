<template>

    <div class="uk-modal" v-el="modal">
        <div class="uk-modal-dialog uk-form uk-form-stacked" v-class="uk-modal-dialog-large: view == 'finder'">

            <div v-show="view == 'settings'">

                <div class="uk-modal-header">
                    <h2>{{ 'Add Image' | trans }}</h2>
                </div>

                <a class="uk-placeholder uk-text-center uk-display-block" v-on="click: openFinder" v-if="!image.src">
                    <img width="60" height="60" alt="{{ 'Placeholder Image' | trans }}" v-attr="src: $url.static('app/system/assets/images/placeholder-image.svg')">
                    <p class="uk-text-muted uk-margin-small-top">{{ 'Select image' | trans }}</p>
                </a>

                <div class="uk-overlay uk-overlay-hover uk-flex uk-flex-center uk-flex-middle uk-margin" v-if="image.src">
                    <img v-attr="src: resolveUrl(image.src)">
                    <div class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle pk-overlay-border">
                        <div>
                            <a class="pk-icon-edit pk-icon-hover" title="{{ 'Edit' | trans }}" data-uk-tooltip="{delay: 500}" v-on="click: openFinder"></a>
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="form-src" class="uk-form-label">{{ 'URL' | trans }}</label>
                    <div class="uk-form-controls">
                        <input id="form-src" type="text" class="uk-width-1-1" v-model="image.src">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label for="form-alt" class="uk-form-label">{{ 'Alt' | trans }}</label>
                    <div class="uk-form-controls">
                        <input id="form-alt" type="text" class="uk-width-1-1" v-model="image.alt">
                    </div>
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-link uk-modal-close" type="button">{{ 'Cancel' | trans }}</button>
                    <button class="uk-button uk-button-link uk-modal-close" type="button" v-on="click: update">{{ 'Update' | trans }}</button>
                </div>

            </div>

            <div v-if="view == 'finder'">

                <v-finder root="{{ storage }}" v-ref="finder"></v-finder>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-link" type="button" v-on="click: cancel">{{ 'Cancel' | trans }}</button>
                    <button class="uk-button uk-button-link" type="button" v-attr="disabled: !selected" v-on="click: select">{{ 'Select' | trans }}</button>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

    module.exports = Vue.extend({

        data: function () {
            return {
                view: 'settings',
                style: '',
                image: { src: '', alt: '' },
                storage: window.$pagekit.storage ? window.$pagekit.storage : '/storage'
            }
        },

        ready: function () {

            var vm = this, modal = UIkit.modal(this.$$.modal);

            modal.on('hide.uk.modal', function () {
                vm.$destroy(true);
            });

            modal.show();

            this.$watch('image.src', this.preview);
            this.preview();
        },

        methods: {

            update: function () {
                this.$emit('select', this.image);
            },

            preview: function () {

                var vm = this, img = new Image(), src = '';

                if (this.image.src) {
                    src = this.$url.static(this.image.src);
                }

                img.onerror = function () {
                    vm.style = '';
                };

                img.onload = function () {
                    vm.style = 'background-image: url("' + src + '"); background-size: contain';
                };

                img.src = src;
            },

            openFinder: function () {
                this.view = 'finder';
            },

            select: function(e) {
                e.preventDefault();
                this.image.src = this.$.finder.getSelected()[0];
                this.cancel(e);
            },

            cancel: function(e) {
                e.preventDefault();
                this.view = 'settings';
            },

            resolveUrl: function(url) {
                return this.$url.static(url);
            }

        },

        computed: {

            selected: function() {
                var selected = this.$.finder.getSelected();
                return selected.length == 1 && this.$.finder.isImage(selected[0]);
            }

        }

    });

</script>
