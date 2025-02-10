<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Define Commission</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="commissionForm" action="{{route('commission.update')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <label class="form-label" for="recharge_commission">Recharge Commission (%):</label>
                                        <input type="number" class="form-control" id="recharge_commission" name="recharge_commission" value="{{$commission->recharge_commission ?? ''}}" step="0.01">
                                        <span class="text-danger">{{$errors->first('recharge_commission')}}</span>
                                        <input type="hidden" name="id" value="{{$commission->id ?? ''}}">
                                </div>
                            </div>
                            <button type="submit" id="submitRecharge" class="btn btn-primary">
                                <span id="buttonText">Submit</span>
                                <span id="buttonLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

