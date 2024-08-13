<?php

namespace App\Documentation\V1\Category;

/**
 * @OA\Schema(
 *     schema="Category",
 *     type="object",
 *     title="Category",
 *     required={"id", "name"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the category"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the category"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         type="string",
 *         description="Slug of the category"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation timestamp"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Last update timestamp"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="CategoryResource",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/Category")
 *     }
 * )
 *
 * @OA\Schema(
 *     schema="CategoryCollection",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/CategoryResource")
 * )
 *
 * @OA\Schema(
 *     schema="CategoryStoreRequest",
 *     type="object",
 *     required={"name", "slug"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the category"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         type="string",
 *         description="Slug of the category"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="CategoryUpdateRequest",
 *     type="object",
 *     required={"name", "slug"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the category"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         type="string",
 *         description="Slug of the category"
 *     )
 * )
 */
class CategorySchema
{
    // This class is only for Swagger documentation purposes
}
