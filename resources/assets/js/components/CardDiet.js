import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import CardDietDetail from './CardDietDetail';

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
                    <div className="row" style="padding-bottom: 20px">
                        <div className="col-lg-12 col-xs-12">
                            <p className="text-center title-color" style='font-size: 50px;font-family: "dosis" !important'>Conoce Nuestras Dietas</p>
                        </div>
                    </div>
                
                    <div className="row justify-content-center">
                        {
                            data.map((row, i) => (
                                        <div className='col-lg-4 col-xs-6 col-md-6 asdsad'>
                                            <CardDietDetail 
                                                description={row.description}
                                                image={row.image}
                                                key={row.id}
                                                />
                                        </div>

                                        )
                            )
                        }
                    </div>
                </div>
                );
    }
}

if (document.getElementById('divDiets')) {
    ReactDOM.render(<CardDiet />, document.getElementById('divDiets'));
}

