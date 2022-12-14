<?= $this->extend('layout/layout') ?>
<?= $this->section('isActiveCollapseTransaction') ?>
active
<?= $this->endSection() ?>
<?= $this->section('isActiveHistory') ?>
active
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800">Transaction History</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header  py-6">
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a class="btn btn-primary btn-icon-split" href="http://localhost:8080/transaction/create" role="button">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="" style="background-color: #f4f2f2;">
                    <tr class="text-dark">
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Select Pkg</th>
                        <th>Total Price</th>
                        <th>Paid</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($transactions as $key => $transaction) : ?>
                        <tr class="">
                            <td><?= $key + 1 ?></td>
                            <td><?= $transaction->invoice ?></td>
                            <td><?= $transaction->package_selected ?></td>
                            <td><?= "Rp. " . number_format($transaction->total_price, 0, '', ',') ?></td>
                            <td class="<?= ($transaction->total_price <= $transaction->paid) ? '' : 'text-danger font-weight-bold'; ?>"><?= ($transaction->total_price <= $transaction->paid) ? "Rp. " . number_format($transaction->paid, 0, '', ',') : "Rp. " . number_format($transaction->paid, 0, '', ','); ?></td>
                            <td>
                                <?php
                                switch ($transaction->status) {
                                    case "ready":
                                        echo '<div class="badge badge-dark text-wrap" style="width: 3.5rem;">
                                            Ready
                                            </div>';
                                        break;
                                    case "process":
                                        echo '<div class="badge badge-warning text-wrap" style="width: 3.5rem;">
                                            Process
                                            </div>';
                                        break;
                                    case "done":
                                        echo '<div class="badge badge-success text-wrap" style="width: 3.5rem;">
                                            Done
                                            </div>';
                                        break;
                                    case "picking up":
                                        echo '<div class="badge badge-primary text-wrap" style="width: 3.5rem;">
                                        Picking Up
                                                </div>';
                                        break;
                                    case "on delivery":
                                        echo '<div class="badge badge-info text-wrap" style="width: 3.5rem;">
                                                    On Delivery
                                                    </div>';
                                        break;
                                    case "new":
                                        echo '<div class="badge badge-danger text-wrap" style="width: 3.5rem;">
                                                        New
                                                        </div>';
                                        break;
                                    default:
                                        echo $transaction->status;
                                } ?>
                            </td>
                            <td><?= $transaction->created_at ?></td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?= base_url('transaction/' . $transaction->id . '/preview') ?>" data-href="<?= base_url('transaction/' . $transaction->id . '/preview') ?>" class="btn btn-sm btn-primary">Detail</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            order: [
                [0, 'asc']
            ],
        });
    });
</script> 
<?= $this->endSection() ?>