 require('./bootstrap');

//import libs
import React, {Component} from 'react';
import { render } from 'react-dom';
import axios from 'axios';

import AddChart from './pages/addchart/AddChart';

render(
  <AddChart />,
  document.getElementById("workarea")
);