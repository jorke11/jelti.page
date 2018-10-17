import React from 'react';
import ReactDOM from 'react-dom';

const SliderProductsTitle = ({title, link}) => {
    return(
            <div className="row row-center text-center ">
                <div className="col-8">
                    <h1 className="text-center">Lo Más Nuevo <br />en SuperFüds</h1>
                    <p className="text-center"><a href={link} className="link-green">Ver todos</a></p>
                </div>
            </div>
            )
}

export default SliderProductsTitle;