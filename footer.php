<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package elit
 */
?>

      <footer id="colophon" class="footer" role="contentinfo">
        <div class="footer__body">
          <div class="row--full module--footer">
            <div class="size-1-of-2">
            <?php
              if ( function_exists( 'ninja_forms_display_form' ) ) {
                ninja_forms_display_form( 5 );
              } 
            ?>
            </div>
            <div class="size-1-of-2--last">
              <div class="footer__block">
                <h2 class="footer__header--minor">Send us a note</h2>
                <p class="footer__body-text--white">
                  Have a news tip or idea for a story? Send it our way.
                </p>
                <a class="footer__btn--link" href="/drop-us-note">Contact us</a>
              </div>
            </div>
          </div>
          <div class="row--full">
            <h2 class="footer__header--minor">More from the <span><a href="http://www.osteopathic.org/Pages/default.aspx" title="American Osteopathic Association">American Osteopathic Association</a></span></h2>
            <div class="footer__col">
              <h3 class="footer__title">About the AOA</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://doctorsthatdo.org/" title="Home - Doctors of Osteopathic Medicine">Doctors That DO</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/aoa-membership/" title="AOA Membership - American Osteopathic Association">AOA Membership</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/leadership/" title="Leadership & Policy - American Osteopathic Association">Leadership and Policy</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/affiliated-organizations/" title="Affiliated Organizations - American Osteopathic Association">Related Organizations</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://aoa.rangemod.com/RetailSite.asp" title="American Osteopathic Association">AOA Store</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/work-at-the-aoa/" title="Work at the AOA - American Osteopathic Association">Work at the AOA</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Accreditation</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/accreditation/" title="COM Accreditation - American Osteopathic Association">COM Accreditation</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/graduate-medical-educators/search-opti-data/" title="Search OPTI data - American Osteopathic Association">Search OPTI Data</a>
                </li>
              </ul>
            </div> <!-- .footer__col -->

            <div class="footer__col">
              <h3 class="footer__title">Advocacy</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/advocacy/federal-advocacy-initiatives/" title="Federal Advocacy Initiatives - American Osteopathic Association">Federal Advocacy</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/advocacy/state-advocacy-initiatives/" title="State Advocacy Initiatives - American Osteopathic Association">State Advocacy</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/about/advocacy/international-advocacy" title="International advocacy initiatives - American Osteopathic Association">International Advocacy</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Education</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="http://opportunities.osteopathic.org/index.htm" title="AOA Opportunities">Find a Training Program</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/graduate-medical-educators/postdoctoral-training-standards/" title="Postdoctoral Training Standards - American Osteopathic Association">Postdoctoral Training</a>
                </li>
              </ul>
              <h3 class="footer__title">CME Opportunities</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://aoaonlinelearning.osteopathic.org/" title="AOA Online Learning">AOA Online Learning</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://omed.osteopathic.org/" title="OMED 2018: Come Together">OMED</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/cme/search/" title="CME Search - American Osteopathic Association">CME Search</a>
                </li>
              </ul>

            </div> <!-- .footer__col -->

            <div class="footer__col--last">
              <h3 class="footer__title">Professional Development</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/practicing-medicine/" title="Practicing Medicine - American Osteopathic Association">Practicing Medicine</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/life-career/career-planning/" title="Career Center - American Osteopathic Association">Career Center</a>
                </li>
                <li class="footer__list-item">
                  <a href="https://osteopathic.org/life-career/research/" title="Osteopathic Research - American Osteopathic Association">Research</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Physician Profiles</h3>
              <ul class="footer__list">
                <li class="footer__list-item">
                  <a href="https://aoaprofiles.org/" title="AOA Profiles">Order Physician Credentialing Reports</a>
                </li>
              </ul>
              
              <h3 class="footer__title">Other publications</h3>
              <ul class="footer__list">
                <li class="footer__list-item"><a href="http://jaoa.org/" title="Home | The Journal of the American Osteopathic Association">JAOA</a>
                </li>
              </ul>
            </div><!-- .footer__col-last -->
          </div><!-- .row -->
        </div> <!-- .footer__container -->

        <div class="row--full module">
          <p class="footer__body-text">
            Copyright <?php echo date('Y'); ?>, American Osteopathic Association. <span>All rights reserved.</span>
          </p>
          <ul class="footer__list--horiz">
            <li class="footer__list-item--horiz">
              <a href="/comment-policy" title="Comment Policy">Comment Policy</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="<?php bloginfo( 'rss_url' ) ?>" title="RSS feed">RSS</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="https://osteopathic.org/terms-of-use/" title="Terms of Use - American Osteopathic Association">Terms of Use</a>
            </li>
            <li class="footer__list-item--horiz">
              <a href="https://osteopathic.org/about/privacy-policy/" title="Privacy Policy - American Osteopathic Association">Privacy Policy</a>
            </li>
<!--             <li class="footer__list-item--horiz"> -->
<!--               <a href="http://www.osteopathic.org/inside-aoa/about/Pages/copyright-notice.aspx" title="Copyright Notice">Copyright Notice</a> -->
<!--             </li> -->
          </ul>
        </div><!-- .row -->
      </footer><!-- #colophon -->
    <?php if ( is_dev_env() ): ?>
      <script src="http://localhost:35729/livereload.js"></script>
    <?php endif; ?>
    <?php wp_footer(); ?>
  </body>
</html>

