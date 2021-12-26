  <table class="table table-bordered table-stripped table-hover table-checkable" id="students_view_table">
    <thead>
      <tr>
        <th width="5%">SL</th>
        <th width="20%">Name</th>
        <th width="30%">Courses</th>
        <th width="30%">Fee Pending</th>
        <th width="10%">Created On</th>
        <th width="5%">Actions</th>



      </tr>
    </thead>

    <tbody>
      <tr>
        <td width="5%">1</td>
        <td width="30%">
          <a href="<?= base_url() ?>students/profile/1">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                <img class="" src="https://preview.keenthemes.com/metronic/demo1/custom/apps/user/assets/media/users/100_14.jpg" alt="photo">
              </div>
              <div class="ml-4">
                <div class="text-dark-75 font-weight-bolder font-size-sm mb-0">Salih</div>
                <a href="#" class="text-muted font-weight-bold text-hover-primary">9943231209</a>
              </div>
            </div>
          </a>
          </div>
        </td>
        <td width="30%">
          <span class="label label-dark label-inline font-weight-bold m-1">Classical Dance</span>
          <span class="label label-dark label-inline font-weight-bold m-1">Classical Music</span>
        </td>
        <td width="30%">350</td>
        <td width="10%">25-10-2020 10:19 AM</td>
        <td width="5%">

          <a href="<?= base_url(); ?>student/profile/1" class="btn btn-sm btn-primary m-1"><i class="flaticon-eye"></i></a>
          <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>students/edit/1"><i class="flaticon-edit"></i></a>
          <a class="btn btn-sm btn-danger m-1 delete_swal_demo"><i class="flaticon-delete"></i></a>

        </td>
      </tr>
    </tbody>
  </table>