//get the modal
var modal = document.getElementById('myModal');

// retrieve image and insert into the modal
var view = document.getElementById('view');
var img = document.getElementById('myImg');
var modalImg = document.getElementById('img01');
var captionText = document.getElementById('caption');

view.onclick = function(){
    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
}

// get the button that closes the modal
var closeBtn = document.getElementById('close');

closeBtn.onclick = function(){
    modal.style.display = "none";
}