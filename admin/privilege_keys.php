<?php 

    ##########################
    # TEMPLATE FOR NEW PAGES #
    # REFRENCES HEADER.PHP   #
    #         + FOOTER.PHP   #
    #                        #
    # MAKE SURE TO UPDATE    #
    # THE ASSETS REFRENCE    #
    ##########################

    $ASSETS_FOLDER = "../assets/";

    require($ASSETS_FOLDER."header.php");



?>
<<script>

    $(document).ready(function() {
        $('#pkeys').DataTable();
    } );

</script>


<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Privilege Keys [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="pkeys" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cell 1</td>
                            <td>Cell 2</td>
                        </tr>
                        <tr>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>