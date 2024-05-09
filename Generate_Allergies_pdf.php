<?php
require_once('TCPDF/tcpdf.php');

//Retrieving data from the query parameter(Damodaran,2013)
$data = json_decode(urldecode($_GET['data']), true);

//Create a new TCPDF instance(Damodaran,2013)
$pdf = new TCPDF();

//Remove the default header and footer(Damodaran,2013)
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//Initialize the PDF content(Damodaran,2013)
$pdfAllergies = '';

//Define the table headers(Damodaran,2013)
$pdfAllergies .= '<h1 style="text-align: center"></h1>';
$pdfAllergies .= '<p style="text-align: center;"><img src="Images/DaycareLogo.jpg" alt="Logo" style="width: 400px;"></p>';
$pdfAllergies .= '<br><br><br><br><br><br><br><br><br><br><br><br><h1 style="text-align: center">Allergies Report</h1>';

//Create the table with custom styling(Damodaran,2013)
$pdfAllergies .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black;">';
$pdfAllergies .= '<tr>';
$pdfAllergies .= '<th style="width: 50%; border: 1px solid black; font-weight: bold;">Child Name</th>';
$pdfAllergies .= '<th style="width: 50%; border: 1px solid black; font-weight: bold;">Allergies</th>';
$pdfAllergies .= '</tr>';

//Loop through the data and populate the table(Damodaran,2013)
foreach ($data as $row) {
    $pdfAllergies .= '<tr>';
    $pdfAllergies .= '<td style="border: 1px solid black;">' . $row['child_name'] . '</td>';
    $pdfAllergies .= '<td style="border: 1px solid black;">' . $row['allergies'] . '</td>';
    $pdfAllergies .= '</tr>';
}

$pdfAllergies .= '</table>';

//Add a new page for each set of allergy details(Damodaran,2013)
$pdf->AddPage();
$pdf->writeHTML($pdfAllergies, true, false, true);

//Output the PDF to the browser
$pdf->Output('Allergies_Report.pdf', 'D');
?>
