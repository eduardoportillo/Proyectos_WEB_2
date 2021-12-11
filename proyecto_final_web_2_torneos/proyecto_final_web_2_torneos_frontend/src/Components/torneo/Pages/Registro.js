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
            row
            inputProps={{
                customStyle: "calistenia"
            }}
            inputs={{
                nombre: { label: "nombre", isRequired: true, defaultValue: this.usr["nombre"], },
                juego_torneo: { label: "juego torneo", isRequired: true, defaultValue: this.usr["juego_torneo"], },
                modalidad_torneo: {
                    label: "modalidad torneo", isRequired: true, type: "select",
                    defaultValue: this.usr["modalidad_torneo"] ? this.usr["modalidad_torneo"] : "Eliminación Simple",
                    options: [
                        {
                            key: "Rondas Suizas",
                            content: "Rondas Suizas"
                        },
                        {
                            key: "Eliminación Simple",
                            content: "Eliminación Simple"
                        },
                        {
                            key: "Round Robin",
                            content: "Round Robin"
                        },
                    ],
                },
                // fecha_inicio: { label: "fecha inicio", isRequired: true, defaultValue: this.usr["fecha_inicio"], type: "date", col: "xs-6" },
                // fecha_fin: { label: "fecha fin", isRequired: true, defaultValue: this.usr["fecha_fin"], type: "date", col: "xs-6" },
                nro_equipos: {
                    label: "# equipos", isRequired: true, type: "select", defaultValue: this.usr["nro_equipos"]?this.usr["nro_equipos"]:"4", options: ["4", "8", "16", "32", "64", "128", "256"],
                },
            }
            }
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
        var reducer = this.props.state[Parent.component + "Reducer"];
        if (reducer.type == "register" && reducer.estado == "exito") {
            reducer.estado = "";
            SNavigation.goBack();
            // SPopup.alert("exito");
        }
        if (reducer.type == "editar" && reducer.estado == "exito") {
            reducer.esssado = "";
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