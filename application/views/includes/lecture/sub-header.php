<div class="subheader"  ng-controller="CanvasControls">
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarText">
            <!-- left-side -->
            <div class="left-side align-items-center mr-auto">
                <ul class="list-inline d-flex tabdiv mb-0">
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" id="editArtBoardBtn"><i class="icomoon-edit"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" id="editorBtn" onclick="setEditorHeight()"><i class="icomoon-test"></i></a>
                    </li>
                </ul>

                <!-- xxxxx -->
                <div id="commands" ng-click="maybeLoadShape($event)" class="disabled">
                <ul class="navbar-nav align-items-center menu1" id="canvasTool">
                    <li class="nav-item">
                        <a class="nav-link send-icon" href="javascript:void(0);" id="draw_select" onclick="selectObject(this.id)" title="Cursor"><i class="icomoon-Path-259"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link eraser-icon" href="javascript:void(0);" id="draw_erase" onclick="eraseCanvas(this.id)"  title="Eraser"><i class="icomoon-double-sided-eraser"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link draw-icon"  href="javascript:void(0);" id="draw_pencil" onclick="addPencil(this.id)" title="Brush"><i class="icomoon-pencil"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-icon" href="javascript:void(0);" id="draw_text" onclick="addText(this.id)" title="Add Text"><i class="icomoon-type"></i></a>
                    </li>
                    <li class="nav-item dropdown art-dropdown" id="shapes" title="Shapes">
                        <a href="javascript:void(0);" class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="showShape" src="<?= base_url('assets/lecture/images/circle-icon.svg') ?>" alt="circle-icon">
                        </a>
                        <div id="dropdownMenuanchor" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <a class="dropdown-item" href="javascript:void(0);" id="draw_circle" onclick="addCricle(this.id)">
                                <img id="draw_circle-icon" src="<?= base_url('assets/lecture/images/circle-icon.svg') ?>" alt="circle-icon">
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);" id="draw_rectangle" onclick="addRectangle(this.id)">
                                <img id="draw_rectangle-icon" src="<?= base_url('assets/lecture/images/rectangle-icon.svg') ?>" alt="rectangle-icon">
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);" id="draw_triangle" onclick="addtriangle(this.id)">
                                <img id="draw_triangle-icon"  src="<?= base_url('assets/lecture/images/trangle-icon.svg') ?>" alt="circle-icon">
                            </a>
                            <a class="dropdown-item pb-1" href="javascript:void(0);" id="draw_line" onclick="addLine(this.id)">
                                <img id="draw_line-icon" src="<?= base_url('assets/lecture/images/line-icon.svg') ?>" alt="circle-icon">
                            </a>
                        </div>
                    </li>
                    
                  <!--   <li class="nav-item" title="Color">
                       <input type="color" value="#000000" id="drawing-color"/>
                    </li> -->

                        
                    <li class="nav-item dropdown color-dropdown" id="colors" title="color">
                        <a href="javascript:void(0);" class="dropdown-toggle" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="color-box black"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu3">
                            <div class="colors-row d-flex justify-content-between">
                                <div class="color-code black" title="Black" data-color="#000" data-classname="black"></div>
                                <div class="color-code red" title="Red" data-color="#FF0000" data-classname="red"></div>
                                <div class="color-code blue" title="Blue" data-color="#0000FF" data-classname="blue"></div>
                                
                            </div>

                            <div class="colors-row d-flex justify-content-between">
                                <div class="color-code green" title="Green" data-color="#008000" data-classname="green"></div>
                                <div class="color-code yellow" title="Yellow" data-color="#FFFF00" data-classname="yellow"></div>
                                <div class="color-code pink" title="Pink" data-color="#FFC0CB" data-classname="pink"></div>
                                
                            </div>

                            <div class="colors-row d-flex justify-content-between">
                                <div class="color-code purple" title="Purple" data-color="#800080" data-classname="purple"></div>
                                <div class="color-code orange" title="Orange" data-color="#FFA500" data-classname="orange"></div>
                                <div class="color-code brown" title="Brown" data-color="#A52A2A" data-classname="brown"></div>
                            </div>
                            <input type="hidden" value="#000" id="drawing-color"/>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link photos-icon" href="javascript:void(0);" title="Image">
                            <label>
                                <input type="file" id="addPicture" accept="image/*"  style="opacity:0;" value="">
                                <i class="icomoon-picture"></i>
                            </label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link undo-icon" href="javascript:void(0);" title="Undo" id="undo" onclick="undo(this.id)"><i class="icomoon-undo2"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link undo-icon" href="javascript:void(0);" title="Redo" id="redo" onclick="redo(this.id)"><i class="icomoon-redo2"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link delete-icon" href="javascript:void(0);" title="" id=""  onclick="confirmationModal02()"><i class="icomoon-bin2"></i></a>
                    </li>
                 </ul>
                
                </div>
            </div>
            <!-- rigth-side -->
            <ul class="navbar-nav align-items-center right-side">
                <li class="nav-item">
                    <a class="nav-link btn-link chat-btn" href="javascript:void(0);">
                        Video & Chat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-link fullboard-btn " href="javascript:void(0);">
                        Full Board
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn-link video-btn active" href="javascript:void(0);" onclick="videoSession()">
                        Full Video
                    </a>
                </li>
                <li class="nav-item border_left mr-0">
                    <select class="selectpicker" id="whiteboards" onchange="changeWhiteboard(this.value,0)">
                        <option value="1" selected>Whiteboard 01</option>
                        <option value="2">Whiteboard 02</option>
                        <option value="3">Whiteboard 03</option>
                        <option value="4">Whiteboard 04</option>
                        <option value="5">Whiteboard 05</option>
                    </select>
                </li>
                <li class="nav-item border_left">
                    <a class="nav-link icon" href="javascript:void(0);"  id="downloadCanvas">
                        <i class="icomoon-download"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>