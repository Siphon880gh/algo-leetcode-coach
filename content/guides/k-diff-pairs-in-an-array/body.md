## Counter, then look up x + k

Build `cnt` of all values.

- `k == 0`: a pair needs two copies of the same value. Count keys with `cnt[x] >= 2`.
- `k > 0`: for each distinct key `x`, add 1 if `x + k` is a key. Counting only from the smaller end means each pair is seen once.

Sort + two pointers also works: skip duplicates of the left value and move the right pointer to keep the gap at least `k`.

Do not loop over `nums` instead of distinct keys — duplicates would count a pair several times. Do not treat `k == 0` like the general case — every `x` would match itself even with one copy.

Time: O(n)  
Space: O(n)

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
