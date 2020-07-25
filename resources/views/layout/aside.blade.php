 <!-- Sidebar Navigation Left -->
 <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">

<!-- Logo -->
<div class="logo-sn ms-d-block-lg">
  <a class="pl-0 ml-0 text-center" href="index.html"> <img src="{{ asset('adminasset/img/logo.png')}}" alt="logo"> </a>
</div>

<!-- Navigation -->
<ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
  <!-- Home -->
  <li class="menu-item ">
    <a class="active" href="{{url('/')}}">
      <span><i class="material-icons fs-16">home</i>Home </span>
    </a>

  </li>
  <!-- /Home -->
  <!-- Setup  -->
  @if (Auth::user()->role_id==1 ||Auth::user()->role_id==4 || Auth::user()->role_id==2)
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#create" aria-expanded="false"
     aria-controls="tables">
      <span><i class="material-icons fs-16">build</i>Setup</span>
    </a>
    <ul id="create" class="collapse" aria-labelledby="tables" data-parent="#side-nav-accordion">
   
    @if (Auth::user()->role_id==1 ||Auth::user()->role_id==4 || Auth::user()->role_id==2  )
    <li> <a href="{{ route('client.index') }}">Clients</a> </li>
    @endif
    @if (Auth::user()->role_id==1 ||Auth::user()->role_id==4  )
      <li> <a href="{{ route('supplier.index') }}">Suppliers</a> </li>
      <li> <a href="{{ route('port.index') }}">Ports</a> </li>
      <li> <a href="{{ route('carrier.index') }}">Carriers</a> </li>
      <li> <a href="{{ route('agent.index') }}" >Agents</a> </li>
      <li> <a href="{{ route('expenses.index') }}">Expenses</a> </li>
      <li> <a href="{{ route('container.index') }}">Containers </a> </li>
      <li> <a href="{{ route('employee.index') }}">Employees </a> </li>
      <li> <a href="{{ route('bank-account.index') }}">Bank Accounts</a> </li>
      <!-- <li> <a href="{{ route('currency.index') }}">Currencies</a> </li> -->
      <li> <a href="{{ route('commodity.index') }}">Commodity</a> </li>
      <li> <a href="{{ route('country.index') }}">Countries</a> </li>
  
      @endif
    </ul>
  </li>
  @endif
  <!--  Setup  -->
  <!-- Price Lists  -->
  @if (Auth::user()->role_id==1 ||Auth::user()->role_id==4 || Auth::user()->role_id==3)
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#basic-elements" aria-expanded="false"
     aria-controls="basic-elements">
      <span><i class="material-icons fs-16">assignment</i>Price Lists</span>
    </a>
    <ul id="basic-elements" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('ocean-freight.index') }}">Ocean Freight</a> </li>
      <li> <a href="{{ route('trucking-rate.index') }}">Trucking Rates</a> </li>
      <li> <a href="{{ route('air-rate.index') }}">Air Rates</a> </li>
    </ul>
  </li>
  @endif
  <!--  Price Lists  -->
<!-- Sales  -->
@if (Auth::user()->role_id==1 ||Auth::user()->role_id==4 || Auth::user()->role_id==2)
<li class="menu-item">
  <a href="#" class="has-chevron" data-toggle="collapse" data-target="#contactsdropdown" aria-expanded="false"
   aria-controls="contactsdropdown">
    <span><i class="material-icons fs-16">assignment</i>Sales</span>
  </a>
  <ul id="contactsdropdown" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">
    <li> <a href="{{ route('sale-quote.index') }}">Sales Quote</a> </li>
 
  </ul>
  
</li>
@endif
<!-- Operations  --> 
@if (Auth::user()->role_id==1 ||Auth::user()->role_id==4 )
<li class="menu-item">
<a href="#" class="has-chevron" data-toggle="collapse" data-target="#operationdropdown" aria-expanded="false"
   aria-controls="contactsdropdown">
  <span><i class="material-icons fs-16">assignment</i>Operations</span>
</a>
<ul id="operationdropdown" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">

<li> <a href="{{ route('operations.index') }}">Operations</a> </li>

</ul>

</li>
@endif
<!-- Accounting  --> 
@if (Auth::user()->role_id==1 ||Auth::user()->role_id==5)
<li class="menu-item">
<a href="#" class="has-chevron" data-toggle="collapse" data-target="#accountdropdown" aria-expanded="false"
   aria-controls="contactsdropdown">
  <span><i class="material-icons fs-16">assignment</i>Accounting</span>
</a>
<ul id="accountdropdown" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">

<li> <a href="{{ route('cash-box.index') }}">Cash Box</a> </li>
<li> <a href="{{ route('bank.index') }}">Bank</a> </li>
<li> <a href="{{ route('cash-finance.index') }}">Cash Box Finance</a> </li>
<li> <a href="{{ route('bank-finance.index') }}">Bank Finance</a> </li>
<li> <a href="{{ route('invoice.index') }}">Invoice</a> </li>



</ul>

</li>
<!-- Operations  --> 
<li class="menu-item">
<a href="#" class="has-chevron" data-toggle="collapse" data-target="#statmentdropdown" aria-expanded="false"
   aria-controls="contactsdropdown">
  <span><i class="material-icons fs-16">assignment</i>Account Statment</span>
</a>
<ul id="statmentdropdown" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">

<li> <a href="{{ route('bank-cash-statment.index') }}">Bank/CashBox Statment</a> </li>
<li> <a href="{{ route('account-statment.index') }}">Operations Statment</a> </li>

</ul>

</li>
@endif

<!-- Reports  --> 
<li class="menu-item">
<a href="#" class="has-chevron" data-toggle="collapse" data-target="#Reports" aria-expanded="false"
   aria-controls="contactsdropdown">
  <span><i class="material-icons fs-16">assignment</i>Reports</span>
</a>
<ul id="Reports" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">

<li> <a href="{{ route('client-report.index') }}">Client Report</a> </li>
<li> <a href="{{ route('supplier-report.index') }}">Supplier Report</a> </li>
<li> <a href="{{ route('total-balance.index') }}">Balances Statment</a> </li>
<li> <a href="{{ route('earn-balance.index') }}">Earning Statment</a> </li>
<li> <a href="{{ route('operation-balance.index') }}">Operation Statment</a> </li>





</ul>

</li>
</ul>


</aside>