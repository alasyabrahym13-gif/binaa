<?PHP

use App\Http\Controllers\EngineerprofileController;
use Illuminate\Support\Facades\Route;


Route::prefix('engineers')->group(function () {

    // 📥 عرض جميع المهندسين
    Route::get('/', [EngineerProfileController::class, 'index']);

    // 🔍 عرض مهندس واحد
    Route::get('/{id}', [EngineerProfileController::class, 'show']);

    // ➕ إنشاء بروفايل مهندس
    Route::post('/', [EngineerProfileController::class, 'store']);

    // ✏️ تعديل البروفايل
    Route::put('/{id}', [EngineerProfileController::class, 'update']);

    // ❌ حذف (Soft Delete)
    Route::delete('/{id}', [EngineerProfileController::class, 'destroy']);
});