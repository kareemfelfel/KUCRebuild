<?php
?>
<br>
<h3 class="text-center">Admins</h3>
<hr>

<!-- For collapsible panels -->
<div id="viewAdminsApp" class="container-fluid">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="result in results">
        <td>{{result.firstName}}</td>
        <td>{{result.lastName}}</td>
        <td><a :href="`mailto:${result.email}`">{{result.email}}</a></td>
      </tr>
    </tbody>
  </table>
    
    <!-- Error Messages -->
    <div v-for="(error, index) in errors" 
         :key="index" class="alert alert-danger alert-dismissible fade show message-box" 
         >
        <button type="button" class="close" @click="clearError(index)">&times;</button>
        {{error}}
    </div>
</div>
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<script>
    new Vue({
        el: "#viewAdminsApp",
        data:{
            results: [],
            errors: []
        },
        created(){
            this.fetchAdmins()
        },
        methods:{
            fetchAdmins(){
                $.getJSON("controller.php",
                {
                    action: "fetchAdmins"
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.errors = errors
                    this.results = result
                }).fail( () => {
                    this.errors = ["Failed to fetch Admins."]
                })
            },
            clearError(index){
                this.errors.splice(index, 1);
            }
        }
    })
</script>

