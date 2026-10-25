<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MembershipApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Apply for church membership. Never creates or links a Member record: an administrator
     * reviews the application and links the account to an existing record (or creates one).
     */
    public function apply(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->member_id) {
            return response()->json(['message' => 'You are already a linked church member.'], 409);
        }
        if ($user->membershipApplications()->where('status', 'pending')->exists()) {
            return response()->json(['message' => 'You already have a pending application.'], 409);
        }

        $data = $request->validate([
            'congregation' => ['required', 'string', 'max:150'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $application = MembershipApplication::create($data + ['app_user_id' => $user->id]);

        return response()->json(['application' => $this->present($application)], 201);
    }

    public function status(Request $request): JsonResponse
    {
        $user = $request->user();
        $latest = $user->membershipApplications()->latest('id')->first();

        return response()->json([
            'membership_status' => $user->membershipStatus(),
            'member_number' => $user->member?->member_number,
            'application' => $latest ? $this->present($latest) : null,
        ]);
    }

    private function present(MembershipApplication $a): array
    {
        return [
            'id' => $a->id,
            'status' => $a->status,
            'congregation' => $a->congregation,
            'rejection_reason' => $a->status === 'rejected' ? $a->rejection_reason : null,
            'submitted_at' => $a->created_at,
            'reviewed_at' => $a->reviewed_at,
        ];
    }
}
