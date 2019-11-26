import React, {Component} from 'react';
import {Route, Switch} from 'react-router-dom';

import Index from './index'
import MedicineDetail from "./medicine/MedicineDetail";
import MedicineList from "./medicine/MedicineList";
import ArticleList from "./article/ArticleList";
import ArticleDetail from "./article/ArticleDetail";
import Auth from "./auth/Auth";
import Profile from "./user/Profile";
import Cart from "./cart/Cart";
import BillList from "./bill/BillList";
import Address from "./user/Address";
import Password from "./user/Password";
import WaitingPay from "./user/purchase/WaitingPay";
import Delivering from "./user/purchase/Delivering";
import Delivered from "./user/purchase/Delivered";
import Cancel from "./user/purchase/Cancel";
import BillDetail from "./user/purchase/BillDetail";
import PromotionDetail from "./promotion/PromotionDetail";

class RouterPath extends Component {
    render() {
        return (
            <Switch>
                <Route exact path='/' component={Index}/>
                <Route exact path='/index.html' component={Index}/>
                <Route exact key={'billDetail'} path='/user/bill/detail/:id' component={BillDetail}/>
                <Route exact key={'profile'} path='/user/profile.html' component={() => <Profile setShowFlg = {() => this.props.setShowFlg()} />}/>
                <Route exact key={'address'} path='/user/address.html' component={Address}/>
                <Route exact key={'purchase'} path='/user/purchase.html' component={WaitingPay}/>
                <Route exact key={'password'} path='/user/password.html' component={Password}/>
                <Route exact key={'wait'} path='/user/waiting.html' component={WaitingPay}/>
                <Route exact key={'delivering'} path='/user/delivering.html' component={Delivering}/>
                <Route exact key={'delivered'} path='/user/delivered.html' component={Delivered}/>
                <Route exact key={'cancel'} path='/user/cancel.html' component={Cancel}/>
                <Route exact key={'cart'} path='/gio-hang.html' component={Cart}/>
                <Route exact key={'user-purchase'} path='/profile/don-hang.html' component={BillList}/>
                <Route exact key='auth' path='/login.html' component={Auth}/>
                <Route exact key={location.pathname} path='/:alias.html' component={MedicineDetail}/>
                <Route exact key={location.pathname} path='/category/:alias.html' component={MedicineList}/>
                <Route exact key={location.pathname} path='/khuyen-mai/:alias.html' component={PromotionDetail}/>
                <Route exact key={location.pathname} path='/article/lam-dep.html' component={ArticleList}/>
                <Route exact key={location.pathname} path='/article/:alias.html' component={ArticleDetail}/>
                {/*<Route exact path='/admin/schedule/edit/:id' component={ScheduleEdit}/>*/}
            </Switch>
        )
    }
}

export default RouterPath