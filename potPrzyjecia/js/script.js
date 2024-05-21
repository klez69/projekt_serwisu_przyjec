function drukuj(){
   // sprawdz mo¿liwosci przegladarki
   if (!window.print){
      alert("Twoja przegladarka nie drukuje!")
   	  return 0;
   }
   window.print(); 
}