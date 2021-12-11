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
        this.key_torneo = SNavigation.getParam("key_torneo");
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
            row
            inputProps={{
                customStyle: "calistenia"
            }}
            inputs={{
                nombre_equipo: { label: "nombre_equipo", isRequired: true, defaultValue: this.usr["nombre_equipo"], },
                // torneo_id: { label: "torneo_id", isRequired: true, type: "number", defaultValue: this.usr["torneo_id"], },
                user_id: { label: "user_id", isRequired: true, type: "number", defaultValue: this.usr["user_id"], }
            }
            }
            onSubmit={(values) => {
                values.torneo_id = this.key_torneo;
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
        var reducer = this.props.state[Parent.component + "Reducer"];
        if (reducer.type == "register" && reducer.estado == "exito") {
            reducer.estado = "";
            SNavigation.goBack();
            // SPopup.alert("exito");
        }
        if (reducer.type == "editar" && reducer.estado == "exito") {
            reducer.estado = "";
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