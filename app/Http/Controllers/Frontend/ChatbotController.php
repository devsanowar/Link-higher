<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    // public function send(Request $request)
    // {
    //     $userMessage = $request->input('message');

    //     // খুব simple rule-based logic
    //     $reply = $this->generateReply($userMessage);

    //     return response()->json([
    //         'reply' => $reply
    //     ]);
    // }

    // private function generateReply($message)
    // {
    //     $text = mb_strtolower($message);

    //     if (str_contains($text, 'hello') || str_contains($text, 'hi')) {
    //         return 'Hello! 😊 কিভাবে সাহায্য করতে পারি?';
    //     }

    //     if (str_contains($text, 'help')) {
    //         return 'আপনি কী ধরনের সাহায্য চান? Order, Account নাকি অন্য কিছু?';
    //     }

    //     if (str_contains($text, 'delivery')) {
    //         return 'Delivary charge $30?';
    //     }

    //     if (str_contains($text, 'thanks') || str_contains($text, 'thank you')) {
    //         return 'আপনাকেও ধন্যবাদ! 💚';
    //     }

    //     // default উত্তর
    //     return 'I am Sorry. Please Contact with our live suport. Click the live chat button and then fill in the gap.? 🙂';
    // }

    public function send(Request $request)
    {
        $message = mb_strtolower($request->input('message'));

        $reply = $this->generateReply($message);

        return response()->json([
            'reply' => $reply,
        ]);
    }

    private function generateReply(string $message): string
    {
        // 1) Specific keyword / intent detect
        if ($this->contains($message, ['link building'])) {
            return $this->linkBuildingReply();
        }

        if ($this->contains($message, ['seo', 'এস্যো', 'এসইও'])) {
            return $this->seoReply();
        }

        if ($this->contains($message, ['website', 'ওয়েবসাইট', 'web design', 'development'])) {
            return $this->websiteReply();
        }

        if ($this->contains($message, ['content writing', 'কন্টেন্ট', 'article'])) {
            return $this->contentReply();
        }

        if ($this->contains($message, ['price', 'pricing', 'দাম', 'cost'])) {
            return "আমাদের সার্ভিসের দাম প্রজেক্টের ধরন অনুযায়ী ভ্যারিয়েশন হয়। আপনি চাইলে নিচের 'লাইভ সাপোর্ট' থেকে ডিটেইল কোট রিকোয়েস্ট করতে পারেন। 🙂";
        }

        // 2) Greeting
        if ($this->contains($message, ['hi', 'hello', 'hey', 'হ্যালো', 'সালাম', 'assalamu'])) {
            return "হ্যালো! 👋 আমরা একটি Web Agency এবং Link Building, SEO, Website Development, আর Content Writing সার্ভিস দেই।\n\nআপনি কোন সার্ভিস সম্পর্কে জানতে চান? উপরের অপশনগুলো থেকেও সিলেক্ট করতে পারেন।";
        }

        // 3) Fallback default
        return "ধন্যবাদ! 🙂 আপনি কোন সার্ভিস সম্পর্কে জানতে চান তা একটু ক্লিয়ার করে লিখবেন?\n\nAvailable services:\n- Link Building\n- SEO Service\n- Website Development\n- Content Writing\n\nঅথবা সরাসরি কথা বলতে নিচের 'লাইভ সাপোর্ট' ব্যবহার করতে পারেন।";
    }

    private function contains(string $message, array $keywords): bool
    {
        foreach ($keywords as $word) {
            if (str_contains($message, mb_strtolower($word))) {
                return true;
            }
        }
        return false;
    }

    private function linkBuildingReply(): string
    {
        return "🔗 *Link Building Service*\n\n- High-authority niche relevant sites\n- White-hat manual outreach\n- DR 30+ / 50+ options\n- Monthly reporting\n\nডিটেইল কোট বা স্যাম্পল রিপোর্ট পেতে 'লাইভ সাপোর্টে কথা বলুন' বাটনে ক্লিক করুন।";
    }

    private function seoReply(): string
    {
        return "📈 *SEO Service*\n\n- Technical SEO Audit\n- On-page optimization\n- Keyword research\n- Monthly performance report\n\nআপনার website URL দিলে আমরা ফ্রি basic SEO review দিতে পারি।";
    }

    private function websiteReply(): string
    {
        return "💻 *Website Design & Development*\n\n- Business website\n- Portfolio / Agency site\n- Landing pages\n- Laravel / WordPress based solutions\n\nস্টার্টিং প্যাকেজ: basic website from ১৫,০০০৳+ ।ডিটেইল জানতে 'লাইভ সাপোর্ট' থেকে কন্টাক্ট করুন।";
    }

    private function contentReply(): string
    {
        return "✍️ *Content Writing Service*\n\n- SEO optimized blog/article\n- Website content & landing page copy\n- Product description\n\nপ্রতি word / per article rate কনটেন্ট টাইপ অনুযায়ী ভ্যারিয়েশন হয়। কাস্টম কোটের জন্য আপনার প্রয়োজন লিখে দিন অথবা লাইভ সাপোর্ট ফর্ম ব্যবহার করুন।";
    }

}
