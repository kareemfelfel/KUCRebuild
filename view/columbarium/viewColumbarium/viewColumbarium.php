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
                <p>
                    <strong class="tag">Location:</strong>  {{columbariumInfo.location}}
                </p>
                <p>
                    <strong class="tag">For Sale:</strong> {{columbariumInfo.forSale ? "Yes" : "No"}}
                </p>
                <p>
                    <strong class="tag">Purchase Date:</strong> {{columbariumInfo.purchaseDate != null ? columbariumInfo.purchaseDate : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Price:</strong> 
                    <span v-if="columbariumInfo.price != null"> ${{columbariumInfo.price}}</span>
                    <span v-else> N/A </span>
                </p>
            </div>
            <div class="col-md-6">
                <img class="image" :src="columbariumInfo.mainImage" alt="columbariumImage"/>
            </div>
        </div>

        <br>
        <hr>

        <div class="owner-info container">
            <h3 class="text-center"> Owner Information </h3>
            <hr class="hr">
            <br>
            <div v-if="columbariumInfo.owner != null">
                <p>
                    <strong class="tag">First Name:</strong> {{columbariumInfo.owner.firstName}}
                </p>
                <p>
                    <strong class="tag">Middle Name:</strong> {{columbariumInfo.owner.middleName != null? columbariumInfo.owner.middleName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Last Name:</strong> {{columbariumInfo.owner.lastName}}
                </p>
                <p>
                    <strong class="tag">Email:</strong> 
                    <a v-if="columbariumInfo.owner.email != null" :href="`mailto:${columbariumInfo.owner.email}`"> {{columbariumInfo.owner.email}}</a>
                    <span v-else> N/A </span>
                </p>
                <p>
                    <strong class="tag">Phone Number:</strong> 
                    <a v-if="columbariumInfo.owner.phoneNumber" :href="`tel:${columbariumInfo.owner.phoneNumber}`"> {{columbariumInfo.owner.phoneNumber}}</a>
                    <span v-else> N/A </span>
                </p>
                <p>
                    <strong class="tag">Address:</strong> {{columbariumInfo.owner.address != null? columbariumInfo.owner.address : "N/A"}}</a>
                </p>
                
                
            </div>
            <div v-else>
                <p class="text-center"> No Owner Associated </p>
            </div>
        </div>

        <br>
        <hr>

        <div class="buried-individuals-info container">
            <h3 class="text-center"> Buried Individuals Information </h3>
            <hr class="hr">
            <br>
            <div v-if="columbariumInfo.buriedIndividuals.length == 0">
                <p class="text-center"> No Buried Individuals Associated </p>
            </div>
            <div v-else 
                 v-for="(result, index) in columbariumInfo.buriedIndividuals"
                 :key="index">
                <h4>Buried Individual #{{index +1}} </h4>
                <hr class="bi-hr">
                <p>
                    <strong class="tag">First Name:</strong> {{result.firstName}}
                </p>
                <p>
                    <strong class="tag">Middle Name:</strong> {{result.middleName != null ? result.middleName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Last Name:</strong> {{result.lastName != null ? result.lastName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Nickname:</strong> {{result.nickname != null ? result.nickname : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Maiden Name:</strong> {{result.maidenName != null ? result.maidenName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Date of Birth:</strong> {{result.dob != null ? result.dob : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Date of Death:</strong> {{result.dod != null ? result.dod : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Veteran Status:</strong> {{result.veteran ? "Yes" : "No"}}
                </p>
                <p>
                    <strong class="tag" style="float: left;">Obituary:</strong> 
                    <p style="padding-left: 90px;">{{result.obituary != null ? result.obituary : "N/A"}}</p>
                </p>
                
                <hr v-if="index != columbariumInfo.buriedIndividuals.length - 1" class="bi-hr">
            </div>
        </div>

        <br>
        <hr>

        <div class="attachments-info container">
            <h3 class="text-center"> Attachments </h3>
            <hr class="hr">
            <div v-if="columbariumInfo.attachments.length == 0">
                <p class="text-center"> No Attachments Associated </p>
            </div>
            <ul v-else>
                <li v-for="(item, index) in columbariumInfo.attachments" :key="index">
                    <a :href="item.link" download>{{item.name}}</a>
                </li>
            </ul>
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