<div id="latest-jobs"></div>


<script>

jQuery(document).ready(function ($) {
    function fetchJobCards() {
        $.ajax({
            url: 'https://api.techieparrot.com/jfdesign26/latest.php', // Update this URL based on your setup
            type: 'GET',
            success: function (data) {
                $('#latest-jobs').html(data); // Display cards in the container
            },
            error: function (error) {
                console.error('Error fetching job cards:', error);
            },
        });
    }

    // Fetch job cards on page load
    fetchJobCards();
});

</script>