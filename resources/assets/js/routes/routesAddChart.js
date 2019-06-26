// import libs
import React from 'react'
import {Router, Route, IndexRoute, browserHistory} from 'react-router'

import Layout from '../addchart/Addchart';

const Routes = (
    <Router history={browserHistory}>
        <Route path="/workareas/create" component={ Addchart }/>
    </Router>
)

export default Routes
