@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- PAGE HEADER -->

    <div class="text-center mb-12">

        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
            <i data-lucide="message-square" class="w-8 h-8 text-white"></i>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold mb-2">
            Get in Touch
        </h1>

        <p class="text-gray-400 max-w-xl mx-auto">
            Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
        </p>

    </div>


    <div class="grid md:grid-cols-3 gap-6">

        <!-- CONTACT FORM -->

        <div class="md:col-span-2 bg-[#0e1625] border border-gray-800 rounded-2xl p-6">

            <h2 class="text-lg font-semibold mb-6">
                Send us a Message
            </h2>


            <!-- SUCCESS MESSAGE -->

            @if(session('success'))

            <div class="bg-green-500/20 text-green-400 border border-green-500/30 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>

            @endif


            <!-- ERROR MESSAGE -->

            @if ($errors->any())

            <div class="bg-red-500/20 text-red-400 border border-red-500/30 p-3 rounded-lg mb-4">
                <ul class="text-sm list-disc pl-4">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>
            </div>

            @endif


            <!-- FORM -->

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">

                @csrf


                <!-- HONEYPOT CAPTCHA -->

                <div class="hidden">
                    <input type="text" name="website">
                </div>


                <!-- NAME -->

                <div>

                    <label class="text-sm text-gray-400 mb-1 block">
                        Your Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter Your Name"
                        value="{{ old('name') }}"
                        required
                        class="w-full bg-[#111827] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500">

                </div>


                <!-- EMAIL -->

                <div>

                    <label class="text-sm text-gray-400 mb-1 block">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full bg-[#111827] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500">

                </div>


                <!-- SUBJECT -->

                <div>

                    <label class="text-sm text-gray-400 mb-1 block">
                        Subject
                    </label>

                    <select
                        name="subject"
                        required
                        class="w-full bg-[#111827] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500">

                        <option value="">Select a subject</option>

                        <option value="Tournament Issue">
                            Tournament Issue
                        </option>

                        <option value="Organization Support">
                            Organization Support
                        </option>

                        <option value="Player Report">
                            Player Report
                        </option>

                        <option value="Partnership">
                            Partnership / Sponsorship
                        </option>

                        <option value="Other">
                            Other
                        </option>

                    </select>

                </div>


                <!-- MESSAGE -->

                <div>

                    <label class="text-sm text-gray-400 mb-1 block">
                        Message
                    </label>

                    <textarea
                        name="message"
                        rows="5"
                        required
                        class="w-full bg-[#111827] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500"
                        placeholder="Write your message here...">{{ old('message') }}</textarea>

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 transition px-6 py-3 rounded-lg font-semibold text-sm">

                    Send Message

                </button>

            </form>

        </div>


        <!-- CONTACT INFO -->

        <div class="space-y-6">

            <!-- EMAIL CARD -->

            <div class="bg-[#0e1625] border border-gray-800 rounded-2xl p-6">

                <div class="flex items-center gap-3 mb-2">

                    <div class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center">

                        <i data-lucide="mail" class="w-5 h-5 text-blue-400"></i>

                    </div>

                    <div>

                        <p class="font-semibold">
                            Email Us
                        </p>

                        <p class="text-xs text-gray-400">
                            We reply within 24 hours
                        </p>

                    </div>

                </div>

                <p class="text-sm text-blue-400">
                    support@xioarena.com
                </p>

            </div>


            <!-- SOCIAL LINKS -->

            <div class="bg-[#0e1625] border border-gray-800 rounded-2xl p-6">

                <p class="font-semibold mb-4">
                    Follow Us
                </p>

                <!-- DESKTOP VIEW -->

                <div class="hidden md:flex flex-col space-y-3 text-sm text-gray-400">

                    <a href="#" class="flex items-center gap-2 hover:text-white">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                        Instagram
                    </a>

                    <a href="#" class="flex items-center gap-2 hover:text-white">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                        Facebook
                    </a>

                    <a href="#" class="flex items-center gap-2 hover:text-white">
                        <i data-lucide="youtube" class="w-4 h-4"></i>
                        YouTube
                    </a>

                    <a href="#" class="flex items-center gap-2 hover:text-white">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Discord
                    </a>

                </div>


                <!-- MOBILE VIEW BUTTONS -->

                <div class="grid grid-cols-2 gap-3 md:hidden">

                    <a href="#"
                        class="flex items-center justify-center gap-2 bg-[#111827] hover:bg-gray-800 border border-gray-700 rounded-lg py-2 text-sm">

                        <i data-lucide="instagram" class="w-4 h-4"></i>
                        Instagram

                    </a>

                    <a href="#"
                        class="flex items-center justify-center gap-2 bg-[#111827] hover:bg-gray-800 border border-gray-700 rounded-lg py-2 text-sm">

                        <i data-lucide="facebook" class="w-4 h-4"></i>
                        Facebook

                    </a>

                    <a href="#"
                        class="flex items-center justify-center gap-2 bg-[#111827] hover:bg-gray-800 border border-gray-700 rounded-lg py-2 text-sm">

                        <i data-lucide="youtube" class="w-4 h-4"></i>
                        YouTube

                    </a>

                    <a href="#"
                        class="flex items-center justify-center gap-2 bg-[#5865F2] hover:bg-[#4752c4] rounded-lg py-2 text-sm">

                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Discord

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection