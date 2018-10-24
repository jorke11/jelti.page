import React, {Component} from 'react';
import ReactDOM from 'react-dom'

export default class Page extends Component {
    render() {
        return(
                <div>asdad</div>
                )
    }
}


if (document.getElementById('page-content')) {
    ReactDOM.render(<Page />, document.getElementById('page-content'));
}

