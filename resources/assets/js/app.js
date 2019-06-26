
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 import React from 'react';
 import { render } from 'react-dom';

 /**
  * Loading React routes from routes.
  */
 // import Routes from './routes/routes'
 //
 // render(
 //     Routes,
 //     document.getElementById('app')
 // )

 /**
 * Render Chart wiht dummy data
 */

 import Chart from './Chart';
 import { getData } from "./utils"

 import { TypeChooser } from "react-stockcharts/lib/helper";

 class ChartComponent extends React.Component {
 	componentDidMount() {
 		getData().then(data => {
 			this.setState({ data })
 		})
 	}
 	render() {
 		if (this.state == null) {
 			return <div>Loading...</div>
 		}
 		return (
 			<TypeChooser>
 				{type => <Chart type={type} data={this.state.data} />}
 			</TypeChooser>
 		)
 	}
 }

 render(
 	<ChartComponent />,
 	document.getElementById("chart")
 );
