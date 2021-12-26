<!--begin: Datatable-->
          <table class="table table-bordered table-tripped table-hover table-checkable" id="leaves_view_table">
            <thead>
              <tr>

                <th width="5%">SL</th>
                <th width="25%">Paid Date</th>
                <th width="20%">Paid Amount</th>
                <th width="20%">Remarks</th>
                <th width="10%">Created On</th>
                <th width="5%">Actions</th>

              </tr>

            </thead>

            <tbody>
              <tr>
                <td width="5%">1</td>
                <td width="25%">25-10-2020</td>
                <td width="20%">350</td>
                <td width="20%">paid via google pay ref:1234</td>
                <td width="10%">25-10-2020 10:19 AM</td>
                <td width="5%">

                  <a href="<?= base_url(); ?>student/profile/1" class="btn btn-sm btn-primary m-1"><i class="flaticon2-printer"></i></a>
                  <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>students/edit/1"><i class="flaticon-edit"></i></a>
                  <a class="btn btn-sm btn-danger m-1 delete_swal_demo"><i class="flaticon-delete"></i></a>
              </tr>
            </tbody>



          </table>