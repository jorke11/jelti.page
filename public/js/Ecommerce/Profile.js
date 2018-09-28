function Profile() {
    this.init = function () {
        $("#btn-edit").click(function () {
            $("#form-info").addClass("d-none")
            $("#form-input").removeClass("d-none")
        })

        this.getInfo()
    }

    this.getInfo = function () {

//        $.ajax({
//            url:'data-user',
//            method:'GET',
//            success:function(data){
//                console.log(data);
//            }
//        })

        fetch('https://randomuser.me/api')
                .then(function (response) {
                    console.log(response)
//                    return response.json();
                })
                .then(function (myJson) {

                    console.log("res", JSON.stringify(myJson));
                })
                .catch(function () {
                    alert("asd");
                });

    }
}

var objProfile = new Profile();
objProfile.init()