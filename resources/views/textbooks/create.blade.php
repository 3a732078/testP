<div style="width:100%;text-align:center">
    <form id="upload" name="upload" action="/textbooks" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div>
            <label for="title">標題</label><br><br>
            <input id="title" name="title" placeholder="請輸入檔案名稱">
        </div>
        <div>
            <label for="subject">科目</label><br><br>
            <select id="subject" name="subject">
                <option value="" >請選擇科目</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="toimage">選擇檔案</label><br><br>
            <input type="file" id="toimage" name="toimage">
        </div>
        <button onclick="check()" class="submit" type="submit" class="btn-sm btn-primary">新增</button>
    </form>
</div>
<style>
    body{
        background-color: #8B939C;
    }
    input{
        padding:5px 15px; background:#ccc; border: 1px solid #ccc;
        cursor:pointer;
        -webkit-border-radius: 5px;
        border-radius: 5px; }
    select{
        padding:5px 15px; background:#ccc; border:0 none;
        cursor:pointer;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }
    button{
        padding:5px 15px; background:#ccc; border:0 none;
        cursor:pointer;
        -webkit-border-radius: 5px;
        border-radius: 5px; }
    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
    .submit {
        font-family: Hack, monospace;
        color: #ffffff;
        cursor: pointer;
        border: 0;
        transition: all 0.5s;
        border-radius: 10px;
        width: auto;
        position: relative;
    }
    .submit::after {
        content: "→";
        font-weight: 400;
        position: absolute;
        left: 85%;
        top: 31%;
        right: 5%;
        bottom: 0;
        opacity: 0;
    }

    .submit:hover {
        background: #2b2bff;
        transition: all 0.5s;
        border-radius: 10px;
        box-shadow: 0px 6px 15px #0000ff61;
    }
    .submit::after {
        opacity: 1;
        transition: all 0.5s;
    }
</style>

<script>
    function check(){
        if(document.upload.title.value===""){
            alert('請輸入檔案名稱')
        }
        if(document.upload.subject.value===""){
            alert('請選擇科目')
        }
        if(document.upload.toimage.value===""){
            alert('請選擇檔案')
        }
    }
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
