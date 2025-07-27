<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvDownloadController extends Controller
{
    public function export(Request $request)
    {
        $keyword = session('keyword');
        $gender = session('gender');
        $category_id = session('category_id');
        $created_at = session('created_at');
        $contacts = Contact::with('category')
            ->GenderSearch($gender)
            ->CategorySearch($category_id)
            ->DateSearch($created_at)
            ->keywordSearch($keyword)
            ->get();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];
        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                '名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種類', 'お問い合わせ内容'
            ]);
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    ['1' => '男性', '2' => '女性', '3' => 'その他'][$contact->gender],
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                ]);
            }
            fclose($handle);
        };
        return new StreamedResponse($callback, 200, $headers);
    }
}
