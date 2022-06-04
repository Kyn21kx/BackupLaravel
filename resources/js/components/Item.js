import ReactDOM from 'react-dom';

export default function ItemRender(props) {
	return (
		<div class="col mb-5">
			<div class="card h-100">
				<div class="badge bg-dark text-white position-absolute" style={{top: '0.5rem', right: '0.5rem'}}>Disponibles: {props.stock.Available}</div>
				<img class="card-img-top" src={props.item.Picture.replaceAll("\\", "")} alt="..." />
				<div class="card-body p-4">
					<div class="text-center">
						<h5 class="fw-bolder">{props.item.Description}</h5>
						<span class="text-muted text-decoration-line-through">${(props.item.Price * 1.15).toFixed(2)}</span>
						${props.item.Price.toFixed(2)}
					</div>
				</div>
				<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
					<div class="text-center"><button class="btn btn-outline-dark mt-auto" onClick={() => buyAndAlert(props.stock.InstrumentId)}>Comprar</button></div>
					<br/>
					<div class="text-center"><button type="button" class="btn btn-danger" onClick={() => removeAndAlert(props.stock.InstrumentId)}>Borrar</button></div>
				</div>
			</div>
		</div>
	);
}

const toApply = document.getElementsByName('saleItem');



toApply.forEach(element => {
	let jsonItem = element.getAttribute('item');
	let jsonStock = element.getAttribute('stock');
	const inlineItem = JSON.parse(jsonItem);
	const inlineStock = JSON.parse(jsonStock);
	console.log(inlineStock);
	ReactDOM.render(<ItemRender item={inlineItem} stock={inlineStock}/>, element);
});	

function buyAndAlert(InstrumentId) {
	console.log("Id: " + InstrumentId);
	const form = document.getElementById("buyForm");
	form.action += InstrumentId;
	//form = addDataToForm(form, {'id': InstrumentId});
	console.log(form);
	form.submit();
}

function removeAndAlert(InstrumentId) {
	console.log("Id: " + InstrumentId);
	const form = document.getElementById("deleteForm");
	form.action += InstrumentId;
	console.log(form);
	form.submit();
}

function addDataToForm(form, data) {
    if(typeof form === 'string') {
        if(form[0] === '#') form = form.slice(1);
        form = document.getElementById(form);
    }

    var keys = Object.keys(data);
    var name;
    var value;
    var input;

    for (var i = 0; i < keys.length; i++) {
        name = keys[i];
        // removing the inputs with the name if already exists [overide]
        // console.log(form);
        Array.prototype.forEach.call(form.elements, function (inpt) {
             if(inpt.name === name) {
                 inpt.parentNode.removeChild(inpt);
             }
        });

        value = data[name];
        input = document.createElement('input');
        input.setAttribute('name', name);
        input.setAttribute('value', value);
        input.setAttribute('type', 'hidden');

        form.appendChild(input);
    }

    return form;
}