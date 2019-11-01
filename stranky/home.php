 <div class="slideshow">

<div class="slide_home">
  <img src="fotky/slide_1_big.jpg" alt="" class="slideshow">
  <div class="big_box">
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <div class="box">
  <div class="text">Rodinný recept v spojení s kvalitnými talianskymi prísadami, najmodernejšou technológiou na trhu, 
  veľkou dávkou kreativity a lásky k tomu čo robíme. Dokonalé splynutie týchto ingrediencií objavíte pri každom ochutnaní zmrzliny od Vanillie.</div>
</div>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
</div>

<div class="slide_home">
  <img src="fotky/slide_2_big.jpg" alt="" class="slideshow">
  <div class="big_box">
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <div class="box">
  <div class="text">Rodinný recept v spojení s kvalitnými talianskymi prísadami, najmodernejšou technológiou na trhu, 
  veľkou dávkou kreativity a lásky k tomu čo robíme. Dokonalé splynutie týchto ingrediencií objavíte pri každom ochutnaní zmrzliny od Vanillie.</div>
</div>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
</div>

<div class="slide_home">
  <img src="fotky/slide_3_big.jpg" alt="" class="slideshow">
  <div class="big_box">
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <div class="box">
  <div class="text">Rodinný recept v spojení s kvalitnými talianskymi prísadami, najmodernejšou technológiou na trhu, 
  veľkou dávkou kreativity a lásky k tomu čo robíme. Dokonalé splynutie týchto ingrediencií objavíte pri každom ochutnaní zmrzliny od Vanillie.</div>
</div>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
</div>

</div>


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusoneSlide() {
  showSlides(slideIndex += 1);
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slide_home");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  
  slides[slideIndex-1].style.display = "block";  


}
  setInterval(plusoneSlide, 50000);
</script>








