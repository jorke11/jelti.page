import React from 'react';
import ReactDOM from 'react-dom';
import '../../sass/carddiet.scss';


const MenuHeaderItem = ({description, link}) => {
    return(
            <a className="dropdown-item color-card-item" href={link}>{description}</a>
            )
};
export default MenuHeaderItem;