<div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="max-width:420px; margin:0 auto;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Receipt</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-4" id="receiptContent">
        <span id="modalReceiptId" style="display:none;"></span>
        <div style="text-align:center; font-family: 'Courier New', monospace;">
          <div style="font-weight:700; font-size:18px;">START SMALL</div>
          <div style="font-size:12px; color:#555;">
            Simple Store • <strong>TIN:</strong> <span id="modalTIN">—</span>
          </div>
          <hr style="border-top:1px dashed #bbb; margin:10px 0;">
        </div>

        <div style="font-family: 'Courier New', monospace; font-size:13px; text-align:left;">
          <div><strong>Receipt #:</strong> <span id="modalReceiptNo">—</span></div>
          <div><strong>Cashier:</strong> <span id="modalCashier">—</span></div>
          <div><strong>Date:</strong> <span id="modalDate">—</span></div>
          <div><strong>Payment:</strong> <span id="modalPayment">—</span></div>

          <table style="width:100%; margin-top:10px; font-family:'Courier New', monospace; font-size:13px;">
            <thead style="border-top:1px dashed #ddd; border-bottom:1px dashed #ddd;">
              <tr>
                <th style="text-align:left; width:50%;">Item</th>
                <th style="text-align:center; width:15%;">Qty</th>
                <th style="text-align:right; width:15%;">Price</th>
                <th style="text-align:right; width:20%;">Total</th>
              </tr>
            </thead>
            <tbody id="modalItems" style="padding-top:6px;">
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" style="text-align:right; border-top:1px dashed #bbb; padding-top:8px; font-weight:700;">
                  TOTAL</td>
                <td style="text-align:right; border-top:1px dashed #bbb; padding-top:8px; font-weight:700;"
                  id="modalTotal">₱0.00</td>
              </tr>
            </tfoot>
          </table>

          <hr style="border-top:1px dashed #bbb; margin:10px 0;">
          <div style="text-align:center; font-size:12px; color:#555;">Thank you for your purchase!</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <button type="button" class="btn btn-outline-primary" id="printReceiptBtn">
          Print
        </button>

        <button type="button" class="btn btn-primary" id="pdfReceiptBtn">
          Download PDF
        </button>
      </div>
    </div>
  </div>
</div>