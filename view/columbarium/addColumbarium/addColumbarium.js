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

