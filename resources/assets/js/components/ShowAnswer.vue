<!--<template>-->
    <!--<div class="row justify-content-center">-->
        <!--<div class="col-md-10">-->
            <!--<div class="card card-default">-->
                <!--<div class="card-header">Detail Survey</div>-->
                <!--<div class="card-body">-->
                    <!--<div style="margin-top: 0px"/>-->
                    <!--<hr>-->
                    <!--<table class="table table-bordered table-hover">-->
                        <!--<thead>-->
                        <!--<tr>-->
                            <!--<th>Survey Id</th>-->
                            <!--<th>Created At</th>-->
                            <!--<th>Actions</th>-->
                        <!--</tr>-->
                        <!--</thead>-->
                        <!--<tbody>-->
                        <!--<tr>-->
                            <!--<div v-for="questions in question" :key="questions.id">-->
                                <!--<td>{{questions.name}}</td>-->
                            <!--</div>-->
                            <!--<div v-for="answers in answer" :key="answers.answerId">-->
                                <!--<td>{{answers}}</td>-->
                            <!--</div>-->
                        <!--</tr>-->
                        <!--</tbody>-->
                    <!--</table>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
<!--</template>-->

<!--<script>-->
    <!--export default {-->
        <!--data(){-->
            <!--return{-->
                <!--answer: [],-->
                <!--question: []-->
            <!--}-->
        <!--},-->
        <!--created() {-->
            <!--let uri = `http://localhost:8000/api/survey/show-answer/${this.$route.params.id}`;-->
            <!--var idOfSurvey;-->
            <!--this.axios.get(uri).then(response => {-->
                <!--this.answer = JSON.parse(response.data.jsonAnswer);-->
                <!--idOfSurvey = response.data.survey_id;-->
                <!--console.log(idOfSurvey);-->

                <!--let uriQ = `http://localhost:8000/api/survey/create/`+idOfSurvey;-->

                <!--this.axios.get(uriQ).then(res => {-->
                    <!--this.question = JSON.parse(res.data.json);-->



                    <!--console.log(res.data.json.length)-->
                <!--})-->
            <!--});-->

        <!--}-->
    <!--}-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->

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
            let uri = `http://localhost:8000/api/survey/show-result/${this.$route.params.id}/${this.$route.params.jbid}`;
            this.axios.get(uri).then((response) => {
                var model = new SurveyVue.Model(response.data.json);
                console.log(response.data.json)
                this.survey = model
                let urlPut = `${this.$route.params.jbid}`;
                this.axios.get("http://localhost:8000/api/survey/show-answer/"+urlPut).then(res=>{
                    this.survey.data = JSON.parse(res.data.jsonAnswer);
                    console.log(res.data.jsonAnswer)
                    this.survey.mode = "display"; //make the survey readonly
                })


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
