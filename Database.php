<?php

class Database extends mysqli
{


    private ?string $host = "localhost";
    private ?string $user = "root";
    private ?string $password = "root";
    private ?string $database = "calendar";
    public static $instance = null;

    public function __construct()
    {
        parent::__construct($this->host, $this->user, $this->password, $this->database);
    }


    public static function getInstance(): ?self
    {
        return self::$instance === null ? new Database() : self::$instance;
    }

    public function fetchAppointments(?int $id): ?array
    {
        $result = array();
        $stmt = $this->prepare("SELECT * FROM appointment WHERE organizer = ? order by date desc;");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $result[] = $row; // Add each row to the result array
            }
        }

        $stmt->close();
        return !empty($result) ? $result : null;
    }

    public function addAppointment(?Appointment $appointment) {
        $stmt = $this->prepare("INSERT INTO appointment (date, organizer, email, description) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Error preparing SQL statement: " . $this->error);
        }

        $data = array(
            'date' => $appointment->getDate(),
            'organizer' => $appointment->getOrganizer(),
            'email' => $appointment->getEmail(),
            'descr' => $appointment->getDescription()
        );

        $stmt->bind_param('ssss', $data['date'], $data['organizer'], $data['email'], $data['descr']);

        if (!$stmt->execute()) {
            throw new Exception("Error executing SQL statement: " . $stmt->error);
        }

        $stmt->close();
    }


    public function fetchUserFromEmail(?string $email){
        $stmt= $this->prepare("select username from user where email =?");
        $stmt->bind_param('s',$email);
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();
        return $username();
    }
    public function closeConnection(){
        $this->close();
    }

    public function fetchAppointmentById(?int $id){
        $stm = $this->prepare("SELECT date, description, email FROM appointment WHERE id = ?");
        $stm->bind_param('i', $id);
        $stm->execute();
        $stm->bind_result($date, $description, $email);
        $stm->fetch();
        $stm->close();  // Close the statement after fetching the data

        // Return the fetched data as an associative array
        return [
            'date' => $date,
            'description' => $description,
            'email' => $email
        ];
    }

}