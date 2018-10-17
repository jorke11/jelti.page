import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import MenuHeaderItem from './MenuHeaderItem';
export default class MenuHeaderCategory extends Component {

    constructor() {
        super();
    }

    render() {
        const {categories} = this.props;
        console.log(categories);
        return (
                <div></div>
                )

    }
}