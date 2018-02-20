import React, { Component } from 'react';
import ProjectViewer from './containers/ProjectViewer/ProjectViewer';
import Layout from './components/Layout/Layout';
import Link from './Link';
import {Route, Switch} from 'react-router-dom';

class Main extends Component {
    constructor(props){
       super(props);
       this.state = {
           component: null
       }
    }

    render(){
        return (
            <div>
                <Switch>
                    <Route path='/projects' component={ProjectViewer}/>
                    <Route path='/link' component={Link}/>
                </Switch>
            </div>
        );
    }
}

export default Main;

