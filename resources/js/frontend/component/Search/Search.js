import React, {Component} from 'react';
import SearchDetail from "./SearchDetail";

class Search extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: []
        }
    }

    componentDidMount() {

    }

    fetchRows = () => {
        return this.props.data.map((object, i) => {
            return <SearchDetail key={i} obj={object}/>
        })
    };

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="">
                            <div className="features_items">
                                <h2 className="title text-center">{this.props.keyword}</h2>
                                {this.fetchRows()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Search;