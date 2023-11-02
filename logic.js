function getMorningSubRoute(val) {
    $.ajax({
        type: "POST",
        url: "getMorningSubRoute.php",
        data: {routeId:val},
        success: function(data){
            $("#ddlSubRoute_m").html(data);
        }
    });
}

function getMorningBusNumber(val){
    $.ajax({
        type: "POST",
        url: "getBusNumber.php",
        data: {subrouteId:val},
        success: function(data){
            $("#txtBusNumber_m").val(data);
        }
    });
}

function getAfternoonSubRoute(val) {
    $.ajax({
        type: "POST",
        url: "getAfternoonSubRoute.php",
        data: {routeId:val},
        success: function(data){
            $("#ddlSubRoute_a").html(data);
        }
    });
}

function getAfternoonBusNumber(val){
    $.ajax({
        type: "POST",
        url: "getBusNumber.php",
        data: {subrouteId:val},
        success: function(data){
            $("#txtBusNumber_a").val(data);
        }
    });
}

function getLearnerDetails(val){
    // $.ajax({
    //     type: "POST",
    //     url: "getLearner.php",
    //     data: {learnerId:val},
    //     success: function(data){
    //         $("#txtBusNumber_a").val(data);
    //     }
    // });
}

function cancelApplication(val){    
    $.ajax({
         type: "POST",
         url: "cancelApplication.php",
         data: {applicationId:val},
         success: function(data){
           location.href = "index.php";
         }
     });
   }

   function updateApplicationStatus(id, status){    
    $.ajax({
         type: "POST",
         url: "updateApplicationStatus.php",
         data: {applicationId:id, statusId:status},
         success: function(data){
           location.href = window.location.href;
         }
     });
   }

