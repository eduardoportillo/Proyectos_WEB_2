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
        this.key_torneo = SNavigation.getParam("key_torneo");
    }

    getContent() {
        var data = Parent.Actions.getAll(this.key_torneo);
        var usuarios = user.Actions.getAll();
        if (!data) return <SLoad />;
        if (!usuarios) return <SLoad />;
        return <STable2
            header={[
                // { key: "index", label: "#", width: 50 },
                { key: "id", label: "Id", width: 50, center: true },
                { key: "nro_ronda", label: "# Ronda", width: 100, center: true, order: "desc" },
                { key: "id_equipo_1", label: "id_equipo_1", width: 100, center: true },
                { key: "id_equipo_2", label: "id_equipo_2", width: 100, center: true },
                { key: "ganador_partida_1", label: "Ganador 1", width: 100, center: true },
                { key: "ganador_partida_2", label: "Ganador 2", width: 100, center: true },
                
            ]}
            data={data}
            limit={50}
        />
    }
    render() {
        if (!this.key_torneo) {
            SNavigation.goBack();
        }
        return (
            <SPage title={'Lista de ' + Parent.component} disableScroll center>
                {this.getContent()}
                <SButtom type={"float"} onPress={() => {
                    SNavigation.navigate(Parent.component + "/registro", { key_torneo: this.key_torneo })
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