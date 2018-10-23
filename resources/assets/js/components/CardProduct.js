import React,{Component} from 'react';
import ReactDOM from 'react-dom';


export default class CardProduct extends Component {

    deleteUnit(){

    }
    addProductEnter(){

    }

    addProduct(){
        
    }

    redirectProduct(){

    }
    showOption(){
        
    }

    render() {
        
        const {product} =this.props;
        console.log("product",product)

        

        return (
            <div className="col-lg-3 col-xs-4 col-md-3 col-6">
                <div className="card" id="card_{product.id}">
                    <img className="card-img-top card-img-product" src={`/${product.thumbnail}`} alt="Card image cap" onClick={this.redirectProduct('{product.slug}')} />
                    <div className="card-body text-center">
                        <p className="text-left text-muted ">
                            <a href={`/search/s=${product.slug_supplier}`} className="text-supplier">{product.supplier}</a>
                        </p>
                        <h5 className="card-title text-left title-products"  onClick={this.redirectProduct('{product.slug}')}>{product.title_ec}</h5>
                    <p className="text-left">
                        
                    </p>
                    
                    <p className="text-left">
                        {(product.price_sf_with_tax==undefined?'':product.price_sf_with_tax)}
                    </p>

                    if($product.quantity)(
                    <button className="btn" type="button" onMouseOver={this.showOption(product.id)} id={`buttonShow_${product.id}`}
                            >{product.quantity} en carrito</button>
                            )
                    

                    <div className="row d-none row-center" id="buttonAdd_{product.id}">
                        <div className="col-lg-6">
                            <div className="row row-form-add-product">
                                <div className="col-lg-4 col-4">
                                    <span  onClick={this.deleteUnit(product.id,product.slug,`quantity_new_product_${product.id}`)}>-</span>
                                </div>
                                <div className="col-lg-4 col-4" >
                                    <input type="text" id={`quantity_new_product_${product.id}`} className="input-quantity-product input-number"
                                           onKeyPress={this.addProductEnter(event,product.id,product.slug)} />
                                </div>
                                <div className="col-lg-4 col-4" >
                                    <span  onClick={this.addProduct('{product.id}','{product.slug}','quantity_new_product_{product.id}')}>+</span>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-2" >
                            <div className="row icon-ok">
                                <div className="col-lg-6">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <button className="btn">Agregar</button>
                </div>
            </div>
        </div>
        
                )
    }
}
