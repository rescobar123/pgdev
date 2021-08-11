<?php  
if ($peticionAjax) {
	require_once "../core/MainModel.php";
}else{
	require_once "./core/MainModel.php";
}
class ContenidoModelo extends MainModel{

	//Desce aca para birro
	protected function obtenerBlogModelo($filtro){
		$sql=MainModel::conectar()->prepare("SELECT * FROM blog ".$filtro." ORDER BY Id DESC");
		$sql->execute();
		return $sql;
	}

		protected function obtenerComentariosBlogModelo($idBlog){
		$sql=MainModel::conectar()->prepare("SELECT IdComentario, ComentarioBlogComentario, ComentarioBlogFecha, ComentarioBlogUsuario, ComentarioBlogEmail FROM comentarioBlog WHERE IdBlog = :IdBlog AND IdBlog != 0 ORDER BY IdComentario DESC");
		$sql->bindParam(":IdBlog", $idBlog);
		$sql->execute();
		return $sql;
	}
	protected function obtenerComentariosDeComentarioBlogModelo($idComentario){
		$sql=MainModel::conectar()->prepare("SELECT IdComentario, ComentarioBlogComentario, ComentarioBlogFecha, ComentarioBlogUsuario, ComentarioBlogEmail FROM comentarioBlog WHERE ComentarioIdComentario = :IdComentario AND ComentarioIdComentario != 0 ORDER BY IdComentario ASC");
		$sql->bindParam(":IdComentario", $idComentario);
		$sql->execute();
		return $sql;
	}

	protected function obtenerBlogContenidoModelo($filtro){
		$sql=MainModel::conectar()->prepare("SELECT Id, BlogTitulo, BlogFechaPublicacion, BlogUsuarioCreo, BlogImagen, BlogPalabrasClave FROM blog ".$filtro." ORDER BY Id DESC");
		$sql->execute();
		return $sql;
	}

	protected function obtenerTipoBlogModelo(){
		$sql=MainModel::conectar()->prepare("SELECT * FROM tipoArticuloBlog  ORDER BY Id DESC");
		$sql->execute();
		return $sql;
	}

	protected function obtenerPortafolioModelo($filtro){
		$sql=MainModel::conectar()->prepare("SELECT * FROM tipoArticuloBlog  ORDER BY Id DESC");
		$sql->execute();
		return $sql;
	}

	public function agregarComentarioModelo($datos){
		$sql=MainModel::conectar()->prepare("INSERT INTO comentarioBlog(IdBlog, IdCuenta, ComentarioBlogComentario, ComentarioBlogFecha, ComentarioBlogUsuario, ComentarioBlogEmail, ComentarioIdComentario) VALUES(:IdBlog, :IdCuenta, :BlogComentario,  NOW(), :BlogUsuario, :BlogEmail, :IdComentario)");
		$sql->bindParam(":IdBlog", $datos['IdBlog']);
		$sql->bindParam(":IdCuenta", $datos['IdCuenta']);
		$sql->bindParam(":BlogComentario", $datos['BlogComentario']);
		$sql->bindParam(":BlogUsuario", $datos['BlogUsuario']);
		$sql->bindParam(":BlogEmail", $datos['BlogEmail']);
		$sql->bindParam(":IdComentario", $datos['IdComentario']);
		$sql->execute();

		return $sql;
	}

	protected function agregarNuevoMailModelo($datos){
		$sql=MainModel::conectar()->prepare("INSERT INTO contacto(ContactoNombre, ContactoEMail, ContactoAsunto, ContactoMensaje, ContactoFechaHora) VALUES(:Nombre, :Mail, :Asunto, :Mensaje, NOW())");
		$sql->bindParam(":Nombre", $datos['Nombre']);
		$sql->bindParam(":Mail", $datos['Mail']);
		$sql->bindParam(":Asunto", $datos['Asunto']);
		$sql->bindParam(":Mensaje", $datos['Mensaje']);
		$sql->execute();

		return $sql;
	}


}