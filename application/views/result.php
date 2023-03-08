<?php
if ($this->session->flashdata('result')) {
    if (isset($this->session->flashdata('result')['alert']) && ($this->session->flashdata('result')['alert'] == 'danger' or $this->session->flashdata('result')['alert'] == 'success')) {
?>
        <div class="alert alert-<?php echo $this->session->flashdata('result')['alert'] ?> alert-dismissible fade show" role="alert">
            <b>Respon:</b> <?php echo $this->session->flashdata('result')['title'] ?><br />
            <b>Pesan:</b> <?php echo $this->session->flashdata('result')['msg'] ?>
            <?php if ($this->session->userdata('login')) { ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <?php } ?>

        </div>
<?php
    }
}
$this->session->unset_userdata('result');
?>