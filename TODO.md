# TODO: Implement Role-Based Routes and Controllers

## Step 1: Update Routes in web.php
- [x] Move data management routes (/jenis-hewan, /ras-hewan, /kategori, /kategori-klinis, /kode-tindakan-terapi, /pemilik, /pet, /role, /user) under ['auth', 'isAdmin'] middleware.

## Step 2: Update Controllers to Use Admin Views
- [x] Update JenisHewanController to return 'admin.jenishewan.index'
- [x] Update RasHewanController to return 'admin.rashewan.index'
- [x] Update KategoriController to return 'admin.datakategori.index'
- [x] Update KategoriKlinisController to return 'admin.datakategoriklinis.index'
- [x] Update KodeTindakanTerapiController to return 'admin.datatindakan.index'
- [x] Update PemilikController to return 'admin.datapemilik.index'
- [x] Update PetController to return 'admin.datapet.index'
- [x] Update RoleController to return 'admin.manajemenrole.index'
- [x] Update UserController to return 'admin.datauser.index'

## Step 3: Verify Implementation
- [x] Test that only admins can access these routes.
- [x] Ensure views load correctly with admin layout.
