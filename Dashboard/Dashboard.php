    <nav class="bg-gray-800 ">
        <div class="max-w-7xl mx-auto lg:px-8">
          <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 flex items-center md:hidden">
              <!-- Mobile menu button-->
              <button
              id="boton"  
              type="button" onclick="mostrar();" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <?php 
                require_once("../controlador/login.php");
                entrar();
                ?>    
                <!--
                  Icon when menu is closed.
      
                  Heroicon name: outline/menu
      
                  Menu open: "hidden", Menu closed: "block"
                -->
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <!--
                  Icon when menu is open.
      
                  Heroicon name: outline/x
      
                  Menu open: "block", Menu closed: "hidden"
                -->
                <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
              <div class="hidden lg:hidden" id="mobile-menu">
                 <div class="bg-gray-800 px-20 text-center pt-4 pb-3 lg:hidden md:hidden">
                            <?php
                          switch($_SESSION['rol']){
                            case 'a':
                            ?>
                      <div class="mt-60"> 
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="../Dashboard/profile.php" class="sm:mb-10 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium" aria-current="page">Inicio</a><br>

                        <a href="../users_profile/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md mt-10 text-xl text-sm font-medium" aria-current="page">Usuarios</a><br>
                      
                        <a href="../rubric/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Rubrica</a><br>

                        <a href="../students/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Estudiantes</a><br>
            
                        <a href="../academico/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Acádemico</a><br>
            
                        <a href="../Projects/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Proyectos</a><br>

                        <a href="../calificar/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Cálificar</a><br>

                        <a href="../ranking/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Ranking</a><br>

                        <a href="../parameters/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md  text-xl text-sm font-medium">Parametros</a>
                      </div>
                          <?php
                          break;
                          ?>
                          <?php
                          case 'c':
                            
                          ?>
                      <div class="mt-40">
                        <a href="../Dashboard/profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium" aria-current="page">Inicio</a><br>

                        <a href="../rubric/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium">Rubrica</a><br>

                        <a href="../users_profile/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium" aria-current="page">Usuarios</a><br>

                        <a href="../students/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium">Estudiantes</a><br>

                        <a href="../ranking/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium">Ranking</a><br>

                        <a href="../academico/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium">Acádemico</a><br>

                        <a href="../Projects/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium">Proyectos</a><br>
                      </div>
                        <?php
                          break;
                          ?>
                          <?php
                          case 'j':

                          ?>
                      
                        <a href="../Dashboard/profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium" aria-current="page">Inicio</a><br>

                        <a href="../calificar/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl text-sm font-medium">Cálificar</a><br>
                    
                        
                        <?php
                        break;
                        ?>
                        <?php
                        }
                        ?>
                    
                  </div>
                </div>
            <div id="menu" class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
              <div class="hidden md:block sm:ml-6">
                <div class="flex space-x-4">
                  <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                  <?php
                  switch($_SESSION['rol']){
                    case 'a':
                  ?>
                  <a href="../Dashboard/profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Inicio</a>

                  <a href="../users_profile/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Usuarios</a>
                 
                  <a href="../rubric/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Rubrica</a>

                  <a href="../students/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Estudiantes</a>
      
                  <a href="../academico/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Acádemico</a>
      
                  <a href="../Projects/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Proyectos</a>

                  <a href="../calificar/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Cálificar</a>

                  <a href="../ranking/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Ranking</a>

                  <a href="../parameters/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Parametros</a>
                  <?php
                  break;
                  ?>
                  <?php
                  case 'c':

                  ?>
                  <a href="../Dashboard/profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Inicio</a>

                  <a href="../rubric/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Rubrica</a>

                  <a href="../users_profile/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Usuarios</a>

                  <a href="../students/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Estudiantes</a>
      
                  <a href="../ranking/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Ranking</a>

                  <a href="../academico/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Acádemico</a>

                  <a href="../Projects/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Proyectos</a>
                  <?php
                  break;
                  ?>
                  <?php
                  case 'i':

                  ?>
                  <a href="../Dashboard/profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Inicio</a>
      
                  <a href="../ranking/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Ranking</a>

                  <a href="../Projects/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Proyectos</a>
                  <?php
                  break;
                  ?>
                  <?php
                  case 'j':

                  ?>
                  <a href="../Dashboard/profile.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Inicio</a>

                  <a href="../calificar/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Cálificar</a>
                  <?php
                  break;
                  ?>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm: sm:pr-0">
              <!-- Profile dropdown -->
              <div class="ml-3 relative">
                <div>
                  <button type="button" onclick="mostrarpremio();" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full" src="../recursos/perfil.jpg" alt="">
                  </button>
                </div>
      
                <!--
                  Dropdown menu, show/hide based on menu state.
      
                  Entering: "transition ease-out duration-100"
                    From: "transform opacity-0 scale-95"
                    To: "transform opacity-100 scale-100"
                  Leaving: "transition ease-in duration-75"
                    From: "transform opacity-100 scale-100"
                    To: "transform opacity-0 scale-95"
                -->
                <div id="premio" class="hidden hover:block origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <!-- Active: "bg-gray-100", Not Active: "" -->
                  <a href="../profile/editPersonalData.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Editar perfil</a>
                  <a class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" href="../controlador/logout.php" id="user-menu-item-1">Salir</a>

                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
      </nav>
