import React, {Component} from 'react';
import ReactDOM from 'react-dom';

export default class SliderProductsList extends Component {
        constructor(){
         super();    
        }
        
render() {
return (
        <div className="row row-center test" >
            <div className="col-lg-11 col-md-12 offset-md-0 box-slider-products">
                <div className="row">
                    <div className="col-10 offset-1 ">
                        <div id="carouselExampleIndicators322" className="carousel slide" data-ride="carousel">
                            <div className="carousel-inner">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        )
    }
}