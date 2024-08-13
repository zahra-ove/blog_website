<?php


//namespace App\V1\Documentation\Mobile\Seller\Auth;
//
//use App\V1\InterFaces\Documentation\ConstructInterface;
//use OpenApi\Attributes\Response;
//use OpenApi\Attributes\JsonContent;
//use OpenApi\Attributes\Post;
//use OpenApi\Attributes\Property;
//use OpenApi\Attributes\RequestBody;
//
//class LoginDocument implements ConstructInterface
//{
//    #[Post(
//        path: '/sellers/auth/login',
//        description: 'این سرویس برای ورود فروشندگان میباشد',
//        summary: 'ورود فروشندگان',
//        requestBody: new RequestBody(
//            required: true,
//            content: new JsonContent(
//                required: [
//                    'phone'
//                ],
//                properties: [
//                    new Property(
//                        property: 'phone',
//                        title: 'شماره تلفن همراه کاربر',
//                        type: 'string',
//                        example: '*****'
//                    )
//                ]
//            )
//        ),
//        tags: [
//            'auth'
//        ],
//        responses: [
//            new Response(
//                response: 200,
//                description: 'عملیات با موفقیت انجام شد'
//            ),
//            new Response(
//                response: 404,
//                description: 'شما قبلا ثبت‌نام نکرده‌اید، لطفا ثبت نام کنید'
//            ),
//            new Response(
//                response: 403,
//                description: 'دسترسی غیر مجاز (کاربر مورد نظر جز فروشندگان نمیباشد)'
//            ),
//            new Response(
//                response: 422,
//                description: 'اطلاعات ارسال شده نامعتبر میباشد',
//            ),
//
//        ]
//    )]
//    public function __construct()
//    {
//    }
//}
