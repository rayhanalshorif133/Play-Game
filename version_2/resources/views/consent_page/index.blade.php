<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div>
    <div class="my-20">
        <img src="{{asset('images/bkash_payment_logo.png')}}" class="w-auto h-16 mx-auto flex" alt="image">
        <h3 class="text-center mx-auto font-bold py-2 text-stone-700 text-xl">স্বাগতম B2M Technologies Ltd.</h3>
        <h3 class="text-center mx-auto font-bold py-2 text-stone-700 text-lg my-2">আপনার সর্বমোট চার্জ  10/= + ভ্যাট</h3>
        {{-- pay now btn --}}
        <div class="flex flex-col sm:flex-row mx-auto justify-center sm:space-x-10 mt-10">
            <a href="#" class="text-gray-50 bg-[#DA196C] py-2 px-4 rounded-lg hover:shadow-md hover:shadow-[#DA196C]">
                <i class="fa fa-money-bill-wave text-white"></i> পেমেন্ট করুন
            </a>
            {{-- cancel --}}
            <a href="{{route('home')}}" class="text-gray-50 bg-[#9f9f9f] py-2 px-4 rounded-lg hover:shadow-md hover:shadow-[#9f9f9f]">
                <i class="fa fa-times text-white"></i> বাতিল করুন
            </a>
        </div>
        <h3 class="text-center mx-auto font-bold py-2 text-gray-700 mt-40">
            যেকোনো সহযোগিতার জন্য আমাদের সাথে যোগাযোগ করুন:
            <a href="tel:+88017xxxxxxxx" class="text-blue-500">88017xxxxxxxx</a>
        </h3>
    </div>
  </div>
</body>
</html>