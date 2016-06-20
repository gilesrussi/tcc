<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Ausencia;
use App\Curso;
use App\CursoInstituicaoDisciplina;
use App\Disciplina;
use App\Feriado;
use App\Instituicao;
use App\Nota;
use App\Notificacao;
use App\Turma;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
        $minhasTurmas = Auth::user()->turmas()->with('cid.disciplina')->get();
        return view('turma/index', array(
            'minhasTurmas' => $minhasTurmas
        ));
    }

    public function store(Request $request) {
        $input = $request->input();
        if( (int) $input['instituicao'] > 0) {
            $instituicao = Instituicao::find($input['instituicao']);
        } else {
            $instituicao = new Instituicao();
            $instituicao->nome = $input['instituicao'];
            $instituicao->save();
        }
        if( (int) $input['curso'] > 0) {
            $curso = Curso::find($input['curso']);
        } else {
            $curso = new Curso();
            $curso->nome = $input['curso'];
            $curso->save();
        }
        if( (int) $input['disciplina'] > 0) {
            $disciplina = Disciplina::find($input['disciplina']);
        } else {
            $disciplina = new Disciplina();
            $disciplina->nome = $input['disciplina'];
            $disciplina->save();
        }
        $cid = CursoInstituicaoDisciplina::
              where('instituicao_id', $instituicao->id)
            ->where('curso_id', $curso->id)
            ->where('disciplina_id', $disciplina->id)
            ->get()
            ->first();
        if(!$cid) {
            $cid = new CursoInstituicaoDisciplina();
            $cid->instituicao_id = $instituicao->id;
            $cid->curso_id = $curso->id;
            $cid->disciplina_id = $disciplina->id;
            $cid->save();
        }

        $turma = new Turma($request->all());
        $turma->cid()->associate($cid);
        $turma->save();
        $carga_horaria = (int) $input['carga_horaria'];
        $data_inicio = Carbon::parse($input['data_inicio']);
        $data_fim = Carbon::parse($input['data_fim']);
        if($carga_horaria > 0 || $data_inicio->lt($data_fim)) {
            if($carga_horaria == 0) {
                $carga_horaria = 500;
            }
            if($data_inicio->gt($data_fim)) {
                $data_fim->addYear();
            }
            $dia_semana_inicio = $data_inicio->dayOfWeek;
            $temp_data_inicio = $data_inicio->subDays($dia_semana_inicio);
            while ($carga_horaria > 0 && $temp_data_inicio->lt($data_fim)) {
                for ($i = 0; $i < sizeof($input['dia']); $i++) {
                    echo $temp_data_inicio . '<br>';
                    if ($temp_data_inicio->addDays($input['dia'][$i]) >= $data_inicio) {
                        if (Feriado::nao_eh_feriado($temp_data_inicio)) {
                            $aula = Aula::create(array('dia' => $temp_data_inicio, 'horario_inicio' => $input['horario_inicio'][$i], 'horario_fim' => $input['horario_fim'][$i], 'turma_id' => $turma->id));
                            $aula->save();
                            $tempo = Carbon::parse($input['horario_fim'][$i])->diffInMinutes(Carbon::parse($input['horario_inicio'][$i])) / 60;
                            $carga_horaria -= $tempo;
                        }
                    }
                    $temp_data_inicio->subDays($input['dia'][$i]);

                }
                $temp_data_inicio = $temp_data_inicio->addWeek();
            }
        }
        return redirect()->action('TurmaController@show', $turma);

    }

    public function join(Turma $turma) {
        Auth::user()->join($turma);
        return redirect()->action('TurmaController@show', $turma->id);
    }

    public function show(Turma $turma) {
        $aulas = $turma->aulas()->where('dia', '>=', new Carbon('today'))->orderBy('dia')->limit(5)->get();
        $atividades = $turma->atividades()->where('data', '>=', Carbon::now())->orderBy('data')->limit(5)->get();
        $anotacoes = $turma->anotacoes()->orderBy('updated_at', 'desc')->limit(7)->get();
        $minhasFaltas = Ausencia::doUsuarioNaTurma(Auth::user(), $turma)->where('aulas.cancelada', 0)->count();
        $minhasNotas = Nota::doUsuarioNaTurma(Auth::user(), $turma)->sum('nota');
        return view('turma/show', compact('turma', 'minhasFaltas', 'minhasNotas', 'aulas', 'atividades', 'anotacoes'));
    }

    public function find() {
        $instituicoes = Instituicao::lists('nome', 'id');
        $cursos = Curso::lists('nome', 'id');
        $disciplinas = Disciplina::lists('nome', 'id');

        return view('turma/find', array(
            'instituicoes' => $instituicoes,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas
        ));
    }

    public function search(Request $request) {
        return Turma::withFilters($request->instituicao, $request->curso, $request->disciplina)->paginate(10);
    }

    public function create(Request $request) {
        $instituicoes = Instituicao::lists('nome', 'id');
        $cursos = Curso::lists('nome', 'id');
        $disciplinas = Disciplina::lists('nome', 'id');
        $turma = new Turma;
        $turma->instituicao = $request->instituicao;
        $turma->curso = $request->curso;
        $turma->disciplina = $request->disciplina;
        $dias_semana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
        return view('turma/create', array(
            'instituicoes' => $instituicoes,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'turma' => $turma,
            'dias_semana' => $dias_semana,
        ))->withInput($request);
    }

    public function classmates(Turma $turma) {
        $colegas = $turma->participantes()->get();
        return view('turma.classmates', compact('turma', 'colegas'));
    }

    public function leave(Turma $turma) {
        Auth::user()->leave($turma);
        return redirect()->action('TurmaController@show', $turma);
    }

    public function invite(Turma $turma) {
        $amigos = Auth::user()->trueFriends()->get();
        return view('turma.invite', compact('turma', 'amigos'));

    }

    public function inviteFriend(Turma $turma, User $user) {
        $notificacao = new Notificacao();
        $notificacao->mensagem = view('notificacao.templates.convidar_para_turma', array('turma' => $turma, 'sender' => Auth::user()));
        $notificacao->paraPessoa($user);
        return redirect()->action('TurmaController@invite', $turma);
    }
}
