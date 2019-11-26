import React, {Component} from 'react';
import {Link} from "react-router-dom";

class NewItemActive extends Component {
    render() {
        return (
            <div className="col-sm-4">
                <div className="product-image-wrapper">
                    <div className="single-products">
                        <div className="productinfo text-center">
                            <Link to={this.props.obj.alias + '-' + this.props.obj.id + '.html'}>
                            <img src={this.props.obj.thumbnail_web} alt={this.props.obj.name}/>
                            <p>{this.props.obj.name}</p>
                            </Link>
                            <h4>{this.props.obj.format_price}<sup>đ</sup></h4>
                            {/*<a href="#" className="btn btn-default add-to-cart"><i*/}
                            {/*    className="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>*/}
                        </div>

                    </div>
                </div>
            </div>
        );
    }
}

export default NewItemActive;