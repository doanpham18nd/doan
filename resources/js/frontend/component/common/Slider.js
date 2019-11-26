import React, {Component} from 'react';
import {NavLink} from 'react-router-dom'

class Slider extends Component {

    checkActiveParentMenu = (path) => {
        let pathActive = window.location.pathname;
        return (pathActive.indexOf(path) !== -1) ? "active menu-open" : "";
    };

    checkActive = (path) => {
        let pathActive = window.location.pathname;
        return (pathActive === path) ? 'active' : ''
    };

    fetchPromotion = () => {
        return this.props.promotion.map((object, i) => {
            if (i === 0) {
                return (
                    <div key={i} className="item active text-center">
                        <NavLink to={'/khuyen-mai/' + object.alias + '-' + object.id + '.html'}>
                            <img src={object.slide}
                                 className="girl img-responsive" alt=""/>
                        </NavLink>
                    </div>
                )
            }
            return (
                <div key={i} className="item text-center">
                    <NavLink to={'/khuyen-mai/' + object.alias + '-' + object.id + '.html'}>
                    <img src={object.slide}
                         className="girl img-responsive"
                         alt=""/>
                    </NavLink>
                </div>
            )
        })
    };

    fetchSliderNumber = () => {
        return this.props.promotion.map((object, i) => {
            if (i === 0) {
                return (
                    <li key={i} data-target="#slider-carousel" data-slide-to="0" className="active"/>
                )
            }
            return (
                <li key={i} data-target="#slider-carousel" data-slide-to={i}/>
            )
        })
    }

    render() {
        return (
            <section id="slider">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div id="slider-carousel" className="carousel slide" data-ride="carousel">
                                <ol className="carousel-indicators">
                                    {this.fetchSliderNumber()}
                                </ol>

                                <div className="carousel-inner text-center">
                                    {this.fetchPromotion()}
                                </div>

                                <a href="#slider-carousel" className="left control-carousel hidden-xs"
                                   data-slide="prev">
                                    <i className="fa fa-angle-left"/>
                                </a>
                                <a href="#slider-carousel" className="right control-carousel hidden-xs"
                                   data-slide="next">
                                    <i className="fa fa-angle-right"/>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Slider;