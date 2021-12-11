import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SHr, SNavigation, SPage, SText, SView, STheme, SLoad, SButtom } from 'servisofts-component';
import user from '../Components/user';
class Ajustes extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    logout() {
        return <SButtom type={"danger"} onPress={() => {
            this.props.dispatch({ type: "USUARIO_LOGOUT" });
        }}>Logout</SButtom>
    }
    render() {
        user.Actions.validateSession(this.props);
        return (
            <SPage title={'Ajustes'}>
                <SView col={"xs-12"} center>
                    {this.logout()}
                </SView>
            </SPage>
        );
    }
}
const initStates = (state) => {
    return { state }
};
export default connect(initStates)(Ajustes);