import React, { Component } from 'react';
import { connect } from 'react-redux';
import {
	SButtom,
	SForm,
	SHr,
	SPage,
	SText,
	SNavigation,
	SLoad,
	SView,
	SIcon,
	SPopup,
	SDate,
} from 'servisofts-component';
import SHttp from '../../../SHttp';
import equipo from '../../equipo';
import DetallePartida from '../../partida/Component/DetallePartida';
import user from '../../user';
import Parent from '../index';
class Perfil extends Component {
	constructor(props) {
		super(props);
		this.state = {};
		this.key_torneo = SNavigation.getParam('key');
	}

	getParticipantes() {
		if (!this.obj) return null;
		var usuarios = user.Actions.getAll();
		var equipos = equipo.Actions.getAll(this.obj.id);
		if (!equipos) return <SLoad />;
		if (!usuarios) return <SLoad />;
		var cant = parseInt(this.obj.nro_equipos);
		if (Object.keys(equipos).length >= cant) {
			if (!this.state.lleno) {
				this.setState({ lleno: true });
			}
		}
		var arr = [...new Array(cant)]
		return arr.map((a, i) => {
			var e = equipos[Object.keys(equipos)[i]];
			var usuario = {};
			if (e) {
				if (e.user_id) {
					usuario = usuarios[e.user_id];
				}
			}
			return <SView width={120} height={60} style={{
				padding: 8,
			}}>
				<SView col={"xs-12"} height center card onPress={() => {
					if (e) return;
					SPopup.confirm({
						title: "Confirmar",
						message: "¿Desea incribirse en el torneo?",
						onPress: () => {
							equipo.Actions.register({
								torneo_id: this.obj.id,
								nombre: "name"
							})
						}
					})

				}}>
					<SText col={"xs-12"} color={"#666"}>{e ? e.id : ""}</SText>
					<SView col={"xs-12"} flex center style={{
						padding: 8,
					}}>
						<SText center fontSize={12}>{e ? usuario.name : "Click para inscribirse!"}</SText>
					</SView>
				</SView>
			</SView>
		})

	}
	getIniciar() {
		if (this.obj.estado == "iniciado") {
			return <SText>Torneo iniciado</SText>
		}
		if(this.obj.creador_user_id != user.Actions.validateSession().id){
			return null;
		}
		if (!this.state.lleno) return <SText>El torneo aun no esta lleno!</SText>;
		var key_torneo = this.key_torneo;
		return <SButtom type='danger' onPress={() => {
			SHttp.get({
				component: "torneo",
				type: "iniciar"
			}, key_torneo + "")
		}}>Iniciar</SButtom>
	}
	getContent() {
		this.obj = {};
		if (this.key_torneo) {
			this.obj = Parent.Actions.getById(this.key_torneo, this.props);
			if (!this.obj) return <SLoad />;
		}
		return (
			<SView col={"xs-12 md-8 xl-6"} center>
				<SView col={"xs-11"} card center>
					<SHr />

					{/* <SView row col={"xs-12"} center>
						<SText col={"xs-5.5"} center>Inicio: {new SDate(this.obj.fecha_inicio).toString("yyyy MONTH, dd hh:mm")}</SText>
						<SText col={"xs-5.5"} center>Fin: {new SDate(this.obj.fecha_fin).toString("yyyy MONTH, dd hh:mm")}</SText>
					</SView> */}
					<SHr />
					<SText col={"xs-11"} fontSize={20}># {this.obj.id}</SText>
					<SText fontSize={18} bold>{this.obj.nombre}</SText>
					<SHr />
					<SText fontSize={18} col={"xs-11"}>Juego: {this.obj.juego_torneo}</SText>
					<SHr />
					<SText col={"xs-11"}>Estado: {this.obj.estado}</SText>
					<SHr />
					<SText col={"xs-11"}>Modalidad: {this.obj.modalidad_torneo}</SText>
					<SHr />
					<SText col={"xs-11"}># de Equipos: {this.obj.nro_equipos}</SText>
					<SHr />
					{/* <SText col={"xs-11"}>Creador: {this.obj.creador_user_id}</SText> */}
					{/* <SHr /> */}
					<SHr />

					<SView row>
						<SView center card style={{ padding: 8 }}>
							<SText>{this.obj.puntuacion_victoria}</SText>
							<SText>Victoria</SText>
						</SView>
						<SView width={20} />

						<SView center card style={{ padding: 8 }}>
							<SText>{this.obj.puntuacion_empate}</SText>
							<SText>Empate</SText>
						</SView>
						<SView width={20} />
						<SView center card style={{ padding: 8 }}>
							<SText>{this.obj.puntuacion_derrota}</SText>
							<SText>Derrota</SText>
						</SView>
					</SView>
					<SHr />
					<SHr />
					{this.getIniciar()}
					<SHr />
					<SHr />
				</SView>


			</SView>
		);
	}
	render() {
		return (
			<SPage title={'Perfil de ' + Parent.component} center>
				<SView height={30}></SView>
				{this.getContent()}
				<SHr />
				<SHr />
				<SText fontSize={20}>Equipos</SText>
				<SHr />
				<SView row col={"xs-12 sm-10 md-8"} center>
					{this.getParticipantes()}
				</SView>
				<SView row col={"xs-12 sm-10 md-8 lg-6"} center>
					<DetallePartida key_torneo={this.key_torneo} />
				</SView>
			</SPage>
		);
	}
}
const initStates = state => {
	return { state };
};
export default connect(initStates)(Perfil);
