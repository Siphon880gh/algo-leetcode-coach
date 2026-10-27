## Count floors, not moves

Drop an egg from some floor with `m` moves and `k` eggs left:

- It breaks: the floors below must be solved with `m − 1` moves and `k − 1` eggs.
- It survives: the floors above with `m − 1` moves and `k` eggs.

So `f(m, k) = f(m − 1, k − 1) + f(m − 1, k) + 1`, with `f(0, k) = f(m, 0) = 0`.

Keep a 1-D array `dp[0..k]` and increase `m`:

- for `j` from `k` down to 1: `dp[j] = dp[j − 1] + dp[j] + 1`.
- Stop as soon as `dp[k] ≥ n`; return `m`.

Going down in `j` uses the previous round's `dp[j − 1]`.

The direct DP over (eggs, floors) with a min over every drop floor is O(k · n²), too slow; binary searching the drop floor brings it to O(k · n log n).

Do not drop with binary search on floors alone; with few eggs, a break early leaves too few eggs for the floors below.

Time: O(k · m), m ≤ n  
Space: O(k)

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
