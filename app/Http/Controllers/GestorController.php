<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Issue;
use App\Models\Role;
use App\Models\UserActivity;
use App\Models\UserIssue;

/*

EL GESTOR DESDE TINKER

Llamar al controlador desde tinker
$controller = app()->make('App\Http\Controllers\GestorController');
$controller = app()->make('App\Http\Controllers\ProductController');
$controller = app()->make('App\Http\Controllers\UserController');

// Obtener actividades por id de proyecto
app()->call([$controller, 'activitiesByProjectId'], ['id' => 2]);

// Obtener proyectos por id de usuario
app()->call([$controller, 'usersByProjectId'], ['id' => 4]);

// Obtener incidencias de usuario
app()->call([$controller, 'issuesByUserId'], ['id' => 4]);

// Añadir actividad
app()->call([$controller, 'addActivity'], ['newactivity' => 'Nueva actividad', 'idproject' => 2 ]);

// Añadir incidencia a actividad
app()->call([$controller, 'addIssue'], ['newissue' => 'Nueva incidencia', 'idactivity' => 4 ]);

// Asignar usuario a proyecto
app()->call([$controller, 'addUserToProject'], ['iduser' => '7', 'idproject' => 2, 'role' => 'participante' ]);

// Asignar usuario a actividad
app()->call([$controller, 'addUserToActivity'], ['iduser' => '7', 'idactivity' => 2, 'roleuser' => 'participante' ]);

// Asignar usuario a incidencia
app()->call([$controller, 'addUserToIssue'], ['iduser' => '7', 'idissue' => 2 ]);

*/


/*

Un usuario puede ser responsable y participante de un proyecto
Un usuario puede ser responsable o participante de una actividad.
Un usuario puede ser asignado a más de una actividad.
Un usuario puede ser asignado a una actividad si es participante del proyecto.
Un usuario puede ser asignado a una incidencia si es responsable de la actividad.

*/

class GestorController extends Controller
{

    public function addActivity($newactivity, $idproject) {

        $activ = new Activity;
        $activ->name = $newactivity; 
        $activ->project_id = $idproject;
        $activ->save();

        return "Saved";

    }

    public function addIssue($newissue, $idactivity) {

        $issue = new Issue;
        $issue->name = $newissue; 
        $issue->activity_id= $idactivity;
        $issue->save();

        return "Saved";
    }

    public function addUserToProject($iduser, $idproject, $roleuser) {

        $rol = new Role;
        $rol->user_id = $iduser; 
        $rol->project_id= $idproject;
        $rol->role=$roleuser;
        $rol->save();
        
        return "Saved";

    }

    public function addUserToActivity($iduser, $idactivity, $roleuser) {
  
        // aquí necesitamos saber a qué proyecto pertenece esta actividad

        $pro = Activity::select('project_id')->find($idactivity);

        $proid=$pro->project_id;

        // comprobar si el usuario participa del proyecto

        $roluser = Role::select('role')->where('project_id' ,'=', $proid)->where('user_id','=',$iduser)->first();
        $rolu=$roluser->role;

        if ($rolu==NULL) {

            return "El usuario no puede asignarse a la actividad.";

        } else {

            $useract = new UserActivity;
            $useract->user_id = $iduser; 
            $useract->activity_id= $idactivity;
            $useract->role=$roleuser;
            $useract->save();
            
            return "Usuario asignado.";

        }

    }

    public function addUserToIssue($iduser, $idissue) {

        // necesitamos saber a qué actividad pertenece esta incidencia

        $act = Issue::select('activity_id')->find($idissue);
        
        $actid=$act->activity_id;
        
        // y su rol en la actividad

        $roluser = UserActivity::select('role')->where('activity_id' ,'=', $actid)->where('user_id','=',$iduser)->first();
        $rolu=$roluser->role;

        if ($rolu!='responsable') {

            return "El usuario no puede asignarse.";

        } else {


            $useriss = new UserIssue;
            $useriss->user_id = $iduser; 
            $useriss->issue_id = $idissue; 
            $useriss->save();
            
            return "Usuario asignado.";

        }


    }


}
