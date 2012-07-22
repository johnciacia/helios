<?php

class TeacherController extends Controller {

	public function __construct() {
		require_once('models/TeacherModel.php');
		$this->model = new TeacherModel();

		switch( $_GET['q'] ) {
			case 'delete':
				$this->deleteTeacher();
				break;
			case 'edit':
				$this->editTeacher();
				break;
			case 'add':
				$this->addTeacher();
				break;
			default:
				$this->listTeachers();
		}
	}

	public function addTeacher() {
		if( $this->post_validate( array('first_name', 'last_name', 'teach_id') ) ) {
			$this->model->add_teacher( $_POST['first_name'], $_POST['last_name'], $_POST['teach_id']);
			header("Location: ?p=teacher");
		}
		$this->loadView('header.php');
		$this->loadView('add_teacher.php');
		$this->loadView('footer.php');
	}

	public function listTeachers() {
		$this->loadView('header.php');
		if( isset( $_GET['update']) && $_GET['update'] == 1
			&& isset($_GET['id'])) {
			$teacher = $this->model->get_teacher( $_GET['id'] );
			echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				'. $teacher['first_name'] .' ' . $teacher['last_name'] . ' has been updated.
				</div>';
		}
		$teachers = $this->model->get_teachers();

		$args = array( 'teachers' => $teachers );
		$this->loadView('list_teachers.php', $args);
		$this->loadView('footer.php');
	}

	public function editTeacher() {
		if( isset($_POST['action']) && $_POST['action'] == 'update-teacher') {
			$this->model->update_teacher( $_GET['id'], $_POST['first_name'], $_POST['last_name'], $_POST['teach_id']);
			header("Location: ?p=teacher&update=1&id=" . $_GET['id']);
		}

		$this->loadView('header.php');
		$teacher = $this->model->get_teacher( $_GET['id'] );
		$args = array( 
			'first_name' => $teacher['first_name'],
			'last_name' => $teacher['last_name'],
			'teach_id' => $teacher['teach_id']
		);
		$this->loadView('edit_teacher.php', $args );
		$this->loadView('footer.php');
	}

	public function deleteTeacher() {
		$this->model->delete_teacher( $_GET['id'] );
		header("Location: ?p=teacher");
	}
}