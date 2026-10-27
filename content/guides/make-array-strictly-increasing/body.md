## DP over the last value

1. Sort and dedupe `arr2`. `dp = {−∞: 0}`.
2. For each `a` in `arr1`, build `nd` from each `(prev, ops)` in `dp`:
   - If `a > prev`: `nd[a] = min(nd[a], ops)`.
   - `b` = smallest value in `arr2` greater than `prev` (binary search); if it exists, `nd[b] = min(nd[b], ops + 1)`.
3. If `nd` is empty, return −1; else `dp = nd`.
4. Return `min(dp.values())`.

Replacing with the smallest larger value is always best, since a smaller last value never hurts later choices.

`[1,5,3,6,7]` with `[1,3,2,4]` → 1, with `[4,3,1]` → 2, with `[1,6,3,3]` → −1.

Do not decide greedily per index; keeping or replacing can each be right. Do not reuse duplicates of `arr2`; dedupe first.

Time: O(n · m log m)  
Space: O(m)

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
