import React, { Component } from 'react';
import { connect } from 'react-redux';
import { SHr, SLoad, SOrdenador, SPage, SPopup, SText, SView } from 'servisofts-component';
import partida from '..';
import SHttp from '../../../SHttp';
import equipo from '../../equipo';
import torneo from '../../torneo';
import user from '../../user';

class DetallePartida extends Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    cb({ ronda, partida, resultado }) {

        var id_usr = user.Actions.validateSession().id;
        var equipo1 = this.getEquipo(partida.id_equipo_1)
        if (!equipo1) equipo1 = {};
        var equipo2 = this.getEquipo(partida.id_equipo_2)
        if (!equipo2) equipo2 = {};
        return <SView width={50} height={30} style={{
            padding: 4,
        }}>
            <SView card col={"xs-12"} height center onPress={() => {
                if (this.ronda_actual != ronda) return;

                if (partida.resultado) return;
                if (id_usr != this.torneo.creador_user_id) {
                    if (equipo1.id != id_usr && equipo2.id != id_usr) {
                        return;
                    }
                }
                SPopup.confirm({
                    title: "Marcar como ganador",
                    onPress: (ptd) => {
                        SHttp.post({
                            component: "partida",
                            type: "win",
                            data: {
                                partida_id: partida["id"],
                                resultado: resultado,
                            }
                        })
                    }
                })
            }}>
                <SText>{partida.resultado ? (partida.resultado == resultado ? "win" : "loss") : ""}</SText>
            </SView>
        </SView>
    }

    getEquipo(id_equipo) {
        var usuarios = user.Actions.getAll();
        var equipos = equipo.Actions.getById(this.props.key_torneo, id_equipo);
        if (!equipos) return null;
        return usuarios[equipos.user_id];
    }
    getFixture() {
        var partidas = partida.Actions.getAll(this.props.key_torneo);
        if (!partidas) return <SLoad />;
        this.partidas = partidas;
        var rondas = {};
        Object.keys(partidas).map((key) => {
            var obj = partidas[key];
            if (!rondas[obj.nro_ronda]) rondas[obj.nro_ronda] = [];
            rondas[obj.nro_ronda].push(obj);
        })
        var ronda_actual = 1;
        return new SOrdenador([{ key: "index", order: "desc" }]).ordernarObject(rondas).map((ronda, i) => {
            var ptds_ronda = rondas[ronda];
            var isComplete = true;
            var LIST = ptds_ronda.map((ptd) => {
                if (!ptd.resultado) {
                    isComplete = false;
                }
                return <SView col={"xs-12 sm-6"} style={{ padding: 8 }}>
                    <SView col={"xs-12"} row card center>
                        <SHr />
                        <SView col={"xs-5"} row center>
                            <SText fontSize={11}>{ptd["id_equipo_1"] ? this.getEquipo(ptd["id_equipo_1"]).name : `Ganador pt ${ptd["ganador_partida_1"]}`}</SText>
                            {this.cb({ ronda: i + 1, partida: ptd, resultado: "1" })}
                        </SView>
                        <SView col={"xs-2"} row center>
                            <SText color={"#666"}>{" vs "}</SText>
                        </SView>
                        <SView col={"xs-5"} row center>
                            {this.cb({ ronda: i + 1, partida: ptd, resultado: "2" })}
                            <SText fontSize={11}>{ptd["id_equipo_2"] ? this.getEquipo(ptd["id_equipo_2"]).name : `Ganador pt ${ptd["ganador_partida_2"]}`}</SText>
                        </SView>
                        <SHr />
                    </SView>
                </SView>
            })
            if (isComplete) {
                ronda_actual = i + 2;
            }
            this.ronda_actual = ronda_actual;
            return <>
                <SHr />
                <SView col={"xs-12"} card row>
                    <SView row col={"xs-12"}>
                        <SText color={"#666"}> Ronda {i + 1}</SText>
                        <SView flex />
                        <SText color={"#666"}>  {ronda_actual >= (i + 1) ? (ronda_actual != (i + 1) ? "Finalizado" : "En progreso") : "Esperando ronda anterior!!"}</SText>
                    </SView>

                    <SHr />
                    {LIST}
                    <SHr />
                </SView>
                <SHr />
            </>
        });
    }

    render() {
        if (!this.props.key_torneo) return null;
        this.torneo = torneo.Actions.getById(this.props.key_torneo, this.props);
        if (!this.torneo) return <SLoad />;
        if (this.torneo.estado != "iniciado") return null;

        return (
            <SView col={"xs-12"} center>
                <SHr />
                <SText fontSize={20}>Fixture</SText>
                <SView col={"xs-12"}>
                    {this.getFixture()}
                </SView>
                <SHr height={50} />
            </SView>
        );
    }
}
const initStates = (state) => {
    return { state }
};
export default connect(initStates)(DetallePartida);