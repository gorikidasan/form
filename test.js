var btn_ok = document.getElementById("btn_ok");

btn_ok.addEventListener(
  "click",
  function() {
    window.confirm("実行しますか？", false, "実行確認")
  };
