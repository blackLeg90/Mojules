import React, {Component} from 'react';

class Layout extends Component {

    componentDidMount() {
        fetch('/api/projects')
            .then(response => {
                console.log(response.json());
                return response.json();
            })
    }

    render() {
        return (
            <div>
                React is awesome!
            </div>
        );
    }
}

export default Layout;