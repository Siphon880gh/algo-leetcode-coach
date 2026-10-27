## Fix k, then match greedily

1. Sort `nums`.
2. For each `i ≥ 1` with `d = nums[i] − nums[0]` positive and even: `k = d / 2`.
3. Counter of `nums`; for `x` ascending with count left: need `x + 2k` with count left; take both and output `x + k`. Success when n values are produced.

Examples → `[3,7,11]`, `[2,2]`, `[220]`. Checked on random hidden arrays by confirming the output reproduces nums for some k.

The smallest remaining value must be a lower value, so pairing it with `x + 2k` is forced. k must be positive, so `d = 0` is skipped, and odd `d` cannot be `2k`. With n ≤ 1000, up to 2n candidates × O(n log n) is fine.

Time: O(n² log n)  
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
