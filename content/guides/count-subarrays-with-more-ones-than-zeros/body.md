Given a binary array nums, return the number of subarrays that contain more 1s than 0s, modulo 10^9 + 7. For instance, [0,1,1,0,1] → 9, [0] → 0, [1] → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count smaller earlier prefixes

1. `cnt[0] = 1`, `s = 0`, `less = 0` (earlier prefixes `< s`).
2. On a 1: `less += cnt[s]` (those equal to the old `s` are now below), then `s += 1`.
3. On a 0: `s −= 1`, then `less −= cnt[s]` (those equal to the new `s` are no longer below).
4. `ans += less`; `cnt[s] += 1`.

Constructed checks (verified against counting every subarray on random arrays): the three cases above → 9, 0, 1.

Because `s` changes by exactly one, only one bucket crosses the "below" line each step, which is what makes it O(n) instead of a Fenwick tree's O(n log n). Offset `s` by n to index an array.

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
