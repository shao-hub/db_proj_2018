<div class="container">
    <h2>You are in the View: application/views/anncs/index.php (everything in this box comes from that file)</h2>
    <!-- main content output -->
    <div>
        <?php
        if(Auth::isAdmin())
        {
            ?>
            <a href="<?php echo URL . 'anncs/add' ; ?>">add an announcement</a><br>
        <?php
        }
        ?>

        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>title</td>
                <td>date</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($anncs as $annc) { ?>
                <tr>
                    <td><?php if (isset($annc->title)) echo $annc->title; ?></td>
                    <td><?php if (isset($annc->date)) echo $annc->date; ?></td>
                    <td><a href="<?php echo URL . 'anncs/getDetail/' . $annc->id; ?>">detail</a></td>
                    <?php
                        if(Auth::isAdmin())
                        {
                            ?>
                            <td><a href="<?php echo URL . 'anncs/delete/' . $annc->id; ?>">x</a></td>
                    <?php
                        }
                    ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>
