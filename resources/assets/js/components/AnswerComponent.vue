<template>
    <div>
        <survey :survey="survey" ></survey>
        <div id="surveyResult"></div>
    </div>
</template>

<script>
    // import CreateComponent from './components/CreateComponent'
    import * as SurveyVue from 'survey-vue'
    import 'bootstrap/dist/css/bootstrap.css'

    var Survey = SurveyVue.Survey;
    Survey.cssType = 'bootstrap';

    import * as widgets from 'surveyjs-widgets'
    import 'inputmask/dist/inputmask/phone-codes/phone.js'

    export default {
        name: 'app',
        components: {
            Survey,
        },
        data() {
            window.survey = new SurveyVue.Model("");
            return {
                survey: survey,
            }
        },
        mounted(){
            let uri = `http://localhost:8000/api/survey/create/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                var model = new SurveyVue.Model(response.data.json);
                console.log(response.data.json)
                this.survey = model
                let urlPut = `${this.$route.params.id}`;

                this.survey.onComplete.add(function (sender, options) {
                    $.ajax({
                        url: 'http://localhost:8000/api/survey/answer/'+urlPut,
                        type: "POST",
                        data: {
                            json : JSON.stringify(sender.data)
                        },
                        success: function (data) {
                            alert("success")
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert('gagal')
                            alert(thrownError);
                        }
                    });

                    console.log(JSON.stringify(sender.data))
                    document
                        .querySelector('#surveyResult')
                        .innerHTML = "result: " + JSON.stringify(sender.data);
                });
            });

        },
        created(){

        },methods: {
            sendDataToServer(survey) {
                var resultAsString = JSON.stringify(survey.data);
                alert(survey.data); //send Ajax request to your web server.
            }
        }
    }
</script>

<style>
    #app {
        font-family: "Avenir", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
    }
</style>
