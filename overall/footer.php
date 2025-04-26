</div>
      </section>
      
      <?php

      include 'pages/modal.php';
      ?>

      <!-- Modal End -->
      <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
          <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Select Layout</h6>
              <div class="selectgroup layout-color w-50">
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                  <span class="selectgroup-button">Light</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                  <span class="selectgroup-button">Dark</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Sidebar Color</h6>
              <div class="selectgroup selectgroup-pills sidebar-color">
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Color Theme</h6>
              <div class="theme-setting-options">
                <ul class="choose-theme list-unstyled mb-0">
                  <li title="white" class="active">
                    <div class="white"></div>
                  </li>
                  <li title="cyan">
                    <div class="cyan"></div>
                  </li>
                  <li title="black">
                    <div class="black"></div>
                  </li>
                  <li title="purple">
                    <div class="purple"></div>
                  </li>
                  <li title="orange">
                    <div class="orange"></div>
                  </li>
                  <li title="green">
                    <div class="green"></div>
                  </li>
                  <li title="red">
                    <div class="red"></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="mini_sidebar_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Mini Sidebar</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="sticky_header_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Sticky Header</span>
                </label>
              </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
              <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                <i class="fas fa-undo"></i> Restore Default
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="main-footer">
      <div class="footer-left">
        <a href="templateshub.net">Recipe Management System</a></a>
      </div>
      <div class="footer-right">
      </div>
    </footer>
  </div>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
 

<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/page/datatables.js"></script>
<!-- Page Specific JS File -->
<script src="assets/bundles/sweetalert2/sweetalert2.all.min.js"></script>
<script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/bundles/cleave-js/dist/cleave.min.js"></script>
<script src="assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
<script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
<script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/forms-advanced-forms.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
<script>
$(document).ready(function() {
// Initialize the DataTable
var staffTable = $('#staff_table').DataTable({
  "responsive": true,
  "autoWidth": false,
  "lengthChange": true,
  lengthMenu : [[10,50,100,200,-1],[10,50,100,200,"All"]],
  "buttons": ["copy", "csv", "excel", "pdf", "print"],
  "ajax": {
  "processing": true,
  "serverSide": true,
  "type" : "JSON",
  "method": "POST",
      "url": "api/staff_list.php",
      "error": function (xhr, error, thrown) {
      console.log(thrown);
      }
  },
  language: {
          searchPlaceholder: "Andika chochote",
          "sZeroRecords" : "No Data Found On Database"
        },
}).buttons().container().appendTo('#staff-table_wrapper .col-md-6:eq(0)');
// Initialized DataTable End Here

// Initialize Select2 Start Here
$(".select2").select2({
  minimumResultsForSearch: Infinity,
  width: '100%',
  placeholder : "Select Staff Gender",
  allowClear: true,
});
$(".position").select2({
  minimumResultsForSearch: Infinity,
  width: '100%',
  placeholder : "Select Staff Position",
  allowClear: true,
});
// Initialize Select2 End Here

// Initialize Datepicker Start Here
// $('.datepicker2').datepicker({
//   format: 'yyyy-mm-dd',
//   autoclose: true,
//   todayHighlight: true,
//   orientation: "bottom auto",
//   todayBtn: "linked",
//   clearBtn: true,
//   toggleActive: true,
// })
// Initialize Datepicker End Here

// Save Functionality Start Here

$("#save_staff").on("click", function() {
  var first_name = $("#first_name");
  var middle_name = $("#middle_name");
  var last_name = $("#last_name");
  var location = $("#location");
  var email = $("#email");
  var phone_number = $("#phone_number");
  var gender = $("#gender");
  var position = $("#position");
  var dob = $("#dob");

  if(isNotEmty(first_name) && isNotEmty(middle_name) && isNotEmty(last_name) && isNotEmty(location) && isNotEmty(email) && isNotEmty(phone_number) && isSelect(gender) && isSelect(position) && isNotEmty(dob)) {
    Swal.fire({
      title : "Are you sure ?",
      text : "Are you sure you want to save this staff ? \n Once you save, you will not be able to delete this staff!",
      icon : "warning",
      showCancelButton: true,
      showDenyButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
      cancelButtonText: 'Cancel',
    }).then((result) => {
      if (result.isConfirmed) {
        // User clicked "Save"
    $.ajax({
      url: "function.php",
      type: "POST",
      dataType: "json",
      data: {
        action : "save_staff",
        first_name: first_name.val(),
        middle_name: middle_name.val(),
        last_name: last_name.val(),
        location: location.val(),
        email: email.val(),
        phone_number: phone_number.val(),
        gender : gender.val(),
        position: position.val(),
        dob: dob.val()
      },
      // contentType: false,
      // processData: false,
      success: function(response) {
        if (response == 1) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Staff saved successfully!',
          });
          staffTable.ajax.reload(null, false); // Reload the DataTable without resetting the paging
          $("#staff_form")[0].reset(); // Reset the form after successful submission
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to save staff.',
          });
        }
      },
      error: function(xhr, status, error) {
        Swal.fire("Error: " + error);
      }
    });
      } else if (result.isDenied) {
        // User clicked "Don't save"
        Swal.fire('You Denied to save staff information ', '', 'info')
      } else if (result.isDismissed) {
        // User clicked "Cancel"
        Swal.fire('You canceled to save staff information', '', 'info')
      }
    });
  }

});
// Save Functionality End Here

// Delete Functionality Start Here
$(document).on("click", ".delete_staff", function() {
  var staff_id = $(this).data("id");
  var staff_name = $(this).data("name");
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to recover this file!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "api/staff_delete.php",
        type: "POST",
        data: { staff_id: staff_id },
        success: function(response) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
          staffTable.ajax.reload(null, false); // Reload the DataTable without resetting the paging
        },
        error: function(xhr, status, error) {
          console.log("Error: " + error);
        }
      });
    }
  });
});
// Delete Functionality End Here

// Edit Functionality Start Here
$(document).on("click", ".edit_staff", function() {
  var staff_id = $(this).data("id");
  $.ajax({
    url: "api/staff_edit.php",
    type: "POST",
    data: { staff_id: staff_id },
    dataType: "json",
    success: function(data) {
      $("#staff_id").val(data.staff_id);
      $("#first_name").val(data.first_name);
      $("#staff_position").val(data.staff_position).trigger("change");
      $("#staff_email").val(data.staff_email);
      $("#staff_mobile").val(data.staff_mobile);
      $("#gender").val(data);
      $("#gender").select2().val(data.gender);
    },
    error: function(xhr, status, error) {
      console.log("Error: " + error);
    },
  });
});

// Edit Functionality End Here

// View Functionality Start Here
$(document).on("click", ".view_staff", function() {
  var staff_id = $(this).data("id");
  $.ajax({
    url: "api/staff_view.php",
    type: "POST",
    data: { staff_id: staff_id },
    dataType: "json",
    success: function(data) {
      $("#view_staff_name").text(data.first_name);
      $("#view_staff_position").text(data.staff_position);
      $("#view_staff_email").text(data.staff_email);
      $("#view_staff_mobile").text(data.staff_mobile);
    },
    error: function(xhr, status, error) {
      console.log("Error: " + error);
    },
  });
});
// View Functionality End Here

// Validation Start Here
function isNotEmty(caller) { // Check if the field is empty
  if(caller.val() == "") {
    caller.css("border", "1px solid #A60000"); // Red border for empty fields
    return false;
  } else {
    caller.css("border", "1px solid #32A600"); // Green border for filled fields
    return true;
  }
}

function isSelect(caller) {// Check if the select field is empty
  if(caller.val() == ""){ // Check if the field is empty
    Swal.fire('You must select this field'); // Show alert if the field is empty
    return false; // Return false if the field is empty
  }else{
    caller.css('border','1px solid #32A600'); // Green border for filled fields
    return true; // Return true if the field is filled
  }
}

function checkVideo(caller) {
  caller = caller.val(); // Get the value of the field
  if(caller == "") { // Check if the field is empty
    Swal.fire('You must select this field'); // Show alert if the field is empty
    return false; // Return false if the field is empty
  } else {
    caller.css("border", "1px solid #32A600"); // Green border for filled fields
    return true; // Return true if the field is filled
  }
}

function checkImage(caller) {
  caller = caller.val(); // Get the value of the field
  if(caller == "") { // Check if the field is empty
    Swal.fire('You must select this field'); // Show alert if the field is empty
    return false; // Return false if the field is empty
  } else {
    caller.css("border", "1px solid #32A600"); // Green border for filled fields
    return true; // Return true if the field is filled
  }
}
// Validation End Here

// Ganaral Functionality Start Here
function checkLogin() {
  $.ajax({
    url: "function.php",
    type: "POST",
    dataType: "json",
    data: { 
      action: "checkLogin"
    },
    success: function(response) { // Handle success response
      if(response.output == 2) {
        window.location.href = "logout.php"; // Redirect to logout page if session is expired
      }else if(response.output == 3) {
        window.location.href = "logout.php"; // Redirect to index page if session is active
      }
    },
    error: function(xhr, status, error) { // Handle error
      console.log("Error: " + error); // Log error to console
    }
  });
}
// Ganaral Functionality End Here
});
</script>
</body>


<!-- Recipe Management System  21 Apr 2025 03:54:41 GMT -->
</html>