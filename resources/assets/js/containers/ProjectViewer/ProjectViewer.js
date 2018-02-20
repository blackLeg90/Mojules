import React, {Component} from 'react';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/css/bootstrap-theme.css';
import Project from '../../components/Projects/Project/Project';
import Projects from '../../components/Projects/Projects';
import Layout from '../../components/Layout/Layout';
import {Route} from 'react-router-dom';

import './ProjectViewer.css';

class ProjectViewer extends Component {
    constructor() {
        super ();
        this.state = {
            projects: [],
            selectedProject: null,
            selectedId: null,
            layoutImages: []
        }
    }

    // Retrieve all projects
    componentDidMount() {
        fetch('/api/projects')
            .then(response => {
                return response.json();
            })
            .then(projects => {
                console.log(projects);
                this.setState({ projects });
            });
    }

    // Handle success button onClick
    onClickHandler(id) {
        const layout = this.state.projects[id-1].layouts;
        console.log(layout);
        this.state.selectedId = id;
        this.state.selectedProject = this.state.projects[id-1].projectName;

        // Assign images to array
        this.state.projects[id-1].layouts.map(layout => {
            this.state.layoutImages.push(layout.fileName)
        });

        // Specify url with selected project name
        this.props.history.replace('/projects/view/' + this.state.selectedProject);
    }

    // Map projects array into individual items
    renderProjects() {
        return this.state.projects.map(project => {
            return (
                <Project key={project.id}
                    id={project.id}
                    projectName={project.projectName}
                    clicked={() => this.onClickHandler(project.id)}/>
            );
        })
    }

    // Route specification for /projects and /projects/view/ along with rendered items
    // Pass data to Layout component to show layout images
    render() {
        return (
            <div>
                <Route
                    path={'/projects'}
                    exact
                    render={() => <Projects renderProjects={this.renderProjects()}/>}/>
                <Route
                    path={'/projects/view/' + this.state.selectedProject}
                    render={()=>(
                        <Layout
                            layoutImages={this.state.layoutImages}/>)} />
            </div>
        );
    }
}

export default ProjectViewer;