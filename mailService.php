<?php
class MailService
{
    private $token;
    private $email;

    function __construct($email)
    {
        $this->email = $email;
        $this->generateToken();
    }

    function generateToken()
    {
        if (!isset($this->token)) {
            $this->token = random_int(100000, 999999);
        }
    }

    public function sendToken()
    {
        $headres = array(
            "MIME-Version" => "1.0",
            "Content-Type" => "text/html;charset=UTF-8",
            "From" => "biblioteczka@mail.com",
            "Reply-To" => "biblioteczka@mail.com",
        );
        $subject = "Kod autoryzacyji";
        $send = mail($this->email, $subject, $this->token, $headres);

        echo "<script>console.log('Send result: " . $send . "' );</script>";
    }

    public function verifyToken($token)
    {
        $result = $this->token == $token;
        if ($result) {
            echo "<script>console.log('Token correct');</script>";
        } else {
            echo "<script>console.log('Token incorrect');</script>";
        }
        return $result;
    }

    // Debug functions

    public function printEmail()
    {
        echo "<script>console.log('Email is: " . $this->email . "' );</script>";
    }

    public function printToken()
    {
        echo "<script>console.log('Token is: " . $this->token . "' );</script>";
    }
}
?>