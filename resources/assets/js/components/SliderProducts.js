import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import SliderProductsTitle from './SliderProductsTitle';
import SliderProductsList from './SliderProductsList';

export default class SliderProducts extends Component {
    constructor() {
        super();
        
    }
    
    componentWillMount(){
        
    }
    
    render() {
        return (
                <div className="container-fluid test">
                    <SliderProductsTitle link="/search/all=new"/>
                    <SliderProductsList />
                </div>
                )
    }
}

if (document.getElementById('slider-new-products')) {
    ReactDOM.render(<SliderProducts />, document.getElementById('slider-new-products'));
}