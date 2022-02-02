<?php

/* 
 * this page is accessible by the public and admins
 * 
 * the page should have a collection of cards, search bar at the bottom that
 * filters dead individuals by name.
 * 
 * Filter button should make the FilterModal pop up.
 * There should be no search button as we should filter the results using JS
 * 
 * The cards should have 3 properties:
 *  1. Dead individual name
 *  2. Owner name (only accessible by admins)
 *  3. DoD
 * 
 * BACK-END notes: 
 *  1. the public should only see the plots that belong to a dead person.
 *  2. admins can see plots that are not associated with a dead person.
 *      These plots must have an owner
 */

