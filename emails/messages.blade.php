@extends(AdminTheme::wrapper(), ['title' => __('admin.email', ['default' => 'Emails']), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
<link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
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
            <form action="{{ route('admin.settings.store') }}" method="POST">
            <div class="card-header">
              <h4>{!!  __('admin.email_content', ['default' => 'Email content']) !!}</h4>
            </div>
            <div class="card-body">
                @csrf
              <div class="row">

                <div class="form-group col-md-12 col-12">
                    <label for="email::outro">{!!  __('admin.email_outro', ['default' => 'Email Outro']) !!}</label>
                    <textarea class="summernote form-control" name="email::outro" id="email::outro" style="display: none;">
                        @settings('email::outro',
                        'Should you have any further inquiries or require ongoing support, please feel free to reach out to us through our online portal. Our dedicated team is available to assist you promptly and efficiently via the ticketing system.')
                    </textarea>
                    <small class="form-text text-muted">
                        {!!  __('admin.email_outro_desc', ['default' => 'Outro messages included at the end of all emails sent out.']) !!}
                    </small>
                </div>

                <div class="form-group col-md-12 col-12">
                    <label for="email::welcome_email">{!!  __('admin.email_welcome_title', ['default' => 'Welcome Email']) !!}</label>
                    <textarea class="summernote form-control" name="email::welcome_email" id="email::welcome_email" style="display: none;">
                        @settings('email::welcome_email',
                        "Welcome to ". settings('app_name', 'Host') ."! We are thrilled to have you and can't wait to offer you our exceptional services. Our platform is designed to cater to your needs, whether you're connecting with others, streamlining workflows, or exploring new possibilities. With a seamless user experience, we look forward to providing you with top-notch services that will enhance your online experience.")
                    </textarea>
                    <small class="form-text text-muted">{!!  __('admin.email_welcome_desc', ['default' => 'Write a welcoming message to new clients']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                    <label for="email::payment_paid">{!!  __('admin.email_payment_paid_title', ['default' => 'Payment Paid']) !!}</label>
                    <textarea class="summernote form-control" name="email::payment_paid" id="email::payment_paid" style="display: none;">
                        @settings('email::payment_paid',
                        "We are pleased to inform you that your payment has been successfully processed and received. This email serves as a confirmation that your payment has been successfully completed.")
                    </textarea>
                    <small class="form-text text-muted">{!!  __('admin.email_payment_paid_desc', ['default' => ' ']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                    <label for="email::refund">{!!  __('admin.email_processing_refund_title', ['default' => 'Processing Refund']) !!}</label>
                    <textarea class="summernote form-control" name="email::refund" id="email::refund" style="display: none;">
                        @settings('email::refund',
                        "We are writing to inform you that we have initiated a refund for one of your payments. Your refund is being processed in the background. Please allow 3 - 5 business days to receive your refund. For Payments made with Balance this is instant.")
                    </textarea>
                    <small class="form-text text-muted">{!!  __('admin.email_processing_refund_desc', ['default' => ' ']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                  <label for="email::cancelled">{!!  __('admin.email_service_cancelled_title', ['default' => 'Service Cancelled']) !!}</label>
                  <textarea class="summernote form-control" name="email::cancelled" id="email::cancelled" style="display: none;">
                      @settings('email::cancelled',
                      "We are writing to inform you that you have cancelled your service. Should you change your mind; you can dismiss your cancellation within the grace period. <br><br> We hope to see you as a client in the future.")
                  </textarea>
                  <small class="form-text text-muted">{!!  __('admin.email_service_cancelled_desc', ['default' => ' ']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                  <label for="email::suspended">{!!  __('admin.email_service_suspended_title', ['default' => 'Service Suspended']) !!}</label>
                  <textarea class="summernote form-control" name="email::suspended" id="email::suspended" style="display: none;">
                      @settings('email::suspended',
                      "We regret to inform you that your service has been suspended due to overdue payment. To avoid termination, please settle any outstanding invoices within ". settings('orders::terminate_suspended_after', 7) ." days from the due date. If payment is not received within this timeframe, your service will be terminated, resulting in the deletion or revocation of all associated data, files, and licenses.")
                  </textarea>
                  <small class="form-text text-muted">{!!  __('admin.email_service_suspended_desc', ['default' => ' ']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                  <label for="email::terminated">{!!  __('admin.email_service_terminated_title', ['default' => 'Service Terminated']) !!}</label>
                  <textarea class="summernote form-control" name="email::terminated" id="email::terminated" style="display: none;">
                      @settings('email::terminated',
                      "We regret to inform you that your service has been terminated due to overdue payment. Termination can happen due to a couple of reasons. You were late on payment, or you cancelled the service. All data / files / licenses belonging to this service have been deleted or revoked. <br> We hope to see you as a client in the future.")
                  </textarea>
                  <small class="form-text text-muted">{!!  __('admin.email_service_terminated_desc', ['default' => ' ']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                  <label for="email::new_device">{!!  __('admin.email_service_new_device_detect_title', ['default' => 'New device detected']) !!}</label>
                  <textarea class="summernote form-control" name="email::new_device" id="email::new_device" style="display: none;">
                      @settings('email::new_device',
                      "It looks like you signed into your account from a new device and IP address.")
                  </textarea>
                  <small class="form-text text-muted">{!!  __('admin.email_service_new_device_detect_desc', ['default' => ' ']) !!}</small>
                </div>

                <div class="form-group col-md-12 col-12">
                  <label for="email::account_deletion_requested">Account Deletion Request Notice</label>
                  <textarea class="summernote form-control" name="email::account_deletion_requested" id="email::account_deletion_requested" style="display: none;">
                      @settings('email::account_deletion_requested', "You have requested to have your account permanent deleted from our platform. To protect you, we have placed your account in a queue of 72 hours, after which your account will be permanently deleted. this action is irreversible."),
                  </textarea>
                  <small class="form-text text-muted"></small>
                </div>

              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">{!!  __('admin.submit', ['default' => 'Submit']) !!}</button>
            </div>
          </div>
        </form>
    </div>
</div>
<style>
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }
</style>
@endsection
