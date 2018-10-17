import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import MenuHeaderCategory from './MenuHeaderCategory';

export default class MenuHeader extends Component {

    constructor() {
        super();
        this.state = {
            categories: []
        }
    }

    componentWillMount() {
        let $this = this;

        axios.get("/categories").then(response => {
            $this.setState({
                categories: response.data
            })
        }).catch(err => {
            console.log(err)
        });
    }

    render() {
        const {categories} = this.state
        return(
                <div>
                    <MenuHeaderCategory categories={categories}/>
                </div>
                );
    }
}


if (document.getElementById('menu-header')) {
    ReactDOM.render(<MenuHeader />, document.getElementById('menu-header'));
}
