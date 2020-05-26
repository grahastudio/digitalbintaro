<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?php foreach ($category as $category) { ?>
                        <ul>
                            <li><a href="<?php echo base_url('category/' . $category->category_slug); ?>"><?php echo $category->category_name; ?></a></li>
                        </ul>
                    <?php }; ?>
                </div>
            </div>
        </div>
    </div>
</div>