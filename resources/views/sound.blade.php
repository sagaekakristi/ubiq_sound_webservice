<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {display:none;}

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
    </style>
  </head>
  <body>
    <h1 style="text-align: center;">Sound System</h1>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker1</h4>
            <p class="card-text">Volume: <?php echo $volume[0];?> | Status : <?php echo $mute[0];?><br>
            Bass: <?php echo $bass[0];?> | Treble: <?php echo $treble[0];?> | Echo: <?php echo $echo[0];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm1">Configure</button>
            <div class="modal fade bd-example-modal-sm1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker1</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=1>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker2</h4>
            <p class="card-text">Volume: <?php echo $volume[1];?><?php if($mute[1] == "Mute"){echo '<div style="color:red">';}else{echo '<div style="color:green">';} echo $mute[1].'</div>';?><br>
            Bass: <?php echo $bass[1];?> | Treble: <?php echo $treble[1];?> | Echo: <?php echo $echo[1];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm2">Configure</button>
            <div class="modal fade bd-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker2</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=2>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker3</h4>
            <p class="card-text">Volume: <?php echo $volume[2];?> | Status: <?php echo $mute[2];?><br>
            Bass: <?php echo $bass[2];?> | Treble: <?php echo $treble[2];?> | Echo: <?php echo $echo[2];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm3">Configure</button>
            <div class="modal fade bd-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker3</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=3>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker4</h4>
            <p class="card-text">Volume: <?php echo $volume[3];?> | Status: <?php echo $mute[3];?><br>
            Bass: <?php echo $bass[3];?> | Treble: <?php echo $treble[3];?> | Echo: <?php echo $echo[3];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm4">Configure</button>
            <div class="modal fade bd-example-modal-sm4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker4</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=4>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
        </div>
        <div class="col-md-2 offset-md-2">
          <div class="card card-block text-xs-center">
            <h4>Microphone</h4>
            <p>Status:</p>
            <!-- Rounded switch -->
            <label class="switch">
              <input type="checkbox" onchange="microphone(this)" <?php if($checked == 1) {echo "checked";}?>> 
              <div class="slider round"></div>
            </label></p>
          </div>
        </div>
        <div class="col-md-3 offset-md-2">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker5</h4>
            <p class="card-text">Volume: <?php echo $volume[4];?> | Status: <?php echo $mute[4];?><br>
            Bass: <?php echo $bass[4];?> | Treble: <?php echo $treble[4];?> | Echo: <?php echo $echo[4];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm5">Configure</button>
            <div class="modal fade bd-example-modal-sm5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker5</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=5>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 offset-md-3">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker6</h4>
            <p class="card-text">Volume: <?php echo $volume[5];?> | Status: <?php echo $mute[5];?><br>
            Bass: <?php echo $bass[5];?> | Treble: <?php echo $treble[5];?> | Echo: <?php echo $echo[5];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm6">Configure</button>
            <div class="modal fade bd-example-modal-sm6" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker6</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=6>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
        </div>
        <div class="col-md-3">
          <div class="card card-block text-xs-center">
            <h4 class="card-title">Speaker7</h4>
            <p class="card-text">Volume: <?php echo $volume[6];?> | Status: <?php echo $mute[6];?><br>
            Bass: <?php echo $bass[6];?> | Treble: <?php echo $treble[6];?> | Echo: <?php echo $echo[6];?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm7">Configure</button>
            <div class="modal fade bd-example-modal-sm7" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Speaker7</h4>
                  </div>
                  <form method="post" action="/configureUI">
                    <input type="hidden" name="speaker" value=7>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Set to</label>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Volume</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="volume" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Status</label>
                          <div class="col-xs-10">
                            <select class="form-control" name="mute" id="exampleSelect1">
                              <option>Mute</option>
                              <option>Unmute</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Bass</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="bass" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Treble</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="treble" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="example-number-input" class="col-xs-2 col-form-label">Echo</label>
                          <div class="col-xs-10">
                            <input class="form-control" name="echo" type="number" value="" min="1" max="100" id="example-number-input">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    <script>
    function microphone(element) {
      if(element.checked) {
        window.location = "/microphoneUI?scale=0.5&checked=1";
      }
      else {
        window.location = "/microphoneUI?scale=1&checked=0";
      }
    }
    </script>
  </body>
</html>
