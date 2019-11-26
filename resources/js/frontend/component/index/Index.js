import React, {Component} from 'react';
import Slider from "../common/Slider";
import axios from 'axios/index';
import Suggest from "./Suggest";
import NewItem from "./NewItem";
import NewItemActive from "./NewItemActive";
import Article from "./Article";
import {Link} from "react-router-dom";
import DealHot from "./DealHot";
import Ads from "./Ads";
import NewArticle from "./NewArticle";

class Index extends Component {

    constructor(props) {
        super(props);
        this.state = {
            newItemActive: [],
            newItem: [],
            suggest: [],
            article: [],
            dealHot: [],
            newPost: [],
            promotion: []
        }
    };

    componentDidMount() {
        document.title = 'Mỹ phẩm chức năng';
        axios.get(window.Laravel.baseUrl + '/api/index')
            .then(response => {
                if (response.data.status === 1) {
                    let newItemActive = response.data.data.new.slice(0, 3);
                    let newItem = response.data.data.new.slice(3);
                    this.setState(
                        {
                            suggest: response.data.data.suggest,
                            newItemActive: newItemActive,
                            newItem: newItem,
                            article: response.data.data.article,
                            dealHot: response.data.data.dealHot,
                            newPost: response.data.data.newPost,
                            promotion: response.data.data.promotion
                        }
                    )
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    suggestItem = () => {
        if (this.state.suggest instanceof Array) {
            return this.state.suggest.map((object, i) => {
                return <Suggest obj={object} key={i} index={i}/>
            })
        }
    };

    dealHot = () => {
        if (this.state.dealHot instanceof Array) {
            return this.state.dealHot.map((object, i) => {
                return <DealHot obj={object} key={i} index={i}/>
            })
        }
    };

    newItemActive = () => {
        if (this.state.newItemActive instanceof Array) {
            return this.state.newItemActive.map((object, i) => {
                return <NewItemActive obj={object} key={i} index={i}/>
            })
        }
    };
    newItem = () => {
        if (this.state.newItem instanceof Array) {
            return this.state.newItem.map((object, i) => {
                return <NewItem obj={object} key={i} index={i}/>
            })
        }
    };

    articles = () => {
        if (this.state.article instanceof Array) {
            return this.state.article.map((object, i) => {
                return <Article obj={object} key={i} index={i}/>
            })
        }
    };

    ads = () => {
        return <Ads/>
    };

    post = () => {
        if (this.state.newPost instanceof Array) {
            return this.state.newPost.map((object, i) => {
                return <NewArticle obj={object} key={i} index={i}/>
            })
        }
    };

    render() {
        return (
            <div>
                <Slider promotion={this.state.promotion}/>
                <section>
                    <div className="container">
                        <div className="row">
                            <div className="">
                                {this.ads()}
                                <div className="recommended_items">
                                    <h2 className="title text-center">sản phẩm mới</h2>
                                    <div id="recommended-item-carousel1" className="carousel slide" data-ride="carousel">
                                        <div className="carousel-inner">
                                            <div className="item active">
                                                {this.newItemActive()}
                                            </div>
                                            <div className="item">
                                                {this.newItem()}
                                            </div>
                                        </div>
                                        <a className="left recommended-item-control" href="#recommended-item-carousel1"
                                           data-slide="prev">
                                            <i className="fa fa-angle-left"/>
                                        </a>
                                        <a className="right recommended-item-control" href="#recommended-item-carousel1"
                                           data-slide="next">
                                            <i className="fa fa-angle-right"/>
                                        </a>
                                    </div>
                                </div>
                                <div className="features_items">
                                    <h2 className="title text-center">làm đẹp</h2>
                                    {this.articles()}
                                </div>
                                <div className="recommended_items">
                                    <h2 className="title text-center">deal hot</h2>
                                    <div id="recommended-item-carousel" className="carousel slide" data-ride="carousel">
                                        <div className="carousel-inner">
                                            <div className="item active">
                                                {this.newItemActive()}
                                            </div>
                                            <div className="item">
                                                {this.newItem()}
                                            </div>
                                        </div>
                                        <a className="left recommended-item-control" href="#recommended-item-carousel"
                                           data-slide="prev">
                                            <i className="fa fa-angle-left"/>
                                        </a>
                                        <a className="right recommended-item-control" href="#recommended-item-carousel"
                                           data-slide="next">
                                            <i className="fa fa-angle-right"/>
                                        </a>
                                    </div>
                                </div>
                                <div className="features_items">
                                    <h2 className="title text-center">bài viết mới</h2>
                                    {this.post()}
                                </div>
                                <div className="features_items">
                                    <h2 className="title text-center">GỢI Ý CHO BẠN</h2>
                                    {this.suggestItem()}
                                </div>
                                <div className="features_items">
                                    <h2 className="title text-center">mỹ phẩm-khuyên dùng</h2>
                                    <div className="col-sm-6">
                                        <div className="post-product">
                                            <div className="single-products">
                                                <div className="productinfo text-center">
                                                    <Link
                                                        to={'/kem-trang-diem-sakura-cc-cream-flawless-control-base-spf50-pa-10.html'}><img
                                                        src={'/images/medicine/cc-cream.png'} alt={
                                                        'Kem trang điểm Sakura CC Cream Flawless Control Base SPF50+ PA++++'}/></Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="post-product">
                                            <div className="single-products">
                                                <div className="productinfo text-center">
                                                    <Link
                                                        to={'/kem-trang-diem-sakura-cc-cream-flawless-control-base-spf50-pa-10.html'}><img
                                                        src={'/images/medicine/trang-diem.png'} alt={
                                                        'Kem trang điểm Sakura CC Cream Flawless Control Base SPF50+ PA++++'}/></Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        );
    }
}

export default Index;