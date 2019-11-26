import React, {Component} from 'react';
import ReactDOM from "react-dom";
import ListMessage from "./ListMessage";

export default class Chat extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <ListMessage/>
        );
    }
}

if (document.getElementById('chat')) {
    ReactDOM.render(<Chat />, document.getElementById('chat'));
}