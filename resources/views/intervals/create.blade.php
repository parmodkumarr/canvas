@extends('index')
@section('content')
<style>
.operators_box{
    border: 1px solid #eee;
    padding: 2px !important;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
}
.operators_box:hover{
    border:1px solid #000;
}
[name="formula"].error{
    border:1px solid red;
}
[name="formula"].success{
    border:1px solid green;
}
#formulaErrorDesc{
    color:red;
    font-size:12px;
}
.highlight{
	background:red;
}
#formulaErrorPos{
	margin-top: 10px;
    border: 1px solid #eee;
    padding: 5px;
    border-radius: 5px;
}
</style>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <!--h2 class="no-margin-bottom">Create User Indicator -->
        </div>
    </header>
    <section class="forms"> 
        <div class="container">
            <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-12">
                    <div class="card edit_heading">

                        <h5>Create User Indicator</h5>
                        <div class="card-body">
							<!-- will be used to show any messages -->
							@if (Session::has('message'))
								<div class="alert alert-info">{{ Session::get('message') }}</div>
							@endif
							<!-- will be used to show any error from Validator -->
							@if($errors->count())
							  <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
							@endif						
                            
                            {{ Form::open(array('url' => 'intervals/create')) }}


                            <div class="form-group row">
                                    <div class="row col-md-8">
                                        <div class="col-md-6 ltitle">
                                        <label>Title</label>
                                        <div class="row">
                                             {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                        <div class="col-md-6 formula">
                                             <label>Formula</label>
                                        <div>
                                             {{ Form::text('formula', Input::old('formula'), array('class' => 'form-control')) }}
                                            
                                        </div>
                                        </div>  
                                        <div class="Formula_values_display">
                                        <div id="formulaErrorPos" class="col-md-12"></div>
                                            <span id="formulaErrorDesc"></span>
                                          </div>  

                                </div>

                                   <div class="col-md-4">
                                        <label class="operator">Operators</label>
                                        <div class=" row col-md-12 blue_box">
                                            <div class="operators_box operators">+</div>
                                            <div class="operators_box operators">-</div>
                                            <div class="operators_box operators">*</div>
                                            <div class="operators_box operators">/</div>
                                            <div class="operators_box operators">(</div>
                                            <div class=" operators_box operators">)</div>
                                        </div>
                                    </div>
                                 
                                </div>

                                  
                                </div>
                                  <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="columns_bottom">
                                            <label>Asset</label>
                                            <div class="col_pad">
                                                <div id="asset_box" style="height:300px;overflow:auto">
                                                </div>
                                            </div>
                                        </div>
                                      
                                       
                                        
                                        <div class="columns_bottom">
                                        <label>Indicators</label>
                                            <div class="col_pad">
                                                <div id="indicator_box" style="height:300px;overflow:auto">
                                                </div>
                                            </div>
                                        </div>


                                    <div class="columns_bottom">
                                        <label>User Indicators</label>
                                            <div class="col_pad">
                                                <div id="userIndicator_box" style="height:300px;overflow:auto">
                                                </div>
                                            </div>

                                    </div>

                                     <div class="columns_bottom">
                                        <label>User Algos</label>
                                        <div class="col_pad">
                                            <div id="userAlgo_box" style="height:300px;overflow:auto">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="columns_bottom">
                                         <label>Asset Properties</label>
                                        <div class="col_pad">
                                            <div class=" col-md-6 operators_box asset_property">value</div>
                                            <div class=" col-md-6 operators_box asset_property">max</div>
                                            <div class=" col-md-6 operators_box asset_property">min</div>
                                            <div class=" col-md-6 operators_box asset_property">open</div>
                                            <div class=" col-md-6 operators_box asset_property">close</div>
                                        </div>
                                        </div>
                                    
                                    </div>
                                  
                                </div>
                                </br>
                                </br>
                                <div class="form-group col-md-12" style="text-align:center;">
                                    <a class="btn btn-default back" href="{{  URL::to('intervals') }}">Back</a>
                                    {{ Form::submit('Create the Interval!', array('class' => 'save btn btn-primary submit_button')) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script> 
<script type="text/javascript">
    function getAssetBoxData(type = 'asset' ){
        var series_no = 1;
        var url = 'ws://embeddedSoft.eu:7778';
        var socket = new WebSocket(url);
        var socket_data = ('{ "userId":77777, "msgId":1234567890101112, "cmd":"get", "arg":"list", "type":"'+type+'" }\r\n');        
        socket.onopen = function() {
            socket.send(socket_data);            
        };
                 
        socket.onmessage = function(event) {
            var result = event.data;
            
            var pars   = JSON.parse(result);
            switch(type){
                case 'asset':
                    var data   = pars.instrument;
                    break;
                case 'indicator':
                    var data   = pars.indicator;
                    break;
                case 'userIndicator':
                    var data   = pars.userIndicator;
                    break;
                case 'userAlgo':
                    var data   = pars.userAlgo;
                    break;    
            }
            
            var leng   = data.length;
            var options = '';
            var selected = '';
            
            if(leng > 0){
                for(var i=0; i <= leng -1; i++){   
                    if( ! data[i].formula ){
                        data[i].formula = '';
                    }                 
                    options += '<div class=" col-md-12 operators_box asset_name '+type+' " formula="'+data[i].formula+'" value="'+data[i].id+'" >'+data[i].name+'</div>';
                }
            }            
            $("#"+type+"_box").html(options);
            
        };
    }

    getAssetBoxData('asset');
    getAssetBoxData('indicator');
    getAssetBoxData('userIndicator');
    getAssetBoxData('userAlgo');

    function formulaValidation( textValue ){
        var url = 'ws://embeddedSoft.eu:7778';
        var socket = new WebSocket(url);
        var socket_data = ('{ "userId":1, "msgId":1234567890101112,"cmd":"verify", "arg":"formula", "formula":"'+ textValue+'" }\r\n');        
        socket.onopen = function() {
            socket.send(socket_data); 
            console.log(socket_data);           
        };
                 
        socket.onmessage = function(event) {
            var result = event.data;               
            var pars   = JSON.parse(result);                
            console.log(pars);  
            if( pars.status == 'fail'){
                $('[name="formula"]').addClass('error').removeClass('success');
                $('#formulaErrorDesc').html( pars.descr + ' at position ' + pars.pos);
                $('#formulaErrorPos').html( textValue.substr(0, pars.pos) + '<span class="highlight">' + textValue.substr(pars.pos,1) + '</span>' + textValue.substr(pars.pos +1) );
            }   
            else{
                $('#formulaErrorDesc').html( '' );
                $('[name="formula"]').addClass('success').removeClass('error');
                $('#formulaErrorPos').html( textValue );
            }           
        };
    }

    $(document).ready(function(){
        $.fn.extend({
            insertAtCaret: function(myValue) {
                this.each(function() {
                    if (document.selection) {
                        this.focus();
                        var sel = document.selection.createRange();
                        sel.text = myValue;
                        this.focus();
                    } else if (this.selectionStart || this.selectionStart == '0') {
                        var startPos = this.selectionStart;
                        var endPos = this.selectionEnd;
                        var scrollTop = this.scrollTop;
                        this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos,this.value.length);
                        this.focus();
                        this.selectionStart = startPos + myValue.length;
                        this.selectionEnd = startPos + myValue.length;
                        this.scrollTop = scrollTop;
                    } else {
                        this.value += myValue;
                        this.focus();
                    }
                });
                this.trigger('change');
                return this;
            }
        });

        $(document).on('click','.operators_box.asset, .operators_box.indicator, .operators_box.operators',function(){
            $('[name="formula"]').insertAtCaret($(this).html());
        });
        $(document).on('click','.operators_box.userIndicator, .operators_box.userAlgo',function(){
            //$('[name="formula"]').insertAtCaret($(this).attr('formula'));
            $('[name="formula"]').insertAtCaret($(this).html());
        });

        $('[name="formula"]').change(function(){            
            formulaValidation( $(this).val() );
        });
        $('[name="formula"]').keyup(function(){            
            formulaValidation( $(this).val() );
        });


    });
</script>
@endsection
