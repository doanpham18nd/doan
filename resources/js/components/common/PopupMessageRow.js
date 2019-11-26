import React, {Component} from 'react';

class PopupMessageRow extends Component {

    checkUnRead() {
        if (this.props.obj.type != 1 && this.props.obj.read_flg == 0 && this.props.unRead > 0) {
            return 'unReadMess'
        }
        return '';
    };

    render() {
        return (
            <a className={"dropdown-item d-flex align-items-center " + this.checkUnRead()} href="#"
               onClick={() => this.props.getUserId(this.props.obj.patient_id)}>
                <div className="dropdown-list-image mr-3">
                    <img className="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60"
                         alt=""/>
                    <div className="status-indicator bg-success"/>
                </div>
                <div className="font-weight-bold">
                    <div className="text-truncate">{this.props.obj.content}
                    </div>
                    <div className="small text-gray-500">Emily Fowler · 58m</div>
                </div>
            </a>
        );
    }
}

export default PopupMessageRow;