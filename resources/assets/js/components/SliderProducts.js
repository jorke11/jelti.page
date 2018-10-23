import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import SliderProductsTitle from './SliderProductsTitle';
import SliderProductsList from './SliderProductsList';

export default class SliderProducts extends Component {
    constructor() {
        super();
        this.state = {
            products: [],
        }
    }

    componentWillMount() {
        axios.get("/new-products").then(response => {
            this.setState({
                products: response.data
            })
        });
    }

    render() {
        return this.state.products.lenght === 0 ? false :
        (
           <div className="container-fluid test">
                <SliderProductsTitle link="/search/all=new"/>
                <SliderProductsList products={this.state.products}/>
            </div>
        )
    }
}

if (document.getElementById('slider-new-products')) {
    ReactDOM.render(<SliderProducts />, document.getElementById('slider-new-products'));
}