import * as ClassiGenerali from "./Generali/ClassiGenerali.js";



document.addEventListener("DOMContentLoaded", async function() {

    // alert("prova");
    let EndPoint="./Ajax/OperazioniBackEnd.php";
    // let Informazione= New ClassiGenerali.Dato("Informazione","",EndPoint)
    // await Informazione.OttieniDato().then((Risultato)=>{
    //  risultato bla bla bla
    // })
    var formTestata = document.getElementById("FormTestata");
    formTestata.addEventListener("submit", function(event) {
        event.preventDefault();
        
        // BloccaForm(document.getElementById("FormCorpo"),true)
        DatiTestata={};
        [...formTestata.elements].forEach(elemento=>{
            if(!elemento.id.includes("Lookup")){
                DatiTestata[elemento.name]=elemento.value
            }
        })

        document.getElementById("CorpoFile").hidden=false;
        BloccaForm(formTestata,true)

    })
})