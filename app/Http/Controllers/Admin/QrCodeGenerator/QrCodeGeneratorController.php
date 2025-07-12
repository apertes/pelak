<?php

namespace App\Http\Controllers\Admin\QrCodeGenerator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeGeneratorController extends Controller
{
    public function index()
    {
        return view('admin-panel.qr-generator.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start_id' => 'required|integer|min:1',
            'end_id' => 'required|integer|min:1|gte:start_id',
        ], [
            'start_id.required' => 'شماره شروع الزامی است',
            'start_id.integer' => 'شماره شروع باید عدد باشد',
            'start_id.min' => 'شماره شروع باید حداقل 1 باشد',
            'end_id.required' => 'شماره پایان الزامی است',
            'end_id.integer' => 'شماره پایان باید عدد باشد',
            'end_id.min' => 'شماره پایان باید حداقل 1 باشد',
            'end_id.gte' => 'شماره پایان باید بزرگتر یا مساوی شماره شروع باشد',
        ]);

        $startId = $request->input('start_id');
        $endId = $request->input('end_id');
        
        try {
            // ایجاد پوشه موقت برای ذخیره کدهای QR
            $tempDir = storage_path('app/temp/qr-codes-' . time());
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            $qrCodes = [];
            
            for ($id = $startId; $id <= $endId; $id++) {
                // تولید URL برای هر ID
                $publicUrl = url('/tree/' . $id);
                
                // تولید کد QR به صورت SVG
                $qrCodeSvg = QrCode::size(300)
                    ->format('svg')
                    ->generate($publicUrl);
                
                // ذخیره فایل SVG
                $filename = "tree-{$id}.svg";
                $filePath = $tempDir . '/' . $filename;
                file_put_contents($filePath, $qrCodeSvg);
                
                $qrCodes[] = [
                    'id' => $id,
                    'filename' => $filename,
                    'filePath' => $filePath,
                    'url' => $publicUrl
                ];
            }

            // ایجاد فایل ZIP
            $zipFilename = "qr-codes-{$startId}-to-{$endId}.zip";
            $zipPath = $tempDir . '/' . $zipFilename;
            
            $zip = new ZipArchive();
            $zipResult = $zip->open($zipPath, ZipArchive::CREATE);
            
            if ($zipResult === TRUE) {
                foreach ($qrCodes as $qrCode) {
                    if (file_exists($qrCode['filePath'])) {
                        $zip->addFile($qrCode['filePath'], $qrCode['filename']);
                    }
                }
                $zip->close();
            } else {
                return back()->withErrors(['error' => 'خطا در ایجاد فایل ZIP']);
            }

            // بررسی اینکه فایل ZIP ایجاد شده است
            if (!file_exists($zipPath)) {
                return back()->withErrors(['error' => 'خطا در ایجاد فایل ZIP']);
            }

            // حذف فایل‌های موقت SVG (بعد از ایجاد ZIP)
            foreach ($qrCodes as $qrCode) {
                if (file_exists($qrCode['filePath'])) {
                    unlink($qrCode['filePath']);
                }
            }

            // دانلود فایل ZIP
            return response()->download($zipPath)->deleteFileAfterSend();
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'خطا در تولید کدهای QR: ' . $e->getMessage()]);
        }
    }
} 