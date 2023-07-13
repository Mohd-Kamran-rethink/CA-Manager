@extends('Admin.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">Dashboard</h1>
                </div>
            </div>
            @if (session()->has('msg-success'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg-success') }}
                </div>
            @elseif (session()->has('msg-error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('msg-success') }}
                </div>
            @endif
        </div>
    </section>
    <hr>
    {{-- new card design  --}}
    <section class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6" style="border-right: 2px solid">
                    <h2>CRICADDA MAIN</h2>
                    {{-- today --}}
                    <div class="card-body table-responsive p-0 small-box ">
                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr style="border: none !important">
                                    <th scope="col">
                                        <h3>Today</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Today's New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Deposit</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center ">

                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MaintodaysDepositAllClient->sum('amount') }}</span> <span
                                                class="badge badge-danger right">{{ $MaintodaysDepositAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 180, 180, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MaintodaysWithdrawAllClient->sum('amount') }}</span><span
                                                class="badge badge-danger right">{{ $MaintodaysWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">
                                            {{ $MaintodaysDepositAllClient->sum('bonus') - $MaintodaysWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Net Profit/Loss</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MaintodaysDepositAllClient->sum('amount') - $MaintodaysWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- weeek --}}
                    <div class="card-body table-responsive p-0  small-box ">

                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr>
                                    <th scope="col">
                                        <h3>Week</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Week New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Deposit</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MainThiWeekDepositAllClient->sum('amount') }}</span>
                                            <span class="badge badge-danger right">
                                                {{ $MainThiWeekDepositAllClient->count() }}
                                            </span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 180, 180, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class=" text-center" >
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>
                                                {{ $MainThiWeekWithdrawAllClient->sum('amount') }}</span> <span
                                                class="badge badge-danger right">{{ $MainThiWeekWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MainThiWeekDepositAllClient->sum('bonus') - $MainThiWeekWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td class="">
                                        <h4 style="font-weight: bold"> Net Profit/Loss</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MainThiWeekDepositAllClient->sum('amount') - $MainThiWeekWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- months --}}
                    <div class="card-body table-responsive p-0 small-box ">

                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr>
                                    <th scope="col">
                                        <h3>Month</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Month New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Deposit(D-W)</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MainThiMonthDepositAllClient->sum('amount') }}</span>
                                       
                                            <span class="badge badge-danger right">{{ $MainThiMonthDepositAllClient->count() }} </span>
                                        </h4>
                                    </td>   
                                </tr>
                                <tr  style="background: rgba(255, 180, 180, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0-0</h4>
                                    </td>
                                    <td style="font-weight: bold" >
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MainThiMonthWithdrawAllClient->sum('amount') }}</span><span class="badge badge-danger right">{{ $MainThiMonthWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td>
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MainThiMonthDepositAllClient->sum('bonus') - $MainThiMonthWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td>
                                        <h4 style="font-weight: bold">Net Profit/Loss</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MainThiMonthDepositAllClient->sum('amount') - $MainThiMonthWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- year --}}
                    <div class="card-body table-responsive p-0 small-box ">

                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr>
                                    <th scope="col">
                                        <h3>year</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Year New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Deposit(D-W)</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MainThiYearDepositAllClient->sum('amount') }}</span>
                                       
                                            <span class="badge badge-danger right">{{ $MainThiYearDepositAllClient->count() }} </span>
                                        </h4>
                                    </td>   
                                </tr>
                                <tr  style="background: rgba(255, 180, 180, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0-0</h4>
                                    </td>
                                    <td style="font-weight: bold" >
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $MainThiYearWithdrawAllClient->sum('amount') }}</span><span class="badge badge-danger right">{{ $MainThiYearWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td>
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MainThiYearDepositAllClient->sum('bonus') - $MainThiYearWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td>
                                        <h4 style="font-weight: bold">Net Profit/Loss</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $MainThiYearDepositAllClient->sum('amount') - $MainThiYearWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- crickadda f2 --}}
                <div class="col-6" style="border-right: 2px solid">
                    <h2>CRICADDA F2</h2>
                    {{-- today --}}
                    <div class="card-body table-responsive p-0 small-box ">
                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr style="border: none !important">
                                    <th scope="col">
                                        <h3>Today</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Today's New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Deposit</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center ">

                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $F1todaysDepositAllClient->sum('amount') }}</span> <span
                                                class="badge badge-danger right">{{ $F1todaysDepositAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 180, 180, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $F1todaysWithdrawAllClient->sum('amount') }}</span><span
                                                class="badge badge-danger right">{{ $F1todaysWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">
                                            {{ $F1todaysDepositAllClient->sum('bonus') - $F1todaysWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Net Profit/Loss</h4>
                                    </td>
                                    <td class="text-center ">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1todaysDepositAllClient->sum('amount') - $F1todaysWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- weeek --}}
                    <div class="card-body table-responsive p-0  small-box ">

                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr>
                                    <th scope="col">
                                        <h3>Week</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Week New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Deposit</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{  $F1ThiWeekDepositAllClient->sum('amount')  }}</span>
                                            <span class="badge badge-danger right">
                                                {{ $F1ThiWeekDepositAllClient->count() }}
                                            </span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 180, 180, 0.5)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class=" text-center" >
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>
                                                {{ $F1ThiWeekWithdrawAllClient->sum('amount') }}</span> <span
                                                class="badge badge-danger right">{{ $F1ThiWeekWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td class="">
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1ThiWeekDepositAllClient->sum('bonus') - $F1ThiWeekWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td class="">
                                        <h4 style="font-weight: bold"> Net Profit/Loss</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class=" text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1ThiWeekDepositAllClient->sum('amount') - $F1ThiWeekWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- months --}}
                    <div class="card-body table-responsive p-0 small-box ">

                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr>
                                    <th scope="col">
                                        <h3>Month</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Month New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Deposit(D-W)</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $F1ThiMonthDepositAllClient->sum('amount') }}</span>
                                       
                                            <span class="badge badge-danger right">{{ $F1ThiMonthDepositAllClient->count() }} </span>
                                        </h4>
                                    </td>   
                                </tr>
                                <tr  style="background: rgba(255, 180, 180, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0-0</h4>
                                    </td>
                                    <td style="font-weight: bold" >
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $F1ThiMonthWithdrawAllClient->sum('amount') }}</span><span class="badge badge-danger right">{{ $F1ThiMonthWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td>
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1ThiMonthDepositAllClient->sum('bonus') - $F1ThiMonthWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td>
                                        <h4 style="font-weight: bold">Net Profit/Loss</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1ThiMonthDepositAllClient->sum('amount') - $F1ThiMonthWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- year --}}
                    <div class="card-body table-responsive p-0 small-box ">

                        <table class="table table-bordered">
                            <thead style="background: black;color: white">
                                <tr>
                                    <th scope="col">
                                        <h3>Year</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>year New</h3>
                                    </th>
                                    <th class="text-center" scope="col">
                                        <h3>Total</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr style="background: rgba(128, 128, 128, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Deposit(D-W)</h4>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center mt-0 ">
                                        <h4 style="font-weight: bold">0</h4>
                                        <h6 style="font-weight: bold;font-size: 20px !important"
                                            class="badge badge-danger right">0</h6>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $F1ThiYearDepositAllClient->sum('amount') }}</span>
                                       
                                            <span class="badge badge-danger right">{{ $F1ThiYearDepositAllClient->count() }} </span>
                                        </h4>
                                    </td>   
                                </tr>
                                <tr  style="background: rgba(255, 180, 180, 0.5)">
                                    <td>
                                        <h4 style="font-weight: bold">Withdraw</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0-0</h4>
                                    </td>
                                    <td style="font-weight: bold" >
                                        <h4 style="font-weight: bold" class="d-flex justify-content-between">
                                            <span>{{ $F1ThiYearWithdrawAllClient->sum('amount') }}</span><span class="badge badge-danger right">{{ $MainThiYearWithdrawAllClient->count() }}</span>
                                        </h4>
                                    </td>
                                </tr>
                                <tr style="background: rgba(255, 242, 99, 0.801)">
                                    <td>
                                        <h4 style="font-weight: bold">Bonus(D-W)</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1ThiYearDepositAllClient->sum('bonus') - $F1ThiYearWithdrawAllClient->sum('bonus') }}
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 style="font-weight: bold">Expense</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                </tr>
                                <tr style="background: rgb(20, 255, 20)">
                                    <td>
                                        <h4 style="font-weight: bold">Net Profit/Loss</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">0</h4>
                                    </td>
                                    <td class="text-center">
                                        <h4 style="font-weight: bold">
                                            {{ $F1ThiYearDepositAllClient->sum('amount') - $F1ThiYearWithdrawAllClient->sum('amount') }}
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- new card design ends --}}

    {{-- <section class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6" style="border-right: 2px solid">
                    <h2>CRICADDA MAIN</h2>
                    <div class="card-body table-responsive p-0 small-box bg-primary">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Today</th>
                                    <th scope="col">Today's New</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Deposit</td>
                                    <td>100-5</td>
                                    <td>{{ $MaintodaysDepositAllClient->sum('amount') }}-{{ $MaintodaysDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $MaintodaysWithdrawAllClient->sum('amount') }}-{{ $MaintodaysWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $MaintodaysDepositAllClient->sum('bonus') - $MaintodaysWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $MaintodaysDepositAllClient->sum('amount') - $MaintodaysWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="card-body table-responsive p-0  small-box bg-primary">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">This Week</th>
                                    <th scope="col">This Week New</th>
                                    <th scope="col">This Week Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Deposit</td>
                                    <td>0-5</td>
                                    <td>{{ $MainThiWeekDepositAllClient->sum('amount') }}-{{ $MainThiWeekDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $MainThiWeekWithdrawAllClient->sum('amount') }}-{{ $MainThiWeekWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $MainThiWeekDepositAllClient->sum('bonus') - $MainThiWeekWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $MainThiWeekDepositAllClient->sum('amount') - $MainThiWeekWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="card-body table-responsive p-0 small-box bg-primary">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">This Month</th>
                                    <th scope="col">This Month New</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> Deposit(D-W)</td>
                                    <td>100-5</td>
                                    <td>{{ $MainThiMonthDepositAllClient->sum('amount') }}-{{ $MainThiMonthDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $MainThiMonthWithdrawAllClient->sum('amount') }}-{{ $MainThiMonthWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $MainThiMonthDepositAllClient->sum('bonus') - $MainThiMonthWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $MainThiMonthDepositAllClient->sum('amount') - $MainThiMonthWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="card-body table-responsive p-0 small-box bg-primary">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">This Year</th>
                                    <th scope="col">This Year New</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Deposit</td>
                                    <td>100-5</td>
                                    <td>{{ $MainThiYearDepositAllClient->sum('amount') }}-{{ $MainThiYearDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $MainThiYearWithdrawAllClient->sum('amount') }}-{{ $MainThiYearWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $MainThiYearDepositAllClient->sum('bonus') - $MainThiYearWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $MainThiYearDepositAllClient->sum('amount') - $MainThiYearWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-6">
                    <h2>CRICADDA F2</h2>
                    <div class="card-body table-responsive p-0 small-box bg-primary">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Today</th>
                                    <th scope="col">Today's New</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Deposit</td>
                                    <td>100-5</td>
                                    <td>{{ $F1todaysDepositAllClient->sum('amount') }}-{{ $F1todaysDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $F1todaysWithdrawAllClient->sum('amount') }}-{{ $F1todaysWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $F1todaysDepositAllClient->sum('bonus') - $F1todaysWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $F1todaysDepositAllClient->sum('amount') - $F1todaysWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="card-body table-responsive p-0 small-box bg-primary">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">This Week</th>
                                    <th scope="col">This Week New</th>
                                    <th scope="col">This Week Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Deposit</td>
                                    <td>0-5</td>
                                    <td>{{ $F1ThiWeekDepositAllClient->sum('amount') }}-{{ $F1ThiWeekDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiWeekWithdrawAllClient->sum('amount') }}-{{ $F1ThiWeekWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiWeekDepositAllClient->sum('bonus') - $F1ThiWeekWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiWeekDepositAllClient->sum('amount') - $F1ThiWeekWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="card-body table-responsive p-0 small-box bg-primary">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">This Month</th>
                                    <th scope="col">This Month New</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Deposit</td>
                                    <td>100-5</td>
                                    <td>{{ $F1ThiMonthDepositAllClient->sum('amount') }}-{{ $F1ThiMonthDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiMonthWithdrawAllClient->sum('amount') }}-{{ $F1ThiMonthWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiMonthDepositAllClient->sum('bonus') - $F1ThiMonthWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiMonthDepositAllClient->sum('amount') - $F1ThiMonthWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="card-body table-responsive p-0 small-box bg-primary">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">This Year</th>
                                    <th scope="col">This Year New</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Deposit</td>
                                    <td>100-5</td>
                                    <td>{{ $F1ThiYearDepositAllClient->sum('amount') }}-{{ $F1ThiYearDepositAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Withdraw</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiYearWithdrawAllClient->sum('amount') }}-{{ $F1ThiYearWithdrawAllClient->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus(D-W)</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiYearDepositAllClient->sum('bonus') - $F1ThiYearWithdrawAllClient->sum('bonus') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Net Profit/Loss</td>
                                    <td>--</td>
                                    <td>{{ $F1ThiYearDepositAllClient->sum('amount') - $F1ThiYearWithdrawAllClient->sum('amount') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="">Leads Project Details</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $leadManagers ?? 0 }}</h3>
                            <p>Total Managers</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $leadAgent ?? 0 }}</h3>
                            <p>Total Agents</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                {{-- daily --}}
                <div class="col-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $todaysLeads ?? 0 }}</h3>
                            <p>Todays Leads</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $ProctodaysLeads ?? 0 }}</h3>
                            <p>Todays Processed Leads</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                {{-- monthly --}}
                <div class="col-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $monthlyLeads ?? 0 }}</h3>
                            <p>Monthly Total Leads</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $ProcmonthlyLeads ?? 0 }}</h3>
                            <p>Monthly Processed Leads</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                {{-- total --}}
                <div class="col-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $TotalLeads ?? 0 }}</h3>
                            <p>Total Leads</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $ProcTotalLeads ?? 0 }}</h3>
                            <p>Total Processed Leads</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
