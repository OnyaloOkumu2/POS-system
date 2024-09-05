
  <?php require viewsPath('partials/header');?>
  <style>
    .hide{
      display:none;
    }
    @keyframes appear {
      0%{
        opacity:0;transform:translateY(-100px);
      }
      100%{opacity:1;transform:translateY(0px);}
    }
  </style>

      <div class="d-flex">
        <div style="height:550px;" class="shadow-sm col-8 p-4">
            <div class="input-group mb-3"><h3>Items</h3>
              <input onkeyup="checkForEnter(event)" type="text" class="form-control shadow-none ms-4 rounded js-search" placeholder="search" aria-label="search" aria-describedby="basic-addon1" autofocus>
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
            </div>
            <div  class="js-products d-flex" style="height:90%; overflow-y:scroll;flex-wrap:wrap;">
        
        
            </div>
        </div>
        <div class="col-4 bg-light p-4 pt-2">
          <div> <center><h3>cart <div class="js-item-count badge bg-primary" style="border-radius:50%">0</div></h3></center></div>
          <div class="table-responsive" style="height: 300px;overflow-y:scroll">
            <table class="table table-striped table-hover">
              <th>
                <tr>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
              </th>
              <tbody class="table-body js-items">
              </tbody>
            </table>
          </div>
          <div class="alert alert-danger js-gtotal" style="font-size:20px">Total: KSh. 0</div>
          <div class="">
            <button type="button"class="btn-success btn my-2 py-3 w-100 shadow-none" onclick="showModal('amountPaid')">Checkout</button><br>
            <button class="btn-primary btn my-2  w-100 cart-clear shadow-none">Clear All</button>
          </div>
        </div>
      </div>
      <!-- modal section -->
        <!-- Enter Amount Modal -->
        <div onclick="closeModal(event,'amountPaid')" role="close-btn" class="js-amount-paid-modal hide"style="background-color:#000000aa;width:100%;height:100%;position:fixed;animation:appear .5s ease;left:0px;top:0px;z-index:4;">
          <div style="width:500px;min-height:200px;background-color:white;padding:10px;margin:auto;margin-top:100px;" class="rounded js-modal">
            <h5>Checkout <button role="close-btn" onclick="closeModal(event,'amountPaid')" class="btn btn-danger float-end shadow-none p-0 px-2">X</button></h5>
            <br>
            <label class="form-label">Enter Amount Paid ksh.</label>
            <input type="text" onkeyup="if(event.keyCode==13)validateAmountPaid(event)" name="" id="" class="form-control shadow-none js-amount-paid-input" placeholder="Enter Amount Paid:">
            <br>
            <button role="close-btn" onclick="closeModal(event,'amountPaid')"class="btn btn-secondary shadow-none">Cancel</button>
            <button class="btn btn-primary float-end shadow-none" onclick="validateAmountPaid(event)">Next</button>
          </div>
        </div>
        <!-- End Enter Amount Modal -->
        <!-- change  Modal -->
        <div onclick="closeModal(event,'change')" role="close-btn" class="js-change-modal hide"style="background-color:#000000aa;width:100%;height:100%;position:fixed;animation:appear .5s ease;left:0px;top:0px;z-index:4;">
          <div style="width:500px;min-height:200px;background-color:white;padding:10px;margin:auto;margin-top:100px;" class="rounded js-modal">
            <h5>Change: <button role="close-btn" onclick="closeModal(event,'change')" class="btn btn-danger float-end shadow-none p-0 px-2">X</button></h5>
            <br>
            <div class="form-control shadow-none js-change-input text-center" style="font-size:30px">0.00</div>
            <br>
            <center>
            <button role="close-btn" onclick="closeModal(event,'change')"class="btn btn-secondary shadow-none btn-lg rounded js-btn-change">Continue</button></center>
          </div>
        </div>
        <!-- End change  Modal -->
      <!-- end of modals -->
  <script>
    let PRODUCTS=[];
    let ITEMS=[];
    let BARCODE = false;
    let GRANDTOTAL =0;
    let BALANCE =0;
    let RECEIPT_WIND = null;
    let searchBox =document.querySelector(".js-search");
    let itemCountCart = document.querySelector(".js-item-count");
    let itemDiv = document.querySelector(".js-items");
    let productsDiv = document.querySelector(".js-products");
    let gTotalDiv = document.querySelector(".js-gtotal");
    let clearAllBtn = document.querySelector(".cart-clear");
    let itemAddBtn = document.querySelector(".qty-plus");
    let itemSubBtn = document.querySelector(".qty-minus");
    function validateAmountPaid(e){
      let amount = e.currentTarget.parentNode.querySelector(".js-amount-paid-input").value.trim();
      if(amount==""){
        alert("please Enter Amount");
        document.querySelector(".js-amount-paid-input").focus();
        return;
      }
      amount =parseFloat(amount);
      if(amount<GRANDTOTAL){
        alert("amount must be higher or equal to total");
        return;
      }
      BALANCE =amount-GRANDTOTAL;
      BALANCE =BALANCE.toFixed(2);
      closeModal(true,'amountPaid');
      showModal('change');
      //remove unwanted information
      let ITEMS_NEW =[];
      for(var i=0;i < ITEMS.length;i++){
        let tmp ={};
        tmp.qty=ITEMS[i]['qty'];
        tmp.id=ITEMS[i]['id'];
        ITEMS_NEW.push(tmp);
      }
      //send cart data through ajax
      sendData({
        "dataTYpe":"checkout",
        "text":ITEMS_NEW
      });
      //show print receipt
      printReceipt({
        company:"OD YATH",
        amount:amount,
        change:BALANCE,
        data:ITEMS, 
        grandTotal:GRANDTOTAL
      });
      //clear cart
      ITEMS=[];
      itemsDisplayCountRefresh();
      //reload products
      sendData({
        "dataTYpe":"search",
        "text":""
      });
    }
    function printReceipt(obj){
      let vars=JSON.stringify(obj);
      RECEIPT_WIND = window.open("index.php?pg=print&data="+vars,"printpage","popup","width=100px");
      setTimeout(function(){
        RECEIPT_WIND.close();
      },3000);
      

    }
    function showModal(modal){
      if(modal=="amountPaid"){
        if(ITEMS.length ==0){
          alert("No item selected");
          return;
        }
        let modalDiv = document.querySelector(".js-amount-paid-modal");
        modalDiv.classList.remove("hide");
        modalDiv.querySelector(".js-amount-paid-input").value="";
        modalDiv.querySelector(".js-amount-paid-input").focus();

      }else if(modal=="change"){
        let modalDiv = document.querySelector(".js-change-modal");
        modalDiv.classList.remove("hide");
        modalDiv.querySelector(".js-change-input").innerHTML="ksh."+BALANCE;
        modalDiv.querySelector(".js-btn-change").focus();
      }
    }
    function closeModal(e,modal){
      if(e==true ||e.target.getAttribute("role")=="close-btn"){
        if(modal=="amountPaid"){
          let modalDiv = document.querySelector(".js-amount-paid-modal");
          modalDiv.classList.add("hide");
        }else if(modal=="change"){
          let modalDiv = document.querySelector(".js-change-modal");
          modalDiv.classList.add("hide");
        }
      }
    }

    function addItemFromIndex(index){
      for(let i=ITEMS.length-1;i>=0;i--){
        if(ITEMS[i].id == PRODUCTS[index].id){
          ITEMS[i].qty +=1;
          itemsDisplayCountRefresh();
          return;
          }
        }
        let temp = PRODUCTS[index];
        temp.qty =1;
        ITEMS.push(temp);
        itemsDisplayCountRefresh();
    }

    function handleResult(result){
      let obj = JSON.parse(result);
      if(typeof obj !="undefined"){
        //valid JSON object
        if(obj.dataType =="search"){
          productsDiv.innerHTML="";
          PRODUCTS = [];
          if(obj.data!=""){
            PRODUCTS = obj.data;
            for(let i = 0; i < obj.data.length; i++){
              productsDiv.innerHTML +=productHtml(obj.data[i],i);
            }
            if(BARCODE  && PRODUCTS.length==1){
              addItemFromIndex(0);
            }
          }
        }else if(obj.dataType=="checkout"){

        }
      }
    }

    function sendData(data){
      let xhr = new XMLHttpRequest();
      xhr.open("POST","index.php?pg=ajax",true);
      xhr.setRequestHeader('content-Type','application/x-www-form-urlencoded');
      xhr.onload = function(){
        if(this.status=="200"){
          if(this.responseText!=""){
            handleResult(this.responseText);
          }else{
            if(BARCODE){
              alert("that item was not found or it is out of stock");
            }
          }
        }else{
          console.log("Error sending request: Error code:-" + this.status+" Status Text ="+this.statusText );
        }
        //clear input if enter was pressed
        if(BARCODE){
          searchBox.value="";
          searchBox.focus();
        }
        BARCODE=false;
      };
      xhr.send(JSON.stringify(data));
    }
    function itemHtml(data,index){
      return `
              <!-- item -->
              <tr>
                <td style="width:80px"><img src='${data.image}' class='rounded ' style="width:75px; height:75px"></td>
                <td class="text-primary">
                  <p>${data.description}</p>
                  <div class="input-group my-3" style="max-width:130px;">
                    <span index="${index}" class="input-group-text qty-minus " onclick="changeQuantity('down',event)" style="cursor:pointer"><i class="fa fa-minus text-primary"></i></span>
                    <input index="${index}" onblur="changeQuantity('input',event)" type="text" class="form-control shadow-none text-center text-primary" placeholder="1" value="${data.qty}">
                    <span index="${index}" class="input-group-text qty-plus " onclick="changeQuantity('up',event)" style="cursor:pointer"><i class="fa fa-plus text-primary"></i></span>
                  </div>
                </td>
                <td>
                  <p class="text fw-bold">Ksh.${data.amount}</p>
                  <button onclick="clearItem(${index})" class="btn btn-sm float-end shadow-none btn-danger"><i class="fa fa-times"></i> </button>
                </td>
              </tr>
              <!-- end item -->
              `;
    }
    function productHtml(data,index){
      return `
            <!-- view -->
              <div class="card mb-4 border-0 shadow me-4 "style="min-width:250px;max-width:250px">
                <div class='img-fluid'>
                  <a href="#">
                    <img src='${data.image}' class='rounded w-100' style="height: 250px;" index="${index}">
                  </a>
                </div>
                <div class="p-1" style="font-size:20px;">
                  <p class="text-muted">${data.description}</p>
                  <p class="text fw-bold">Ksh.${data.amount}</p>
                </div>
              </div>
              <!-- end view -->
              `;
    }
    function addItems(e){
      if(e.target.tagName=="IMG"){
        let index = e.target.getAttribute("index");
        //check if item is already added
        addItemFromIndex(index); //
      }
    }
    function itemsDisplayCountRefresh(){
      itemCountCart.innerHTML = ITEMS.length;
      itemDiv.innerHTML ="";
      let grandTotal =0;
      for(let i=ITEMS.length-1; i>=0; i--){
        itemDiv.innerHTML+=itemHtml(ITEMS[i],i);
        grandTotal+=(ITEMS[i].amount*ITEMS[i].qty);
      }
      gTotalDiv.innerHTML = "Total : KSh."+ grandTotal.toFixed(2) ;
      GRANDTOTAL =grandTotal;
    }
    function clearAll(){
      if(!confirm("Are you sure you want to clear all items???!!")){
        return;
      }
      ITEMS=[];
      itemsDisplayCountRefresh();
    }
    function clearItem(index){
      if(!confirm("clear item??")){
        return;
      }
      ITEMS.splice(index, 1);
      itemsDisplayCountRefresh();
    }
    function changeQuantity(direction,e){
      let index=e.currentTarget.getAttribute("index");
      if(direction=="up"){
        ITEMS[index].qty +=1;
      }else if(direction=="down"){
        ITEMS[index].qty -=1;
      }
      else{
        ITEMS[index].qty = parseInt(e.currentTarget.value);
      }
      //make sure is not less than 1
      if(ITEMS[index].qty<1){
        ITEMS[index].qty=1;
      }
      itemsDisplayCountRefresh();
    }
    function checkForEnter(e){
      if(e.keyCode==13){
        BARCODE=true;
        searchItem(e);
      }
    }
   
    productsDiv.addEventListener("click", function(e){
      addItems(e);
    })

    clearAllBtn.addEventListener("click", function(e){
      clearAll();
    })
    
    searchBox.addEventListener("input",(e)=>{
      searchItem(e);
    });

    function searchItem(e){
      let text = e.target.value.trim();
      let data ={};
      data.dataTYpe = "search";
      data.text =text;
      sendData(data);
    }
    

    
    window.onload = function(){
      sendData({
        "dataTYpe":"search",
        "text":""
      });
    }
  </script>
  <?php require viewsPath('partials/footer');?>
