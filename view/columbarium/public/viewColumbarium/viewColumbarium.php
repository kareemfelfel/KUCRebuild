<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="viewColumbariumApp" class="container-fluid">
    <div v-if="!loading">
        <br>
        <hr>

        <div class="columbarium-info container">
            <h3 class="text-center"> Columbarium Information </h3>
            <hr class="hr">
            <br>
            <div class="col-md-6">
                <br><br>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Location:</strong>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <b>{{columbariumInfo.location}}</b>
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">For Sale:</strong> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        {{columbariumInfo.forSale ? "Yes" : "No"}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Purchase Date:</strong> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        {{columbariumInfo.purchaseDate != null ? columbariumInfo.purchaseDate : "N/A"}}
                    </div>
                </div>
                <div v-if="columbariumInfo.forSale" class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Price:</strong> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <span>Please refer to <a href="controller.php?action=directToContactUsPage">contact us</a> page.</span>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-6 text-center">
                <img class="image" :src="columbariumInfo.mainImage" alt="columbariumImage"/>
            </div>
        </div>

        <br>
        <hr>

        <div class="buried-individuals-info container">
            <h3 class="text-center"> Buried Individuals Information </h3>
            <hr class="hr">
            <div v-if="columbariumInfo.buriedIndividuals.length == 0" class="empty-block">
                <p class="text-center"> No Buried Individuals Associated </p>
            </div>
            <div v-else>
                <br>
                <div
                     v-for="(result, index) in columbariumInfo.buriedIndividuals"
                     :key="index">
                    <h4>Buried Individual #{{index +1}} </h4>
                    <hr class="bi-hr">
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">First Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.firstName}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Middle Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.middleName != null ? result.middleName : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Last Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.lastName != null ? result.lastName : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Nickname:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.nickname != null ? result.nickname : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Maiden Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.maidenName != null ? result.maidenName : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Date of Birth:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.dob != null ? result.dob : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Date of Death:</strong>
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.dod != null ? result.dod : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Veteran Status:</strong>
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.veteran ? "Yes" : "No"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Obituary:</strong>
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            <pre>{{result.obituary != null ? result.obituary : "N/A"}}</pre>
                        </div>
                    </div>

                    <hr v-if="index != columbariumInfo.buriedIndividuals.length - 1" class="bi-hr">
                </div>
            </div>
        </div>

        <br><br><br>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="../view/columbarium/viewColumbarium/viewColumbarium.css">
<script>
    new Vue({
        el: "#viewColumbariumApp",
        data:{
            id: null,
            loading: false,
            columbariumInfo: null
        },
        created(){
            this.loading = true;
            this.getId();
            this.getColumbariumInfo();
        },
        methods:{
            getId(){
                let uri = window.location.href.split('?');
                if(uri.length == 2) {
                  let vars = uri[1].split('&');
                  let getVars = {};
                  let tmp = '';
                  vars.forEach(function(v) {
                    tmp = v.split('=');
                    if(tmp.length == 2)
                      getVars[tmp[0]] = tmp[1];
                  });
                  this.id = getVars['id'];
                }
            },
            getColumbariumInfo(){
                this.loading = true;
                $.getJSON("controller.php",
                {
                    action: "fetchColumbariumById",
                    id: this.id
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result[0]))
                    this.columbariumInfo = data
                }).always( () => {
                    this.loading = false
                });
            }
        }
    })
</script>
