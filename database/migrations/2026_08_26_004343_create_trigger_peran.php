<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_peran_after_insert');

        DB::unprepared("
            CREATE TRIGGER trg_peran_after_insert
            AFTER INSERT ON model_has_roles
            FOR EACH ROW
            BEGIN
                DECLARE v_nama_peran VARCHAR(125);
                DECLARE v_username   VARCHAR(50);

                SELECT name INTO v_nama_peran
                FROM roles WHERE id = NEW.role_id;

                SELECT username INTO v_username
                FROM users WHERE id = NEW.model_id;

                INSERT INTO log_aktivitas
                    (user_id, aksi, tabel_tujuan, deskripsi, created_at)
                VALUES
                    (NEW.model_id, 'beri_peran', 'model_has_roles',
                    CONCAT('Peran ', COALESCE(v_nama_peran, '-'), 
                           ' ditetapkan untuk pengguna ', 
                           COALESCE(v_username, '-')),
                    NOW());
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_peran_after_insert');
    }
};
