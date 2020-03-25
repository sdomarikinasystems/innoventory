    function count_work_days(startDate, endDate) {



        var curr = startDate.split("-");
        var yy = curr[0];
        var mm = curr[1];
        var dd = parseInt(curr[2]);
        dd -= 1;
        var startDate = new Date(yy,mm,dd);


        var curr1 = endDate.split("-");
        yy = curr1[0];
        mm = curr1[1];
        dd = parseInt(curr1[2]);
        dd += 1;
        var endDate = new Date(yy,mm,dd);



  var millisecondsPerDay = 86400 * 1000; 
    startDate.setHours(0,0,0,1);  
    endDate.setHours(23,59,59,999);  
    var diff = endDate - startDate;     
    var days = Math.ceil(diff / millisecondsPerDay);
    
    // Subtract two weekend days for every week in between
    var weeks = Math.floor(days / 7);
    days = days - (weeks * 2);

    // Handle special cases
    var startDay = startDate.getDay();
    var endDay = endDate.getDay();
    
    // Remove weekend not previously removed.   
    if (startDay - endDay > 1)         
        days = days - 2;      
    
    // Remove start day if span starts on Sunday but ends before Saturday
    if (startDay === 0 && endDay != 6)
        days = days - 1; 
            
    // Remove end day if span ends on Saturday but starts after Sunday
    if (endDay === 6 && startDay !== 0)
        days = days - 1;
    
    return days;
   }