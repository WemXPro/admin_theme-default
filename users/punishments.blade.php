@extends(AdminTheme::wrapper(), ['title' => __('admin.punishments'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">

@endsection

@section('js_libraries')
<script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
<script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12">
                @includeIf(AdminTheme::path('users.user_nav'))
            </div>
        </div>

        <div class="col-12">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <h4>{!! __('admin.punishments') !!}</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#banModal" class="btn btn-icon icon-left btn-primary"><i class="fas fa-solid fa-plus"></i> 
                                {!! __('admin.create') !!}
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                <tr>
                                    <th>{!! __('admin.id') !!}</th>
                                    <th>{!! __('admin.user') !!}</th>
                                    <th>{!! __('admin.staff') !!}</th>
                                    <th>{!! __('admin.type') !!}</th>
                                    <th>{!! __('admin.reason') !!}</th>
                                    <th>{!! __('admin.create_at') !!}</th>
                                    <th class="text-right">{!! __('admin.actions') !!}</th>
                                </tr>

                                @foreach($punishments as $punishment)
                                    <tr>
                                        <td>{{ $punishment->id }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', ['user' => $punishment->user->id]) }}"
                                               style="display: flex; color: #6c757d">
                                                <img alt="image" src="{{ $punishment->user->avatar() }}"
                                                     class="rounded-circle mr-1 mt-1" width="32px" height="32px"
                                                     data-toggle="tooltip" title=""
                                                     data-original-title="{{ $punishment->user->first_name }} {{ $punishment->user->last_name }}">
                                                <div class="flex">
                                                    {{ $punishment->user->username }} <br>
                                                    <small>{{ $punishment->user->email }}</small>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            @isset($punishment->staff)
                                            <a href="{{ route('users.edit', ['user' => $punishment->staff->id]) }}"
                                               style="display: flex; color: #6c757d">
                                                <img alt="image" src="{{ $punishment->staff->avatar() }}"
                                                     class="rounded-circle mr-1 mt-1" width="32px" height="32px"
                                                     data-toggle="tooltip" title=""
                                                     data-original-title="{{ $punishment->staff->first_name }} {{ $punishment->staff->last_name }}">
                                                <div class="flex">
                                                    {{ $punishment->staff->username }} <br>
                                                    <small>{{ $punishment->staff->email }}</small>
                                                </div>
                                            </a>
                                            @endisset
                                        </td>
                                        <td>
                                            <div class="flex align-items-center">
                                                <i class="fas fa-solid fa-circle 
                                                @if(in_array($punishment->type, ['ban', 'ipban'])) text-danger @else text-warning @endif"
                                                   style="font-size: 11px;"></i> {{ ucfirst($punishment->type) }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $punishment->reason }}    
                                        </td>
                                        <td>
                                            {!! __('admin.created') !!}: {{ $punishment->created_at->translatedFormat(settings('date_format', 'd M Y')) }}
                                            <br>
                                            {!! __('admin.expires_in') !!}: @isset($punishment->expires_at) {{ $punishment->expires_at->translatedFormat(settings('date_format', 'd M Y')) }} @else Never @endisset
                                            <br>
                                        </td>
                                        <td class="text-right">
                                            @if(in_array($punishment->type, ['ban', 'ipban']))
                                                <a href="{{ route('admin.bans.unban', $punishment->id) }}" class="btn btn-warning">Unban</a>
                                            @endif
                                            <a href="{{ route('admin.bans.destroy', $punishment->id) }}" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      {{ $punishments->links(AdminTheme::pagination()) }}
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Modal -->
<div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="banModalLabel">Punish {{ $user->username }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.user.punishments.create', $user->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="type">Type</label>
                    <div class="input-group mb-2">
                        <select name="type" id="type" class="form-control select2 select2-hidden-accessible"
                                tabindex="-1" aria-hidden="true" onchange="toggleType()">
                                <option value="warning" @if(false) selected @endif>Warning</option>
                                <option value="ban" @if(false) selected @endif>Ban</option>
                                <option value="ipban" @if(false) selected @endif>IP Ban</option>
                        </select>
                        <small class="form-text text-muted"></small>
                    </div>
                </div>

                <div class="form-group" style="display: none;" id="ip_address">
                    <label>IP Address</label>
                    <input type="text" class="form-control" name="ip_address" value="@if($user->ips()->exists()){{ $user->ips()->orderBy('uses', 'desc')->first()->ip_address  }}@endif"/>
                    <small class="mt-1">The IP address is automatically retrieved by checking which IP the user used to most to access the application</small>
                </div>

                <div class="form-group">
                    <label>Reason (optional)</label>
                    <textarea type="text" class="form-control" name="reason" value=""></textarea>
                </div>

                <div class="form-group">
                    <label>Expires at (optional)</label>
                    <input type="date" class="form-control" name="expires_at" value=""/>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function toggleType() {        
        if(document.getElementById("type").value == 'ipban') {
            document.getElementById("ip_address").style.display = 'unset';
        } else {
            document.getElementById("ip_address").style.display = 'none';
        }
    }
  </script>
@endsection
