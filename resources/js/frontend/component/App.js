import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Router} from 'react-router-dom';
import RouterPath from './RouterPath';
import Header from "./common/Header";
import {createBrowserHistory} from "history";
import Footer from "./common/Footer";
import Search from "./Search/Search";
import axios from "axios";


const history = createBrowserHistory();

history.listen(location => {
    setTimeout(() => {
        if (location.action === 'POP') {
            return;
        }
        window.scrollTo(0, 0);
    });
});


export default class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showSearchFlg: false,
            keyword: '',
            data: []
        }
    }
    componentDidMount() {
        this._isMounted = true;
    }

    searchMedicine = (keyword) => {
        this.setState({
            keyword: keyword
        });
        if (keyword.length !== 0) {
            let data = {};
            data.keyword = keyword;
            axios.post(window.Laravel.baseUrl + '/api/search', data).then( res => {
                this.setState({
                    data: res.data.data
                })
            })
        }
    };

    setShowFlg = () => {
        this.setState({
            showSearchFlg: true
        })
    };

    showSearch = () => {
        if (this.state.keyword) {
            return <Search data={this.state.data} setShowFlg={() => this.setShowFlg()}/>
        }
        return (
            <div>
                <RouterPath setShowFlg={() => this.setShowFlg()}/>
            </div>
        )
    };

    componentWillUnmount() {
        this._isMounted = false;
    }

    render() {
        return (
            <Router history={history}>
                <div>
                    <Header searchMedicine={(keyword) => this.searchMedicine(keyword)}/>
                    {this.showSearch()}
                    <Footer/>
                </div>
            </Router>
        )
    }
}

ReactDOM.render(<App/>, document.getElementById('app'));