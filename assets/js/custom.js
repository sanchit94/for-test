(function($, window, document, undefined) {
  "use strict";
  
  var pay_method = "debit card";
    
  $(document).on("click",".dropdown-outer [data-dropdown-value]", function() {
      $('.dropdown-outer [data-dropdown-value]').removeClass('active');
      var item = $(this);
      item.addClass('active');
      console.log(item.data('dropdown-value'));
      $(".dropdown-outer .dropdown-toggle").text(item.text());
      pay_method = item.data('dropdown-value');
      commission();
  })

  
  
//  Commission calculation code
    
//  Rate of interest in various methods
        var commissions = {
        
        debit_card: {
          paypal  : 2.5,
          paytm   : 2,
          transaqt: 1
        },
        credit_card: {
          paypal  : 2.5,
          paytm   : 2,
          transaqt: 1.85
        },
        netbanking: {
          paypal  : 2.5,
          paytm   : 2,
          transaqt: 1.75
        },
        wallets: {
          paypal  : 2.5,
          paytm   : 2,
          transaqt: 1.9
        },
        upi: {
          paypal  : 2.5,
          paytm   : 2,
          transaqt: 1
        }
    }
        
// Function for calculating and displaying the commissions
        
    function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    function commission(){
        
        var amount = sliderValue;
        
        var paypal = $('#paypal .card-title');
        var paytm = $('#paytm .card-title');
        var transaqt = $('#transaqt .card-title');
        
        var paypal_rates = $('#paypal .int-rate');
        var paytm_rates = $('#paytm .int-rate');
        var transaqt_rates = $('#transaqt .int-rate');
        var payee = $('.card.pricing .payee');
        var footer_mesg = $('#pricing .card-extension');
        
        
        var paypal_comm, 
            paytm_comm,
            transaqt_comm,
            comm_diff;
        
        var rate_paypal,
            rate_paytm,
            rate_transaqt;
        
         
        if(pay_method === "debit card") {
          paypal_comm = amount * commissions.debit_card.paypal / 100;
          paytm_comm = amount * commissions.debit_card.paytm / 100;
          transaqt_comm = amount * commissions.debit_card.transaqt / 100;
          comm_diff = paytm_comm - transaqt_comm;
            
          rate_paypal = commissions.debit_card.paypal;
          rate_paytm = commissions.debit_card.paytm;
          rate_transaqt = commissions.debit_card.transaqt;
          
        };
        if(pay_method === "credit card") {
          paypal_comm = amount * commissions.credit_card.paypal / 100;
          paytm_comm = amount * commissions.credit_card.paytm / 100;
          transaqt_comm = amount * commissions.credit_card.transaqt / 100;
          comm_diff = paytm_comm - transaqt_comm;
            
          rate_paypal = commissions.credit_card.paypal;
          rate_paytm = commissions.credit_card.paytm;
          rate_transaqt = commissions.credit_card.transaqt;

        };
        if(pay_method === "netbanking") {
          paypal_comm = amount * commissions.netbanking.paypal / 100;
          paytm_comm = amount * commissions.netbanking.paytm / 100;
          transaqt_comm = amount * commissions.netbanking.transaqt / 100;
          comm_diff = paytm_comm - transaqt_comm;
            
          rate_paypal = commissions.netbanking.paypal;
          rate_paytm = commissions.netbanking.paytm;
          rate_transaqt = commissions.netbanking.transaqt; 
        };
        if(pay_method === "wallets") {
          paypal_comm = amount * commissions.wallets.paypal / 100;
          paytm_comm = amount * commissions.wallets.paytm / 100;
          transaqt_comm = amount * commissions.wallets.transaqt / 100;
          comm_diff = paytm_comm - transaqt_comm;
            
          rate_paypal = commissions.wallets.paypal;
          rate_paytm = commissions.wallets.paytm;
          rate_transaqt = commissions.wallets.transaqt;
        };
        if(pay_method === "upi") {
          paypal_comm = amount * commissions.upi.paypal / 100;
          paytm_comm = amount * commissions.upi.paytm / 100;
          transaqt_comm = amount * commissions.upi.transaqt / 100;
          comm_diff = paytm_comm - transaqt_comm;
            
          rate_paypal = commissions.upi.paypal;
          rate_paytm = commissions.upi.paytm;
          rate_transaqt = commissions.upi.transaqt;
        };
        
        paypal.text("INR " + numberWithCommas(Math.floor(paypal_comm)));
        paypal_rates.text(rate_paypal + "% + GST");
            
        paytm.text("INR " + numberWithCommas(Math.floor(paytm_comm)));
        paytm_rates.text(rate_paytm + "% + GST");
            
        transaqt.text("INR " + numberWithCommas(Math.floor(transaqt_comm)));
        transaqt_rates.text(rate_transaqt + "% + GST");
        
        footer_mesg.html('You save at least <strong>INR ' + numberWithCommas(Math.round(comm_diff)) + '</strong> monthly.');    
    }
    

    
    $('#pricing .r-slider, #pricing-cards').on("mousemove mouseup touchmove", commission);
    
})(jQuery, window, document);