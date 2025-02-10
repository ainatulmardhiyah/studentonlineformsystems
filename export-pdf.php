<?php
// Include the FPDF library
require('fpdf/fpdf.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "studentonlineformdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the student ID (replace this with dynamic logic for logged-in student)
$student_id = 1; // Replace with the actual logged-in student ID

// Fetch student details
$student_query = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$student_query->bind_param("i", $student_id);
$student_query->execute();
$student_result = $student_query->get_result();
$student = $student_result->fetch_assoc();

// Fetch submissions for the student
$sql = "SELECT * FROM submission WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// PDF Title
$pdf->Cell(0, 10, "Student Submissions", 0, 1, 'C');
$pdf->Ln(10);

// Student Info
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, "Name: " . $student['name'], 0, 1);
$pdf->Cell(50, 10, "Student ID: " . $student['student_id'], 0, 1);
$pdf->Ln(10);

// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, "ID", 1, 0, 'C');
$pdf->Cell(80, 10, "Assignment Name", 1, 0, 'C');
$pdf->Cell(50, 10, "Submission Date", 1, 0, 'C');
$pdf->Cell(40, 10, "File", 1, 1, 'C');

// Table Content
$pdf->SetFont('Arial', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row['submission_id'], 1, 0, 'C');
        $pdf->Cell(80, 10, $row['assignment_name'], 1, 0);
        $pdf->Cell(50, 10, $row['submission_date'], 1, 0, 'C');
        $pdf->Cell(40, 10, basename($row['file_url']), 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, "No submissions found.", 1, 1, 'C');
}

// Output the PDF
$pdf->Output("D", "Submissions.pdf");

// Clean up
$stmt->close();
$conn->close();
?>
