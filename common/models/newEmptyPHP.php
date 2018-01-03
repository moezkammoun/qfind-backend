<?php
$this->title = (isset($pricing_general->meta_title)) ? $pricing_general->meta_title : 'Orbi';
$pricing = \backend\models\TicketsPricing::find()->where(['status' => 1])->all();
$this->registerLinkTag(['rel' => 'canonical', 'href' => \yii\helpers\Url::canonical()]);

$this->registerLinkTag(['rel' => 'alternate', 'href' => 'https://' . $_SERVER['SERVER_NAME'] . Yii::$app->request->baseUrl . '/ar/pricing', 'hreflang' => "ar"]);
?>
<div class="packages_page with_logo">

    <div class="contact_box full_page" id="pricing">


        <div class="container"  style="width:1000px;">
            <h1>Pricing</h1>
            <div class="row">
                <div class="col-sm-8">
                    <div class="pricing_box">

                        <?php foreach ($pricing as $price) { ?>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h2>
                                            <?= ($price->name) ? strtoupper($price->name) : 'Not Set' ?></h2>
                                        <?= ($price->offer_text) ? $price->offer_text : '' ?>



                                        <?php
                                        $ticketRanges = backend\models\TicketsDetails::find()->where(['ticket_id' => $price->id])->orderBy(['sort_order' => SORT_ASC])->all();
                                        if (count($ticketRanges) > 0) {
                                                ?>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <?php foreach ($ticketRanges as $ticketRange) { ?>
                                                                <tr>
                                                                    <td><?= ($ticketRange->description) ? $ticketRange->description : '' ?> </td>
                                                                    <td width="60" align="right" style="vertical-align:top"><?= ($ticketRange->price) ? $ticketRange->price : '' ?></td>
                                                                </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="col-xs-4 boorder_left">
                                                <div class="book_btn"><a href="/reserve-now" class="btn btn-default skelton">Reserve Now</a>
                                                </div>
                                            </div>
                                    <?php } ?>
                                </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-xs-8">
                                <h2>Mirdif Experience </h2>
                                Enjoy any of the leisure and entertainment offers  at City Centre Mirdif at a special price.

                            </div>
                            <div class="col-xs-4 boorder_left">
                                <div class="book_btn"><a href="https://www.theplaymania.com/offers/mirdif-experience"  target="_blank"  class="btn btn-default skelton">View Offer Details</a>
                                </div>
                            </div>
                        </div>




                        <?php /*
                          <?php foreach ($pricing as $price) { ?>
                          <div class="row">
                          <div class="col-xs-8">
                          <h2><?= ($price->name) ? strtoupper($price->name) : 'Not Set' ?>
                          <?= ($price->offer_text) ? '<br><span>(' . strtoupper($price->offer_text) . ')</span>' : '' ?></h2>
                          <p><?= ($price->short_description) ? $price->short_description : 'Not Set' ?></p>
                          </div>
                          <div class="col-xs-4 boorder_left">
                          <div class="amount">AED <?= ($price->price) ? $price->price : 'Not Set' ?></div>
                          <div class="book_btn"><a href="<?= Yii::$app->request->baseUrl . '/reserve-now' ?>" class="btn btn-default skelton" >Reserve Now</a></div>
                          </div>
                          </div>

                          <?php } ?>
                          <p class="terms_condition">*Kids below 3 years get to enter for free.</p>
                         */ ?>
                    </div>
                </div>
                <div class="col-sm-4 margin-auto"><img src="<?= Yii::$app->request->baseUrl . '/images/elephants_1.png' ?>" alt="Elephants"/></div>
                <div class="animal_element elepant ststic_on_small"></div>
            </div>
        </div>
    </div>





</div>



