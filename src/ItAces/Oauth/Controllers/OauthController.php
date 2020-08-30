<?php

namespace VVK\Oauth\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use VVK\Admin\Controllers\AdminController;
use VVK\Utility\Helper;
use VVK\Web\Fields\FieldContainer;
use VVK\Oauth\Entities\Client;
use VVK\Oauth\Entities\PersonalAccessClient;

class OauthController extends AdminController
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \VVK\Admin\Controllers\AdminController::store($request, $classUrlName, $group)
     */
    public function store(Request $request, string $classUrlName, string $group)
    {
        $className = Helper::classFromUlr($classUrlName);
        
        if ($className != Client::class) {
            return parent::store($request, $classUrlName, $group);
        }
        
        $data = $request->post();
        
        if (array_key_exists('personalAccessClient', $data[$classUrlName]) && $data[$classUrlName]['personalAccessClient']) {
            $request->validate($className::getRequestValidationRules());
            $user = $this->repository->findOrFail(User::class, $data[$classUrlName]['user']);
            $personal = new PersonalAccessClient();
            $client = new Client();
            $client->setName($data[$classUrlName]['name']);
            $client->setUser($user);
            $client->setSecret(Str::random(40));
            $client->setPersonalAccessClient(true);
            $personal->setClient($client);
            
            try {
                $this->repository->em()->persist($personal);
                $this->repository->em()->flush();
            } catch (ValidationException $e) {
                $messages = FieldContainer::exceptionToMessages($e, $classUrlName);
                throw ValidationException::withMessages($messages);
            }
        } else {
            $data[$classUrlName]['secret'] = Str::random(40);
            $this->repository->saveFieldContainer($data, $classUrlName);
        }
        
        $classShortName = (new \ReflectionClass(Client::class))->getShortName();
        $alias = lcfirst($classShortName);
        $url = route('admin.'.$group.'.search', [$classUrlName]);
        
        return redirect($url.'?order[]=-'.$alias.'.createdAt')->with('success', __('Record created successfully.'));
    }

}
