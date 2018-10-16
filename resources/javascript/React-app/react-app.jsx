import React from "react";
import ReactDOM from "react-dom";

const App = () => {
	let Route = (props) => null;
	switch (JSDATA.component) {
		// case 'dashboard':
		// 	Route = (props) => <Dashboard {...props}/>;
		// 	break;
	}

	return (
			<div className={'minimumHeight'}>
				hi
				{/*<Route/>*/}
			</div>
	);
};

ReactDOM.render(<App/>, document.getElementById("react-container"));