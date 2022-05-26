const messaggio = document.querySelector(".comptrain__messaggio");
const salva = document.querySelector("input.btn");
const wodData = document.getElementById("wod-data");
const erroreData = document.getElementById("errore-data");
const wodTitolo = document.getElementById("wod-titolo");
const erroreTitolo = document.getElementById("errore-titolo");
const wodTesto = document.getElementById("wod-testo");
const erroreTesto = document.getElementById("errore-testo");
const form = document.getElementById('form');

//DAFARE: Aggiungere evento all'avvio che rimuove messaggio o aggiungere classe?

messaggio.addEventListener("click", () => {
	messaggio.style.display = "none";
});

salva.addEventListener("click", (evento) => {
	evento.preventDefault();
	//messaggio.style.display = "block";

	//Verifica se campi sono validi
	if (validaForm()) {
		messaggio.textContent = "Form valido, invio i Dati";
		messaggio.classList.add("comptrain__messaggio-conferma");
		messaggio.style.display = "block";
        form.submit();
		//DAFARE: Reset input e messaggi
        
	} else {
		messaggio.textContent = "I dati inseriti non sono validi, ricontrolla!";
		messaggio.style.display = "block";
		messaggio.classList.add("comptrain__messaggio-errore");
	}
});

function validaForm() {
	let valido = true;

	if (!wodData.value) {
		erroreData.classList.remove("nascosto");
		erroreData.textContent = "Inserisci una data valida";
		valido = false;
	}
	if (!wodTitolo.value) {
		erroreTitolo.classList.remove("nascosto");
		erroreTitolo.textContent = "Inserisci un titolo";
		valido = false;
	}
	if (!wodTesto.value) {
		erroreTesto.classList.remove("nascosto");
		erroreTesto.textContent = "Inserisci un contenuto";
		valido = false;
	}
	return valido;
}


