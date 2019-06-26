//import libs
import React, {Component} from 'react';
import { render } from 'react-dom';
import axios from 'axios';
// import AddButton from './AddButton';
// import AddTypes from './AddTypes';

class AddChart extends Component {

    constructor(props) {
        super(props);

        this.state = {
            charts: {
                data: []
            },
            chart: {
                type: '',
                color: '',
                position: '',
                title: ''
            },
            saving:false,
            message: '',
            type: ''
        };

        this.setTitle = this.setTitle.bind(this);
        this.clearRender = this.clearRender.bind(this);

        this.renderTypes = this.renderTypes.bind(this);
        this.setType = this.setType.bind(this);

        this.renderColors = this.renderColors.bind(this);
        this.setColor = this.setColor.bind(this);

        this.renderPosition = this.renderPosition.bind(this);
        this.setPosition = this.setPosition.bind(this);

        this.addChart = this.addChart.bind(this);
        this.saveWorkarea = this.saveWorkarea.bind(this);



    }

    renderPosition() {
        render(
            <div className="panel panel-default">
              <div className="panel-heading">Chouse Position</div>
              <div className="panel-body">
                <div className="btn" data-position="main" onClick={this.setPosition}>Main</div>
                <div className="btn" data-position="sub" onClick={this.setPosition}>Sub</div>
              </div>
            </div>,
            document.getElementById("position")
        );
    }

    renderColors() {
        render(
            <div className="panel panel-default">
              <div className="panel-heading">Chouse Color</div>
              <div className="panel-body">
                <div className="btn" data-color="blue" onClick={this.setColor}>Blue</div>
                <div className="btn" data-color="red" onClick={this.setColor}>Red</div>
                <div className="btn" data-color="green" onClick={this.setColor}>Green</div>
              </div>
            </div>
            ,
            document.getElementById("colors")
        );
    }

    renderTypes() {
        render(
            <div className="panel panel-default">
              <div className="panel-heading">Chouse Type</div>
              <div className="panel-body">
                <div className="btn" data-type="candle" onClick={this.setType}>Candle</div>
                <div className="btn" data-type="line" onClick={this.setType}>Line</div>
                <div className="btn" data-type="bar" onClick={this.setType}>Bar</div>
              </div>
            </div>
            ,
            document.getElementById("types")
        );
    }

    updateChart(chart) {
        this.setState({chart});
    }

    updateCharts(charts) {
        this.setState({charts});
    }

    setType(e) {
        this.state.chart.type = e.target.getAttribute("data-type");
        this.updateChart(this.state.chart);
        this.renderColors();
    }
    setColor(e) {
        this.state.chart.color = e.target.getAttribute("data-color");
        this.updateChart(this.state.chart);
        this.renderPosition();
    }
    setPosition(e) {
        this.state.chart.position = e.target.getAttribute("data-position");
        this.addChart();
    }

    setTitle(e) {
        this.state.chart.title = e.target.value;
        this.updateChart(this.state.chart);
    }

    clearRender(block) {
      render(
          <div></div>
          ,
          document.getElementById(block)
      );
    }

    addChart() {
        let charts = this.state.charts.data;
        this.state.chart.title = this.state.chart.type + ' ' + this.state.chart.color + ' ' + this.state.chart.position;
        charts.push(this.state.chart)
        this.setState({
            chart: {
                type: '',
                color: '',
                position: '',
                title: ''
            }
        });

        this.clearRender("colors");
        this.clearRender("position");
        this.clearRender("types");

        render(
            <div className="panel panel-default">
              <div className="panel-body">
                {charts.map((chart) => {
                    return (
                      <div>
                        {chart.title}
                      </div>
                    )
                })}
              </div>
            </div>
            ,
            document.getElementById("charts")
        );


    }

    saveWorkarea() {
      const charts = this.state.charts.data;
      console.log('save');
      console.log(charts);
      const workchart_id = document.getElementById("workchart_id").value;
      console.log(workchart_id);
      const data = {
          charts:this.state.charts.data,
          workchart_id:workchart_id
      };
      console.log(data);
      axios.post(`/api/workarea/add`, data)
        .then(response => {
          console.log(response);
            if (response.status === 200) {
                this.showMessage(response.data.status, response.data.message);
                this.clearRender("charts");
            }
            this.setState({saving: false});
        })
        .catch(error => {
            this.setState({saving: false});
            this.showMessage(response.data.status, response.data.message);
        });
    }

    showMessage(type, message) {
        this.setState({type, message});
    }

    resetMessage(type = '', message = '') {
        this.showMessage({type, message});
    }

    render() {
        const {saving, type, message} = this.state;

        return (
            <div>
                <div className="row">
                    <div className="col-sm-12">
                    <div
                        className={"alert" + (type === 'success' ? ' alert-success ' : ' alert-danger ') + (message !== '' ? '' : ' hidden ')}>
                        {message}
                    </div>
                    </div>

                    <div className="col-sm-3">
                        <div id="charts"></div>
                    </div>
                    <div className="col-sm-3" id="types"></div>
                    <div className="col-sm-3" id="colors"></div>
                    <div className="col-sm-3" id="position"></div>

                    <div className="col-sm-12">
                      <a className="btn btn-default" href="/workcharts">Back to Worcharts</a>
                      <a className="btn btn-default" onClick={this.renderTypes}>Add Charts</a>
                      <a className="btn btn-primary" onClick={this.saveWorkarea}>Save</a>
                    </div>

                </div>
            </div>
        );
    }
}

export default AddChart;
