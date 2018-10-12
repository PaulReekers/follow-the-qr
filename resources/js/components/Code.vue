<template>
    <div id="code">

        <ui-textbox
                disabled
                icon="gps_fixed"
                label="Your current location"
                :placeholder=$route.params.id
                v-model="gpsLocation"
            ></ui-textbox>
    </div>
</template>

<script>
    import { UiTextbox } from 'keen-ui';

    export default {
            data() {
                return {
                    gpsLocation: '',
                };
            },
            components: {
                UiTextbox
            }
    }
</script>

<style>

</style>
