import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const CardDietDetail = ({image, description, link}) => {
    return (
            <div className="card">
                <img className="card-img-top" 
                     src={image} 
                     alt={description}
                     />
                <div className="card-body">
                    <h2 className="card-title text-center title-diet" >{description}</h2>
                    <p className="text-center justify-content-center"><a href={link} className="link-green">Ver todos</a></p>
                </div>
            </div>
            )
}

export default CardDietDetail;
