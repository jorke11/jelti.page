import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import CardDietDetail from './CardDietDetail';

import '../../sass/carddiet.scss';

export default class CardDiet extends Component {

    constructor() {
        super();
        this.state = {
            data: []
        };
    }

    componentWillMount() {
        const $this = this;
        axios.get("/diet").then(response => {
            $this.setState({data: response.data})
        }).catch(err => {
            console.log(err)
        })
    }

    render() {
        const {data} = this.state;

        return (
                <div className="container-fluid">
                
                    <div className="row row-card">
                        <div className="col-lg-12 col-xs-12">
                            <p className="text-center title-color">Conoce Nuestras Dietas</p>
                        </div>
                    </div>
                
                    <div className="row justify-content-center">
                        <div className="col-10">
                            <div className="row">
                                {
                                    data.map((row, i) => (
                                        <div className='col-lg-4 col-xs-6 col-md-6 ' key={i}>
                                            <CardDietDetail 
                                                key={i}
                                                description={row.description}
                                                image={row.image}
                                                />
                                        </div>

                                                )
                                    )
                                }
                            </div>
                        </div>
                    </div>
                </div>
                );
    }
}

if (document.getElementById('divDiets')) {
    ReactDOM.render(<CardDiet />, document.getElementById('divDiets'));
}

