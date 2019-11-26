import React, {Component} from 'react';
import Menu from "./Menu";

class Password extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <Menu/>
                    <div className="col-sm-9">
                        <div className="">
                            <div className="features_items">
                                <h2 className="title text-center">Password</h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        );
    }
}

export default Password;