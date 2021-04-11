<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\AboutContract;
use App\Services\Contracts\EducationContract;
use App\Services\Contracts\PortfolioConfigContract;
use Constants;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;

class PortfolioController extends Controller
{
    /**
     * @var PortfolioConfigContract
     */
    private $portfolioConfig;

    /**
     * @var AboutContract
     */
    private $about;

    /**
     * @var EducationContract
     */
    private $education;

    /**
     * Create a new instance
     * 
     * @param PortfolioConfigContract $portfolioConfig
     * @param AboutContract $about
     * @param EducationContract $education
     * @return void 
     */
    public function __construct(
        PortfolioConfigContract $portfolioConfig,
        AboutContract $about,
        EducationContract $education
    )
    {
        $this->portfolioConfig = $portfolioConfig;
        $this->about = $about;
        $this->education = $education;
    }

    /**
     * Get configs
     * 
     * @param Request $request 
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $result = $this->portfolioConfig->getAllConfigData();
        } elseif ($request->isMethod('post')) {
            $result = $this->portfolioConfig->setConfigData($request->all());
        }
        
        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * Handle seo request
     * 
     * @param Request $request 
     * @return JsonResponse 
     */
    public function seo(Request $request)
    {
        $result = $this->portfolioConfig->setMetaData($request->all());

        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * Handle about request
     * 
     * @param Request $request 
     * @return JsonResponse 
     */
    public function about(Request $request)
    {
        if ($request->isMethod('get')) {
            $result = $this->about->getAllFields();
        } elseif ($request->isMethod('post')) {
            $result = $this->about->store($request->all());
        }
        
        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * Avatar resource
     * 
     * @param Request $request 
     * @return JsonResponse
     */
    public function avatar(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->about->processUpdateAvatarRequest($request->all());
        } elseif ($request->isMethod('delete')) {
            $result = $this->about->processDeleteAvatarRequest($request->file);
        }

        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * CV resource
     * 
     * @param Request $request 
     * @return JsonResponse
     */
    public function cv(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->about->processUpdateCVRequest($request->all());
        } elseif ($request->isMethod('delete')) {
            $result = $this->about->processDeleteCVRequest($request->file);
        }

        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * Cover resource
     * 
     * @param Request $request 
     * @return JsonResponse
     */
    public function cover(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->about->processUpdateCoverRequest($request->all());
        } elseif ($request->isMethod('delete')) {
            $result = $this->about->processDeleteCoverRequest($request->file);
        }

        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * Get education list
     * 
     * @param Request $request 
     * @return JsonResponse 
     */
    public function educationList(Request $request)
    {
        $result = $this->education->getAllFieldsWithPaginate($request->all());

        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }

    /**
     * Education resource
     * 
     * @param Request $request 
     * @return JsonResponse 
     */
    public function education(Request $request)
    {
        if ($request->isMethod('get')) {
            $result = $this->education->getById($request->id);
        } elseif ($request->isMethod('post')) {
            return response()->json($this->education->store($request->all()));
        } elseif ($request->isMethod('delete')) {
            return response()->json($this->education->deleteByIds($request->ids));
        }

        return response()->json($result, !empty($result['status']) ? $result['status'] : Constants::STATUS_CODE_SUCCESS);
    }
}
