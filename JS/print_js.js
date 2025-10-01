$(document).ready(function(){

  //PRINT FUNCTION
  $(".print-btn").click(function(){
    PrintElement('.report-grid');
  });  
  function PrintElement(elem){
    Popup($(elem).parent().html());
  }
  //Creates a new window and populates it with your content
  function Popup(data) {
    //Create your new window
    var w = window.open('', 'Print Me', 'height=600,width=800');
    w.document.write('<html><head><title>Print Me</title>');
    //Include your stylesheet (optional)
    w.document.write("<link rel='stylesheet' id='twentyfifteen-table-css'  href='https://www.precisefinancialgroup.com/wp-content/themes/own/css/table.css' type='text/css' media='all' /> ");
    w.document.write('</head><body>');
    //Write your content
    w.document.write(data);
    w.document.write('</body></html>');
    w.print();
    w.close();
    return true;
  }//print end

});

