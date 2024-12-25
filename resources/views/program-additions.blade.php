@extends('layouts.app')
@section('title')
{{ __('Program additions') }}
@endsection
@section('content')
<section id="app" class=" section-guide">
    <div class="container">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <div class="d-flex justify-content-between  w-100">
                <h4 class="main-heading mb-0">{{ __('site.user manual') }}</h4>
                <a href="https://www.youtube.com/watch?v=qKg3XU5t70Y" target="_blank" class="btn btn-danger btn-sm ">
                    @lang('Watch a video tutorial')
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </div>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            تعرف على برنامج المبيعات (الكاشير )
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            هو برنامج محاسبي سريع يعمل على جميع الانشطة التجارية المقاهي / المطاعم - محلات الملابس ....كل الانشطة التجارية . والبرنامج قابل للتطوير والتعديل ويعمل على الشكبات الداخليه او مباشرة عبر الانترنت
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            المخزون اوالمنتجات ؟
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            يتم اضافة المنتجات عن طريق كتابة اسم المنتج واخيار القسم الخاص بالمنتج وأيضا كتابة سعر الشراء وسعر البيع للمنتج حتى يمكن للبرنامج حساب الأرباح ويمكنك اضافة كمية معينة للمنتج وباركود وتحديد مدة صلاحية المنتج فى حال كان منتج استهلاكى مثلا وسيظهر ذلك فى البرنامج بسهولة للمستخدم لمعرفة حالة المنتجات الموجودة وسيقوم البرنامج أيضا بعمل تقرير مالى لكل منتج من حيث عدد مرات البيع والرصيد الحالى من المنتج وكذلك كميته الافتتاحية .
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapseTwo">
                            العروض
                        </button>
                    </h2>
                    <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            يمكنك اضافة عرض على منتج معين أو سلعة معينة وذلك بتحديد اسم المنتج وتاريخ بداية ونهاية العرض ونسبة الخصم على المنتج وستظهر نسبة الخصم المحددة للمنتج فى شاشة البيع عند وفى حال انتهاء تاريخ العرض المحدد أثناء اضافة العرض لن يظهر الخصم مجددا فى شاشة البيع .
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapseTwo">
                            الباقات
                        </button>
                    </h2>
                    <div id="collapse-4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            يمكنك تفعيلها من الاعدادات من خلال خيار " تفعيل الباقة " وستظهر الباقات فى الناف بار أسفل عنوان الاعدادات ويمكنك حينها اضافة باقة من خلال كتابة اسم الباقة وسعرها والنسبة ومن ثم الذهاب الى " العملاء " واختيار العميل لمراد اضافته للباقة والضغط على تعديل العميل واختيار الباقة ثم حفظ .. تسمح الباقة للعملاء المشتركين فيها باستخدام الرصيد الخاص بها فى عمليات شراء المنتجات فى شاشة البيع من خلال خيار اسمه " استخدام رصيد الباقة " .
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapseTwo">
                            شاشة البيع
                        </button>
                    </h2>
                    <div id="collapse-5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            يتم بداخلها عمليات البيع عن طريق تحديد المنتجات المراد بيعها وكتابة المبلغ المدفوع ومن ثم حفظ الفاتورة .. وأيضا يتوفر خيار تعليق الفاتورة من خلال اختيار عميل محدد ثم تحديد المنتجات والضغط على تعليق الفاتورة حينها ستصبح حالة الفاتورة معلقة لحين الرجوع اليها مرة أخرى وسدادها
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false" aria-controls="collapseTwo">
                            المحاسبة
                        </button>
                    </h2>
                    <div id="collapse-6" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            تتضمن المشتريات والمصروفات حيث يمكن اضافة فواتير لكل منهما وتحديد أقسام للمصروفات وايضا تقارير تشمل العميل والموظف وتعطى انطباع وتقرير شامل عن الحسابات داخل الموقع ويمكن طباعة هذه التقارير أو تصديرها أكسل </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

