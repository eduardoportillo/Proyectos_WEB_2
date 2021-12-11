import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SButtom, SIcon, SLoad, SNavigation, SPage, STable2, SText, SView } from 'servisofts-component';
import Parent from '../index'
class Lista extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    getContent() {
        var data = Parent.Actions.getAll();
        if (!data) return <SLoad />;
        return <STable2
            header={[
                { key: "index", label: "#", width: 50 },
                { key: "id", label: "Id", width: 150 },
                { key: "name", label: "Nombres", width: 150 },
                { key: "last_name", label: "Apellidos", width: 150 },
                { key: "email", label: "Correo", width: 150, order: "asc" },
                { key: "id-editar", label: "Editar", width: 50, center: true, component: (item) => { return <SView onPress={() => { SNavigation.navigate(Parent.component + "/registro", { key: item }) }}> <SIcon name={"Edit"} width={35} /></SView> } },
                { key: "key", label: "Roles", width: 50, center: true, component: (item) => { return <SView onPress={() => { SNavigation.navigate("") }}> <SIcon name={"Ajustes"} width={35} /></SView> } },
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