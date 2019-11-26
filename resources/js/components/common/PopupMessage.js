import React, {Component} from 'react';
import PopupMessageRow from "./PopupMessageRow";

class PopupMessage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            countMess : 0
        }

    }

    fetchRows() {
        if (this.props.messageData instanceof Array) {
            return this.props.messageData.map((object, i) => {
                return <PopupMessageRow unRead={this.props.unRead} obj={object} key={i} index={i} getUserId={(id) => this.props.getUserId(id)}/>
            })
        }
    };

    checkUnRead() {
        if (this.props.unRead > 0) {
            return this.props.unRead
        }
        return '';
    };
    render() {
        return (
            <li className="nav-item dropdown no-arrow mx-1">
                <a className="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i className="fas fa-envelope fa-fw"/>
                    <span className="badge badge-danger badge-counter">{this.checkUnRead()}</span>
                </a>
                <div className="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="messagesDropdown">
                    <h6 className="dropdown-header">
                        Message Center
                    </h6>
                    {this.fetchRows()}
                    <a className="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li>
        );
    }
}

export default PopupMessage;