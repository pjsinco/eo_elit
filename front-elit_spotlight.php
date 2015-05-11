<?php 
/**
 * Template for the front-page spotlight.
 * 
 *
 * @package elit
 */

?>

      <div class="row">
        <div class="size-1-of-1">
          <div class="section-title-hat"><span class="section-title-hat__text">Spotlight</span></div>
        </div>
      </div>
      <div class="row">
        <div class="unit size-1-of-1 module">
          <div id="spotlight" class="spotlight">
            <h3 class="vis-title">Where graduates practice, by school</h3>
            <div class="spotlight__feature-wrapper">

              <div class="vis-info">
                <div class="school-info" id="school-info">
                  <p class="school-info__name"></p>
                  <p class="school-info__meta"></p>
                </div>
                <form class="schools-form">
                  <label class="schools-label" for="schools">Select school</label>
                  <select id='schools' name='schools'>
                    <option value="ATSU-KCOM">ATSU-KCOM</option>
                    <option value="DMU-COM">DMU-COM</option>
                    <option value="GA-PCOM">GA-PCOM</option>
                    <option value="KCUMB-COM">KCUMB-COM</option>
                    <option value="LECOM">LECOM</option>
                    <option value="LECOM-Bradenton">LECOM-Bradenton</option>
                    <option value="MSUCOM">MSUCOM</option>
                    <option value="MWU/AZCOM">MWU/AZCOM</option>
                    <option value="MWU/CCOM">MWU/CCOM</option>
                    <option value="NSU-COM">NSU-COM</option>
                    <option value="NYITCOM">NYITCOM</option>
                    <option selected value="OSU-COM">OSU-COM</option>
                    <option value="OU-HCOM">OU-HCOM</option>
                    <option value="PCOM">PCOM</option>
                    <option value="RowanSOM">RowanSOM</option>
                    <option value="TUCOM">TUCOM</option>
                    <option value="TUNCOM">TUNCOM</option>
                    <option value="UNECOM">UNECOM</option>
                    <option value="UNTHSC/TCOM">UNTHSC/TCOM</option>
                    <option value="UP-KYCOM">UP-KYCOM</option>
                    <option value="VCOM-Virginia Campus">VCOM-Virginia Campus</option>
                    <option value="WVSOM">WVSOM</option>
                    <option value="WesternU/COMP">WesternU/COMP</option>
                  </select>
                </form>
              </div> <!-- .vis-info -->
              <div id="vis" class="vis">
                <div class="ui-buttons">
                  <button id="reset" class="ui-button">Reset</button>
                </div>
              </div> <!-- .vis -->

            </div> <!-- spotlight__feature-wrapper -->
            <div class="spotlight__body">
              <h5 class="spotlight__kicker">DO<span style="text-transform: lowercase">s</span> in practice</h5>
              <h2 class="spotlight__head">Grads stay close to home</h2>
              <p class="spotlight__body-text">Here's a look at where AOA members are practicing, grouped by their medical school. As you'll see, they generally stay near the schools where they trained.</p>
              <p class="spotlight__body-text">We focus on AOA members&mdash;namely, those who are out of residency and care for patients&mdash;because they are the DOs for whom we have the most accurate information. We exclude schools that are too new to have a significant number of graduates out of residency.</p>
              <p class="spotlight__body-text--source">Sources: AOA Physician Masterfile; <em>The Journal of the American Osteopathic Association</em></p>
            </div> <!-- spotlight__body -->
          </div>
        </div>
      </div>
