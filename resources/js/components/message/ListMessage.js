import React, {Component} from 'react';
import axios from "axios/index";
import DetailMessage from "./DetailMessage";

// import Echo from "laravel-echo";

class ListMessage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            content: '',
            messages: [],
            showChatForm: false,
            patientId: 0
        };
        this.handleSubmit = this.handleSubmit.bind(this);
        this.fetchRows = this.fetchRows.bind(this)
    }

    onChange(e) {
        if (e.target.value.length == 1) {

        }
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    componentDidMount() {
        let self = this;
        Echo.channel('new-chat').listen('Chat', (e) => {
            if (e.message.patient_id == self.state.patientId) {
                self.setState({
                    messages: [...this.state.messages, e.message],
                    showChatForm: true,
                    patientId: e.message.patient_id
                })
            }
        });
        Echo.channel('read').listen('Read', (e) => {
            if (e.patientId != self.state.patientId) {
                self.setState({
                    patientId: e.patientId
                });
            }
            self.setState({
                showChatForm: true
            });

            axios.get(window.Laravel.baseUrl + '/admin/message/' + e.patientId)
                .then(response => {
                    if (response.data.status === 1) {
                        this.setState({
                            messages: response.data.data,
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        })

    }

    componentWillUnmount() {
        clearInterval(this.change)
    }

    scrollToBottom() {
        const scrollHeight = this.msg_container_base.scrollHeight;
        const height = this.msg_container_base.clientHeight;
        const maxScrollTop = scrollHeight - height;
        this.msg_container_base.scrollTop = maxScrollTop > 0 ? maxScrollTop : 0;
    }

    componentDidUpdate() {
        if (this.state.showChatForm) {
            this.scrollToBottom();
        }
    }

    handleSubmit(e) {
        let self = this;
        if (e.keyCode === 13) {
            let data = {};
            data.patient_id = this.state.patientId;
            data.content = this.state.content;
            axios.post('/chatAdmin', data).then(function (res) {
                console.log(res.data.data);
                self.setState({
                    // messages: [...self.state.messages, res.data.data],
                    // loading: false,
                    content: ''
                })
            }).catch(function (err) {
                console.log(err)
            });
        }
    }

    fetchRows() {
        if (this.state.messages.length > 0) {
            return this.state.messages.map((object, i) => {
                return <DetailMessage obj={object} key={i} index={i}/>
            })
        }
        return '';
    }

    closeChatForm(event) {
        this.setState({
            showChatForm:false
        })
    }

    showForm() {
        if (this.state.showChatForm) {
            return (
                <div className="row chat-window" id="chat_window_1">
                    <div className="">
                        <div className="panel panel-default">
                            <div className="panel-heading top-bar">
                                <div className="box-left">
                                    <h6 className="panel-title2">Lương Minh Phương</h6>
                                </div>
                                <div className="box-right">
                                    <button className="icon-button"><i id="minim_chat_window"
                                                                       className="fas fa-minus padding-rigt"/>
                                    </button>
                                    <button className="icon-button"><i id="close_chat-window" onClick={(event) => {this.closeChatForm(event)}}
                                                                       className="fas fa-times"/>
                                    </button>
                                </div>
                            </div>
                            <div className="panel-body msg_container_base" id="top-panel" ref={(div) => {
                                this.msg_container_base = div
                            }}>
                                {this.fetchRows()}
                            </div>
                            <div className="panel-footer">
                                <div className="input-group">
                                    <input id="btn-input" type="text" className="form-control input-sm chat_input"
                                           onChange={(event) => this.onChange(event)}
                                           onKeyDown={(event) => this.handleSubmit(event)}
                                           value={this.state.content}
                                           name="content"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )
        }
        return ''
    }

    render() {
        return (
            this.showForm()
        );
    }
}

export default ListMessage;
