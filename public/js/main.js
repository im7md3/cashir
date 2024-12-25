// Click tog-show
if (document.querySelector(".tog-show")) {
    let togglesShow = document.querySelectorAll(".tog-show");
    togglesShow.forEach((e) => {
        let togg = true;
        e.addEventListener("click", (evt) => {
            let listItem = document.querySelector(e.getAttribute("data-show"));
            if (togg == true) {
                listItem.style.display = "flex";
                togg = false;
            } else {
                listItem.style.display = "none";
                togg = true;
            }
        });
    });
}

// Show The Current Date And Time
window.addEventListener("load", () => initClock())

function updateClock() {
    const now = new Date();
    let dname = now.getDay(),
        mo = now.getMonth(),
        dnum = now.getDate(),
        yr = now.getFullYear(),
        hou = now.getHours(),
        min = now.getMinutes(),
        sec = now.getSeconds(),
        pe = "AM";

    if (hou >= 12) {
        pe = "PM";
    }
    if (hou == 0) {
        hou = 12;
    }
    if (hou > 12) {
        hou = hou - 12;
    }

    Number.prototype.pad = function (digits) {
        for (var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
    }

    let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    let ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
    let values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
    for (let i = 0; i < ids.length; i++)
        document.getElementById(ids[i]).firstChild.nodeValue = values[i];
}

function initClock() {
    updateClock();
    window.setInterval("updateClock()", 1);
}


// print
if (document.getElementById("prt-content")) {
    var btnPrtContent = document.getElementById("btn-prt-content");
    btnPrtContent.addEventListener("click", printDiv);

    function printDiv() {
        var prtContent = document.getElementById("prt-content");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(prtContent.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
}

// csv file
if  (document.getElementById("export-btn")) {

    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob(["\uFEFF" + csv], {
            type: "text/csv"
        });
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }

    function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            data.push(row.join(","));
        }
        downloadCSVFile(data.join("\n"), filename);
    }
    document.getElementById("export-btn").addEventListener("click", function() {
        var html = document.getElementById("data-table").outerHTML;
        htmlToCSV(html, "report.csv");
    });
}

if(document.querySelector(".loader-holder")) {
    let theLoader = document.querySelector(".loader-holder");
    document.body.style.overflow = "hidden";
    window.addEventListener("load", () => {
        setTimeout(() => {
            document.body.style.overflow = "auto";
            theLoader.classList.add("hidden");
        }, 400);
    })
}


function validateInput(inputId) {
    // الحصول على قيمة الحقل النصي
    var input = document.getElementById(inputId).value;

    // فحص ما إذا كانت القيمة تحتوي على أرقام فقط باستخدام التعبير النمطي
    if (!/^[0-9]*$/.test(input)) {
      // إذا كانت القيمة غير مقبولة، قم بإزالة آخر حرف تم إدخاله
      document.getElementById(inputId).value = input.substring(0, input.length - 1);
    }
  }
