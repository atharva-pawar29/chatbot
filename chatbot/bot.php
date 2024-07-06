<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $message = $_POST['message'];
  $response = "";

  // Bot logic
  if (strtolower($message) === "" || strtolower($message) === null || strtolower($message) === 'intro') {
    $response = "Hello! I am a chatbot at your service. How can I assist you today?";
  } elseif (strtolower($message) === "hi" || strtolower($message) === "hello") {
    $response = "Hello! How can I assist you today?";
  } elseif (strtolower($message) === "what is your name" || strtolower($message) === "who" || strtolower($message) === "you" || strtolower($message) === "who are you") {
    $response = "My name is ChatBot. Nice to meet you!";
  } elseif (strtolower($message) === "tell me about blood donation" || strtolower($message) === "blood" || strtolower($message) === "donation") {
    $response = "Blood donation is the process of voluntarily giving blood to be used for transfusion or other medical purposes. It helps save lives and improve health conditions.";
  } elseif (strtolower($message) === "tell me about yourself" || strtolower($message) === "about you" || strtolower($message) === "your information") {
    $response = "Blood bank is a place where blood bags collected from blood donation events are stored. The term 'blood bank' refers to a division of a hospital laboratory where blood product storage occurs and proper testing is performed to reduce the risk of transfusion-related events. The process of managing the blood bags received from blood donation events needs proper and systematic management. The blood bags must be handled with care and treated thoroughly as they are related to someone's life. The development of the Web-based Blood Bank And Donation Management System (BBDMS) is proposed to provide a management function to the blood bank in order to handle the blood bags and to make entries of individuals who want to donate blood and those who are in need.";
  } elseif (preg_match('/^hi i am (.+)$/i', $message, $matches) || preg_match('/^i am (.+)$/i', $message, $matches)) {
    $name = $matches[1];
    $response = "Hello $name! How can I assist you today?";
  } else {
    $response = "I'm sorry, I don't have information about that. How else can I assist you? Please provide your blood group and I can tell you the available blood groups which are currently available.";
  }

  echo $response;
}
?>
