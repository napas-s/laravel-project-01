


function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// wizard pic
$("#wizard-picture").change(function() {
    readURLwizard(this);
});

function readURLwizard(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
    }
}

//SEO Description Length
function ChkLength(){
    var objTextBox = document.getElementById('remainLength');
    var MaxLength = 170;
    var curLength = objTextBox.value.length;
    document.getElementById('showNumber_ChkLength').innerHTML = 'คงเหลืออีก '+(MaxLength - curLength)+' ตัวอักษร';
}
//กรอกเฉพาะภาษาอังกฤษ
function ChkEng()
{
    var eng = /^([a-zA-Z])+$/;
    var objTextBox = document.getElementById('permalink');
    var valOK = true;

    // for (i=0; i<objTextBox.length & valOK; i++){
    //     valOK = (str.indexOf(objTextBox.charAt(i))!= -1)
    // }

    // if (!valOK) {
    //         alert("ภาษาอังกฤษเท่านั้น !!! ")
    //         obj.focus()
    //         return false
    // } return true

}

$(window).resize(function() {
    $('.card-wizard').each(function() {
      $wizard = $(this);

      index = $wizard.bootstrapWizard('currentIndex');
      refreshAnimation($wizard, index);

      $('.moving-tab').css({
        'transition': 'transform 0s'
      });
    });
});

function checkMainmenu(elem){
    var id = $(elem).attr("id");
    $('#' + id +'.mainMenu').siblings().find(".active").removeClass("active");
    localStorage.setItem("selectedolditem", id);
    localStorage.setItem("selectedolditemMain", 'null');
    localStorage.setItem("selectedolditemSub", 'null');
};


function deleteModal(e){
    var deleteId = $(e).data('id');
    var deleteName = $(e).data('name');

    $('#deleteId').val(deleteId);
    $('#deleteName').html('"'+deleteName+'"');
}

function deleteModal2(e){
    var deleteId = $(e).data('id');
    var deleteName = $(e).data('name');

    $('#deleteId2').val(deleteId);
    $('#deleteName2').html('"'+deleteName+'"');
}

function setDate(e){

    if(e == 2){
        document.getElementById("setDate").classList.remove("hidden");
    }else{
        document.getElementById("setDate").classList.add("hidden");
    }
}

if ($(".datepicker").length != 0) {
    $('.datepicker').datetimepicker({
      format: 'DD-MM-YYYY',
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });
}

//select menu sidebar left
// function checkSubmenu(elem){
//     var subid = $(elem).attr("id");
//     var id = $(elem).data("id");
//     localStorage.setItem("selectedolditem", 'null');

//     $('#' + id).siblings().find(".show").removeClass("show");
//     localStorage.setItem("selectedolditemMain", id);

//     $('#' + subid +'.subMenu').siblings().find(".active").removeClass("active");
//     localStorage.setItem("selectedolditemSub", subid);

// }

// var selectedolditem = localStorage.getItem('selectedolditem');

// if (selectedolditem != 'null') {
//     $('#' + selectedolditem + '.mainMenu').siblings().find(".active").removeClass("active");
//     $('#' + selectedolditem + '.mainMenu').addClass("active");
// }

// var selectedolditemMain = localStorage.getItem('selectedolditemMain');
// var selectedolditemSub = localStorage.getItem('selectedolditemSub');

// if (selectedolditemMain != 'null') {
//     $('#' + selectedolditemMain).siblings().find(".show").removeClass("show");
//     $('#' + selectedolditemMain).addClass("show");
//     $('#' + selectedolditemSub +'.subMenu').siblings().find(".active").removeClass("active");
//     $('#' + selectedolditemSub +'.subMenu').addClass("active");
// }

// if (selectedolditem == null && selectedolditemMain == null && selectedolditemSub == null) {
//     $('#dashboard.mainMenu').siblings().find(".active").removeClass("active");
//     $('#dashboard.mainMenu').addClass("active");
// }
