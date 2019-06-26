// import libs
import React from 'react'
import {Router, Route, IndexRoute, browserHistory} from 'react-router'

import Layout from '../pages/Layout';
import Register from '../pages/register'
import Login from '../pages/auth'
import Home from '../pages/Home'
import Users from '../pages/users/Users'
import Articles from '../pages/articles/Articles'
import EditArticle from '../pages/articles/EditArticle';

/** workchart component **/
import Workcharts from '../pages/workcharts/Workcharts'
import EditWorkchart from '../pages/workcharts/EditWorkchart';
import AddWorkchart from '../pages/workcharts/AddWorkchart';

const Routes = (
    <Router history={browserHistory}>
        <Route path="/" component={ Layout }>

            <IndexRoute component={ Home }/>

            <Route path="/users" component={ Users }/>

            <Route path="/articles" component={ Articles }/>
            <Route path="/articles/:id/edit" component={ EditArticle }/>

            <Route path="/workcharts" component={ Workcharts }/>
            <Route path="/workcharts/:id/edit" component={ EditWorkchart }/>
            <Route path="/workcharts/add" component={ AddWorkchart }/>

            {/* <Route path="/register" component={ Register }/>
            <Route path="/login" component={ Login }/> */}

        </Route>
    </Router>
)

export default Routes
