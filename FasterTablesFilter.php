<?php

/**
 * Faster tables filter plugin
 * ===========================
 * Useful when there's way too many tables than it shoud be and Adminer Tables Filter is slow
 *
 * @author Martin Macko, https://github.com/linkedlist
 * @license http://http://opensource.org/licenses/MIT, The MIT License (MIT)
 */
class FasterTablesFilter {

	function tablesPrint($tables) { ?>

  <p class="jsonly"><input id="filter-field">
  <style>
    .select-text {
      margin-right: 5px;
    }
  </style>
  <p id='tables'></p>
  <script type="text/javascript">
  var filterf = function () {
    var spanProto = document.createElement('span');
    var aProto = document.createElement('a');
    var brProto = document.createElement('br');

    function appendTables() {
      var fragment = document.createDocumentFragment();
      var item;
      for (var i = 0, len = tempTables.length; i < len; i++) {
          item = tempTables[i];
          var span = spanProto.cloneNode();

          var aSelect = aProto.cloneNode();
          aSelect.href = hMe+"select="+item;
          aSelect.text = langSelect;
          aSelect.className = "select-text";

          var aName = aProto.cloneNode();
          aName.href = hMe+"table="+item;
          aName.text = item;
          span.appendChild(aSelect);


          span.appendChild(aName);
          var br = brProto.cloneNode();
          span.appendChild(br);
          fragment.appendChild(span);
      }
      tableDiv.appendChild(fragment);
    }

    var tables = [<?php foreach($tables as $table => $type) { echo "'".urlencode($table) ."'". ",";}?>];
    var tempTables = tables;
    var hMe = "<?php echo h(ME) ?>";
    hMe = hMe.replace(/&amp;/g, '&');
    var langSelect = "<?php echo lang('select');?>";


    var filter = document.getElementById("filter-field");
    var tableDiv = document.getElementById("tables");
    filter.onkeyup = function(event) {

      while(tableDiv.firstChild) {
        tableDiv.removeChild(tableDiv.firstChild);
      }

      tempTables = [];
      var value = this.value.toLowerCase();
      var item;
      for (var i = 0, len = tables.length; i < len; i++) {
          item = tables[i];
          if(item.toLowerCase().indexOf(value) > -1) {
            tempTables.push(item);
          }
      }
      appendTables();
    };

    appendTables();
  }
  filterf();
</script>
<?php return true;}} ?>
