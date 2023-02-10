<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function Add(Student $student)
        {
            $this->RetrieveData();
            array_push($this->studentList, $student);
            $this->SaveData();
        }

        public function Delete($recordId){

            $this->RetrieveData();

            foreach($this->studentList as $key => $student){

                //echo "<br>La key es $key ---> y el objeto es -->";
                //var_dump($student);
                //echo "<br><br>";

                if($student->getRecordId() == $recordId){
                    
                    //echo "<br> Elimino a --->";
                    //var_dump($this->studentList[$key]);
                    unset($this->studentList[$key]);
                    //var_dump($this->studentList[$key]);
                }
            }
            $this->SaveData($this->studentList);
        }

        public function GetAll()
        {
            $this->RetrieveData();
            /*
            foreach($this->studentList as $key => $student){

                echo "<br>La key es $key ---> y el objeto es -->";
                var_dump($student);
                echo "<br><br>";
            }
            */
            return $this->studentList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
                $valuesArray["recordId"] = $student->getRecordId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/students.json', $jsonContent);
        }

        public function Edit($recordId, $firstName, $lastName){

            $this->RetrieveData();

            foreach($this->studentList as $key => $student){

                if($student->getRecordId() == $recordId){

                    //echo "<br>Editar La key es $key ---> y el objeto es -->";
                    //var_dump($this->studentList[$key]);
                    $this->studentList[$key]->setRecordId($recordId);
                    $this->studentList[$key]->setFirstName($firstName);
                    $this->studentList[$key]->setLastName($lastName);
                }
            }
            $this->SaveData();            
        }

        private function RetrieveData()
        {
            $this->studentList = array();

            if(file_exists('Data/students.json'))
            {
                $jsonContent = file_get_contents('Data/students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $student = new Student();
                    $student->setRecordId($valuesArray["recordId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);

                    array_push($this->studentList, $student);
                }
            }
        }
    }
?>