<?php

/* 
 * this file is accessed by the public and by admins as well.
 * 
 * Admins should be able to navigate to:
 *  1. Edit Tomb (for all fields)
 *  2. Download Deed
 * 
 *
 * 
 * BACK-END notes : TODO update these notes based on client needs
 * Users can also delete plots from this page. Deleting a plot should:
 *  1. DELETE all information associated with a plot (buried individual and owner)
 *      - This should not change the SQL logic as the table should automatically
 *          have "on cascade delete". You should only delete the plot from the table.
 *  2. deleting a buried individual should not delete the plot.
 *      The plot can remain with no data about buried individual.
 * 
 * 3. deleting an owner is only possible if the plot is changed to open
 */

