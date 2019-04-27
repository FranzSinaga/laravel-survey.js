<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">Detail Survey</div>
                <div class="card-body">
                    <div style="margin-top: 0px"/>
                    <hr>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Survey Id</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <div v-for="questions in question" :key="questions.id">
                                <td>{{questions.name}}</td>
                            </div>
                            <div v-for="answers in answer" :key="answers.answerId">
                                <td>{{answers}}</td>
                            </div>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                answer: [],
                question: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/survey/show-answer/${this.$route.params.id}`;
            var idOfSurvey;
            this.axios.get(uri).then(response => {
                this.answer = JSON.parse(response.data.jsonAnswer);
                idOfSurvey = response.data.survey_id;
                console.log(idOfSurvey);

                let uriQ = `http://localhost:8000/api/survey/create/`+idOfSurvey;

                this.axios.get(uriQ).then(res => {
                    this.question = JSON.parse(res.data.json);



                    console.log(res.data.json.length)
                })
            });

        }
    }
</script>

<style scoped>

</style>