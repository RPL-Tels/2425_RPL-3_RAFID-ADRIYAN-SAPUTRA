<div class=" fixed  h-full  flex bg-white border dark:bg-[#161A1D] dark:border-[#22272B]  lg:shadow-sm overflow-hidden inset-0 lg:top-16 top-36  lg:inset-x-2 m-auto lg:h-[90%] rounded-t-lg container">
    <div class="hidden lg:flex relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border dark:border-[#22272B]">
        <livewire:chat.chat-list :selectedConversation="$selectedConversation" :query="$query">
    </div>
    <div class="grid   w-full border-l h-full relative overflow-y-auto dark:border-[#22272B]" style="contain:content">
      <livewire:chat.chat-box :selectedConversation="$selectedConversation">
    </div>
</div>
