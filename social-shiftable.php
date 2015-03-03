<?php 
/**
 * 
 * Template for displaying social icons
 * 
 * @package elit
 */


?>

<?php 
  $link = urlencode( get_permalink() );
?>
<ul class="social social--shiftable">
  <li class="social__icon">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" class="social--shiftable__link" target="_blank">
      <span class="icon-facebook">
        <span class="text-replace">Facebook</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="#" class="social--shiftable__link">
      <span class="icon-twitter">
        <span class="text-replace">Twitter</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="#" class="social--shiftable__link">
      <span class="icon-linkedin">
        <span class="text-replace">LinkedIn</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="#" class="social--shiftable__link">
      <span class="icon-pinterest">
        <span class="text-replace">Pinterest</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="#" class="social--shiftable__link">
      <span class="icon-mail">
        <span class="text-replace">Email</span>
      </span>
    </a>
  </li>
</ul>

