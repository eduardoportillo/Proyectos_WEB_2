import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SButtom, SForm, SHr, SPage, SText, SNavigation, SLoad, SView, SIcon, SPopup } from 'servisofts-component';
import Parent from '../index'
class Registro extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
        this.key = SNavigation.getParam("key");
    }
    getContent() {
        this.usr = {};
        if (this.key) {
            this.usr = Parent.Actions.getById(this.key, this.props);
            if (!this.usr) return <SLoad />
        }
        return <SForm
            ref={(form) => { this.form = form; }}
            col={"xs-11 sm-9 md-7 lg-5 xl-4"}
            inputProps={{
                customStyle: "calistenia"
            }}
            inputs={{
                name: { label: "Nombres", isRequired: true, defaultValue: this.usr["name"], },
                last_name: { label: "Apellidos", isRequired: true, defaultValue: this.usr["last_name"], },
                email: { label: "Correo", isRequired: true, defaultValue: this.usr["email"], },
                password: { label: "Password", isRequired: true, type: "password", defaultValue: this.usr["password"], },

            }}
            onSubmit={(values) => {
                if (this.key) {
                    Parent.Actions.editar({
                        ...this.usr,
                        ...values
                    }, this.props);
                } else {
                    Parent.Actions.register(values);
                }
            }}
        />
    }
    render() {
        var reducer = this.props.state.userReducer;
        if (reducer.type == "register" && reducer.estado == "exito") {
            SNavigation.goBack();
            // SPopup.alert("exito");
        }
        if (reducer.type == "editar" && reducer.estado == "exito") {
            SNavigation.goBack();
            // SPopup.alert("exito");
        }
        if (reducer.type == "register" && reducer.estado == "error") {
            reducer.estado = "";
            SPopup.alert(JSON.stringify(reducer.error));
            // SPopup.alert("El usuario ya existe");
        }

        return (
            <SPage title={'Registro de ' + Parent.component} center>
                <SView height={30}></SView>
                {this.getContent()}
                <SHr height={25} />
                <SButtom
                    style={{ color: '#fff' }}
                    loading={reducer.estado == "cargando"}
                    props={{
                        type: "outline"
                    }}
                    onPress={() => { this.form.submit() }}
                >{(this.key ? "Editar" : "Registrar")}</SButtom>
            </SPage>
        );
    }
}
const initStates = (state) => {
    return { state }
};
export default connect(initStates)(Registro);