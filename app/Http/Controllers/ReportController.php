<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Book;

class ReportController extends Controller
{
    public function showForm()
{
    return view('reports.form');
}

public function generate(Request $request)
{
    $request->validate([
        'from' => 'required|date',
        'to' => 'required|date|after_or_equal:from',
    ]);

    $books = Book::with('author')
        ->whereBetween('publish_date', [$request->from, $request->to])
        ->get();

    $pdf = new TCPDF();
    $pdf->AddPage();

    $html = "<h2>Book Report ({$request->from} to {$request->to})</h2><table border='1' cellpadding='5'><tr><th>Title</th><th>Author</th><th>Publish Date</th></tr>";

    foreach ($books as $book) {
        $html .= "<tr><td>{$book->title}</td><td>{$book->author->name}</td><td>{$book->publish_date}</td></tr>";
    }

    $html .= "</table>";

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('book_report.pdf');
}
}
