<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Like;
use \App\Models\Hotel;
use \App\Models\Plan;

class SearchController extends Controller
{
    /**
     * 検索ページを表示
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('search.search');
    }

    /**
     * search画面からのリクエストをもらって、
     * 検索結果を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //最低予算,最高予算,場所,利用人数,チェックイン日時,チェックアウト日時,食事,温泉
        $min_budget = $request->min_budget;
        $max_budget = $request->max_budget;
        // $place = $request->place;
        $max_guest = $request->max_guest;
        $genre = $request->genre;
        $check_in = $request->check_in;
        $check_out = $request->check_out;
        $meal = $request->min_budget;
        $hot_spring = $request->min_budget;
        $group_room = $request->group_room;
        $favorites = $request->favorites;
        $stars = $request->stars;
        $reviews = $request->reviews;
        $sort = $request->sort;
        // 評価点 = (お気に入り数 + 1) x (星の数 + 1) x (予約数 + 1)
        $query = Plan::query();
        // dd($query);
        $num_likes = Like::select('hotel_id')
            ->selectRaw('COUNT(hotel_id) as cnt_likes')
            ->groupBy('hotel_id')
            ->pluck('cnt_likes', 'hotel_id');

        $num_stars = Hotel::all(['id', 'sum_stars'])->keyBy('id');

        $num_reservations = Plan::withCount('reservations')
            ->get()
            ->groupBy('hotel_id')
            ->map(function ($plans) {
                return $plans->sum('reservations_count');
            });

        foreach ($num_stars as $hotel_id => $hotel) {
            $numLikes = $num_likes[$hotel_id] ?? 0;
            $numStars = $hotel->sum_stars ?? 0;
            $numReservations = $num_reservations[$hotel_id] ?? 0;
            $rankingPoint[$hotel_id] = ($numLikes + 1) * ($numStars + 1) * ($numReservations + 1);
        }

        if ($min_budget) {
            $query->where('price', '>=', $min_budget);
        }
        if ($max_budget) {
            $query->where('price', '<=', $max_budget);
        }
        if ($max_guest) {
            $query->where('max_guest', ">=",$max_guest);
        }
        if ($genre) {
            $query->whereHas('hotel', function ($q) use ($genre) {
                $q->where('genre', $genre);
            });
        }
        if ($check_in) {
            $query->whereHas('reservations', function ($q) use ($check_in) {
                $q->where('check_in', '>=', $check_in);
            });
        }
        if ($check_out) {
            $query->whereHas('reservations', function ($q) use ($check_in) {
                $q->where('check_out', '>=', $check_in);
            });
        }
        if ($meal) {
            $query->where('meal', $meal);
        }
        if ($hot_spring) {
            $query->whereHas('hotel', function ($q) use ($hot_spring) {
                $q->where('hot_spring', $hot_spring);
            });
        }
        if ($group_room) {
            $query->whereHas('hotel', function ($q) use ($group_room) {
                $q->where('group_room', '>=', $group_room);
            });
        }
        if ($favorites) {
            $hotelIds = collect($num_likes)
                ->filter(fn($count_likes) => $count_likes >= $favorites)
                ->keys()
                ->all();

            if ($hotelIds) {
                $query->whereIn('hotel_id', $hotelIds);
            }
        }

        if ($stars) {
            $hotelIds = $numStars
                ->filter(function ($hotel) use ($stars) {
                    return $hotel->sum_stars >= $stars;
                })
                ->keys()
                ->all();

            if ($hotelIds) {
                $query->whereIn('hotel_id', $hotelIds);
            }
        }
        if ($reviews) {
            $query->whereHas('hotel', function ($q) use ($reviews) {
                $q->where('cnt_contents', '>=', $reviews);
            });
        }

        switch($sort) {
            case 'ランキング順':
                if($rankingPoint) {
                    $sortRanking = collect($rankingPoint)->sortDesc();
                    $caseSQL = "CASE hotel_id";
                    foreach($sortRanking as $hotel_id => $point) {
                        $caseSQL .= " WHEN {$hotel_id} THEN {$point}";
                    }
                    $caseSQL .= " ELSE 0 END";
                    $query->orderByRaw($caseSQL . ' DESC');
                }
                break;
            case '価格が安い順':
                $query->orderBy('price','asc');
                break;
            case '価格が高い順':
                $query->orderBy('price','desc');
                break;
            case '星の数が多い順':
                $query->join('hotels','plans.hotel_id','=','hotels.id')
                ->orderBy('hotels.sum_stars','desc')
                ->select('plans.*');
                break;
            default:
                $query->orderBy('id');
        };
        $ranking = arsort($rankingPoint);
        $data = $query->with('hotel')->with('reservations')->get();
        return view('search.index',[
            'min_budget' => $min_budget,
            'max_budget' => $max_budget,
            // 'place' => $place,
            'max_guest' => $max_guest,
            'genre' => $genre,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'meal' => $meal,
            'hot_spring' => $hot_spring, 
            'group_room' => $group_room,
            'favorites' => $favorites,
            'stars' => $stars,
            'reviews' => $reviews,
            'sort' => $sort,
            'data' => $data,
            'ranking' => $rankingPoint,
            'num_likes' => $num_likes,

        ]);
    }

    /**
     * 検索画面から、プラン詳細画面を表示
     *
     * @return \Illuminate\Http\Response
     */
    public function show_plan($id)
    {
        //
        $plan = \App\Models\Plan::find($id);
        return view('plan.show', ['plan' => $plan]);
    }

    /**
     * プラン詳細画面から、宿詳細画面を表示
     *
     * @return \Illuminate\Http\Response
     */

    public function show_hotel($id)
    {
        return view('hotel', ['id' => $id]);
    }

    /**
     * お気に入り登録
     *
     * @return \Illuminate\Http\Response
     */
    public function create_like(Request $request)
    {
        //
        \Auth::user()->likeHotels()->attach($request->id);
        return back();
    }

    /**
     * お気に入り解除
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy_like($request)
    {
        //
        \Auth::user()->likeHotels()->detach($request->id);
        return back();
    }
}
