$(document).ready(function () {
    $("#add-name").focus();

    var table = $('#myTable').DataTable({

        "ajax": "/getData",
        "columns": [{
            "data": "id"
        },
        {
            "data": "name"
        },
        {
            "data": "age"
        },
        {
            "data": "street"
        },
        {
            "data": "email"
        },
        {
            "data": "country_name"
        },
        {
            "data": "state_name"
        },
        {
            "data": "city_name"
        },
        {
            "data": "gender"
        },
        {
            "data": "hobby"
        },

        {
            "data": null,
            "defaultContent": "<button type='button' class='btn btn-primary' id='btnEdit' action='btnEdit'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button><button style='margin-left:1rem;'; type='button' class='btn btn-danger ml-1' id='btnDelete' action='btnDelete'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>"
        },
        ]
    });

    $("#myTable tbody").on("click", "button[action=btnEdit]", function (event) {
        var data = table.row($(this).parents('tr')).data();
        var oTable = $("#myTable").dataTable();
        $(oTable.fnSettings().aoData).each(function () {
            $(this.nTr).removeClass('success');
        });

        $(event.target.parentNode.parentNode).addClass('success');
        // alert(data.hobby);   
        $('#hiddenID').val(data.id);
        $('#add-name').val(data.name);
        $('#add-age').val(data.age);
        $('#add-street').val(data.street);
        $('#add-email').val(data.email);
        $('#country').val(data.country_id);

        let country = data.country_id;
        let state = data.state_id;
        let city = data.city_id;

        getState(country, state);

        $("#country").on("change", function (e) {
            // getStateFromCountryC()
            var country = $('#country').val();
            getState(country, "");

        })

        getCity(state, city);


        $("#state").on("change", function (e) {
            getCityFromStateC();
            // getCity(state,city);
        })
        // $('#u_state').append(`<option value="${data.state_id}"selected>${data.state_name}</option>`);



        // $('#u_city').append(`<option value="${data.city_id}"selected>${data.city_name}</option>`);





        $("input[name=gender][value=" + data.gender + "]").prop('checked', true);

        var hobbyList = (data.hobby).split(",");
        console.log(hobbyList.length);

        for (var i = 0; i < hobbyList.length; i++) {

            $("input[value=" + hobbyList[i] + "]").prop('checked', true);


            console.log(hobbyList[i]);


        }
        $('#addStudent').modal('show');
        // $('#update-Form').on('submit', function (e) {
        //     e.preventDefault();
        //     // alert("submit");

        //     var id = data.id;
        //     // alert(id);
        //     $.ajax({
        //         type: "POST",
        //         url: "/studentUpdate" + id,
        //         data: $('#update-Form').serialize(),
        //         // cache:false,
        //         // contentType:false,
        //         // processData:false,
        //         success: function (response) {
        //             location.reload();
        //             console.log(response);
        //             // alert("data updated");
        //             $('#myTable').DataTable().ajax.reload();
        //             $("input[id='hobby1']:checkbox").prop('checked', false);
        //             $("input[id='hobby2']:checkbox").prop('checked', false);
        //             $("input[id='hobby3']:checkbox").prop('checked', false);

        //             $('#exampleaddModal').modal('hide');
        //             toastr.options = {
        //                 "closeButton": false,
        //                 "debug": false,
        //                 "newestOnTop": false,
        //                 "progressBar": false,
        //                 "positionClass": "toast-top-right",
        //                 "preventDuplicates": false,
        //                 "onclick": null,
        //                 "showDuration": "300",
        //                 "hideDuration": "1000",
        //                 "timeOut": "5000",
        //                 "extendedTimeOut": "1000",
        //                 "showEasing": "swing",
        //                 "hideEasing": "linear",
        //                 "showMethod": "fadeIn",
        //                 "hideMethod": "fadeOut"
        //             }
        //             toastr["success"]("Record Updated Successfully");

        //             //    $(event.target.parentNode.parentNode).remoClass('success');
        //             // location.reload();


        //         },
        //         error: function (error) {
        //             var res = jQuery.parseJSON(error.responseText);
        //             // console.log(res);
        //             $('#u_name_error').html(res.errors.name);
        //             $('#u_age_error').html(res.errors.age);
        //             $('#u_street_error').html(res.errors.street);
        //             $('#u_email_error').html(res.errors.email);

        //         }
        //     });

        // });
        $('.btn-close').on('click', function (e) {
            $("input[id='hobby1']:checkbox").prop('checked', false);
            $("input[id='hobby2']:checkbox").prop('checked', false);
            $("input[id='hobby3']:checkbox").prop('checked', false);


        })
    });


    //Insertion part start here
    $('#addStudentData').on('submit', function (e) {
        e.preventDefault();

        var hid_code = $('#hiddenID').val();
        if (hid_code == '') {
            alert("add");
            oper = 'studentadd';
        }
        else {
            alert("update");
            oper = 'studentUpdate';
        }
        $.ajax({
            type: "POST",
            url: oper,
            data: $('#addStudentData').serialize(),

            success: function (response) {
                // console.log(response);

                $('#myTable').DataTable().ajax.reload();
                $('#addStudent').modal('hide');
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["success"]("Record Added Successfully")
                $('#addStudentData').each(function () {
                    this.reset();
                });
            },
            error: function (error) {
                alert(error);

                console.log(error);
                // console.log(error.responseText);
                // var res = jQuery.parseJSON(error.responseText);
                // console.log(res);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["error"]("Unsuccess")
                $('#addStudentData').each(function () {
                    this.reset();
                });

                console.log("res"+res);
                console.log(res.errors.name);
                console.log(res.errors.age);
                console.log(res.errors.street);
                console.log(res.errors.email);

                $('#name_error').html(res.errors.name);
                $('#age_error').html(res.errors.age);
                $('#street_error').html(res.errors.street);
                $('#email_error').html(res.errors.email);
                // alert("data not saved");

            }
        });
    });

    // $('#addModalBtn').on('click', function () {
    //     // $('#addStudent').modal('show');
    //     $("#addStudent").on('show.bs.modal', function () {
    //         alert('The modal will be displayed now!');
    //     });
    // })
    //Insertion part End here



    //Delection Part Start Here
    $("#myTable tbody").on("click", "button[action=btnDelete]", function (event) {
        var data = table.row($(this).parents('tr')).data();
        var oTable = $("#myTable").dataTable();
        $(oTable.fnSettings().aoData).each(function () {
            $(this.nTr).removeClass('danger');
        });
        $(event.target.parentNode.parentNode).addClass('danger');
        $('#deleteModal').modal('show');
        $('#formtextID').val(data.id);
        $('#studentData').html(data.name);
        $('#deleteFormID').on('submit', function (e) {
            e.preventDefault();
            console.log('submit delete');
            var id = $('#formtextID').val();
            // console.log(id);

            $.ajax({
                type: "delete",
                url: "/studentdelete/" + id,
                data: $('#deleteFormID').serialize(),
                success: function (response) {
                    console.log(response);
                    $('#myTable').DataTable().ajax.reload();
                    $('#deleteModal').modal('hide');
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr["error"]("Record Deleted Successfully")
                    //location.reload();
                },
                error: function (error) {
                    console.log(error);

                }
            })
        })
    });
    //Delection Part End Here




    $('#foc').on('click', function () {
        console.log('here');

        document.getElementById("add-name").focus();
    })


    $('#country').on('change', function (e) {
        e.preventDefault();
        let country = $(this).val();
        // alert(country);

        $("#state").empty();

        // $('#state').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: "GET",
            url: '/getState/' + country,
            success: function (response) {
                console.log(response);
                $.each(response, function (key, value) {
                    // console.log(key);

                    $("#state").append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            }
        });
    });

    $('#state').on('change', function (e) {
        // e.preventDefault();
        var state = $('#state').val();
        // alert(state);

        $("#city").empty();

        $.ajax({
            type: "GET",
            url: '/getcity/' + state,
            success: function (response) {
                console.log(response);
                $.each(response, function (key, value) {
                    $("#city").append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            }
        });
    });
});


function getStateFromCountryC() {
    let country = $('#country').val();
    alert(country);

    $("#state").empty();
    $("#city").empty();

    // $('#state').append(`<option value="0" disabled selected>Processing...</option>`);
    $.ajax({
        type: "GET",
        url: '/getState/' + country,
        success: function (response) {
            console.log(response);
            $.each(response, function (key, value) {
                // console.log(key);

                $("#state").append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        }
    });
}



function getCityFromStateC() {
    let state = $('#state').val();
    $("#city").empty();
    $.ajax({
        type: "GET",
        url: '/getcity/' + state,
        success: function (response) {
            console.log(response);
            $.each(response, function (key, value) {
                // console.log(key);

                $("#city").append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        }
    });
}



function getState(country, state) {
    var countryID = country;
    $("#state").empty();

    $.ajax({
        type: "GET",
        url: '/getState/' + countryID,
        success: function (response) {
            console.log(response);
            $.each(response, function (key, value) {
                $("#state").append('<option value=' + value.id + '>' + value.name + '</option>');
            });
            if (state != "") {
                $("#state").val(state);

            }
        }
    });


}

function getCity(state, city) {
    $("#city").empty();
    $.ajax({
        type: "GET",
        url: '/getcity/' + state,
        success: function (response) {
            console.log(response);
            $.each(response, function (key, value) {
                // console.log(key);

                $("#city").append('<option value=' + value.id + '>' + value.name + '</option>');
            });
            if (city != "") {
                $("#city").val(city);

            }
        }
    });
}

