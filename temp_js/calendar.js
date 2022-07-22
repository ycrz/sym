// initiation
var monthvarites = 0;
var d = new Date();
var dt = parseInt(d.getDate());
var n = parseInt(d.getMonth());
var y = parseInt(d.getFullYear());

const fixYear = y;

function parsingCalendar(parse){ monthStart(parse); }

var arrDayName = ['sun','mon','tue','wed','thu','fri','sat'];
var arrMonthName = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
var arrIndoMonthName = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

var monthNowInInteger = 0;
monthvarites = n;
monthStart(0);

// y, m, d
var getFirstDayName = '';
var getFirstMonName = '';
var getFirstDateName = '';
var getFirstYearName = '';

var getLastDayName = '';
var getLastMonName = '';
var getLastDateName = '';
var getLastYearName = '';
var date = '';

function monthStart(monthstatus){
	if (monthstatus == "now") {
		monthvarites = n;
	}else{
		monthvarites = monthvarites + parseInt(monthstatus);
	}

	date = new Date(d.getFullYear(), monthvarites, 1), y = date.getFullYear(), m = date.getMonth();
	var firstDay = new Date(y, m, 1);
	var lastDay = new Date(y, m + 1, 0);

	getFirstDayName = firstDay.toString().split(" ")[0].toLowerCase();
	getFirstMonName = firstDay.toString().split(" ")[1].toLowerCase();
	getFirstDateName = parseInt(firstDay.toString().split(" ")[2].toLowerCase());
	getFirstYearName = parseInt(firstDay.toString().split(" ")[3].toLowerCase());

	getLastDayName = lastDay.toString().split(" ")[0].toLowerCase();
	getLastMonName = lastDay.toString().split(" ")[1].toLowerCase();
	getLastDateName = parseInt(lastDay.toString().split(" ")[2].toLowerCase());
	getLastYearName = parseInt(lastDay.toString().split(" ")[3].toLowerCase());

	var i = arrMonthName.indexOf(getLastMonName);
	document.getElementById('month-info').innerHTML = arrIndoMonthName[i] + " " + getLastYearName;
	monthNowInInteger = i;

	createDOM();

	// on every local data
	getData(arrMonthName[monthNowInInteger], getLastYearName);
	// on every local data
}

function createDOM(){
	var moreDay = 0;

	var i = arrDayName.indexOf(getLastDayName);
	moreDay = 7 - i - 1;

	// get first status
	var firstStatus = 0;
	var i = arrDayName.indexOf(getFirstDayName);
	firstStatus = i;
	
	// ------------------------------1. Clear all Element if Any
	var looped = document.getElementById('date-start');

	while (looped.hasChildNodes()) {
		looped.removeChild(looped.firstChild);
	}

	var tempAfter = 1;
	// ------------------------------2. load current month
	for (var i = 0; i <= getLastDateName + firstStatus - 1 + moreDay; i++) {
		// 1. fc day number
		var DOMfcDayNumber = document.createElement("div");
		DOMfcDayNumber.className = "fc-day-number";

		// 3. fc-day-content
		var DOMfcDayContentWrapper = document.createElement("div");
		DOMfcDayContentWrapper.className = "fc-day-content";

		// 4. fc-wrapper-inner wrapper 1 & 3
		var DOMwrpInnerContentInner = document.createElement("div");
		DOMwrpInnerContentInner.className = "fc-wrapper-inner";
		DOMwrpInnerContentInner.appendChild(DOMfcDayNumber);
		DOMwrpInnerContentInner.appendChild(DOMfcDayContentWrapper);

		// 5. fc-day wrapper 4
		var DOMfcDay = document.createElement("td");
		DOMfcDay.className = "fc-day tp-ta-ct";
		DOMfcDay.style.cssText = "padding:13px 3px 13px 3px;";
		DOMfcDay.appendChild(DOMwrpInnerContentInner);

		// b & a
		if (i + 1 - firstStatus < 1) {
			// date before
			var lslstdate = new Date(y, m + 0, 0);
			var lslstdtdt = parseInt(lslstdate.toString().split(" ")[2].toLowerCase());
			DOMfcDayNumber.innerHTML = lslstdtdt - firstStatus + i + 1;
			if (arrMonthName[monthNowInInteger] == "jan") {
				DOMfcDay.id = (getLastYearName-1)+"-"+"dec"+"-"+(lslstdtdt - firstStatus + i + 1);
				DOMfcDayContentWrapper.id = "fdc-"+(getLastYearName-1)+"-"+"dec"+"-"+(lslstdtdt - firstStatus + i + 1);
				DOMwrpInnerContentInner.id = "fwi-"+(getLastYearName-1)+"-"+"dec"+"-"+(lslstdtdt - firstStatus + i + 1);
			}else{
				DOMfcDay.id = getLastYearName+"-"+arrMonthName[monthNowInInteger-1]+"-"+(lslstdtdt - firstStatus + i + 1);
				DOMfcDayContentWrapper.id = "fdc-"+getLastYearName+"-"+arrMonthName[monthNowInInteger-1]+"-"+(lslstdtdt - firstStatus + i + 1);
				DOMwrpInnerContentInner.id = "fwi-"+getLastYearName+"-"+arrMonthName[monthNowInInteger-1]+"-"+(lslstdtdt - firstStatus + i + 1);
			}

			DOMfcDay.style.backgroundColor = "#f4f4f4";
			DOMfcDay.style.color = "#d6d6d6";
		}else{
			DOMfcDayNumber.innerHTML = i + 1 - firstStatus;
			DOMfcDay.id = getLastYearName+"-"+getLastMonName+"-"+(i + 1 - firstStatus);
			DOMfcDayContentWrapper.id = "fdc-"+getLastYearName+"-"+getLastMonName+"-"+(i + 1 - firstStatus);
			DOMwrpInnerContentInner.id = "fwi-"+getLastYearName+"-"+getLastMonName+"-"+(i + 1 - firstStatus);
		}

		if (i + 1 - firstStatus > getLastDateName) {
			// date after
			if (arrMonthName[monthNowInInteger] == "dec") {
				DOMfcDay.id = (getLastYearName+1)+"-"+"jan"+"-"+tempAfter;
				DOMfcDayContentWrapper.id = "fdc-"+(getLastYearName+1)+"-"+"jan"+"-"+tempAfter;
				DOMwrpInnerContentInner.id = "fwi-"+(getLastYearName+1)+"-"+"jan"+"-"+tempAfter;
			}else{
				DOMfcDay.id = getLastYearName+"-"+arrMonthName[monthNowInInteger+1]+"-"+tempAfter;
				DOMfcDayContentWrapper.id = "fdc-"+getLastYearName+"-"+arrMonthName[monthNowInInteger+1]+"-"+tempAfter;
				DOMwrpInnerContentInner.id = "fwi-"+getLastYearName+"-"+arrMonthName[monthNowInInteger+1]+"-"+tempAfter;
			}
			DOMfcDayNumber.innerHTML = tempAfter++;
			DOMfcDay.style.backgroundColor = "#f4f4f4";
			DOMfcDay.style.color = "#d6d6d6";
		}

		if (n > monthvarites) {
			DOMfcDay.style.backgroundColor = "#f4f4f4";
			DOMfcDay.style.color = "#d6d6d6";
		}

		if (i%7==0) {
			// 6. fc-week wrapper 5 <tr class="fc-week">
			var DOMfcWeek = document.createElement("tr");
			DOMfcWeek.className = "fc-week";
			DOMfcWeek.appendChild(DOMfcDay);
	    	document.getElementById("date-start").appendChild(DOMfcWeek);
		}else{
			document.getElementById("date-start").children[document.getElementById("date-start").children.length - 1].appendChild(DOMfcDay);
		}
	}

	// today background color
	if (document.getElementById(fixYear+"-"+arrMonthName[n]+"-"+dt) != null) {
		document.getElementById(fixYear+"-"+arrMonthName[n]+"-"+dt).style.backgroundColor = '#dbedfc';
	}
}