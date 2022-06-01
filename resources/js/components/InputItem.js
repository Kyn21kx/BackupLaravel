import React from 'react';
import ReactDOM from 'react-dom';

export default function InputItemRender(props) {
	return (
		<div class="mb-3 row">
			<label htmlFor={props.name} className="col-sm-2 col-form-label">{props.description}</label>
            <div class="col-sm-10">
				<input type={props.type} className="form-control" id={props.name} name={props.name}/>
			</div>
		</div>
	);
}

const toApply = document.getElementsByName('inputItemX');

console.log(toApply);

toApply.forEach(element => {
	const name = element.getAttribute('id');
	const type = element.getAttribute('type');	
    const desc = element.getAttribute('desc');
	ReactDOM.render(<InputItemRender name={name} type={type} description={desc}/>, element);
});	
