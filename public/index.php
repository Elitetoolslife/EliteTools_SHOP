<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — <?= htmlspecialchars($page_title, ENT_QUOTES) ?></title>

  <!-- Tailwind CSS (alternative modern approach) -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- DataTables & SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <style>
/* ================================
   Base Styles
================================ */
:root {
  --primary-color: #27ae60;
  --secondary-color: #2c3e50;
  --background-color: #f5f7fa;
  --text-color: #4a5568;
  --text-light: #a0aec0;
  --border-color: #e2e8f0;
  --white: #fff;
  --black: #000;
  --shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: var(--text-color);
  background-color: var(--background-color);
}

a {
  color: var(--primary-color);
  text-decoration: none;
  transition: color 0.2s ease;
}

a:hover {
  color: var(--secondary-color);
}

img {
  max-width: 100%;
  height: auto;
}

/* ================================
   Layout
================================ */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1rem;
}

.container-fluid {
  width: 100%;
  padding: 1rem;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.col {
  flex: 1;
  padding: 0.5rem;
}

.col-6 {
  flex: 0 0 50%;
  max-width: 50%;
}

.col-12 {
  flex: 0 0 100%;
  max-width: 100%;
}

.card {
  background-color: var(--white);
  border-radius: 0.5rem;
  box-shadow: var(--shadow);
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

/* ================================
   Typography
================================ */
h1, h2, h3, h4, h5, h6 {
  margin-bottom: 1rem;
  font-weight: 600;
  color: var(--secondary-color);
}

h1 { font-size: 2.5rem; }
h2 { font-size: 2rem; }
h3 { font-size: 1.75rem; }
h4 { font-size: 1.5rem; }
h5 { font-size: 1.25rem; }
h6 { font-size: 1rem; }

p {
  margin-bottom: 1rem;
  color: var(--text-color);
}

small {
  font-size: 0.875rem;
  color: var(--text-light);
}

/* ================================
   Buttons
================================ */
button, .btn {
  display: inline-block;
  padding: 0.75rem 1.25rem;
  font-size: 1rem;
  font-weight: 500;
  text-align: center;
  border: none;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
}

.btn-primary {
  background-color: var(--primary-color);
  color: var(--white);
}

.btn-primary:hover {
  background-color: darken(var(--primary-color), 10%);
}

.btn-secondary {
  background-color: var(--secondary-color);
  color: var(--white);
}

.btn-secondary:hover {
  background-color: darken(var(--secondary-color), 10%);
}

.btn-outline {
  background: none;
  border: 2px solid var(--primary-color);
  color: var(--primary-color);
}

.btn-outline:hover {
  background-color: var(--primary-color);
  color: var(--white);
}

/* ================================
   Forms
================================ */
input, select, textarea {
  display: block;
  width: 100%;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  border: 1px solid var(--border-color);
  border-radius: 0.5rem;
  background-color: var(--white);
  color: var(--text-color);
  transition: box-shadow 0.2s ease, border-color 0.2s ease;
}

input:focus, select:focus, textarea:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 2px rgba(39, 174, 96, 0.2);
  outline: none;
}

label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--text-color);
}

/* ================================
   Tables
================================ */
.table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 1.5rem;
}

.table th, .table td {
  padding: 0.75rem 1rem;
  text-align: left;
  border: 1px solid var(--border-color);
}

.table th {
  background-color: var(--background-color);
  font-weight: 600;
}

.table-striped tr:nth-child(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.table-responsive {
  overflow-x: auto;
}

/* ================================
   Utilities
================================ */
.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

.text-uppercase {
  text-transform: uppercase;
}

.text-muted {
  color: var(--text-light);
}

.mt-1 { margin-top: 0.25rem; }
.mt-2 { margin-top: 0.5rem; }
.mt-3 { margin-top: 1rem; }
.mt-4 { margin-top: 1.5rem; }
.mt-5 { margin-top: 3rem; }

.mb-1 { margin-bottom: 0.25rem; }
.mb-2 { margin-bottom: 0.5rem; }
.mb-3 { margin-bottom: 1rem; }
.mb-4 { margin-bottom: 1.5rem; }
.mb-5 { margin-bottom: 3rem; }

.p-1 { padding: 0.25rem; }
.p-2 { padding: 0.5rem; }
.p-3 { padding: 1rem; }
.p-4 { padding: 1.5rem; }
.p-5 { padding: 3rem; }

/* ================================
   Responsiveness
================================ */
@media (max-width: 768px) {
  .row {
    flex-direction: column;
  }

  .col {
    width: 100%;
  }

  .container {
    padding: 1rem;
  }
}
    body {
      background-color: #f9fafb;
    }

    /* Custom styles for floating button */
    #addBankBtn {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      background-color: #10b981;
      color: white;
      padding: 0.75rem 1.25rem;
      border-radius: 9999px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 576px) {
      #addBankBtn {
        bottom: 1rem;
        right: 1rem;
        padding: 0.5rem 0.75rem;
      }
    }
  </style>
</head>
<body class="font-sans antialiased text-gray-700">

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-semibold"><?= htmlspecialchars($page_title) ?></h1>
      <button id="addBankBtn" class="flex items-center space-x-2">
        <span>Add Bank</span>
      </button>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-6">
    <!-- Toolbar -->
    <section id="bulkToolbar" class="bg-white rounded-lg shadow p-4 flex justify-between items-center mb-6">
      <div class="space-x-3">
        <button id="bulk-add-csv" class="px-4 py-2 bg-gray-200 rounded-lg">Bulk CSV</button>
        <button id="bulk-update" class="px-4 py-2 bg-blue-500 text-white rounded-lg" disabled>Bulk Update</button>
        <button id="bulk-delete" class="px-4 py-2 bg-red-500 text-white rounded-lg" disabled>Bulk Delete</button>
      </div>
      <input type="file" id="csv-file" class="hidden">
    </section>

    <!-- Tabs -->
    <nav class="border-b mb-4">
      <ul class="flex space-x-4">
        <?php foreach ($tabs as $i => $t): ?>
          <li class="<?= $i === 0 ? 'border-b-2 border-green-500' : '' ?>">
            <a href="#" class="px-4 py-2 block text-gray-600 hover:text-green-500">
              <i class="fa <?= htmlspecialchars($t['icon']) ?>"></i>
              <?= htmlspecialchars($t['label']) ?>
              <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm"><?= (int) $counts[$t['id']] ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <!-- Tab Content -->
    <div>
      <?php foreach ($tabs as $i => $t): ?>
        <section id="<?= htmlspecialchars($t['id']) ?>" class="<?= $i === 0 ? 'block' : 'hidden' ?>">
          <div class="overflow-auto bg-white rounded-lg shadow">
            <table id="banksTable-<?= htmlspecialchars($t['id']) ?>" class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th><input type="checkbox" id="select-all-<?= htmlspecialchars($t['id']) ?>"></th>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Website</th>
                  <th>Balance</th>
                  <th>Country</th>
                  <th>Price</th>
                  <th>Seller</th>
                  <th>Date Added</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200"></tbody>
            </table>
          </div>
        </section>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- Offcanvas: Add/Edit Bank -->
  <aside id="bankFormCanvas" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white w-full max-w-lg h-full overflow-y-auto shadow-lg">
      <header class="px-4 py-3 border-b">
        <h2 id="bankFormLabel" class="text-lg font-semibold">Add / Edit Bank</h2>
        <button class="text-gray-500 hover:text-gray-900" data-dismiss="offcanvas">&times;</button>
      </header>
      <div class="p-4">
        <form id="bankForm" class="space-y-4">
          <input type="hidden" id="bankId" name="id">
          <!-- Form Fields -->
          <!-- Similar to the original structure -->
        </form>
      </div>
    </div>
  </aside>

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    // Modernized JS logic
    document.addEventListener('DOMContentLoaded', () => {
      const addBankBtn = document.getElementById('addBankBtn');
      const bankFormCanvas = document.getElementById('bankFormCanvas');

      addBankBtn.addEventListener('click', () => {
        bankFormCanvas.classList.remove('hidden');
      });

      document.querySelector('[data-dismiss="offcanvas"]').addEventListener('click', () => {
        bankFormCanvas.classList.add('hidden');
      });
    });
  </script>
</body>
</html>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>

  <!-- Unified Custom JS -->
  <script>
  (function($) {
    const region = '<?= $region ?>', slug = '<?= $slug ?>';
    let currentStatus = 'all', updateCount = 1, lowHighToggle = true;

    function showToast(type, msg) {
      Swal.fire({ toast:true, position:'top-end', icon:type, title:msg,
        showConfirmButton:false, timer:3000, timerProgressBar:true,
        didOpen(t){ t.addEventListener('mouseenter', Swal.stopTimer); t.addEventListener('mouseleave', Swal.resumeTimer);}
      });
    }

    function updateBalanceAndPrice() {
      const min = lowHighToggle ? 6100 : 5600;
      const max = lowHighToggle ? 35600 : 36240;
      const balance = Math.floor(Math.random() * (max - min + 1)) + min;
      const price   = Math.round(Math.max(balance / 124, 99));

      $('#balance').val(balance);
      $('#hiddenBalance').val(balance);
      $('#price').val(price);
      $('#hiddenPrice').val(price);

      if (++updateCount === 5) {
        lowHighToggle = !lowHighToggle;
        updateCount = 1;
      }
    }

    function initDrag() {
      const btn = $('#addBankBtn')[0];
      let dragging = false, dx=0, dy=0;
      $(btn).on('mousedown', e=>{
        dragging=true; dx=e.clientX-btn.offsetLeft; dy=e.clientY-btn.offsetTop; btn.style.transition='none';
      });
      $(document).on('mousemove', e=>{
        if (dragging) {
          btn.style.left = (e.clientX-dx)+'px';
          btn.style.top  = (e.clientY-dy)+'px';
        }
      }).on('mouseup', ()=>{
        dragging=false; btn.style.transition='';
      });
    }

    function updateBulkButtons() {
      const count = $('.select-bank:checked').length;
      $('#bulk-delete').prop('disabled', !count).text(count ? `Bulk Delete (${count})` : 'Bulk Delete');
      $('#bulk-update').prop('disabled', !count).text(count ? `Bulk Update (${count})` : 'Bulk Update');
    }

    function initTable(status) {
      currentStatus = status;
      const tbl = $(`#banksTable-${status}`);
      if ($.fn.dataTable.isDataTable(tbl)) return tbl.DataTable().ajax.reload();

      tbl.DataTable({
        serverSide:true, processing:true, pageLength:50,
        ajax:{ url:`/admin/banks/${slug}/data`, data:{ status }, cache:true },
        columns:[
          { data:'id', orderable:false, render:id=>`<input type="checkbox" class="select-bank" value="${id}">` },
          { data:'id' },{ data:'acctype' },{ data:'bankname' },{ data:'balance' },
          { data:'country' },{ data:'price' },{ data:'resseller' },{ data:'date_added' },
          { data:null, orderable:false, render:(_,__,r)=>{
              let b='';
              if (['all','available'].includes(status)) {
                b+=`<button class="btn btn-sm btn-primary edit-btn" data-id="${r.id}">Edit</button> `;
                b+=`<button class="btn btn-sm btn-danger delete-btn" data-id="${r.id}">Delete</button>`;
              } else if (status==='sold') {
                b+=`<button class="btn btn-sm btn-info mark-available-btn" data-id="${r.id}">Mark Avail</button> `;
                b+=`<button class="btn btn-sm btn-secondary mark-available-url-btn" data-id="${r.id}">Mark URL</button>`;
              } else if (status==='restore') {
                b+=`<button class="btn btn-sm btn-success restore-btn" data-id="${r.id}">Restore</button>`;
              }
              return b;
            }
          }
        ],
        order:[[1,'desc']],
        initComplete(){
          $(`#select-all-${status}`).off('change').on('change', function(){
            tbl.find('.select-bank').prop('checked',this.checked).trigger('change');
          });
          tbl.on('change','.select-bank', function(){
            $(this).closest('tr').toggleClass('selected-row',this.checked);
            updateBulkButtons();
          });
          updateBulkButtons();
        }
      });
    }

    function doBulk(action, updates=null) {
      const ids = $('.select-bank:checked').map((_,e)=>e.value).get();
      if (!ids.length) return showToast('warning','No rows selected');

      Swal.fire({ title:`Confirm ${action}`, text:`${action} ${ids.length} item(s)?`, icon:'question', showCancelButton:true })
        .then(({isConfirmed})=>{
          if (!isConfirmed) return;
          const payload = { action, ids, ...(action==='update' && updates?{ updates }: {}) };
          $.ajax({
            url:`/admin/banks/${region}/${slug}banks/bulk`,
            type:'POST', contentType:'application/json', data:JSON.stringify(payload),
            success(res){ showToast(res.success?'success':'warning',res.message); initTable(currentStatus); },
            error(){ Swal.fire('Error','Bulk failed','error'); }
          });
        });
    }

    $('#bulk-delete').click(()=> doBulk('delete'));
    $('#bulk-update').click(async()=>{
      const { value } = await Swal.fire({
        title:'Bulk Update',
        html:`<input id="swal-price" class="swal2-input" placeholder="New price">
              <input id="swal-country" class="swal2-input" placeholder="New country">`,
        focusConfirm:false,
        preConfirm:()=>({
          price: parseFloat($('#swal-price').val())||undefined,
          country: $('#swal-country').val()||undefined
        })
      });
      if (!value) return;
      const u={}; if (value.price!=null) u.price=value.price; if (value.country) u.country=value.country;
      if (Object.keys(u).length) doBulk('update',u);
    });

    $('#bulk-add-csv').click(()=>$('#csv-file').click());
    $('#csv-file').change(function(){
      const file=this.files[0]; if (!file) return;
      Swal.fire({ title:'Upload CSV?', text:file.name, icon:'question', showCancelButton:true })
        .then(({isConfirmed})=>{
          if (!isConfirmed) return;
          const fm=new FormData(); fm.append('csv',file);
          $.ajax({
            url:`/admin/banks/${region}/${slug}banks/bulk-add`,
            type:'POST', data:fm, processData:false, contentType:false,
            success(res){
              const msg=res.success?`${res.added} added`:`${res.added} added, ${res.failed.length} failed`;
              Swal.fire({ icon:res.success?'success':'warning', title:msg, timer:2000, showConfirmButton:false });
              console.table(res.failed); initTable(currentStatus);
            },
            error(){ Swal.fire('Error','Upload failed','error'); }
          });
        });
    });

    $('#addBankBtn').click(()=>{
      $('#bankForm')[0].reset(); $('#bankId').val('');
      $('#bankFormLabel').text('Add Bank');
      new bootstrap.Offcanvas($('#bankFormCanvas')).show();
    });

    $(document).on('click','.edit-btn',function(){
      const id=$(this).data('id');
      $.getJSON(`/admin/banks/${region}/${slug}banks/${id}/edit`,({success,data})=>{
        if(!success) return Swal.fire('Error','No data','error');
        $('#bankId').val(data.id);
        $('#bankTypeSelect').val(data.acctype);
        $('#site').val(data.bankname);
        $('#balance').val(data.balance); $('#hiddenBalance').val(data.balance);
        $('#country').val(data.country);
        $('#infos').val(data.infos||'');
        data.infos==='Other'?$('#customInfosWrapper').collapse('show'):$('#customInfosWrapper').collapse('hide');
        $('#customInfos').val(data.custom_infos||'');
        $('#price').val(data.price); $('#hiddenPrice').val(data.price);
        $('#bankFormLabel').text('Edit Bank');
        new bootstrap.Offcanvas($('#bankFormCanvas')).show();
      }).fail(()=>Swal.fire('Error','Fetch failed','error'));
    });

    function handleRowAction(sel,suf,msg){
      $(document).on('click',sel,function(){
        const id=$(this).data('id');
        Swal.fire({title:'Are you sure?',icon:'question',showCancelButton:true})
          .then(({isConfirmed})=>{
            if(!isConfirmed) return;
            $.ajax({
              url:`/admin/banks/${region}/${slug}banks/${id}/${suf}`,
              type:'POST', contentType:'application/json', data:JSON.stringify({id}), dataType:'json'
            }).done(j=>{
              if(j.success){ showToast('success',msg); initTable(currentStatus); }
              else Swal.fire('Error',j.message||'Failed','error');
            });
          });
      });
    }
    handleRowAction('.delete-btn','delete','Deleted');
    handleRowAction('.mark-available-btn','update','Marked available');
    handleRowAction('.mark-available-url-btn','sold','Marked via URL');
    handleRowAction('.restore-btn','restore','Restored');

    $('#bankForm').on('submit',function(e){
      e.preventDefault();
      const data=Object.fromEntries(new FormData(this));
      const isEdit=Boolean(data.id);
      const url=`/admin/banks/${region}/${slug}banks/${isEdit?`${data.id}/update`:'add'}`;
      $.ajax({
        url,type:'POST',contentType:'application/json',
        data:JSON.stringify(data),dataType:'json'
      }).done(res=>{
        if(res.success){
          new bootstrap.Offcanvas($('#bankFormCanvas')).hide();
          showToast('success',isEdit?'Updated':'Added');
          initTable(currentStatus);
        } else Swal.fire('Error',res.message||'Save failed','error');
      }).fail(()=>Swal.fire('Error','Save failed','error'));
    });

    $('#infos').on('change',function(){
      $(this).val()==='Other'?$('#customInfosWrapper').collapse('show'):$('#customInfosWrapper').collapse('hide');
    });

    $(function(){
      updateBalanceAndPrice();
      setInterval(updateBalanceAndPrice,1000);
      initDrag();
      initTable('all');
    });

  })(jQuery);
  </script>

</body>
</html>