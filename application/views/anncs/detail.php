<div class="container">
    <h2>You are in the View: application/views/anncs/datail.php (everything in this box comes from that file)</h2>
    <div>
        <h2><?php if (isset($annc->title)) echo $annc->title; ?></h2>
        <?php if (isset($annc->date)) echo $annc->date; ?><br><br>
        <?php if (isset($annc->description)) echo $annc->description; ?>

    </div>
</div>
