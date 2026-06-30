<div class="border-b last:border-0 pb-3">
    <div class="text-sm font-medium text-gray-800">{{ $comment->author_name }}</div>
    <div class="text-gray-700 whitespace-pre-line">{{ $comment->body }}</div>
    <div class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
</div>
