import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ListMessage from "../message/ListMessage";
import Header from "../common/Header";

export default class Index extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showChatForm: true
        }
    }

    render() {
        return (
            <div>
                <Header/>
                <div className="container-fluid">
                    Medicine List
                </div>
                <ListMessage/>
            </div>
        );
    }
}

if (document.getElementById('content')) {
    ReactDOM.render(<Index />, document.getElementById('content'));
}