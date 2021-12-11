import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SButtom, SIcon, SLoad, SNavigation, SPage, STable2, SText, SView } from 'servisofts-component';
import user from '../../user';
import Parent from '../index'
class Lista extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
        // this.key_torneo = SNavigation.getParam("key");
        // if(this.key_torneo){
        //     SNavigation.goBack();
        // }
    }

    getContent() {  
        var data = Parent.Actions.getAll(true);
        var usuarios = user.Actions.getAll();
        if (!data) return <SLoad />;
        if (!usuarios) return <SLoad />;
        return <STable2
            header={[
                // { key: "index", label: "#", width: 50 },
                { key: "id", label: "Id", width: 50, center: true },
                { key: "nombre", label: "nombre", width: 150 },
                { key: "juego_torneo", label: "juego torneo", width: 150 },
                { key: "modalidad_torneo", label: "modalidad torneo", width: 150 },
                // { key: "fecha_inicio", label: "fecha inicio", width: 150 },
                // { key: "fecha_fin", label: "fecha fin", width: 150 },
                // { key: "puntuacion_victoria", label: "puntuacion_victoria", width: 150 },
                // { key: "puntuacion_empate", label: "puntuacion_empate", width: 150 },
                // { key: "puntuacion_derrota", label: "puntuacion_derrota", width: 150 },
                // {
                //     key: "creador_user_id", label: "reador", width: 200, render: (item) => {
                //         if (!usuarios[item]) return "null"
                //         return usuarios[item].name + " " + usuarios[item].last_name
                //     }
                // },
                { key: "estado", label: "Estado", width: 150 },
                { key: "nro_equipos", label: "Numero Equipos", width: 150 },
                { key: "id-editar", label: "Editar", width: 50, center: true, component: (item) => { return <SView onPress={() => { SNavigation.navigate(Parent.component + "/registro", { key: item }) }}> <SIcon name={"Edit"} width={35} /></SView> } },
                // { key: "id-equipo", label: "equipo", width: 50, center: true, component: (item) => { return <SView onPress={() => { SNavigation.navigate("equipo", { key_torneo: item }) }}> <SIcon name={"Ajustes"} width={35} /></SView> } },
                // { key: "id-partida", label: "partida", width: 50, center: true, component: (item) => { return <SView onPress={() => { SNavigation.navigate("partida", { key_torneo: item }) }}> <SIcon name={"Ajustes"} width={35} /></SView> } },
                { key: "id-ver", label: "Ver", width: 50, center: true, component: (item) => { return <SView onPress={() => { SNavigation.navigate(Parent.component + "/perfil", { key: item }) }}> <SIcon name={"Salir"} width={35} /></SView> } },
            ]}
            data={data}
            limit={50}
        />
    }
    render() {
        return (
            <SPage title={'Lista de ' + Parent.component} disableScroll center>
                {this.getContent()}
                <SButtom type={"float"} onPress={() => {
                    SNavigation.navigate(Parent.component + "/registro")
                }}>
                    <SIcon name={"Add"} height={50} />
                </SButtom>

            </SPage>
        );
    }
}
const initStates = (state) => {
    return { state }
};
export default connect(initStates)(Lista);