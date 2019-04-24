<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Create Survey</div>
                <div class="card-body">
                    <div id="surveyCreatorContainer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import * as SurveyCreator from 'survey-creator'
    import 'survey-creator/survey-creator.css'

    import * as SurveyKo from 'survey-knockout'
    import * as widgets from 'surveyjs-widgets'

    import 'inputmask/dist/inputmask/phone-codes/phone.js'

    // widgets.icheck(SurveyKo)
    // widgets.select2(SurveyKo)
    // widgets.inputmask(SurveyKo)
    // widgets.jquerybarrating(SurveyKo);
    // widgets.jqueryuidatepicker(SurveyKo)
    // widgets.nouislider(SurveyKo);
    // widgets.select2tagbox(SurveyKo);
    // widgets.signaturepad(SurveyKo);
    // widgets.sortablejs(SurveyKo);
    // widgets.ckeditor(SurveyKo);
    // widgets.autocomplete(SurveyKo)
    // widgets.bootstrapslider(SurveyKo);
    export default {
        data() {
            return {
                json: null,
                post: 'asd'
            }
        },
        created(){
            let uri = `http://localhost:8000/api/survey/create/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                console.log(response.data.json)
                this.post = response.data.json;
                this.surveyCreator.text = this.post
            });
        },
        mounted() {
            // SurveyCreator.StylesManager.applyTheme("darkblue");
            let options = {
                showPropertyGrid: false,
                questionTypes: ["text", "checkbox", "radiogroup", "dropdown"],
            };
            this.surveyCreator = new SurveyCreator.SurveyCreator(
                'surveyCreatorContainer',
                options
            );
            let urlPut = `${this.$route.params.id}`;
            console.log('http://localhost:8000/api/survey/update/'+urlPut)
            this.surveyCreator.saveSurveyFunc = function (saveNo, callback) {

                $.ajax({
                    url: 'http://localhost:8000/api/survey/update/'+urlPut,
                    type: "POST",
                    data: {
                        json : this.text
                    },
                    success: function (data) {
                        callback(saveNo, data.isSuccess);
                        alert("success")
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        callback(saveNo, false);
                        alert('gagla')
                        alert(thrownError);
                    }
                });
            };
        },
        methods:{
            getSurveyId(){

            },
            getDataSurvey(){
                console.log(this.post)
                alert(this.post)
            }
        }
    }
</script>

<style scoped>

</style>