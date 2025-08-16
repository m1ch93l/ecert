<?php

include __DIR__ . '/../config/database.php';

class Certificate extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getCertificatesByParticipantId($participantId)
    {
        $query = "SELECT acquired_cert.participant_id, 
                     certificate.id as certificate_id, 
                     certificate.type, 
                     certificate.event 
              FROM acquired_cert 
              INNER JOIN certificate ON acquired_cert.certificate_id = certificate.id 
              WHERE acquired_cert.participant_id = :participantId";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':participantId', $participantId, PDO::PARAM_INT);
        $stmt->execute();
        $certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $certificates;
    }

}