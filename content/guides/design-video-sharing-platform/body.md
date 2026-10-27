Design a platform holding videos as strings of digits. upload(video) gives the video the smallest unused non-negative id (ids of removed videos become reusable) and returns it. remove(id) deletes a video if it exists. watch(id, start, end) adds one view and returns the substring from start to min(end, length − 1). like(id) and dislike(id) add a like or dislike. getLikesAndDislikes(id) returns [likes, dislikes] and getViews(id) returns the view count. Calls on a missing id return −1 (or the string -1 for watch, and [−1] for the pair), and like/dislike do nothing. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Smallest free id

1. `free` = min-heap, `next = 0`, `videos` = map id → record.
2. `upload`: id = pop `free` if non-empty, else `next++`; store the record.
3. `remove`: if present, delete and push id to `free`.
4. `watch`, `like`, `dislike`, getters: check presence first; `watch` adds a view and slices up to `min(end, len − 1)`.

Constructed check (simulated): upload 123 → 0, upload 456 → 1, remove 0, upload 789 → 0, watch(1, 0, 5) → 456, watch(1, 0, 1) → 45, a like and two dislikes on 1 → [1,2], views of 1 → 2, watch(3, 0, 1) → -1.

Any freed id is smaller than `next`, so preferring the heap is always right.

Time: O(log n) for upload/remove, O(len) for watch  
Space: O(total length)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
