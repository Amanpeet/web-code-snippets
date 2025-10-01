https://mpdf.github.io/reference/mpdf-functions/output.html
https://mpdf.github.io/

Output()

(FPDF)

Output – Finalise the document and send it to specified destination
DescriptionPermalink¶

string Output ([ string $filename , string $dest ])

Send the document to a given destination: browser, file or string. In the case of browser, the plug-in may be used (if present) or a download (“Save as” dialog box) may be forced.
ParametersPermalink¶

$filename

The name of the file. If not specified, the document will be sent to the browser (destination I).

BLANK or omitted: “doc.pdf”

$dest

Destination where to send the document.

DEFAULT: “I” i.e. Browser

I: send the file inline to the browser. The plug-in is used if available. The name given by $filename is used when one selects the “Save as” option on the link generating the PDF.

D: send to the browser and force a file download with the name given by $filename.

F: save to a local file with the name given by $filename (may include a path).

S: return the document as a string. $filename is ignored.
**Note:** You can use the 'S' option to e-mail a PDF file - see example under E-mail a PDF file.