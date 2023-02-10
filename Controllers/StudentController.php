<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
        }

        public function ShowAddView(){
            //require_once(VIEWS_PATH."student-add.php");
            header("location: ../Home/Index");
        }

        public function ShowListView(){
            $studentList = $this->studentDAO->GetAll();
            sort($studentList);
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowEditView($recordId, $firstName, $lastName){
            require_once(VIEWS_PATH.'student-edit.php');
        }

        public function Add($recordId, $firstName, $lastName){
            $student = new Student();
            $student->setRecordId($recordId);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);
            $this->studentDAO->Add($student);
            $this->ShowAddView();
        }
        
        public function Delete($recordId){
            $this->studentDAO->Delete($recordId);
            $this->ShowListView();
        }
        
        public function Edit($recordId, $firstName, $lastName){
            $this->studentDAO->Edit($recordId, $firstName, $lastName);
            $this->ShowListView();
        }

        public function List(){
            $studentList = $this->studentDAO->GetAll();
        }
    }
?>