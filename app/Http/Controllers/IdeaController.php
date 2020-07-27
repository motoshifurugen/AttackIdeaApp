<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Attack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    protected $ATTRIBUTES = ['ノーマル', 'ほのお', 'みず', 'くさ', 'でんき', 'こおり', 'かくとう', 'どく', 'じめん', 'ひこう', 'エスパー', 'むし', 'いわ', 'ゴースト', 'ドラゴン', 'あく', 'はがね', 'フェアリー'];
    protected $REGIONS = ['a'=>'カントー', 'b'=>'ジョウト', 'c'=>'ホウエン', 'd'=>'シンオウ', 'e'=>'イッシュ', 'f'=>'カロス', 'g'=>'アローラ', 'h'=>'ガラル'];

    public function index()
    {
        $user_id = Auth::id(); // ログインユーザIDを取得する
        $user = Auth::user();
        $attacks = Attack::all();
        $query = DB::table('ideas')->where('user_id', $user_id);
        $count = $query->count();

        if (request('attribute')) {
            foreach(request('attribute') as $abute) {
                $query->where('attribute', 'like',  '%' .$abute. '%');
            }
        }

        if (request('region')) {
            $query->whereIn('region', request('region'));
        }

        $ideas = $query->orderBy('created_at', 'desc')->paginate(10);
        $performance = $this->calcPerformance($ideas);

        return view('ideas.index', compact('ideas'), ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS, 'pf'=>$performance, 'user'=>$user, 'count'=>$count, 'attacks'=>$attacks]);
    }

    public function calcPerformance($ideas){
        $ret = [
            'total' => 0
        ];

        foreach($ideas as $idea) {
            if($idea->size >= 0) {
                $ret['total'] += 1;
            }
        }
        return $ret;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attacks = Attack::all();
        return view('ideas.create', ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS, 'attacks'=>$attacks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idea = new Idea();
        var_dump($idea->id);
        $idea->user_id = Auth::id();
        $idea->monster_name = request('monster_name');
        $attribute_array = implode(",", request('attribute'));
        $idea->attribute = $attribute_array;
        $idea->region = request('region');
        $idea->size = request('size');
        $idea->weight = request('weight');

        if()
        $attack = new Attack();
        var_dump($attack->id);
        $attack->attack_name = request('attack_name');
        $attack->attack_description = request('attack_description');

        $idea->save();
        $attack->save();

        $idea_id = $idea->id;
        $attack_id = $attack->id;
        $idea->attacks()->attach(
            ['idea_id' => $idea_id],
            ['attack_id' => $attack_id],
        );

        return redirect('ideas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        $i_id = $idea->id;
        $join = DB::table('attack_idea')->join('ideas', 'attack_idea.idea_id', '=', 'ideas.id')->join('attacks', 'attack_idea.attack_id', '=', 'attacks.id');
        $query = $join->where('idea_id', $i_id);
        // var_dump($idea);
        $ideas = $query->get();
        $attacks = Attack::all();

        return view('ideas.show', compact('ideas', 'attacks'), ['attributes'=>$this->ATTRIBUTES, 'regions'=>$this->REGIONS, ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
