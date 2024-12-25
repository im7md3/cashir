    <div class="modal fade" id="retrieved{{ $invoice->id }}" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('site.Invoice_refund') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="refund">{{ __('site.Amount') }}</label>
              <input type="text" class="form-control" wire:model="refund" id="refund">
            </div>
            <div class="mb-2">
              <label for="refund_status">{{ __('site.Status') }}</label>
              <select class="form-control" wire:model="refund_status" id="refund_status">
                <option value="">{{ __('site.choose') }}</option>
                <option value="creditor">{{ __('site.Creditor') }}</option>
                <option value="debtor">{{ __('site.Debtor') }}</option>
              </select>
            </div>
            <div class="alert alert-info m-0 py-2 w-100 " role="alert">
              - {{ __('site.Creditor_receiving_an_amount_from_the_customer') }}
              <br>
              - {{ __('site.A_debtor_refunds_the_amount_to_the_customer') }}
            </div>
          </div>
          <div class="modal-footer">
            <div class="d-flex align-items-center justify-content-between gap-3 m-0 w-100">
              <div class="d-flex align-items-center justify-content-end gap-1">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='retrieved({{ $invoice->id }})' type="button" class="btn btn-primary"
                  data-bs-dismiss="modal">{{ __('site.yes') }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
