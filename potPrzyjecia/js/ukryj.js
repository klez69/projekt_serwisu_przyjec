function PokazUkryjTekst(polecenie,id) {
    var PrzyciskPokaz = document.getElementById('PrzyciskPokaz_' + id);
    var PrzyciskUkryj = document.getElementById('PrzyciskUkryj_' + id);
    var TrescSkrocona = document.getElementById('TrescSkrocona_' + id);
    var TrescPelna = document.getElementById('TrescPelna_' + id);
	if (polecenie == 1) {
		PrzyciskPokaz.style.display = 'none';
		PrzyciskUkryj.style.display = 'block';
		TrescSkrocona.style.display = 'none';
		TrescPelna.style.display = 'block';
	} 
	else if (polecenie == 2) {
		PrzyciskPokaz.style.display = 'block';
		PrzyciskUkryj.style.display = 'none';
		TrescSkrocona.style.display = 'block';
		TrescPelna.style.display = 'none';
	}
}