
            <div id="results" class="welcome-message">
            	<h2><?php echo _("Welcome!"); ?></h2>
                <p>Hi, and welcome to NAME OF YOUR SEARCH ENGINE!</p>
                <p>This search engine currently features <strong><?php echo number_format($resultset->getNumFound()); ?> records</strong> from <strong><?php echo number_format(count($resultset->getFacetSet()->getFacet('FacetSource'))); ?> different data sources</strong>.</p>
                
                <h2><?php echo _("Notes about search"); ?></h2>
                <?php include('_includes/instructions.php'); ?>
                
                <h2><?php echo _("Upcoming record additions"); ?></h2>
                <p><?php echo _("More records are being added to this database on an ongoing basis, so check back soon for updates!"); ?>  <?php echo _("Planned upcoming record additions include"); ?>:</p>
                <ul>
                	<li>YOUR DATA GOES HERE</li>
                    <li><?php echo _("...and more!"); ?></li>
                </ul>
                <p><?php echo _("We also welcome submissions of new data sets."); ?></p>
                
                <h2><?php echo _("Upcoming site features"); ?></h2>
               	<ul>
                	<li>YOUR DATA GOES HERE</li>
                </ul>
                <br /><br />
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
