import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SButtom, SHr, SNavigation, SPage, SPopup, SText, STheme, SView } from 'servisofts-component';
import user from '../Components/user';
import SHttp from '../SHttp';

class Home extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    render() {
        user.Actions.validateSession(this.props);
        return (
            <SPage title={'Home'} center preventBack>
                <SView row>
                    <SButtom type={"outline"} onPress={() => {
                        SNavigation.navigate('ajustes');
                    }}>Ajustes</SButtom>
                    <SHr />
                    {/* <SButtom type={"outline"} onPress={() => {
                        SNavigation.navigate('user');
                    }}>usuarios</SButtom>
                    <SHr />
                    <SButtom type={"outline"} onPress={() => {
                        SNavigation.navigate('torneo');
                    }}>torneos todos</SButtom> */}
                    <SButtom type={"outline"} onPress={() => {
                        SNavigation.navigate('torneo/user');
                    }}>Mis Torneros</SButtom>
                    <SButtom type={"outline"} onPress={() => {
                        SNavigation.navigate('torneo/open');
                    }}>Torneos open</SButtom>
                </SView>
            </SPage>
        );
    }
}
const initStates = (state) => {
    return { state }
};
export default connect(initStates)(Home);