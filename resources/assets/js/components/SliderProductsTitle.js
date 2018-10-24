import React from 'react';
import ReactDOM from 'react-dom';
import SliderProductsList from './SliderProductsList';

const styles = {
    container: {
        backgroundColor: '#f8f7f5',
        marginLeft: "10px",
        paddingTop: "1%",
        paddingBottom: "1%"
    }
};


const SliderProductsTitle = ({title, link}) => {
    return(
            <div>
                <div className="row row-center text-center ">
                    <div className="col-8">
                        <h1 className="text-center">Lo Más Nuevo <br />en SuperFüds</h1>
                        <p className="text-center"><a href={link} className="link-green">Ver todos</a></p>
                    </div>
                </div>
            </div>
            )
}

export default SliderProductsTitle;
