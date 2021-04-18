const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

                  const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
                  v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
                  )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

                  // do the work...
                  document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                  const table = th.closest('table');
                  Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
                        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                        .forEach(tr => table.appendChild(tr) );
                  })));

// : V2

// REVERSE COLUMN ORDER
function sortTable(table, col, reverse) {
      var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
            tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
            i;
      reverse = -((+reverse) || -1);
      tr = tr.sort(function (a, b) { // sort rows
            return reverse // `-1 *` if want opposite order
                  * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                              .localeCompare(b.cells[col].textContent.trim(), undefined, {numeric: true})
                  );
      });
      for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
}

function makeSortable(table) {
      var th = table.tHead, i;
      th && (th = th.rows[0]) && (th = th.cells);
      if (th) i = th.length;
      else return; // if no `<thead>` then do nothing
      while (--i >= 0) (function (i) {
            var dir = 1;
            th[i].addEventListener('click', function () {
                  sortTable(table, i, (dir = 1 - dir));
                  jQuery(this).find('i').toggleClass('fa-angle-up fa-angle-down');
            });
      }(i));
}

function makeAllSortable(parent) {
      parent = parent || document.body;
      var t = parent.getElementsByTagName('table'), i = t.length;
      while (--i >= 0) makeSortable(t[i]);
}

window.onload = function () {makeAllSortable();};