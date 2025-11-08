    <!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Order Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- content loaded by AJAX -->
        <div id="orderModalContent" class="p-2">Loading...</div>
      </div>
      <div class="modal-footer no-print">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="modalPrintBtn" type="button" class="btn btn-success">Print</button>
      </div>
    </div>
  </div>
</div>
