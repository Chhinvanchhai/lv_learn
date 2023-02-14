
    <html lang="en">
      <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">


      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

      <title>Hello, world!</title>
    </head>
      <body>
          <h1>Hello, world!</h1>


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
          </button>
          <button  onclick="Checkout.showPaymentPage();">
            Payment
          </button>

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body" id="hco-embedded">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>


          <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
          <script src="https://test-gateway.mastercard.com/static/checkout/checkout.min.js" data-error="errorCallback" data-cancel="cancelCallback"
          data-beforeRedirect="beforeRedirect" data-afterRedirect="afterRedirect" data-complete="completeCallback">
          </script>
      <script inline="javascript">
          var  successIndicator = '0269606c67474cda'
          function beforeRedirect() {
              return {
                  successIndicator: '0269606c67474cda',
                  orderId: 'A12345678'
              };
          }
          // This method is specifically for the full payment page option. Because we leave this page and return to it, we need to preserve the
          // state of successIndicator and orderId using the beforeRedirect/afterRedirect option
          function afterRedirect(data) {
              // Compare with the resultIndicator saved in the completeCallback() method
          }
          $('#exampleModal').on('shown.bs.modal', function (e) {
                  Checkout.showEmbeddedPage('#hco-embedded')
          });

          function errorCallback(error) {
              var message = JSON.stringify(error);
              $("#loading-bar-spinner").hide();
              console.log(message);
          }
          function cancelCallback() {
              console.log('Payment cancelled');
              // Reload the page to generate a new session ID - the old one is out of date as soon as the lightbox is invoked
              window.location.reload(true);
          }
          // This handles the response from Hosted Checkout and redirects to the appropriate endpoint
          function completeCallback(response) {
              resultIndicator = response;
              var result = (resultIndicator === successIndicator) ? "SUCCESS" : "ERROR";
              console.log(result)
          }
          Checkout.configure({
              billing: {
                  address: {
                      street: '123343',
                      city: 'Phnom Penh',
                      street: '12321',
                      street: 'KH'
                  }
              },
              session: {
                  id: 'SESSION0002764608882I6461349L38'
              },
              interaction: {
                  merchant: {
                      name: 'merchant.TEST12345168',
                      address: {
                          line1: '200 Sample St',
                          line2: '1234 Example Town'
                      }
                  }
              }
          });

      </script>

        </body>
        </html>
