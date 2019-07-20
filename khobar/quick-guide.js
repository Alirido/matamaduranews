$(document).ready(function() {
    
    counter = 2
    $("#poll-entry").hide()
    
    $("#addVoting").click(function (){
        $("#poll-entry").show()
    })

    $("#addChoice").click(function (){
        $('<label for="choice'.concat(counter).concat('">Nama Pilihan ').concat(counter).concat('</label>')).insertBefore( "#addChoice" )
        $('<input type="text" id="choice'.concat(counter).concat('"><br>')).insertBefore("#addChoice")
        counter = counter + 1
    })

    $("#removeChoice").click(function () {
        N = $("#poll-choices").children().length
        $("#poll-choices").children().eq(N-4).remove()
        N = $("#poll-choices").children().length
        $("#poll-choices").children().eq(N-4).remove()
        N = $("#poll-choices").children().length
        $("#poll-choices").children().eq(N-4).remove()
        counter = counter - 1
    })
});

