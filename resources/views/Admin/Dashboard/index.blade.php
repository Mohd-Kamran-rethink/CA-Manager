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

    {{-- customer care project --}}
    <hr>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="">Customer Care Details</h1>
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
                            <h3>{{ $totalWithdrawrers ?? 0 }}</h3>
                            <p>Total Withdrawars</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalDepositers ?? 0 }}</h3>
                            <p>Total Depositers</p>
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
                            <h3>{{ $totalWithdrawrersBanker ?? 0 }}</h3>
                            <p>Total Withdrawal Banker</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totaldepositbanker ?? 0 }}</h3>
                            <p>Total Deposit Banker</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>

                    </div>
                </div>
                {{-- monthly --}}
                <div class="col-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $ApprovedWithdrawToday ?? 0 }}</h3>
                            <p>Today's Total Withdraws (Money)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $ApprovedDepoistToday ?? 0 }}</h3>
                            <p>Today's Total Deposits (Money)</p>
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
                            <h3>{{ $ApprovedDepoistTotal ?? 0 }}</h3>
                            <p>Total Deposits (Money)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $ApprovedWithdrawTotal ?? 0 }}</h3>
                            <p>Total Withdraws (Money)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                {{-- count --}}
                <div class="col-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($ApprovewithTranTotal) ?? 0 }}</h3>
                            <p>Total Approved Withdraws (Count)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ count($PendingwithTranTotal) ?? 0 }}</h3>
                            <p>Total Pending Withdraws (Count)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ count($ApproveDepoistTranTotal) ?? 0 }}</h3>
                            <p>Total Approved Deposit (Count)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ count($PendingDepTranTotal) ?? 0 }}</h3>
                            <p>Total Pending Deposit (Count)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                {{-- bonus --}}
                <div class="col-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $todaysBonus ?? 0 }}</h3>
                            <p>Today's Bonus</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalBonus ?? 0 }}</h3>
                            <p>Total Bonus</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>

                    </div>
                </div>
            </div>
    </section>
    {{-- expense projects --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="">Expense Project Details</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $internalTransfer?? 0 }}</h3>
                            <p>Total Internal Transfer</p>
                        </div>
                        <div class="icon">
                            <i style="font-size: 50px" class="fa fa-credit-card"></i>
                        </div>
                    </div>
                </div>
                {{-- dwbit --}}
                <div class="col-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $ExpenseDebit?? 0 }}</h3>
                            <p>Total Expense Debits</p>
                        </div>
                        <div class="icon">
                            <i style="font-size: 50px" class="fa fa-credit-card"></i>
                        </div>
                    </div>
                </div>
                {{-- credits --}}
                <div class="col-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $ExpenseCredit?? 0 }}</h3>
                            <p>Total Expense Credits</p>
                        </div>
                        <div class="icon">
                            <i style="font-size: 50px" class="fa fa-credit-card"></i>
                        </div>
                    </div>
                </div>

            </div>
    </section>
@endsection
