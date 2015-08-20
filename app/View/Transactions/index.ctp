<div class="">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Categories
                <a class="btn btn-success pull-right" href="<?= Router::Url(['controller' => 'categories', 'action' => 'add']); ?>" style="margin-top: -8px;">Add Category</a>
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Photo</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0;
                foreach ($categories as $category) :
                $no++;
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $category['Category']['name'] ? $category['Category']['name'] : '' ?></td>
                    <td><?php echo $category['Category']['type'] ? $category['Category']['type'] : '' ?></td>
                    <td><?php echo $category['Category']['photo'] ? $category['Category']['photo'] : '' ?></td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="<?= Router::Url(['controller' => 'categories', 'action' => 'edit', $category['Category']['id']]); ?>">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a class="btn btn-danger" id="delete<?php echo $category['Category']['id'] ?>">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
                <script type="text/javascript">
                    $(document).ready(function() {
                    $("#delete<?php echo $category['Category']['id'] ?>").click(function() {
                        jQuery.ajax({
                            type:'DELETE',
                            async: true,
                            cache: false,
                            url: '<?= Router::Url(['controller' => 'categories', 'action' => 'deleteCategory', $category['Category']['id']], TRUE); ?>',
                            success: function(response) {
                                console.log(response);
                                window.location = '<?= Router::Url(['controller' => 'categories', 'action' => 'index'], TRUE); ?>';
                                jQuery('#currentWallet').val(response);
                            },
                            data:jQuery('form').serialize()
                        });
                        return false;
                    });
                    });
                </script>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>