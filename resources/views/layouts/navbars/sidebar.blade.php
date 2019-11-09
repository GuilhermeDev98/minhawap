<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="{{route('home')}}" class="simple-text logo-mini">
      {{ __('MW') }}
    </a>
    <a href="{{route('home')}}" class="simple-text logo-normal">
      {{ __('Minha Wap') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    @if(Auth::user()->status == 'admin')
          <ul class="nav">
              <li class="@if ($activePage == 'home') active @endif">
                  <a href="{{ route('home') }}">
                      <i class="fas fa-tachometer-alt"></i>
                      <p>{{ __('Dashboard') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'comunity') active @endif">
                  <a href="{{ route('admin.comunity.index') }}">
                      <i class="fas fa-globe"></i>
                      <p>{{ __('Comunidades') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'user') active @endif">
                  <a href="{{ route('admin.user.index') }}">
                      <i class="fas fa-users"></i>
                      <p> {{ __("Usuários") }} </p>
                  </a>
              </li>
              <li class="@if ($activePage == 'invoice') active @endif">
                  <a href="{{ route('admin.invoice.index') }}">
                      <i class="fas fa-file-invoice-dollar"></i>
                      <p> {{ __("Faturas") }} </p>
                  </a>
              </li>
              <li class="@if ($activePage == 'plan') active @endif">
                  <a href="{{ route('admin.plan.index') }}">
                      <i class="fas fa-tag"></i>
                      <p>{{ __('Planos') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'offer') active @endif">
                  <a href="{{ route('admin.offer.index') }}">
                      <i class="fas fa-stream"></i>
                      <p>{{ __('Ofertas') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'note') active @endif">
                  <a href="{{ route('admin.note.index') }}">
                      <i class="fas fa-sticky-note"></i>
                      <p>{{ __('Recados') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'profile') active @endif">
                  <a href="{{ route('profile.edit') }}">
                      <i class="fas fa-user"></i>
                      <p> {{ __("Perfil") }} </p>
                  </a>
              </li>
          </ul>
    @endif

    @if(Auth::user()->status == 'user')
            <ul class="nav">
                <li class="@if ($activePage == 'home') active @endif">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li class="@if ($activePage == 'comunity') active @endif">
                    <a href="{{ route('comunity.index') }}">
                        <i class="fas fa-globe"></i>
                        <p>{{ __('Comunidades') }}</p>
                    </a>
                </li>
                <li class="@if ($activePage == 'plan') active @endif">
                    <a href="{{ route('admin.plan.index') }}">
                        <i class="fas fa-tag"></i>
                        <p>{{ __('Planos') }}</p>
                    </a>
                </li>
                <li class="@if ($activePage == 'note') active @endif">
                    <a href="{{ route('admin.note.index') }}">
                        <i class="fas fa-sticky-note"></i>
                        <p>{{ __('Recados') }}</p>
                    </a>
                </li>
                <li class="@if ($activePage == 'profile') active @endif">
                    <a href="{{ route('profile.edit') }}">
                        <i class="fas fa-user"></i>
                        <p> {{ __("Perfil") }} </p>
                    </a>
                </li>
            </ul>
    @endif
  </div>
</div>
