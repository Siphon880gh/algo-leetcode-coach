## Sliding window

1. Sort; pre = prefix sums.
2. `cost(l, r)` with m = (l + r) / 2: `a[m]·(m − l) − (pre[m] − pre[l]) + (pre[r + 1] − pre[m + 1]) − a[m]·(r − m)`.
3. For each r: while cost(l, r) > k, l += 1; ans = max(ans, r − l + 1).

Examples → 3, 3. Checked against trying every target value on 1,000 random arrays.

The best group is always a contiguous range of the sorted array. k reaches 10^14; use 64-bit.

Time: O(n log n)  
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
