<?php
class Project {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Méthode pour récupérer les projets d'un responsable
    public function getByResponsable($responsableId) {
        $query = "SELECT * FROM projet WHERE responsable = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $responsableId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        
        return $projects;
    }

    // Autres méthodes existantes...
}
?>

<?php
require_once '../models/Project.php';
require_once '../models/Person.php';
require_once '../models/TimeSlot.php';
require_once '../models/Appointment.php';

class ProjectController {
    private $projectModel;
    private $personModel;
    private $timeSlotModel;
    private $appointmentModel;

    public function __construct() {
        $this->projectModel = new Project();
        $this->personModel = new Person();
        $this->timeSlotModel = new TimeSlot();
        $this->appointmentModel = new Appointment();
    }

    public function listProjects() {
        session_start();
        $userId = $_SESSION['user_id'];
        $projects = $this->projectModel->getByResponsable($userId);
        require_once '../views/projects/list.php';
    }

    public function addProject() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'label' => $_POST['label'],
                'responsable' => $_SESSION['user_id'],
                'groupe' => $_POST['groupe']
            ];
            
            if ($this->projectModel->create($data)) {
                header('Location: /projects');
                exit;
            } else {
                $error = "Erreur lors de la création du projet";
                require_once '../views/projects/add.php';
            }
        } else {
            require_once '../views/projects/add.php';
        }
    }

    public function listExaminers() {
        $examiners = $this->personModel->getExaminers();
        require_once '../views/projects/examiners.php';
    }

    public function projectExaminers($projectId) {
        $examiners = $this->timeSlotModel->getExaminersByProject($projectId);
        $project = $this->projectModel->getById($projectId);
        require_once '../views/projects/project_examiners.php';
    }

    public function projectSchedule($projectId) {
        $appointments = $this->appointmentModel->getByProject($projectId);
        $project = $this->projectModel->getById($projectId);
        require_once '../views/projects/schedule.php';
    }
}
?>