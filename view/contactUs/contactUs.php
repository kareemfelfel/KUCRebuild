<?php

/* 
 * This page has public access
 * 
 * the Contact Us page should not need to contact the controler at all.
 * Only Front-End hard-coded information will be provided here.
 */
?>
<br>
<div id="contactUsApp" class="container">
    <div v-for="(result, index) in results" 
         class="col-md-4"
         :key="index">
        <div class="contact-box center-version">
            <div class="my-wrapper">
                <img alt="image" class="img-circle contact-img" src="../assets/images/contactImage.png">
                <h3 class="m-b-xs name-section"><strong>{{result.name}}</strong></h3>

                <div class="font-bold title-section">{{result.title}}</div>

                <div class="contact-box-footer">
                    <div class="contact_btns">
                        <a class="btn-link my-anchor" :href="`tel:${result.phoneNumber}`"><i class="fa fa-phone"></i> {{result.phoneNumber}} </a>                            
                        <a class="btn-link my-anchor title-section" :href="`mailto:${result.email}`"><i class="fa fa-envelope"></i> {{result.email}}</a>                        
                    </div> <!-- m-t-xs btn group -->
                </div> <!-- contact-box-footer -->
            </div>
        </div>
    </div>  
    <!-- Error Messages -->
    <div v-for="(error, index) in errors" 
         :key="index" class="alert alert-danger alert-dismissible fade show message-box" 
         >
        <button type="button" class="close" @click="clearError(index)">&times;</button>
        {{error}}
    </div>
</div><!-- class container -->
<link rel="stylesheet" type="text/css" href="../view/contactUs/contactUs.css">
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
        el: "#contactUsApp",
        data:{
            results: [],
            errors: []
        },
        created(){
            this.fetchContacts()
        },
        methods:{
            fetchContacts(){
                $.getJSON("controller.php",
                {
                    action: "fetchContacts"
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.errors = errors
                    this.results = result
                }).fail( () => {
                    this.errors = ["Failed to fetch KUC Contacts. Please try to refresh."]
                })
            },
            clearError(index){
                this.errors.splice(index, 1);
            }
        }
    })
</script>
</body>
</html>