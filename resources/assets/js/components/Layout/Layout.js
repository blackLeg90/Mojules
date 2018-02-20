import React, {Component} from 'react';

class Layout extends Component {
    renderLayoutImages(images) {
        return images.map(layoutImage => {
            return (
                <img key={layoutImage}
                    src={'https://s3-ap-southeast-1.amazonaws.com/mojules/' + layoutImage}/>
            );
        })
    }

    render() {
        return (
            <div>
                {this.renderLayoutImages(this.props.layoutImages)}
            </div>
        );
    }
}

export default Layout;