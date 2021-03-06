//Refer to createSystem.js for other comments
//The only difference here is that form id being used and the addRam and addStorage
//button being added at the start

let addRam = document.createElement( 'button' );
addRam.innerHTML = "Add More";
addRam.classList.add( 'btn');
addRam.classList.add( 'w-100');
addRam.type = 'button';
addRam.onclick = addRAMInput;

let addStorage = document.createElement( 'button' );
addStorage.innerHTML = "Add More";
addStorage.classList.add( 'btn');
addStorage.classList.add( 'w-100');
addStorage.type = 'button';
addStorage.onclick = addStorageInput;

document.querySelectorAll('#ramDiv select')
	.forEach( select => {
		select.addEventListener('change', selectHandler );
	});
document.querySelectorAll('#storageDiv select')
	.forEach( select => {
		select.addEventListener('change', selectHandler );
	});

document.querySelector('#ramDiv').appendChild(addRam);
document.querySelector('#storageDiv').appendChild(addStorage);

function selectHandler( event ){
	let firstSelect = event.target.parentElement.querySelector('select');
	if( event.target == firstSelect )
		if( event.target.value != '')
			event.target.parentElement.appendChild( (event.target.parentElement.id == 'ramDiv' ) ? addRam : addStorage );
		else
			event.target.parentElement.removeChild( (event.target.parentElement.id == 'ramDiv' ) ? addRam : addStorage );
	else
		if( event.target.value == '')
			event.target.parentElement.removeChild(event.target);
}

function addRAMInput( event ){
	let select = document.querySelector('#ramDiv select').cloneNode( true );
	select.name = "ram_id";
	select.classList.add('w-100')
	select.getElementsByTagName('option')[0].innerHTML = "Add More RAM";
	select.addEventListener( 'change', selectHandler );
	event.target.parentElement.insertBefore( select, event.target );
}

function addStorageInput( event ){
	let select = document.querySelector('#storageDiv select').cloneNode( true );
	select.name = "storage_id";
	select.classList.add('w-100')
	select.getElementsByTagName('option')[0].innerHTML = "Add More Storage";
	select.addEventListener( 'change', selectHandler );
	event.target.parentElement.insertBefore( select, event.target );
}

$("#editSystemForm").submit(function(event) {

    event.preventDefault(); // avoid to execute the actual submit of the form.

    let rams = [], storages = [];

    document.querySelectorAll('select[name="ram_id"]').forEach(
    	ram => {
    		rams.push( ram.value );
    	});
    document.querySelectorAll('select[name="storage_id"]').forEach(
    	storage => {
    		storages.push( storage.value );
    	});

    document.querySelector("#ram_ids").value = JSON.stringify(rams);
    document.querySelector("#storage_ids").value = JSON.stringify(storages);

    $(this).submit();
    
});
