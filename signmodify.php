<!DOCTYPE html>
<html>
    <title>회원정보 수정</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <link href="bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" href="D.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="signup.js"></script>
   
    <!-- 폼 시작 -->
    <body>
        <?php
        # 로그인한 사용자의 user 테이블 레코드 가져오기 : select ... where 절에 email, passwd
        # 컬럼값을 각 입력필드에 표시하기 : value 속성에 표시. value = <?=$row['email] ?)
        session_start();
        include_once('dbconn.php');
        $userid = $_SESSION['userid'];
        $sql = "select * from user where userid = '$userid'";
        $result = $conn->query($sql);
        if(isset($result) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <p class="navbar-brand" style="font-size: 150%;">Dmaket</p>
        </nav>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-30">
                <div class="card">
                <div class="card-header font-weight-bold">회원정보 수정</div>
                <div class="card-body">
                <form action="signmodproc.php" method="POST">
                    <!-- 아이디 -->
                    <div class="form-group col-30">
                        <label for="userid" class="font-weight-bold">아이디</label>
                        <div class="form-row">
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><span class="fas fa-user"></span></span>
                                
                                <input type="text" class="form-control ime-mode" placeholder="아이디" name="userid" id="userid" value="<?=$row['userid']?>" readonly
                                    pattern=".*(?=.{5,15})(?=.*[0-9a-zA-Z]).*" maxlength="15" required>
                            </div>
                        </div>
                        <small class="form-text text-muted">필수 입력 항목입니다. 5~15자로 입력해주세요.(영문 소문자, 숫자만 사용 가능)</small>
                    
                    </div>
                    <!-- 패스워드 -->
                    <label for="pwd" class="font-weight-bold">패스워드</label>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><span class="fas fa-lock"></span></span>
                                </div>
                                <input type="password" class="form-control pwbox" placeholder="패스워드" name="pwd" id="pwd1" maxlength="20" value="<?=$row['pwd']?>" required>
                            
                            </div>
                        </div>
                        <small class="form-text text-muted">필수 입력 항목입니다. 6~20자로 입력해주세요.(영문, 숫자 조합 필수, 특수문자 사용 가능)</small>
                        
                    </div>
                    <div class="form-row">
                        <!-- 이름 -->
                        <div class="form-group col">
                            <label for="name" class="font-weight-bold">이름</label>
                            <input type="text" class="form-control" placeholder="홍길동" name="name" id="name" required value="<?=$row['name']?>">
                            <small class="form-text text-muted">필수 입력 항목입니다.</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <!-- 이메일 -->
                        <div class="form-group col">
                            <label for="email" class="font-weight-bold">이메일</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="username@example.com" value="<?=$row['email']?>"
                                required>
                            <small class="form-text text-muted">필수 입력 항목입니다.</small>
                            <small class="form-text text-muted">비밀번호 찾기 시 이용되오니 정확히 입력해주세요.</small>
                        </div>
                        <!-- 전화번호 -->
                        <div class="form-group col">
                            <label for="phone" class="font-weight-bold">전화번호</label>
                            <input type="tel" onkeyup="inputTelNumber(this)" class="form-control"
                                pattern="[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}" maxlength="13" placeholder="010-1234-5678" name="phone" value="<?=$row['phone']?>"
                                id="phone">
                        </div>
                    </div>
                    <!-- 주소 -->
                    <div class="form-group">
                        <label for="" class="font-weight-bold">주소</label>
                        <div class="form-inline">
                            <input type="text" class="form-control" id="postcode" name="ADDRESS_ZIPCODE" placeholder="우편번호" value="<?=$row['ADDRESS_ZIPCODE']?>"
                                readonly>
                            <input type="button" class="btn btn-outline-primary ml-2" onclick="execDaumPostcode()"
                                value="우편번호 찾기"><br>
                        </div>
                        <input type="text" class="form-control my-1" id="roadAddress" name="ADDRESS_ROAD" placeholder="도로명주소" value="<?=$row['ADDRESS_ROAD']?>"
                            readonly>
                        <!-- <input type="text" class="form-control my-1" id="jibunAddress" name="ADDRESS_LAND" placeholder="지번주소"
                            readonly>
                        <span id="guide" class="form-control my-1" style="color:#999;display:none"></span> -->
                        <input type="text" class="form-control my-1" id="detailAddress" name="ADDRESS_DETAIL" placeholder="상세주소" value="<?=$row['ADDRESS_DETAIL']?>">
                        <input type="text" class="form-control mt-1" id="extraAddress" name="ADDRESS_SUBDETAIL" placeholder="참고항목" value="<?=$row['ADDRESS_SUBDETAIL']?>"
                            readonly>
                    </div>
                    <!-- 변경버튼 -->
                    <button type="submit" class="col-12 btn btn-primary" id="submit">
                        <span class="fas fa-check"></span>
                        변경
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <?php } // <?php} 안됨. 붙여쓰면 안되고, 띄어써야 함.
            else{
                session_destroy();
                echo "<script>alert('로그인한 사용자의 데이터를 읽을 수 없습니다.')
                    history.go(-1)</script>";
            }
        ?>
</body>
</html>
