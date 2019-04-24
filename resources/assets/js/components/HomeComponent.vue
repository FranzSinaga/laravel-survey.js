<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">Welcome To Survey Builder &copy; using Survey.js</div>
                <div class="card-body">
                    List Of Survey
                    <!--<router-link to="/survey/create" class="btn btn-secondary float-right">Create Survey</router-link>-->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                        Create Survey
                    </button>
                    <div style="margin-top: 30px"/>
                    <hr>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts" :key="post.id">
                                <td>{{post.id}}</td>
                                <td>{{ post.name }}</td>
                                <td>
                                    <router-link :to="{name: 'create', params: {id: post.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Survey</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" @submit.prevent="addSurvey">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Survey Name</label>
                                <input type="text" class="form-control" v-model="post.name" id="exampleInputEmail1" placeholder="Enter Survey Name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                post:{},
                posts: []
            }
        },
        created() {
            this.getData()
        },
        methods: {
            addSurvey(){
                let uri = 'http://localhost:8000/api/survey/createSurvey';
                console.log(this.post)
                this.axios.post(uri, this.post).then((response) => {
                    console.log('success')
                    this.$router.push({name: 'home'});
                    this.getData();
                });
            },
            getData(){
                let uri = 'http://localhost:8000/api/survey';
                this.axios.get(uri).then(response => {
                    this.posts = response.data.data;
                    console.log(response.data.data)
                });
            }
        }
    }
</script>

<style scoped>

</style>