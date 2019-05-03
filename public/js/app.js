function typeWriter(id, txt, speed) {
	var i = 0;

  if (i < txt.length) {
    document.getElementById(id).innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
	}
}