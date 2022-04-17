<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    { {
            $authUser = $request->user();

            return array_merge(parent::share($request), [
                'permission' => function () use ($authUser) {
                    if (!$authUser) return;

                    return [
                        'users' => [
                            'create' => $authUser->can('create', User::class),
                            'viewAny' => $authUser->can('viewAny', User::class),
                            'view' => $authUser->can('view', User::class),
                            'create' => $authUser->can('create', User::class),
                            'update' => $authUser->can('update', User::class),
                            'delete' => $authUser->can('delete', User::class),
                            'usersExport' => $authUser->can('usersExport', User::class),
                            'editRole' => $authUser->hasRole('admin'),
                        ],

                        'applicants' => [
                            'create' => $authUser->can('create', Applicant::class),
                            'viewAny' => $authUser->can('viewAny', Applicant::class),
                            'view' => $authUser->can('view', Applicant::class),
                            'create' => $authUser->can('create', Applicant::class),
                            'update' => $authUser->can('update', Applicant::class),
                            'delete' => $authUser->can('delete', Applicant::class),
                            'applicantsExport' => $authUser->can('applicantsExport', Applicant::class),
                            'editRole' => $authUser->hasRole('admin'),
                        ],

                        'colleges' => [
                            'create' => $authUser->can('create', College::class),
                            'viewAny' => $authUser->can('viewAny', College::class),
                            'view' => $authUser->can('view', College::class),
                            'create' => $authUser->can('create', College::class),
                            'update' => $authUser->can('update', College::class),
                            'delete' => $authUser->can('delete', College::class),
                            'collegesExport' => $authUser->can('collegesExport', Applicant::class),
                        ],

                        'courses' => [
                            'create' => $authUser->can('create', Course::class),
                            'viewAny' => $authUser->can('viewAny', Course::class),
                            'view' => $authUser->can('view', Course::class),
                            'create' => $authUser->can('create', Course::class),
                            'update' => $authUser->can('update', Course::class),
                            'delete' => $authUser->can('delete', Course::class),
                            'coursesExport' => $authUser->can('coursesExport', Course::class),
                        ],
                    ];
                },
            ]);
        }
    }
}
