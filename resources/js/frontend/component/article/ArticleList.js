import React, {Component} from 'react';
import axios from "axios";
import ArticleRow from "./ArticleRow";
import MostArticle from "./mostArticle";

class ArticleList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            list: [],
            mostArticle: []
        };
    }


    componentDidMount() {
        document.title = 'Tin tức-làm đẹp';
        axios.get(window.Laravel.baseUrl + '/api/article')
            .then(response => {
                if (response.data.status === 1) {
                    this.setState({
                        list: response.data.data.list,
                        mostArticle: response.data.data.mostArticle
                    })
                }
            })
            .catch(function (error) {
                console.log(error)
            });
    }


    fetchRows() {
        let list = Object.values(this.state.list);
        return list.map((object, i) => {
            return <ArticleRow obj={object} key={i} index={i}/>
        })
    }

    mostArticle = () => {
        if (this.state.mostArticle instanceof Array) {
            return this.state.mostArticle.map((object, i) => {
                return <MostArticle obj={object} key={i} index={i}/>
            })
        }
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8">
                        <div className="blog-post-area">
                            <h2 className="title text-center">CÁCH DƯỠNG TRẮNG DA</h2>
                            {this.fetchRows()}
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="left-sidebar">
                            <h2 className="title text-center">Tin làm đẹp xem nhiều</h2>
                            {this.mostArticle()}
                        </div>
                        <div className="left-sidebar">
                            <img src="https://hoaanhdao.vn/data/banner/03818098649761ff883bd82f2b3bd1b6.png" style={{width: 100 + '%', marginTop: 50 + 'px'}}/>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default ArticleList;