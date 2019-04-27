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
                        <tr v-for="answers in answer" :key="answers.answerId">
                            <td>{{ answers.id }}</td>
                            <td>{{answers.created_at}}</td>
                            <td>
                                <router-link :to="{name: 'showAnswer', params:{id: answers.id}}" class="btn btn-sm btn-secondary">Look Answer</router-link>
                            </td>
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
        name: "DetailAnswer",
        data(){
            return{
                answer: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/survey/detail-answer/${this.$route.params.id}`;
            this.axios.get(uri).then(response => {
                this.answer = response.data.data;
                console.log(response.data.data)
            });
        }
    }
</script>

<style scoped>

</style>