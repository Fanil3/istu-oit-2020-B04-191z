function Upload()  {
    let f = imageFile.files[0];
    if (f) {
        image.src = URL.createObjectURL(f);
        localStorage.setItem('image', image.src);
    }
}
	
function Print() {
	window.print();
}

var i = 0;

window.onclick = function (e) {
	if (e.target.classList.contains('imageClass') && e.pageX < 600 && e.pageY < 600)
	{			
		var restaurant = this.document.getElementById("restaurant");
		var names = this.document.getElementById("guests");
		var name = this.prompt();
		if (name.length > 0)
		{
			var p = this.document.createElement("p");
			p.innerHTML = i + 1 + ". " + name;
			var btn = document.createElement("button");
			btn.appendChild(this.document.createTextNode("X"));
			btn.setAttribute("onclick", "DeleteGuest("+ i +")");
			p.appendChild(btn);
			p.setAttribute("id", "Name" + i);
			names.appendChild(p);
			var circle = this.SetCircle(e.pageX - 10, e.pageY - 10, i++, restaurant);
			circle.setAttribute("onclick", "DeleteGuest("+ i +")");
			circle.setAttribute("class", "circle");
			restaurant.appendChild(circle);
		}
	}
	else if (e.target.classList.contains('circle'))
	{
		DeleteGuest(e.target.id.replace("Restaurant", ""));
	}
}


function DeleteGuest(p) {
	if (confirm("Удалить?"))
	{
		document.getElementById("Name" + p).remove();
		document.getElementById("Restaurant" + p).remove();
	}
}

function SetCircle(x, y, index, restaurant) {
    var circle = document.createElement("div");
    circle.style.position = "absolute";
    circle.style.left = x + "px";
    circle.style.top = y + "px";
    circle.style.borderRadius = "100%";
    circle.style.width = "20px";
    circle.style.height = "20px";
    circle.style.backgroundColor = "green";
    circle.style.textAlign = "center";
    circle.textContent = index + 1;
    circle.setAttribute("id", "Restaurant" + index);
    return circle;
}