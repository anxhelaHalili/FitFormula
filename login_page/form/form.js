window.onload=start;

function start(){

const steps = Array.from(document.querySelectorAll("form .step"));  

const nextBtn = document.querySelectorAll("form .next-btn");  

const prevBtn = document.querySelectorAll("form .previous-btn");  

const form = document.querySelector("form"); 

nextBtn.forEach((button) => {  
    button.addEventListener("click", () => {  
     changeStep("next");  
    });  
   });  
   
prevBtn.forEach((button) => {  
    button.addEventListener("click", () => {  
     changeStep("prev");  
    });  
   });  

function changeStep(btn) {  
 let index = 0;  
 const active = document.querySelector(".active");  
 index = steps.indexOf(active);  
 steps[index].classList.remove("active");  
 if (btn === "next") {  
  index++;  
 } else if (btn === "prev") {  
  index--;  
 }  
 steps[index].classList.add("active"); 

 fixTab(index+1);
}  

function fixTab(index){
    for(var i=1;i<6;i++){
       document.getElementById("tab"+i).style.opacity = "0.5";
    }
    document.getElementById("tab"+index).style.opacity = "1";
}

}

function calculate(){
   var bmi;
   var result = document.getElementById("result");

   var weight = parseInt(document.getElementById("weight").value);
   document.getElementById("weight-val").textContent = weight + " kg";

   var height = parseInt(document.getElementById("height").value);
   document.getElementById("height-val").textContent = height + " cm";

   bmi = (weight / Math.pow( (height/100), 2 )).toFixed(1);
   result.textContent = bmi;

   if(bmi < 18.5){
       category = "Underweight 😒";
       result.style.color = "#ffc44d";
   }
   else if( bmi >= 18.5 && bmi <= 24.9 ){
       category = "Normal Weight 😍";
       result.style.color = "#0be881";
   }
   else if( bmi >= 25 && bmi <= 29.9 ){
       category = "Overweight 😮";
       result.style.color = "#ff884d";
   }
   else{
       category = "Obese 😱";
       result.style.color = "#ff5e57";
   }
   document.getElementById("category").textContent = category;
}

function calories(){
   var result = document.getElementById("result2");

   var cal = parseInt(document.getElementById("caloriesid").value);
   document.getElementById("calories").textContent = cal + " cal";

   var age=parseInt(document.getElementById("age").value);
   var e=document.getElementById("sex");
   var gender=e.options[e.selectedIndex].index;
   var category;

   document.body.style.backgroundColor = "aliceblue";
   document.getElementById("showresult2").style.color = "black";

   if(age<18){
       document.getElementById("showresult2").style.color = "#ff0000";
       document.body.style.backgroundColor = "red";
       category="You're too young!";
   }

   if( age >= 18 && age <= 25 ){
       if(gender==0){
           if(cal<2600){
               category="Too little 😒";
           }
           else if(cal>2600&&cal<3000){
               if(cal>2775&&cal<2825){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
       else{
           if(cal<2000){
               category="Too little 😒";
           }
           else if(cal>2000&&cal<2400){
               if(cal>2175&&cal<2225){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
   }
   else if( age > 25 && age <= 45 ){
       if(gender==0){
           if(cal<2400){
               category="Too little 😒";
           }
           else if(cal>2400&&cal<2800){
               if(cal>2575&&cal<2625){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
       else{
           if(cal<1800){
               category="Too little 😒";
           }
           else if(cal>1800&&cal<2200){
               if(cal>1975&&cal<2025){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
   }
   else if( age > 45 && age <= 50 ){
       if(gender==0){
           if(cal<2200){
               category="Too little 😒";
           }
           else if(cal>2200&&cal<2600){
               if(cal>2375&&cal<2525){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
       else{
           if(cal<1800){
               category="Too little 😒";
           }
           else if(cal>1800&&cal<2200){
               if(cal>1975&&cal<2025){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
   }
   else if( age > 50 && age <= 65 ){
       if(gender==0){
           if(cal<2200){
               category="Too little 😒";
           }
           else if(cal>2200&&cal<2600){
               if(cal>2375&&cal<2525){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
       else{
           if(cal<1600){
               category="Too little 😒";
           }
           else if(cal>1600&&cal<2000){
               if(cal>1775&&cal<1925){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
   }
   else if(age>65){
       if(gender==0){
           if(cal<2000){
               category="Too little 😒";
           }
           else if(cal>2000&&cal<2400){
               if(cal>2175&&cal<2225){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
       else{
           if(cal<1600){
               category="Too little 😒";
           }
           else if(cal>1600&&cal<2000){
               if(cal>1775&&cal<1925){
                   category="Perfect 😍";
               }
               else{
                   category="About right 😮"
               }
           }
           else{
               category="Too much 😱";
           }
       }
   }
   document.getElementById("showresult2").textContent = category;
}

function onlyOne(checkbox) {
   var checkboxes = document.getElementsByClassName("dietbutton");
   for(let i=0;i<checkboxes.length;i++){
       if(checkboxes[i]!==checkbox){
           checkboxes[i].checked=false;
       }
   }
}

function onlyOne2(checkbox) {
   var checkboxes = document.getElementsByClassName("bodybutton");
   for(let i=0;i<checkboxes.length;i++){
    if(checkboxes[i]!==checkbox){
        checkboxes[i].checked=false;
    }
}
}

function checkDiet(){

    var button=document.getElementById("dietprev");
    var dietBool=false;
    var checkboxesDiet = document.getElementsByClassName("dietbutton");
    for(let i=0;i<checkboxesDiet.length;i++){
        if(checkboxesDiet[i].checked){
            dietBool=true;
        }
    }

    if(!dietBool){
        alert("Complete form!");
        button.click();
    }
}

function checkBody(){

    var button=document.getElementById("bodyprev");
    var bodyBool=false;
    var checkboxesBody = document.getElementsByClassName("bodybutton");
    for(let i=0;i<checkboxesBody.length;i++){
        if(checkboxesBody[i].checked){
            bodyBool=true;
        }
    }

    if(!bodyBool){
        alert("Complete form!");
        button.click();
    }
}