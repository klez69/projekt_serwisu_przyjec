function drukuj(){
   // sprawdz możliwosci przegladarki
   if (!window.print){
      alert("Twoja przegladarka nie drukuje!")
   	  return 0;
   }
   window.print(); 
}