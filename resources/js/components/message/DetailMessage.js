import React, {Component} from 'react';

class DetailMessage extends Component {

    checkTypeMessage() {
        let typeClass = (this.props.obj.type === 1) ? 'base_sent' : 'base_receive';
        let typeMsg = (this.props.obj.type === 1) ? 'msg_sent' : 'msg_receive';
        let typeImg = (this.props.obj.type !== 1) ?
            <div className="avatar">
                <img src="https://source.unsplash.com/fn_BT9fwg_E/60x60" className=" img-responsive rounded-circle"/>
            </div>
            : '';
        return (
            <div className={"row msg_container " + typeClass}>
                {typeImg}
                <div className="message-box">
                    <div className={"messages " + typeMsg}>
                        <p>{this.props.obj.content}</p>
                        <time dateTime="2009-11-13T20:00">Timothy • 51 min</time>
                    </div>
                </div>
            </div>
        )

    }

    render() {
        return (
            this.checkTypeMessage()
        );
    }
}

export default DetailMessage;
