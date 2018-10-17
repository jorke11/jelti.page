import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import MenuHeaderCategory from './MenuHeaderCategory';
import MenuHeaderDiet from './MenuHeaderDiet';

export default class MenuHeader extends Component {

    constructor() {
        super();
        this.state = {
            categories: [],
            diets: []
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

        axios.get("/card-diets").then(response => {
            $this.setState({
                diets: response.data
            })
        });


    }

    render() {
        const {categories, diets} = this.state
        return(
                <ul className="navbar-nav" id="menu-header">
                    <MenuHeaderCategory categories={categories}/>
                    <MenuHeaderDiet diets={diets}/>
                </ul>
                );
    }
}


if (document.getElementById('menu-header')) {
    ReactDOM.render(<MenuHeader />, document.getElementById('menu-header'));
}
