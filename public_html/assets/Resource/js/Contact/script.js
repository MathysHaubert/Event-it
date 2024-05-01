document.addEventListener("DOMContentLoaded", () => {
    const formButton = document.getElementById("formButton"); 
    const formSection = document.getElementById("formSection"); 

    if (formButton) {
        formButton.addEventListener("click", ()=>{
            container2.scrollIntoView({behavior: "smooth"});
        });
    } else{
        console.log("Bouton introuvable")
    }
});