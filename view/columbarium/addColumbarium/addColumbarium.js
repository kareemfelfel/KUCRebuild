/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* Script for collapse icon */
function changeIcon(x){
    if(x.classList.contains("fa-caret-down")){
        x.classList.add("fa-caret-right");
        x.classList.remove("fa-caret-down");
    }
    else if(x.classList.contains("fa-caret-right")){
        x.classList.add("fa-caret-down");
        x.classList.remove("fa-caret-right");
    }
}

function disableForOpen(x){
    if(x.checked){
        //Clear the owner selected data, remove required, and disable it
        document.getElementById("owner-label").classList.remove("required");
        document.getElementById("owner").setAttribute("disabled", true);
        $('#owner').selectpicker('val', '');
        document.getElementById("buried-individuals").setAttribute("disabled", true);
        $('#buried-individuals').selectpicker('val', '');
        // disable purchase date and clear it
        document.getElementById("purchaseDate").setAttribute("disabled", true);
        document.getElementById("purchaseDate").value = '';
    }
    else{
        document.getElementById("owner-label").classList.add("required");
        document.getElementById("owner").removeAttribute("disabled");
        document.getElementById("buried-individuals").removeAttribute("disabled");
        document.getElementById("purchaseDate").removeAttribute("disabled");
    }
}

