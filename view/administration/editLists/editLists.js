/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

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
