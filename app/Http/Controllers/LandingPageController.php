<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use App\Models\CarouselIndex;
use App\Models\ClientExperience;
use App\Models\Comment;
use App\Models\HeroImages;
use App\Models\AboutUs;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Service;
use App\Models\ContactUs;
use App\Models\Sorotan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class LandingPageController extends Controller
{

    public function index()
    {
        $hero = HeroImages::where('modul', 'index')->first();
        $clientExperience = ClientExperience::latest()->limit(8)->get();
        $carousel = CarouselIndex::latest()->where('status', 'aktif')->get();
        $carouselInActive = CarouselIndex::latest()->where('status', 'nonaktif')->get();
        $carousel = $carousel->merge($carouselInActive);
        $sorotan = Sorotan::latest()->get();
        return view('user.index', compact('hero', 'clientExperience', 'carousel', 'sorotan'));
    }
    public function about()
    {
        $hero = HeroImages::where('modul', 'about')->first();
        $about = AboutUs::first();
        return view('user.about', compact(['hero', 'about']));
    }
    public function service()
    {
        $hero = HeroImages::where('modul', 'service')->first();
        $services = Service::all();
        return view('user.service', compact(['hero', 'services']));
    }

    public function product()
    {
        $hero = HeroImages::where('modul', 'product')->first();
        $kategoriProduk = KategoriProduk::all();
        return view('user.product.index', compact(['hero', 'kategoriProduk']));
    }

    public function blog()
    {
        $hero = HeroImages::where('modul', 'blog')->first();
        $blog = BlogArticle::with(['user'])->latest()->paginate(9);
        return view('user.blog.index', compact(['hero', 'blog']));
    }

    public function loadMorePosts(Request $request)
    {

        $posts = BlogArticle::with('user')->latest()->paginate(9);

        $posts->getCollection()->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug, // Asumsi Anda punya slug untuk URL
                'image_url' => $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/400x250/E9D5FF/3B0764?text=Blog+Post',
                'author_name' => $post->user->name ?? 'Anonim',
                'author_avatar' => 'https://placehold.co/40x40/CFD8DC/78909C?text=' . substr($post->user->name ?? 'A', 0, 1),
                'published_date' => \Carbon\Carbon::parse($post->tanggal)->format('d F Y'),
                'likes' => $post->likes ?? 0,
                'comments' => $post->comments ?? 0,
                'views' => $post->views ?? 0,
            ];
        });

        return response()->json($posts);
    }

    public function showBlog($slug)
    {
        BlogArticle::where('slug', $slug)->increment('views');
        $blog = BlogArticle::where('slug', $slug)->with(['user'])->first();
        $recentPost = BlogArticle::with(['user'])->whereNot('slug', $slug)->latest()->limit(3)->get(); 
        $comments = Comment::where('blog_id', $blog->id)->latest()->get();
        return view('user.blog.show', compact('blog', 'recentPost', 'comments'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function sendContact(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone_number' => 'required|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:1000',
            ]);
            DB::beginTransaction();



            ContactUs::create([
                'tanggal' => date('Y-m-d H:i:s'),
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'message' => $request->message,
                'ip_address' => $request->ip(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih sudah menghubungi kami, tunggu pesan balasan dari kami ya !'
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Error',
                'message' => 'Gagal mengirimkan pesan, silahkan coba lagi !'
            ], 500);
        }
    }

    public function showProduct(Request $request, $slug){
        $product = Produk::where('slug', $slug)->firstOrFail();
        return view('user.product.show', compact('product'));
    }

    public function comment(Request $request){
       
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'comment' => 'required|string|max:1000',
            ]);
            DB::beginTransaction();

            Comment::create([
                'blog_id' => $request->blog_id,
                'tanggal' => now()->format('Y-m-d H:i:s'),
                'nama' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'ip' => $request->ip(),
            ]);
            BlogArticle::where('id', $request->blog_id)->increment('comments');
            DB::commit();

            return response()->json([
                'success' => 'success',
                'message' => 'Terima kasih sudah memberikan komentar !'
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Error',
                'message' => 'Gagal mengirimkan komentar, silahkan coba lagi !'
            ], 500);
        }
    
    }
}
