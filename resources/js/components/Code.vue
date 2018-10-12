<template>
    <div id="code">
        <div class="page-header header-filter" style="background-image: url('/img/bg.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="" action="">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Hey hello, <br>lets add your current location to the journey!</h4>
              </div>
              <p class="description text-center">51.4442192,5.4717674</p>
              <div class="card-body">
                <div class="input-group">
                    <ui-textbox
                enforce-maxlength
                help="Maximum 140 characters"
                label="Leave a message for others to see"
                placeholder=""
                icon="short_text"

                :multi-line="true"
                :maxlength="140"

                v-model="gpsDescription"
            ></ui-textbox>
                </div>

              </div>
              <div class="footer text-center">
                <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Add your location</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>


    </div>
</template>

<script>
    import { UiTextbox } from 'keen-ui';

    export default {
            data() {
                return {
                    gpsDescription: '',
                };
            },
            components: {
                UiTextbox
            }
    }
</script>

<style>

</style>
