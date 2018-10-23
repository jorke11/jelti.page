import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import MenuHeaderItem from './MenuHeaderItem';

export default class MenuHeaderCategory extends Component {

    constructor() {
        super();
    }

    render() {
        const {diets} = this.props;

    return (
            <li className="nav-item dropdown" id="menu-category">
                <a className="nav-link dropdown-toggle title-menu" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >DIETAS</a>
                   <div className="dropdown-menu" aria-labelledby="dropdown01">
                    {
                diets.map((row, i) => (
                    <MenuHeaderItem key={i}  description={row.description} link={`/search/c=${row.slug}`}/>
                        ))
                    }
                </div>
            </li>

        )

    }
}