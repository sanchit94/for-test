/*Struggling to find the right bezier.
Help me figure it out.
Hot points in css(fiddle with css there)*/

setInterval(changePos,3500)

function changePos(){
  var x = document.getElementsByClassName("ultra")[0].childNodes;
  x = Array.from(x)
   
  // console.log(x);
  for(var i=1; i<x.length;i+=2){  
    if(x[i].classList.contains("tab-0")){
      x[i].classList.remove("tab-0");
      x[i].classList.add("tab-4");
    }
    else if(x[i].classList.contains("tab-1")){
      x[i].classList.remove("tab-1");
      x[i].classList.add("tab-0");
 
    }
    else if(x[i].classList.contains("tab-2")){
      x[i].classList.remove("tab-2");
      x[i].classList.add("tab-1");
      
    }
    else if(x[i].classList.contains("tab-3")){
      x[i].classList.remove("tab-3");
      x[i].classList.add("tab-2");
      
    }
    else if(x[i].classList.contains("tab-4")){
      x[i].classList.remove("tab-4");
      x[i].classList.add("tab-3");
    }
  }
  
  let y = x.filter((a)=> {
    return a.className !== undefined;
  })
  
  console.log(y)
  let z = findValue(y,"tab-1");
  
  function findValue(arr, str){
    for(let i=0; i <arr.length ;i++){
      if(arr[i].className === str){
        return arr[i].offsetHeight;
      }
    }
  }
  
  y.forEach((a)=>{
    if(a.className==="tab-1"){
      a.style.transform = `scale(1.0)`
    } else if (a.className === "tab-2"){
      a.style.transform = `translateY(${z-a.offsetHeight+30}px) scale(0.9)`
    } else if (a.className === "tab-3"){
      a.style.transform = `translateY(${z-a.offsetHeight+60}px) scale(0.8)`
    } else if (a.className === "tab-4"){
      a.style.transform = `translateY(${z-a.offsetHeight+100}px) scale(0.7)`
    } else if (a.className === "tab-0"){
      a.style.transform = `translateY(${z-a.offsetHeight-90}px) scale(1.08)`
    } 
  })
  
}

