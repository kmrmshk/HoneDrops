$(function() {
    // Get markdown text
    var mdsrc = $('#md_src');
    var mdtxt = mdsrc.text();
    mdsrc.hide();

    // Put rendaring text
    $('#md_out').html(marked(mdtxt));

    // Put title with h1
    var title_txt = $("title").text();
    var h1_txt = $("h1").text();
    $("title").text(h1_txt + " / " + title_txt);
});
