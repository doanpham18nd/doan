import React, {Component} from 'react';

class Ads extends Component {
    render() {
        return (
            <div className="features_items">
                <div className="col-sm-2">
                    <div className="product-image-wrapper2">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <img src={'/images/ads/aven.png'}/>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-sm-2">
                    <div className="product-image-wrapper2">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <img src={'/images/ads/cla.png'}/>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-sm-2">
                    <div className="product-image-wrapper2">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <img src={'/images/ads/heli.png'}/>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-sm-2">
                    <div className="product-image-wrapper2">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <img src={'/images/ads/mura.png'}/>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-sm-2">
                    <div className="product-image-wrapper2">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <img src={'/images/ads/sakura.png'}/>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-sm-2">
                    <div className="product-image-wrapper2">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <img src={'/images/ads/swissline.png'}/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Ads;