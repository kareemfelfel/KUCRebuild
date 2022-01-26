<?php

/* 
 * this file is accessed by the public and by admins as well.
 * 
 * Admins should be able to navigate to:
 *  1. Edit Plot
 *  2. Edit Buried Individual.
 *  3. Edit Plot Owner.
 * 
 * Admins should have buttons to:
 *  1. Delete Plot
 *  2. Delete Buried Individual
 *  3. Delete Plot Owner
 * 
 * BACK-END notes:
 * Users can also delete plots from this page. Deleting a plot should:
 *  1. DELETE all information associated with a plot (buried individual and owner)
 *      - This should not change the SQL logic as the table should automatically
 *          have "on cascade delete". You should only delete the plot from the table.
 *  2. deleting a buried individual should not delete the plot.
 *      The plot can remain with no data about buried individual.
 *  (to be discussed) 3. deleting an owner should automatically delete the whole plot.
 */

