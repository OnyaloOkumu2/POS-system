   <div class="card  shadow mb-4 ">
         <div class="card-body">
            <div class="row">
            <div class="row mb-4"> 
               <div class="col-md-12 mb-4">
               <div class="d-flex align-items-center justify-content-between mb-3">
                  <h5 class="card-title m-0  fw-bold header-font bg-light rounded" style="color:blue; border-left:4px solid blue; padding:10px;width:100%;border-bottom:1px solid blue;"><i class="fa-sharp fa-solid fa-money-bill-trend-up me-2"></i>Update Stock</h5>
               </div>
               <div class="text-end mb-4">
               <input type="text" class="form-control  shadow-none w-25 ms-auto stock-search" placeholder="Type to search">
               </div>
               <div class="table-responsive shadow-none rounded">
               <table class="table table-hover border text-start p-1 " style="overflow-y:scroll;">
               <thead>
                  <tr class="bg-dark text-light header-font">
                     <th scope="col" class="header-font">#</th>
                     <th scope="col" class="header-font">image</th>
                     <th scope="col" class="header-font">product</th>
                     <th scope="col" class="header-font">Current stock</th>
                     <th scope="col" class="header-font">Buying Price</th>
                     <th scope="col" class="header-font">Selling Price</th>
                     <th scope="col" class="header-font">actions</th>
                  </tr>
               </thead>
               <tbody class="text-start bg-light products-data" >
               </tbody>
               </table>
            </div>
               </div>
            </div>
            </div>
         </div>
         </div> 
         <script>
            function sendRequest(val){
               let data ={};
               data.dataTYpe="getStock";
               data.text =val;
               let xhr = new XMLHttpRequest();
               xhr.open("POST","index.php?pg=ajax",true);
               xhr.onload = function (){
                  let MyStockDiv = document.querySelector('.products-data');
                  MyStockDiv.innerHTML = this.responseText;
               }
               xhr.send(JSON.stringify(data));
            }
            let searchBox = document.querySelector(".stock-search");
            searchBox.addEventListener("input", (e)=>{
               sendRequest(e.target.value);
            });
            window.onload = function (){
               
                  sendRequest("");
            }
         </script>  