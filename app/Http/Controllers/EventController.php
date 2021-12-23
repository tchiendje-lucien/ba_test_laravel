<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class EventController extends Controller
{
    public function create_event()
    {
        $id_user = session::get('id_user');
        if (!isset($id_user) || empty($id_user)) {
            return redirect('login');
        } else {
            $select_events = DB::table('evenements')
                ->where('ID_USER', session::get("id_user"))
                ->where('ETAT_EVENT', 1)
                ->get();
            return view(
                'events.create_event',
                [
                    "select_events" => $select_events
                ]
            );
        }
    }

    public function create_agenda()
    {
        $id_user = session::get('id_user');
        if (!isset($id_user) || empty($id_user)) {
            return redirect('login');
        } else {
            $select_events = DB::table('evenements')
                ->where('ID_USER', session::get("id_user"))
                ->get();
            return view(
                'events.agenda',
                [
                    "select_events" => $select_events
                ]
            );
        }
    }

    function verify_input($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    public function store_event(Request $req)
    {
        $title_event = self::verify_input($req->input('title_event'));
        $date_start = self::verify_input($req->input('date_start'));
        $date_end = self::verify_input($req->input('date_end'));
        $desc_event = self::verify_input($req->input('desc_event'));
        $REGEX_DATE = '/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/';

        if (
            !isset($title_event) || empty($title_event) || !isset($date_start) ||
            empty($date_start) || !isset($date_end) || empty($date_end) ||
            !isset($desc_event) || empty($desc_event)
        ) {
            return back()
                ->withInput()
                ->with('error', 'Veillez remplir tous les champs');
        }
        $insert_event = DB::insert(
            'insert into evenements (ID_USER, TITRE_EVENT, DESC_EVENT, ETAT_EVENT, START_EVENT,END_EVENT, DATE_CREATE, DATE_UPDATE)
             values(?,?,?,?,?,?,?,?)',
            [
                session::get('id_user'), $title_event, $desc_event, 1, $date_start, $date_end,
                Carbon::now(), Carbon::now()
            ]
        );
        if ($insert_event) {
            return back()->with('success', "l'evenement a ete ajouter avec susscess !!!");
        } else {
            return back()->with('error', "Une erreure c'est produite lors de l'enregistrement de l'evenement!!! s'il vous plais veillez reessayer");
        }
    }

    public function edit_event(Request $req, $id_event)
    {
        $select_events = DB::table('evenements')
            ->where('ID_EVENT', $id_event)
            ->where('ID_USER', session::get('id_user'))
            ->get();
        return view(
            'events.edit_event',
            [
                "select_events" => $select_events
            ]
        );
    }

    public function update_event(Request $req, $id_event)
    {
        $title_event = self::verify_input($req->input('title_event'));
        $date_start = self::verify_input($req->input('date_start'));
        $date_end = self::verify_input($req->input('date_end'));
        $desc_event = self::verify_input($req->input('desc_event'));

        $req->validate([
            'title_event' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'desc_event' => 'required',
        ]);

        $update_request = DB::update(
            'update evenements set TITRE_EVENT = ?, DESC_EVENT=?, START_EVENT=?, END_EVENT=?, DATE_UPDATE=? where ID_EVENT  = ?',
            [
                $title_event,
                $desc_event,
                $date_start,
                $date_end,
                Carbon::now(),
                $id_event
            ]
        );
        if ($update_request) {
            return redirect('create-event')->with('success', "l'evenement a ete modifier avec susscess !!!");
        } else {
            return back()->with('error', "Une erreure c'est produite lors de la modification de l'evenement!!! s'il vous plais veillez reessayer");
        }
    }

    public function delete_event(Request $req, $id_event)
    {
        $update_request = DB::update(
            'update evenements set ETAT_EVENT = ?, DATE_UPDATE=? where ID_EVENT=?',
            [
                0,
                Carbon::now(),
                $id_event
            ]
        );
        if ($update_request) {
            return back()->with('success', "l'evenement a ete supprimer avec susscess !!!");
        } else {
            return back()->with('error', "Une erreure c'est produite lors de la suppression de l'evenement !!! s'il vous plais veillez reessayer");
        }
    }

    public function active_event($id_event)
    {
        $update_request = DB::update(
            'update evenements set ETAT_EVENT = ?, DATE_UPDATE=? where ID_EVENT=?',
            [
                1,
                Carbon::now(),
                $id_event
            ]
        );
        if ($update_request) {
            return back()->with('success', "l'evenement a ete activer avec susscess !!!");
        } else {
            return back()->with('error', "Une erreure c'est produite lors de l'activation de l'evenement!!! s'il vous plais veillez reessayer");
        }
    }
}
