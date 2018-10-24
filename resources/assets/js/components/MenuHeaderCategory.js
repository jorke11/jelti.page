import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import MenuHeaderItem from './MenuHeaderItem';

export default class MenuHeaderCategory extends Component {

    constructor() {
        super();
    }

    render() {
        const {categories} = this.props;

    return (
            <li className="nav-item dropdown active" id="menu-diet">
                <a className="nav-link dropdown-toggle title-menu" href="" id="title-categories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >CATEGORIAS</a>
                <div className="dropdown-menu" aria-labelledby="dropdown01">
                    {
                categories.map((row, i) => (
                        
                    <MenuHeaderItem key={i}  description={row.description} link={`/products/${row.slug}`}/>
                        ))
                    }
                </div>
            </li>

        )

    }
}