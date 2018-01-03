
<tr>
    <td style="padding-top: 2em;text-align: center"><h2>Welocme to NinePillar</h2></td>
</tr>
<tr>
    <td style="line-height: 25px;padding-top: 1em;text-align: justify">
        <?php
        echo 'Hi ' . $model->name . ',';
        ?>
        <br>
        Thank you for signing Nine Pillers . Please click the below button "Verify my Account" to verify your email.
<br><center> <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/nine-piller/sellers/activate?id=<?= $model->auth_token ?>" class="button">Verify my account</a></center><br>
<p>( If you are not able to click the button, please copy paste the following url to your browser and proceed.<br> http://<?= $_SERVER['HTTP_HOST'] ?>/nine-piller/sellers/activate?id=<?= $model->auth_token ?> )</p>
<center>   <p style="font-size: 11px"> NB : Other features will be available to you only after verifying your email account. </p></center>




