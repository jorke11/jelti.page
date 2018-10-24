import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import CardProduct from './CardProduct'


export default class SliderProductsList extends Component {
        constructor(){
         super();    
        }
        
        componentWillReceiveProps(){
            
        }
        
        
        
render() {
    const {products}=this.props;
    
return (
        
        
        <div className="row row-center" >
            <div className="col-lg-11 col-md-12 offset-md-0 box-slider-products">
                <div className="row">
                    <div className="col -10 offset-1 ">
                        <div id="carouselExampleIndicators322" className="carousel slide" data-ride="carousel">
                            <div className="carousel-inner">
                             {
                             products.map((val,i)=>(
                                  <div className={`carousel-item ${(i==0)?'active':''}`} key={i}>
                                    <div className="row text-center">
                             
                                    {   
                                        val.map((value,j)=>(
                                            <CardProduct product={value} key={j}/>
                                        ))
                                    }
                                    </div>
                                    </div>
                                    
                                 )
                                )
                            }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        )
    }
}