             <?php /* |||  ||| */ $EmAvaliacao = 100;
              $EmProducao = 100000;
              $EmExpesicao = 15;
              $Entregue = 10000;
              ?>
             <!-- Div da Direita (Cadastro de Acabamentos) -->
             <div class="row">
               <div style="text-align: center" class="col-md-6 col-xl-3">
                 <div class="card bg-primary text-white mb-3">
                   <div class="card-header"><i style="font-size: 3em;" class='bx bx-printer bx-flip-vertical bx-tada'></i></div>
                   <div class="card-body">
                     <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $EmProducao ?>" class="purecounter" class="purecounter">0</span></h5>
                     <p class="card-text">Em Produção</p>
                   </div>
                 </div>
               </div>

               <div style="text-align: center" class="col-md-6 col-xl-3">
                 <div class="card bg-secondary text-white mb-3">
                   <div class="card-header"><i style="font-size: 3em;" class='bx bx-package bx-tada'></i></div>
                   <div class="card-body">
                     <h5 class="card-title text-white"> <span data-purecounter-start="0" data-purecounter-end="<?= $EmExpesicao ?>" class="purecounter" class="purecounter">0</span></h5>
                     <p class="card-text">Enviado para Expedição</p>
                   </div>
                 </div>
               </div>
               <div style="text-align: center" class="col-md-6 col-xl-3">
                 <div class="card bg-success text-white mb-3">
                   <div class="card-header"><i style="font-size: 3em;" class='bx bx-paper-plane bx-tada'></i></div>
                   <div class="card-body">
                     <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $Entregue ?>" class="purecounter" class="purecounter">0</span></h5>
                     <p class="card-text">Entregues</p>
                   </div>
                 </div>
               </div>
               <div style="text-align: center" class="col-md-6 col-xl-3">
                 <div class="card bg-danger text-white mb-3">
                   <div class="card-header"><i style="font-size: 3em;" class='bx bx-error bx-tada'></i></div>
                   <div class="card-body">
                     <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $EmProducao ?>"  class="purecounter" class="purecounter">0</span></h5>
                     <p class="card-text">Atrasadas</p>
                   </div>
                 </div>
               </div>

               <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
               <script>
                 new PureCounter();
               </script>
               <script>
                 // import PureCounter from "@srexi/purecounterjs";
                 const pure = new PureCounter();

                 new PureCounter();

                 // Or you can customize it for override the default config.
                 // Here is the default configuration for all element with class 'filesizecount'
                 new PureCounter({
                   // Setting that can't' be overriden on pre-element
                   selector: ".purecounter", // HTML query selector for spesific element

                   // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
                   start: 0, // Starting number [uint]
                   end: 100, // End number [uint]
                   duration: 2, // The time in seconds for the animation to complete [seconds]
                   delay: 10, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
                   once: true, // Counting at once or recount when the element in view [boolean]
                   pulse: false, // Repeat count for certain time [boolean:false|seconds]
                   decimals: 0, // How many decimal places to show. [uint]
                   legacy: true, // If this is true it will use the scroll event listener on browsers
                   filesizing: false, // This will enable/disable File Size format [boolean]
                   currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
                   formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
                   separator: false, // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
                 });
               </script>