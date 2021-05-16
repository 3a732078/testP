
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



{{--<button onclick="showModal()">繼續選擇圖片</button>--}}

{{--<input type="file" value="上傳檔案" name="xa" id="xa" accept="image/png, image/jpeg, image/gif, image/jpg" multiple/>--}}

{{--//測試抓取上傳檔案的數量--}}
{{--<input type="file" name="Upload_File[]" id="Upload_File" multiple="multiple">--}}
{{--<script>--}}
{{--    document.getElementById('Upload_File').onchange = function() {--}}
{{--    const length=document.getElementById("Upload_File").files.length;--}}
{{--    console.log("你上傳的檔案數量為："+length);--}}
{{--    }--}}
{{--    </script>--}}


{{--//自動載入modal↓--}}
<form style="margin:0" id="uplop" name="uplop" method="POST" action="/osimage" enctype="multipart/form-data">
    @csrf
    @method('POST')
<div class="modal" tabindex="-1" role="dialog" id="uploadimg">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">選擇照片</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>已選擇的檔案：</p>
                <div class="pic">
                    <div class="uploadImage">
                        <input type="file" value="上傳檔案" name="upphoto[]" id="osphoto" accept="image/png, image/jpeg, image/gif, image/jpg" multiple/>
                        <div id="after"><p> </p></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="clearupload()" class="btn btn-danger">清空</button>
                <button type="button" id="closemo" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="submit" class="btn btn-primary" >確定載入</button>
            </div>
        </div>
    </div>
</div>
</form>
{{--//載入時打開--}}
<script>
    window.onload=function (){
        $('#uploadimg').modal('show');
    }
</script>

{{--//點擊按鈕打開--}}
{{--<script type="text/javascript">--}}
{{--    function showModal() {--}}
{{--        $('#uploadimg').modal('show');--}}
{{--    }--}}
{{--</script>--}}

<script>

    // document.getElementById('xa').onchange = function() {
    // const a=document.getElementById("xa");
    // console.log(a.value);
    // }


let uploadarray=[];

    document.getElementById('osphoto').onchange = function() {

            var photo = this;
                if(photo.files.length >= 0) {
                    for (var i = 0; i < photo.files.length; i++) {
                        let ima = document.createElement('img');
                        ima.width = 200;
                        ima.height = 200;
                        ima.src = window.URL.createObjectURL(photo.files[i]);
                        document.body.appendChild(ima);
                        let afimg = document.getElementById("after");
                        afimg.insertBefore(ima, afimg.firstElementChild);
                        console.log("這個圖片："+photo.files[i].name);
                        uploadarray.push(photo.files[i].name);
                        console.log("陣列："+uploadarray);
                        console.log(photo.files)
                        console.log(photo.files[i].value)
                    }
                    console.log("value是"+document.getElementById("osphoto").value)
                }
    }
    function clearupload(){
        uploadarray=[];
        console.log("陣列："+uploadarray);
        document.getElementById("after").innerHTML="&nbsp";
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
{{--<script>--}}
{{--    function autose() {--}}
{{--        $("#image").ajaxSubmit(function () {--}}
{{--        });--}}
{{--        document.getElementById("closemo").click();--}}
{{--    }--}}
{{--</script>--}}

