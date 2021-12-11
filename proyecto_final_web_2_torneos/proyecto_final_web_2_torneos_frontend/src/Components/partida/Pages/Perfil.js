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
} from 'servisofts-component';
import SHttp from '../../../SHttp';
import Parent from '../index';
class Perfil extends Component {
	constructor(props) {
		super(props);
		this.state = {};
		this.key = SNavigation.getParam('key');
	}

	getParticipantes() {
		if (!this.obj) return null;
		var cant = this.obj.nro_equipos;
		return [...Array(cant)].map((a, i) => {
			return <SView width={100} height={100} style={{
				padding: 8,
			}}>
				<SView col={"xs-12"} height center card>
					<SText>{i+1}</SText>
				</SView>
			</SView>
		})

	}
	getContent() {
		this.obj = {};
		if (this.key) {
			this.obj = Parent.Actions.getById(this.key, this.props);
			if (!this.obj) return <SLoad />;
		}
		return (
			<SView col={"xs-12 md-8 xl-6"} center>
				<SText>Id Torneo: {this.obj.id}</SText>
				<SText>Nombre: {this.obj.nombre}</SText>
				<SText>Juego Torneo: {this.obj.juego_torneo}</SText>
				<SText>Modalidad Torneo: {this.obj.modalidad_torneo}</SText>
				<SText>Fecha Inicio: {this.obj.fecha_inicio}</SText>
				<SText>Fecha Fin: {this.obj.fecha_fin}</SText>
				<SText>
					Puntuacion Victoria: {this.obj.puntuacion_victoria}
				</SText>
				<SText>Puntuacion Empate: {this.obj.puntuacion_empate}</SText>
				<SText>Puntuacion Derrota: {this.obj.puntuacion_derrota}</SText>
				<SText>Creador: {this.obj.creador_user_id}</SText>
				<SText>Numero de Equipos: {this.obj.nro_equipos}</SText>

				{/* <SButtom
					type='danger'
					onPress={() => {
						SHttp.post({
							comoponent: 'equipo',
							type: 'register',
							data: { torneo_id: this.obj.id }
						});
					}}
				>
					i
				</SButtom> */}


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
				<SView row col={"xs-12 sm-10 md-8 lg-6 xl-4"} center>
					{this.getParticipantes()}
				</SView>
			</SPage>
		);
	}
}
const initStates = state => {
	return { state };
};
export default connect(initStates)(Perfil);
