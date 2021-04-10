<?php
defined('C5_EXECUTE') or die('Access Denied.');

// Show Package Title
$this->controller->GetPackageTitle();
if (!isset($header) || !is_array($header)):

    ?>
    <form method="post" action="<?= $view->action('select_mapping') ?>">
        <?= $this->controller->token->output('select_mapping') ?>
        <fieldset>
            <legend><?= t('Select PageType') ?></legend>
            <div class="form-group">
                <?php
                $pagetypes = $this->controller->GetPageTypes();
                $names = [];
                foreach ($pagetypes as $pagetype):
                    $names[$pagetype['handle']] = $pagetype['name'];
                endforeach;
                ?>
                <?= $form->select('name[]', $names) ?>
            </div>
            <legend><?= t('Enter the path to import') ?></legend>
            <div class="form-group">
                <input type="text" name="path[]">
            </div>
            <legend><?= t('Select CSV File') ?></legend>
            <div class="form-group">
                <?php
                /** @var \Concrete\Core\Application\Service\FileManager $html */
                $html = Core::make('helper/concrete/file_manager');
                echo $html->file('csv', 'csv', t('Choose File'));
                ?>
            </div>
        </fieldset>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <button class="pull-right btn btn-primary" type="submit"><?= t('Next') ?></button>
            </div>
        </div>
    </form>
<?php
else:
    ?>
    <div class="alert alert-warning">
        <p>Maximum Datas 30Column!</p>
        <p>
            <?= t('Please enter "title" or "content" for attribute ID') ?>
        </p>
    </div>
    <form method="post" action="<?= $view->action('run_convert', $f->getFileID()) ?>">
        <?= $this->controller->token->output('run_convert') ?>
        <input type="hidden" name="name" value="<?= $name[0] ?>">
        <input type="hidden" name="path" value="<?= $path[0] ?>">
        <table class="table">
            <thead>
            <tr>
                <th><?= t('CSV Header'); ?></th>
                <th><?= t('Maps To'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($header as $index => $row) {
                ?>
                <tr>
                    <td>
                        <?= $row ?>
                    </td>
                    <td>
                        <p><?php echo t('Enter attribute ID'); ?></p>
                        <p><input type="text" name="mapping[]"></p>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <button class="pull-right btn btn-primary" type="submit"><?= t('Import') ?></button>
            </div>
        </div>
    </form>
<?php
endif;