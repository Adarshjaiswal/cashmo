<ul class="navbar-nav iq-main-menu" id="sidebar">
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled" href="#" tabindex="-1">
            <span class="default-icon">Home</span>
            <span class="mini-icon">-</span>
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ activeRoute(route('dashboard')) }}" aria-current="page" href="{{ route('dashboard') }}">
        <i class="icon">
            <!-- SVG icon for Dashboard -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                <path d="M1 2a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm6 0a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V2zm-6 6a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V8zm6 0a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8zm-6 6a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm6 0a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-3z"/>
            </svg>
        </i>
        <span class="item-name">Dashboard</span>
    </a>
</li>


    @if(auth()->user()->user_type == 'user')

        <!-- Show 'Recharge' menu option for regular users -->
        <li class="nav-item">
            <a class="nav-link {{ activeRoute(route('mobileRecharge')) }}" aria-current="page" href="{{ route('mobileRecharge') }}">
                <i class="icon">
                    <!-- SVG icon code -->
                </i>
                <span class="item-name">Recharge</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ activeRoute(route('AEPS.index')) }}" aria-current="page" href="{{ route('AEPS.index') }}">
                <i class="icon">
                    <!-- SVG icon code -->
                </i>
                <span class="item-name">AEPS</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">
                <i class="icon">
                    <!-- SVG icon code -->
                </i>
                <span class="item-name">PAN</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">
                <i class="icon">
                    <!-- SVG icon code -->
                </i>
                <span class="item-name">Insurance</span>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link {{ activeRoute(route('wallet.allUserTransactionView')) }}" aria-current="page" href="{{ route('wallet.allUserTransactionView') }}">
                <i class="icon">
                    <!-- SVG icon code -->
                </i>
                <span class="item-name">Passbook</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ activeRoute(route('anyQuery')) }}" aria-current="page" href="{{ route('anyQuery') }}">
                <i class="icon">
                    <!-- SVG icon code -->
                </i>
                <span class="item-name">Any Query</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->user_type == 'admin')
        <!-- Show 'Users' menu option for admins -->
        <li class="nav-item">
    <a class="nav-link {{ activeRoute(route('users.index')) }}" aria-current="page" href="{{ route('users.index') }}">
        <i class="icon">
            <!-- Replace this with your desired SVG icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M13 6.5c0 1.379-1.12 2.5-2.5 2.5S8 7.879 8 6.5 9.12 4 10.5 4 13 5.121 13 6.5zm-7 0c0 1.379-1.12 2.5-2.5 2.5S1 7.879 1 6.5 2.12 4 3.5 4 6 5.121 6 6.5zm4.478 3a3.575 3.575 0 0 0 2.59 1.5c.663 0 1.28-.214 1.797-.573A2.7 2.7 0 0 1 16 13.41V14c0 .5-.5 1-1 1H1c-.5 0-1-.5-1-1v-.59c0-.773.385-1.466.965-1.883A3.575 3.575 0 0 1 3.523 9.5a5.99 5.99 0 0 0 1.839-.272C6.314 9.856 7.277 10 8 10c.723 0 1.686-.144 2.638-.772A5.99 5.99 0 0 0 12.478 9.5z"/>
</svg>

        </i>
        <span class="item-name">Users</span>
    </a>
</li>
      
<li class="nav-item">
    <a class="nav-link {{ activeRoute(route('AllPackage.index')) }}" aria-current="page" href="{{ route('AllPackage.index') }}">
        <i class="icon">
            <!-- SVG icon for Package -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.097.22a.5.5 0 0 0-.194 0L1 1.78v7.784a.5.5 0 0 0 .342.474l6.46 2.485a.5.5 0 0 0 .396 0l6.46-2.485a.5.5 0 0 0 .342-.474V1.78L8.097.22zM7.3 1.388a.5.5 0 0 1 .4 0l6.46 2.485-2.967 1.144L4.91 2.532 7.3 1.388zm.8 11.224l-5.3-2.041V3.349l5.3 2.045v7.218zm.6 0V5.394l5.3-2.045v7.222l-5.3 2.041z"/>
                <path d="M5.431 2.108a.5.5 0 0 1 .474.001L8 3.261l2.095-1.152a.5.5 0 0 1 .474 0l3.905 2.147a.5.5 0 0 1-.003.882L8.457 6.94a.5.5 0 0 1-.457 0L1.139 5.137a.5.5 0 0 1-.003-.882L5.431 2.108z"/>
            </svg>
        </i>
        <span class="item-name">Package</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ activeRoute(route('AllWallets.view')) }}" aria-current="page" href="{{ route('AllWallets.view') }}">
        <i class="icon">
            <!-- SVG icon for Wallet Payments -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                <path d="M12 4H2a1 1 0 0 0-1 1v5.5A2.5 2.5 0 0 0 3.5 13h9A2.5 2.5 0 0 0 15 10.5v-5A2.5 2.5 0 0 0 12.5 3H3a2 2 0 0 0-2 2v5.5A2.5 2.5 0 0 0 3.5 13h9A1.5 1.5 0 0 0 14 11.5V9h1V4a2 2 0 0 0-2-2H2.5A2.5 2.5 0 0 0 0 4v5.5A2.5 2.5 0 0 0 2.5 12h10A2.5 2.5 0 0 0 15 9.5V8h-1v1.5A1.5 1.5 0 0 1 12.5 11H2.5A2.5 2.5 0 0 1 0 8.5V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1z"/>
            </svg>
        </i>
        <span class="item-name">Fund Requests</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ activeRoute(route('AllQuery.view')) }}" aria-current="page" href="{{ route('AllQuery.view') }}">
        <i class="icon">
            <!-- SVG icon for Retailers Queries -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                <path d="M5.255 5.786a.237.237 0 0 0-.247.247c.007.081.082.187.255.316.408.29.87.635.87 1.14 0 .396-.276.735-.772.735-.393 0-.752-.187-.983-.529a.237.237 0 0 0-.37-.016l-.007.007c-.217.285-.372.641-.372 1.022 0 .615.344 1.053.944 1.053.61 0 1.056-.475 1.256-1.021.183-.493.342-.875.47-1.203.13-.327.237-.654.237-.992 0-.598-.472-1.096-1.06-1.096-.433 0-.864.177-1.056.556z"/>
                <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"/>
            </svg>
        </i>
        <span class="item-name">Retailers Queries</span>
    </a>
</li>




    @endif
</ul>
