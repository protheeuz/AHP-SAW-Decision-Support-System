<?php
use yii\helpers\Url;

?>

</div>
</div>
</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin mau keluar?</div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i>Cancel</button>
                <a class="btn btn-danger" href="<?= Url::to(['site/logout']) ?>" data-method="post"><i class="fas fa-fw fa-sign-out-alt mr-1"></i>Logout</a>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>

<!-- Bootstrap core JavaScript-->
<script src="<?= Yii::getAlias('@web') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= Yii::getAlias('@web') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= Yii::getAlias('@web') ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= Yii::getAlias('@web') ?>/vendor/chart.js/Chart.min.js"></script>

<!-- Page level plugins -->
<script src="<?= Yii::getAlias('@web') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= Yii::getAlias('@web') ?>/js/demo/datatables-demo.js"></script>

<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>

</body>

</html>