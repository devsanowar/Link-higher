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
        if ($this->contains($message, ['link building', 'linkbuilding', 'লিঙ্ক বিল্ডিং'])) {
            return $this->linkBuildingReply();
        }

        if ($this->contains($message, ['seo', 'এস ই ইউ', 'SEO', 'search engine optimization'])) {
            return $this->seoReply();
        }

        if ($this->contains($message, ['website', 'Website', 'web design', 'development', 'ওয়েবসাইট', 'ওয়েব ডিজাইন'])) {
            return $this->websiteReply();
        }

        if ($this->contains($message, ['content writing', 'কন্টেন্ট', 'article', 'blog writing', 'content', 'লেখা', 'ব্লগ'])) {
            return $this->contentReply();
        }

        if ($this->contains($message, ['price', 'pricing', 'দাম', 'cost', 'rate', 'charges', 'মূল্য', 'কত', 'ফি', 'কিমান', 'কতটাকা', 'কত টাকা', 'কত খরচ'])) {
            return "Our service pricing varies depending on the type of project. If you’d like, you can request a detailed quote from the 'Live Support' option below. 🙂";
        }

        // 2) Greeting
        if ($this->contains($message, ['hi', 'hello', 'hey', 'হ্যালো', 'সালাম', 'assalamu'])) {
            return "Hello! 👋 We are a web agency and we provide Link Building, SEO, Website Development, and Content Writing services.\n\nWhich service would you like to know about? You can also select from the options above.\n\n";
        }

        // 3) Fallback default
        return "Thank you! 🙂 Could you please write a bit more clearly which service you want to know about?\n\nAvailable services:\n- Link Building\n- SEO Service\n- Website Development\n- Content Writing\n\nOr, if you want to talk directly, you can use the 'Live Support' option avobe.";
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
        return "🔗 *Link Building Service*\n\n- High-authority niche relevant sites\n- White-hat manual outreach\n- DR 30+ / 50+ options\n- Monthly reporting\n\nTo get a detailed quote or a sample report, click the 'Live Support' button to talk with us.";
    }

    private function seoReply(): string
    {
        return "📈 *SEO Service*\n\n- Technical SEO audit\n- On-page optimization\n- Keyword research\n- Monthly performance report\n\nIf you share your website URL, we can provide a free basic SEO review.";
    }

    private function websiteReply(): string
    {
        return "💻 *Website Design & Development*\n\n- Business website\n- Portfolio / agency site\n- Landing pages\n- Laravel / WordPress based solutions\n\nStarting package: basic website from $150+. For more details, please contact us via 'Live Support'.";
    }

    private function contentReply(): string
    {
        return "✍️ *Content Writing Service*\n\n- SEO-optimized blog/article\n- Website content & landing page copy\n- Product descriptions\n\nPer-word / per-article rates vary depending on the content type. For a custom quote, write down your requirements or use the Live Support form.";
    }

}
