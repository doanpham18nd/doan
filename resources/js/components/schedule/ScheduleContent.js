import React, {Component} from 'react';
import ReactDOM from "react-dom";
import Row from "./Row";
import axios from "axios";

class ScheduleContent extends Component {

    constructor(props) {
        super(props);
        this.state = {
            scheduleContents: scheduleContents,
            countContent: scheduleContents.length
        };
        this.deleteScheduleContent = this.deleteScheduleContent.bind(this)
    }

    makeList() {
        if (this.state.scheduleContents instanceof Array) {
            return this.state.scheduleContents.map((object, i) => {
                return <Row obj={object} key={i} index={i} getValue={this.handleFieldChange}
                            deleteScheduleContent={this.deleteScheduleContent}/>
            });
        }
    };

    deleteScheduleContent(id) {
        const url = '/api/scheduleContent/' + id;
        axios.delete(url).then(response => {
            if (response.data.status === 1) {
                this.setState({
                    scheduleContents:response.data.data.schedule_contents
                });
                this.setState({
                    countContent: this.state.scheduleContents.length
                })
            }
        })
            .catch(err => {
                console.log(err);
            });
    };

    makeScheduleContentAddDay() {
        let scheduleContent = [];
        let countContent = this.state.countContent + 1;
        if (this.state.scheduleDay > 0) {
            for (let i = 0; i < this.state.scheduleDay; i++) {
                scheduleContent.push(<Row key={i} countContent={countContent} number={i} />);
                countContent++
            }
            return scheduleContent;
        }
    };

    search(event) {
        const {target: {value}} = event;
        this.setState({
            scheduleDay: value
        });
    };

    render() {
        console.log(this.state)
        return (
            <div>
                <div className="mb-4 py-3">
                    <input type="text" className="form-control" id="test"
                           placeholder="Chọn số ngày lịch trình"
                           onChange={(event) => this.search(event)}
                    />
                </div>
                {this.makeList()}
                {this.makeScheduleContentAddDay()}
            </div>
        );
    }
}

export default ScheduleContent;

if (document.getElementById('schedule_content')) {
    ReactDOM.render(<ScheduleContent/>, document.getElementById('schedule_content'));
}