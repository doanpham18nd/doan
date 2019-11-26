import React, {Component} from 'react';
import axios from "axios";
import MostArticle from "./mostArticle";
import {Link} from "react-router-dom";

class ArticleDetail extends Component {
    constructor(props) {
        super(props);
        this.state = {
            mostArticle: [],
            related: [],
            relatedActive: [],
            detail: {}
        }
    }

    componentDidMount() {
        let string = this.props.match.params.alias;
        let aryMedicine = string.split('-');
        let id = aryMedicine.splice(-1)[0];
        // axios.put(window.laravel.baseUrl + '/api/article/view/' + id);

        axios.get(window.Laravel.baseUrl + '/api/article')
            .then(response => {
                if (response.data.status === 1) {
                    this.setState({
                        mostArticle: response.data.data.mostArticle
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            });
        axios.get(window.Laravel.baseUrl + '/api/article/' + id)
            .then(response => {
                if (response.data.status === 1) {
                    document.title = response.data.data.detail.title;
                    this.setState({
                        detail: response.data.data.detail,
                        relatedActive: response.data.data.relatedActive,
                        related: response.data.data.related
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }

    mostArticle = () => {
        if (this.state.mostArticle instanceof Array) {
            return this.state.mostArticle.map((object, i) => {
                return <MostArticle obj={object} key={i} index={i}/>
            })
        }
    };

    getRelatedActiveMedicine = () => {
        return this.state.relatedActive.map((object, i) => {
            return (

                <div key={i} className="col-sm-4">
                    <div className="related">
                        <div className="single-products">
                            <div className="productinfo text-center">
                                <Link to={'/article/' + object.alias + '-' + object.id + '.html'}>
                                    <p style={{ minHeight: 40 + 'px' }}>{object.title}</p>
                                    <img src={object.thumbnail_web} alt=""/>
                                    <p>{object.short_content}</p>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            )
        })
    };

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-sm-8">
                        <div className="blog-post-area">
                            <h2 className="title text-center">LÀM ĐẸP</h2>
                            <div className="single-blog-post">
                                <h2 className="text-center">{this.state.detail.title}</h2>
                                <div className="post-meta">
                                    <ul>
                                        <li><i className="fa fa-user"/> Mac Doe</li>
                                        <li><i className="fa fa-clock-o"/> 1:33 pm</li>
                                        <li><i className="fa fa-calendar"/> DEC 5, 2013</li>
                                    </ul>
                                </div>
                                <div className="control-img">
                                    <p dangerouslySetInnerHTML={{__html: this.state.detail.content}}/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="left-sidebar">
                            <h2 className="title text-center">Tin làm đẹp xem nhiều</h2>
                            {this.mostArticle()}
                        </div>
                        <div className="left-sidebar">
                            <img src="https://hoaanhdao.vn/data/banner/03818098649761ff883bd82f2b3bd1b6.png"
                                 style={{width: 100 + '%', marginTop: 50 + 'px'}}/>
                        </div>
                    </div>
                </div>
                <div className="row"  style={{marginTop: 50 + 'px'}}>
                    <div className="recommended_items">
                        <h2 className="title text-center">Bài viết liên quan</h2>
                        <div className="single-blog-spot">
                            {this.getRelatedActiveMedicine()}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default ArticleDetail;