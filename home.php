<?php
    include_once 'header.php';

    require_once 'includes/db.inc.php';

    $userId=$_SESSION['id'] ?? null;

    $createdEvents=0;
    $registeredEvents=0;

    if ($userId) {
        $sql1="SELECT COUNT(*) FROM events WHERE createrId=?;";
        $stmt1=mysqli_prepare($connect,$sql1);
        mysqli_stmt_bind_param($stmt1, "i",$userId);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1,$createdEvents);
        mysqli_stmt_fetch($stmt1);
        mysqli_stmt_close($stmt1);

        $sql2 = "SELECT COUNT(*) FROM user_events WHERE id = ?;";
        $stmt2=mysqli_prepare($connect,$sql2);
        mysqli_stmt_bind_param($stmt2, "i",$userId);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2,$registeredEvents);
        mysqli_stmt_fetch($stmt2);
        mysqli_stmt_close($stmt2);
    }
    mysqli_close($connect);
?>
    <h1 class="hi">Hi, <?php echo $_SESSION["firstName"]?>! 👋</h1>
    <div class="homecontainer">
    <form class="searchbarhome" action="searchResults.php" method="get">
        <input type="search" class="searchbar" name="query" class="searchhome" placeholder="Search events,users,..." style="font-size:18px; padding-left:10px">
        <button type="submit" class="searchbtn">Search</button>
    </form>

    <div class="about">
        <div class="abouttext">
            <h2>About Us</h2>
            <p>
                Eventz is the official University Event Management System designed to
                 simplify the way campus events are organized and experienced. From
                  academic seminars to cultural festivals, Eventz helps students and 
                  staff easily create, manage, and participate in events, all in one place.
                  Our goal is to make university life more connected and organized by streamlining event 
                  registrations, updates, and participation. With a user-friendly interface and 
                  powerful features, Eventz ensures that no opportunity on campus is missed.
                Join Eventz, where every event starts!
            </p>
        </div>
    </div>
    <h1 class="myEventsPar">My Events Participation</h1>
    <div class="myEventsStats">
        <div class="statsDisplay">
        <div class="pieChart">
            <canvas id="eventsPieChart"></canvas>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
            <script>
            const ctx = document.getElementById('eventsPieChart').getContext('2d');
            const eventsPieChart = new Chart(ctx, {
                type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [<?php echo $createdEvents; ?>, <?php echo $registeredEvents; ?>],
                            backgroundColor: ['rgba(4, 2, 95, 0.7)', 'rgba(20, 132, 206, 0.7)'],
                            borderColor: ['rgba(4, 2, 95, 0.7)', 'rgba(20, 132, 206, 0.7)'],
                            borderWidth: 1
                         }]
                },
            options: {
                plugins: {
                            datalabels:{
                                color:'rgb(255, 255, 255)',
                                formatter:(value,context)=>{
                                    const data=context.chart.data.datasets[0].data;
                                    const total=data.reduce((acc,val)=>acc+val,0);
                                    const pct=(value/total*100).toFixed(1);
                                    return pct+'%';
                                },
                                font:{
                                    weight:'bold',
                                    size:25
                                }
                                
                            }
                            
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            </script>
        </div>
        <div class="statRight">
        <div class="regAndCre">
            <div class="regCount">
            <?php
            echo '<div class="Reg"><h1>REGISTERED</h1>';
            echo '<h1 class="regNo">'.$registeredEvents.'</h1>';
            echo '</div>' ;
            ?>    
        </div>
        <div class="creCount">
            <?php
            echo '<div class="Cre"><h1>CREATED</h1>';
            echo '<h1 class="creNo">'.$createdEvents.'</h1>';
            echo '</div>' ;
            ?>
        </div>
        </div>
        <div class="totalEventCount">
            <?php
            echo '<div class="Total"><h1>TOTAL</h1>';
            echo '<h1 class="totNo">'.$registeredEvents+$createdEvents.'</h1>';
            echo '</div>' ;
            ?>
        </div>
        </div>
        
    </div>
    </div>
</div>
<?php
    include_once 'footer.php';
?>