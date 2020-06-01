<?php

namespace ItAces\Oauth\Controllers;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Illuminate\Http\Request;
use ItAces\Controllers\WebController;
use ItAces\Repositories\WithJoinsRepository;
use ItAces\Utility\Helper;
use ItAces\Utility\Str;
use ItAces\Web\Fields\FieldContainer;

class OauthController extends WebController
{
    
    /**
     *
     * @var array
     */
    protected $views;

    public function __construct()
    {
        $this->repository = new WithJoinsRepository(true, true);
        $this->views = config('admin.views', []);
    }
    
    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, string $classUrlName)
    {
        $className = Helper::classFromUlr($classUrlName);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $classMetadata = $this->repository->em()->getClassMetadata($className);
        $alias = lcfirst($classShortName);
        $container = new FieldContainer($this->repository->em());
        
        $meta = [
            'class' => $className,
            'title' => __( Str::pluralCamelWords($classShortName) ),
            'classUrlName' => $classUrlName
        ];

        $order = $request->get('order');
        $parameters = [];
        
        if (!$order) {
            $parameters = [
                'order' => ['-'.$alias.'.'.$classMetadata->getSingleIdentifierColumnName()]
            ];
        }

        $paginator = $this->paginate($this->repository->createQuery($className, $parameters, $alias))->appends($request->all());
        $container->buildMetaFields($classMetadata);
        $container->addCollection($paginator->items());

        return view($this->views[$classUrlName]['search'] ?? 'itaces::admin.entity.search', [
            'paginator' => $paginator,
            'container' => $container,
            'meta' => $meta
        ]);
    }
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request, string $classUrlName, $id)
    {
        $className = Helper::classFromUlr($classUrlName);
        $entity = $this->repository->findOrFail($className, $id);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $container = new FieldContainer($this->repository->em());
        $container->addEntity($entity);

        $meta = [
            'class' => $className,
            'title' => __( Str::pluralCamelWords($classShortName, 1) ),
            'classUrlName' => $classUrlName
        ];

        return view($this->views[$classUrlName]['details'] ?? 'itaces::admin.entity.details', [
            'container' => $container,
            'meta' => $meta
        ]);
    }
    
    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, string $classUrlName, $id)
    {
        $className = Helper::classFromUlr($classUrlName);
        $entity = $this->repository->findOrFail($className, $id);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $container = new FieldContainer($this->repository->em());
        $container->addEntity($entity);
        
        $meta = [
            'class' => $className,
            'title' => __( Str::pluralCamelWords($classShortName, 1) ),
            'classUrlName' => $classUrlName
        ];

        return view($this->views[$classUrlName]['edit'] ?? 'itaces::admin.entity.edit', [
            'container' => $container,
            'meta' => $meta,
            'formAction' => route('admin.oauth.update', [$classUrlName, $id])
        ]);
    }
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, string $classUrlName)
    {
        $className = Helper::classFromUlr($classUrlName);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $container = new FieldContainer($this->repository->em());
        $container->addEntity(new $className());
        $meta = [
            'class' => $className,
            'title' => __( Str::pluralCamelWords($classShortName, 1) ),
            'classUrlName' => $classUrlName
        ];

        return view($this->views[$classUrlName]['create'] ?? 'itaces::admin.entity.create', [
            'container' => $container,
            'meta' => $meta,
            'formAction' => route('admin.oauth.store', [$classUrlName])
        ]);
    }
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $classUrlName, $id)
    {
        $className = Helper::classFromUlr($classUrlName);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $alias = lcfirst($classShortName);
        $this->repository->saveFieldContainer($request->post(), $classUrlName);
        $url = route('admin.oauth.search', $classUrlName);
        
        return redirect($url.'?order[]=-'.$alias.'.updatedAt')->with('success', __('Record updated successfully.'));
    }
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $classUrlName)
    {
        $className = Helper::classFromUlr($classUrlName);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $alias = lcfirst($classShortName);
        $this->repository->saveFieldContainer($request->post(), $classUrlName);
        $url = route('admin.oauth.search', $classUrlName);
        
        return redirect($url.'?order[]=-'.$alias.'.createdAt')->with('success', __('Record created successfully.'));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, string $classUrlName, $id)
    {
        $className = Helper::classFromUlr($classUrlName);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $alias = lcfirst($classShortName);
        $url = route('admin.oauth.search', $classUrlName);
        $this->repository->delete($className, $id);
        
        try {
            $this->repository->em()->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            $message = config('app.debug') ? $e->getMessage() : __('Cannot delete or update a parent row');
            return redirect($url.'?order[]=-'.$alias.'.createdAt')->with('warning', $message);
        }
        
        return redirect($url.'?order[]=-'.$alias.'.createdAt')->with('success', __('Record deleted successfully.'));
    }
    
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $classUrlName
     * @return \Illuminate\Http\Response
     */
    public function batchDelete(Request  $request, string $classUrlName)
    {
        $className = Helper::classFromUlr($classUrlName);
        $classShortName = (new \ReflectionClass($className))->getShortName();
        $alias = lcfirst($classShortName);
        $url = route('admin.oauth.search', $classUrlName);
        $selected = $request->post('selected');
        
        if ($selected) {
            $ids = explode(',', $selected);
            
            foreach ($ids as $id) {
                $this->repository->delete($className, $id);
            }
            
            $this->repository->em()->flush();
        }
        
        return redirect($url.'?order[]=-'.$alias.'.createdAt')->with('success', __('Records were successfully deleted.'));
    }

}
