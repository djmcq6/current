<!-- foldernavigation.php -->
<div class="row">
    <div class="col col-c">
        <h5 class="text-left">
            <?php
            // Get values for '$portfolio' or 'portfolio', '$filter1' or 'filter1', and '$filter2' or 'filter2' with default values as empty strings
            $portfolioName = $_GET['$portfolio'] ?? $_GET['portfolio'] ?? '';
            $filter1 = $_GET['$filter1'] ?? $_GET['filter1'] ?? '';
            $filter2 = $_GET['$filter2'] ?? $_GET['filter2'] ?? '';
            $filter3 = $_GET['$filter3'] ?? $_GET['filter3'] ?? '';

            // Check if '$portfolio' or 'portfolio' variable exists
            if (!empty($portfolioName)) {
                // Check if '$filter3' or 'filter3' variable exists
                if (!empty($filter3)) {
                    echo "Users/Derek/Portfolio/$portfolioName/$filter1/$filter2/$filter3";
                } elseif (!empty($filter2)) {
                    echo "Users/Derek/Portfolio/$portfolioName/$filter1/$filter2";
                } elseif (!empty($filter1)) {
                    echo "Users/Derek/Portfolio/$portfolioName/$filter1";
                } else {
                    echo "Users/Derek/Portfolio/$portfolioName";
                }
            } else {
                echo 'Users/Derek/Portfolio';
            }
            ?>
        </h5>
        <!-- Add content for the first row in column B here -->
    </div>
</div>

