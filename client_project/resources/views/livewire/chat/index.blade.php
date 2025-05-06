<div class=" fixed  h-full  flex bg-white dark:bg-[#161A1D] border dark:border-[#22272B]  lg:shadow-sm overflow-hidden inset-0 lg:top-16 top-36  lg:inset-x-2 m-auto lg:h-[90%] rounded-t-lg container">
    @section('title', 'Chat-Inbox')
    <div class="relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border dark:border-[#22272B]">
        <livewire:chat.chat-list>
    </div>
    <div class="hidden md:grid w-full border-l h-full relative overflow-y-auto dark:border-[#22272B]" style="contain:content">
        <div class="m-auto text-center justify-center flex flex-col gap-3">
            <h4 class="font-medium text-lg dark:text-white"> Choose a conversation to start chatting </h4>
        </div>
    </div>
</div>
