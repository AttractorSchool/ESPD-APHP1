<style>
    .all_analytics {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-bottom: 25px;
    }

    .all_analytics .analytic {
        width: 30%;
        border: 1px solid black;
        border-radius: 20px;
        text-align: center;
    }

    .all_analytics .analytic p {
        font-size: 20px;
        font-weight: 700;
    }
    @media screen  and (max-width: 584px){
        .analytic h3{
            font-size: 15px;
        }
    }
    @media screen  and (max-width: 390px){
        .analytic h3{
            font-size: 12px;
        }
    }
</style>
<div class="all_analytics">
    <div class="analytic">
        <h3>За 7 дней пользователей зашло:</h3>
        <p>{{$analytic_seven_day}}</p>
    </div>
    <div class="analytic">
        <h3>За месяц пользователей зашло:</h3>
        <p>{{$analytic_month}}</p>
    </div>
    <div class="analytic">
        <h3>За год пользователей зашло:</h3>
        <p>{{$analytic_year}}</p>
    </div>
</div>

