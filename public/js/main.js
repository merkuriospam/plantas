var grid;
var msnry;

docReady( function() {
	grid = document.querySelector('.grid');
	msnry = new Masonry( grid, {
		gutter: 5
		/*columnWidth: 160,
		itemSelector: '.grid-item'*/
	});
	/*var prependButton = document.querySelector('.prepend-button');
	eventie.bind( prependButton, 'click', function() {
	// create new item elements
	var elems = [];
	var fragment = document.createDocumentFragment();
	var elem = getItemElement();
	fragment.appendChild( elem );
	elems.push( elem );
	// append elements to container
	grid.insertBefore( fragment, grid.firstChild );
	// add and lay out newly appended elements
	msnry.prepended( elems );
	});*/
	setInterval(createElemento, 2000);
});

function createElemento() {
	var elems = [];
	var fragment = document.createDocumentFragment();
	var elem = getItemElement();
	fragment.appendChild( elem );
	elems.push( elem );
	// append elements to container
	grid.insertBefore( fragment, grid.firstChild );
	// add and lay out newly appended elements
	msnry.prepended( elems );	
}

function getItemElement() {
	var elem = document.createElement('div');
	var hImg = randomIntInc(1,5);
	elem.className = 'grid-item';
	var oImg=document.createElement("img");
	oImg.setAttribute('src', 'http://lorempixel.com/200/'+hImg+'00/');
	elem.appendChild(oImg);
	return elem;
}

function randomIntInc (low, high) {
    return Math.floor(Math.random() * (high - low + 1) + low);
}
