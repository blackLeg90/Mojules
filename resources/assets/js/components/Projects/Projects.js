import React from 'react';
import './Projects.css';

const projects = (props) => (
    <div className="col-md-6 col-md-offset-2">
        <div>
            <table className="Table">
                <thead>
                <tr>
                    <th className='th' scope="col">#</th>
                    <th className='th' scope="col">Project Name</th>
                    <th className='th' scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    {props.renderProjects}
                </tbody>
            </table>
        </div>
    </div>
);

export default projects;

