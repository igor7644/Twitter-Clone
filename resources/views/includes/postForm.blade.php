<div class="row main-insert">
    <div class="col-md-7 mr-auto main-insert-blue">
        <form action="{{ route('createPost') }}" method="POST">
            @csrf
            <div class="form-group blue-border-focus">
                <textarea class="form-control textarea-insert" id="textarea-insert" name="postText" onkeyup="countChar(this)" onfocus="expand()" cols="40" rows="1" placeholder="What's happening?" maxlength="250"></textarea>
            </div>
            <div class="hiddenContent row" id="hiddenContent">
                <p class="col-md-9"><span class="char-num">250</span><span class="char-text"> characters remaining</span></p>
                <button type="submit" class="btn postBtn col-md-3" id="postBtn">Post</button>
            </div>
        </form>
    </div>
    <div class="col-md-4 sidebar">
        <h3>Who to Follow</h3>
    </div>
</div>