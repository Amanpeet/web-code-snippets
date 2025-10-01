<div class= "obutton feature2" data-id="<?php echo $bookID;?>">
    <button class="reserve-button">Reserve Book</button>
</div>

<script>
$('.reserve-button').click(function(){

    var book_id = $(this).parent().data('id');

    $.ajax
    ({ 
        url: 'reservebook.php',
        data: {"bookID": book_id},
        type: 'post',
        success: function(result)
        {
            $('.modal-box').text(result).fadeIn(700, function() 
            {
                setTimeout(function() 
                {
                    $('.modal-box').fadeOut();
                }, 2000);
            });
        }
    });
});
</script>

<?php
session_start();

$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('library', $conn);

if(isset($_POST['bookID']))
{
    $bookID = $_POST['bookID'];

    $result = mysql_query("INSERT INTO borrowing (UserID, BookID, Returned) VALUES ('".$_SESSION['userID']."', '".$bookID."', '3')", $conn);

    if ($result)
        echo "Book #" + $bookId + " has been reserved.";
    else
        echo "An error message!";
}
?>