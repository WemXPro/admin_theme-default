@extends(AdminTheme::wrapper(), ['title' => __('admin.email', ['default' => 'Emails']), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}"/>
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">

@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="#" method="POST">
                    <div class="card-header">
                        <h4>{!!  __('admin.email_history', ['default' => 'Email History']) !!}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>{!!  __('admin.client', ['default' => 'Client']) !!}</th>
                                    <th>{!!  __('admin.subject', ['default' => 'Subject']) !!}</th>
                                    <th>{!!  __('admin.status', ['default' => 'Status']) !!}</th>
                                    <th>{!!  __('admin.created', ['default' => 'Created at']) !!}</th>
                                    <th class="text-right">{!!  __('admin.actions', ['default' => 'Action']) !!}</th>
                                </tr>
                                @foreach(EmailHistory::latest()->paginate(15) as $email)
                                    <tr>
                                        <td>
                                            @if($email->user)
                                            <a style="display: flex; color: #6c757d"
                                               href="{{ route('users.edit', ['user' => $email->user->id ]) }}">
                                                <img alt="image" src="{{ $email->user->avatar() }}"
                                                     class="rounded-circle mr-2"
                                                     width="35" height="35" data-toggle="tooltip" title=""
                                                     data-original-title="{{ $email->user->first_name }} {{ $email->user->last_name }}">
                                                <div class="flex">
                                                    {{ $email->user->username }} <br>
                                                    <small>{{ $email->user->email }}</small>
                                                </div>
                                            </a>
                                            @else 
                                            {{ $email->receiver }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $email->subject }}
                                        </td>
                                        <td>
                                            <div
                                                class="badge @if($email->is_sent) badge-success @else badge-warning @endif">
                                                @if($email->is_sent)
                                                    {!!  __('admin.send', ['default' => 'send']) !!}
                                                @else
                                                    {!!  __('admin.pending', ['default' => 'pending']) !!}
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $email->created_at->diffForHumans() }}</td>
                                        <td  class="text-right">
                                            <a href="{{ route('emails.resend', ['email' => $email->id]) }}"
                                               class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>
                                                {!!  __('admin.resend', ['default' => 'Resend']) !!}
                                            </a>
                                            <button type="button" data-toggle="modal"
                                                    data-target="#previewEmail-{{ $email->id }}"
                                                    class="btn btn-icon icon-left btn-dark">
                                                <i class="fas fa-solid fa-magnifying-glass"></i>
                                                {!!  __('admin.preview', ['default' => 'Preview']) !!}
                                            </button>

                                            <!-- Modal {{ $email->id }}-->
                                            <div class="modal fade" id="previewEmail-{{ $email->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="previewEmail-{{ $email->id }}Label"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="previewEmail-{{ $email->id }}Label">
                                                                {!!  __('admin.preview_email', ['default' => 'Previewing Email']) !!}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="{{ __('client.close') }}">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @include(EmailTemplate::view(), [
                                                                'name' => $email->user->username ?? '👋',
                                                                'subject' => $email->subject,
                                                                'intro' => $email->content,
                                                                'button' =>  $email->button,
                                                                ])
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                {!!  __('admin.close', ['default' => 'Close']) !!}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ EmailHistory::latest()->paginate(15)->links(AdminTheme::pagination()) }}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }
        body {
            background-color: var(--primary-bg) !important;
        }
    </style>
@endsection
